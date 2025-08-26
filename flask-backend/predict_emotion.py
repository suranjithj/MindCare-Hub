import re
import joblib
import google.generativeai as genai
from flask import Flask, request, jsonify
from spotify_utils import get_spotify_token, search_spotify_track

app = Flask(__name__)

# Load the ML model
model = joblib.load("random_forest_emotion_model.pkl", mmap_mode='r')
tfidf_vectorizer = joblib.load("tfidf_vectorizer.pkl")

# Gemini API Key
GEMINI_API_KEY = " "
genai.configure(api_key=GEMINI_API_KEY)

def get_songs_from_gemini(emotion):
    prompt = (
        f"Suggest 5 popular English songs that match the mood: {emotion}. "
        "Return in the format:\n1. Song - Artist\n2. Song - Artist\n"
        "3. Song - Artist\n4. Song - Artist\n5. Song - Artist"
    )

    try:
        model = genai.GenerativeModel("models/gemini-2.0-flash-lite-001")
        response = model.generate_content(prompt)
        text = response.text

        songs = []
        for line in text.strip().split("\n"):
            match = re.match(r"\d+\.\s*(.+?)\s*-\s*(.+)", line)
            if match:
                title, artist = match.groups()
                songs.append(f"{title.strip()} - {artist.strip()}")
        return songs
    except Exception as e:
        print("Gemini API Error:", e)
        return []

@app.route("/predict", methods=["POST"])
def predict():
    data = request.get_json()
    text = data.get("text", "").strip()
    if not text:
        return jsonify({"error": "No input text provided"}), 400

    X = tfidf_vectorizer.transform([text])
    predicted_emotion = model.predict(X)[0]

    suggested_songs = get_songs_from_gemini(predicted_emotion)

    if not suggested_songs:
        return jsonify({
            "emotion": predicted_emotion,
            "genre": [],
            "songs": []
        })

    token = get_spotify_token()
    embeds = []
    genres_set = set()  # collect unique genres (1–5)

    for song in suggested_songs:
        track_id = search_spotify_track(song, token)
        genre_list = []

        if track_id:
            import requests
            track_url = f"https://api.spotify.com/v1/tracks/{track_id}"
            headers = {"Authorization": f"Bearer {token}"}
            track_res = requests.get(track_url, headers=headers).json()

            if "artists" in track_res and track_res["artists"]:
                artist_id = track_res["artists"][0]["id"]

                # Fetch artist genres
                artist_url = f"https://api.spotify.com/v1/artists/{artist_id}"
                artist_res = requests.get(artist_url, headers=headers).json()
                artist_genres = artist_res.get("genres", [])

                genre_list = artist_genres[:2]  # take 1–2 per artist
                genres_set.update(genre_list)

        embeds.append({
            "song": song,
            "spotify_url": f"https://open.spotify.com/embed/track/{track_id}" if track_id else None,
            "genres": genre_list
        })

    return jsonify({
        "emotion": predicted_emotion,
        "genre": list(genres_set)[:5],  # return max 5 overall
        "songs": embeds
    })


if __name__ == "__main__":
    app.run(debug=True, port=5000)
