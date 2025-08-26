import requests
import base64
import os

SPOTIFY_CLIENT_ID = " "
SPOTIFY_CLIENT_SECRET = " "

def get_spotify_token():
    auth_str = f"{SPOTIFY_CLIENT_ID}:{SPOTIFY_CLIENT_SECRET}"
    b64_auth_str = base64.b64encode(auth_str.encode()).decode()

    headers = {
        "Authorization": f"Basic {b64_auth_str}",
        "Content-Type": "application/x-www-form-urlencoded"
    }

    data = {
        "grant_type": "client_credentials"
    }

    response = requests.post("https://accounts.spotify.com/api/token", headers=headers, data=data)
    response.raise_for_status()
    return response.json()["access_token"]

def search_spotify_track(song_name, token):
    headers = {
        "Authorization": f"Bearer {token}"
    }

    params = {
        "q": song_name,
        "type": "track",
        "limit": 1
    }

    response = requests.get("https://api.spotify.com/v1/search", headers=headers, params=params)
    response.raise_for_status()
    results = response.json()

    tracks = results.get("tracks", {}).get("items", [])
    if tracks:
        return tracks[0]["id"]  # Return track ID
    return None
