from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.chrome.service import Service
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from webdriver_manager.chrome import ChromeDriverManager
import pandas as pd
import os
import time

PAGE_URL = "https://bot.orimon.ai/?tenantId=d34843a4-a520-41ac-888f-03741b99db77&fullScreenBot=true"

# Test Data
test_cases = [
    {"user_input": "Hello", "expected_keywords": ["hi", "hello", "greetings"]},
    {"user_input": "I feel anxious today", "expected_keywords": ["anxious", "relax", "support"]},
    {"user_input": "How do I book a counseling session?", "expected_keywords": ["appointment", "counselor", "available"]},
]

results = []

# Chrome driver
driver = webdriver.Chrome(service=Service(ChromeDriverManager().install()))
driver.maximize_window()
driver.get(PAGE_URL)
wait = WebDriverWait(driver, 30)

# Click "Start a conversation"
try:
    start_bar = wait.until(
        EC.element_to_be_clickable((By.XPATH, "//div[p[text()='Start a conversation']]"))
    )
    start_bar.click()
    print("Clicked 'Start a conversation'")
    time.sleep(2)
except:
    print("Start bar not found, continuing...")

for case in test_cases:
    try:
        input_box = wait.until(
            EC.element_to_be_clickable((By.ID, "inputComposer"))
        )
        input_box.click()      # focus on the textarea
        input_box.clear()      # clear any prefilled text
        input_box.send_keys(case["user_input"])
        input_box.send_keys(Keys.ENTER)

        # Waiting time for bot response
        time.sleep(15)

        # Grab the latest bot message
        all_messages = driver.find_elements(By.CSS_SELECTOR, ".HoverableWrapper")
        latest_message = all_messages[-1] if all_messages else None

        bot_reply = ""
        if latest_message:
            paragraphs = latest_message.find_elements(By.CSS_SELECTOR, ".bg-botChatBubble p")
            bot_reply = "\n".join([p.text for p in paragraphs])

        passed = any(keyword.lower() in bot_reply.lower() for keyword in case["expected_keywords"])

        results.append({
            "user_input": case["user_input"],
            "bot_reply": bot_reply,
            "expected_keywords": ", ".join(case["expected_keywords"]),
            "test_passed": passed
        })
        print(f"Test case '{case['user_input']}' executed. Passed: {passed}")

    except Exception as e:
        print(f"Error during test case '{case['user_input']}': {e}")
        results.append({
            "user_input": case["user_input"],
            "bot_reply": "",
            "expected_keywords": ", ".join(case["expected_keywords"]),
            "test_passed": False
        })

driver.quit()

os.makedirs("results", exist_ok=True)
df = pd.DataFrame(results)
df.to_csv("results/chatbot_test_results.csv", index=False)
print("Test completed! Results saved in results/chatbot_test_results.csv")
