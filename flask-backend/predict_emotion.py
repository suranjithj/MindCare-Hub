import re
import joblib
import google.generativeai as genai
from flask import Flask, request, jsonify
from spotify_utils import get_spotify_token, search_spotify_track

app = Flask(__name__)

# Load the ML model
model = joblib.load("logistic_regression_emotion_model.pkl", mmap_mode='r')

# Gemini API Key
GEMINI_API_KEY = "AIzaSyDVBP9twt6P3Gfk7VSg8oMQXKTinBKkq0s"
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

    predicted_emotion = model.predict([text])[0]
    suggested_songs = get_songs_from_gemini(predicted_emotion)

    if not suggested_songs:
        return jsonify({
            "emotion": predicted_emotion,
            "genre": "unknown",
            "songs": []
        })

    token = get_spotify_token()
    embeds = []
    for song in suggested_songs:
        track_id = search_spotify_track(song, token)
        embeds.append({
            "song": song,
            "spotify_url": f"https://open.spotify.com/embed/track/{track_id}" if track_id else None
        })

    return jsonify({
        "emotion": predicted_emotion,
        "genre": "unknown",
        "songs": embeds
    })

if __name__ == "__main__":
    app.run(debug=True, port=5000)
