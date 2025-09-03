import requests

BASE_URL = "http://127.0.0.1:5000/predict" 

# Test data
test_cases = [
    {"input_text": "I feel very happy today!", "expected_emotions": ["Happy", "Excited"]},
    {"input_text": "I am stressed about my exams.", "expected_emotions": ["Anxious", "Sad"]},
    {"input_text": "Nothing special, just an average day.", "expected_emotions": ["Neutral"]},
]

def test_emotion_prediction():
    for case in test_cases:
        response = requests.post(BASE_URL, json={"text": case["input_text"]})
        
        assert response.status_code == 200, f"API returned {response.status_code}"
        
        data = response.json()
        
        print(f"Input Text: {case['input_text']}")
        print(f"Predicted Emotion: {data.get('emotion')}")
        print("-" * 50)
        
        assert "emotion" in data, "Response JSON does not contain 'emotion'"
        
        assert data["emotion"], (
            f"Input: {case['input_text']}, "
            f"Returned: {data['emotion']}, "
            f"Expected: {case['expected_emotions']}"
        )
