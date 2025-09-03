import requests

BASE_URL = "http://127.0.0.1:5000/predict"

# Test data
test_cases = [
    {"input_text": "I feel very happy today!"},
    {"input_text": "I am stressed about my exams."},
    {"input_text": "Nothing special, just an average day."},
]

def test_mood_prediction_api():
    for case in test_cases:
        response = requests.post(BASE_URL, json={"text": case["input_text"]})
        
        assert response.status_code == 200, f"API returned {response.status_code}"
        
        data = response.json()
        
        # Print inputs and outputs
        print(f"Input Text: {case['input_text']}")
        print(f"Predicted Emotion: {data.get('emotion')}")
        print(f"Genres: {data.get('genre')}")
        print("Songs:")
        for song in data.get("songs", []):
            print(f"  - {song.get('song')} | Spotify: {song.get('spotify_url')} | Genres: {song.get('genres')}")
        print("-" * 50)
        
        assert "emotion" in data, "Response does not contain 'emotion'"
        assert isinstance(data.get("songs"), list), "'songs' should be a list"
        assert len(data.get("songs")) > 0, "No songs returned for the predicted mood"

        for song in data["songs"]:
            assert "song" in song and song["song"], "Each song entry must have 'song' name"
            assert "spotify_url" in song, "Each song entry must have 'spotify_url'"
            assert "genres" in song and isinstance(song["genres"], list), "Each song must have a 'genres' list"
