from flask import Flask, jsonify, request
import requests
from bs4 import BeautifulSoup
import pymysql
import urllib3
import re

app = Flask(__name__)

# Suppress SSL warnings
urllib3.disable_warnings(urllib3.exceptions.InsecureRequestWarning)

# Database connection
db = pymysql.connect(
    host="localhost",
    user="root",
    password="",
    database="mock_interview",
    charset="utf8mb4"
)
cursor = db.cursor()

# Create table for C questions (change the table name from python_questions to c_questions)
create_table_query = """
CREATE TABLE IF NOT EXISTS c_questions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    question TEXT NOT NULL,
    answer TEXT NOT NULL
);
"""
cursor.execute(create_table_query)
db.commit()

# Base URL for C Questions
base_url = "https://www.indiabix.com/technical/c/arrays/"  # Update as needed

# Define the number of pages to scrape
pages_to_scrape = 4  # Update if more pages exist


def clean_text(text):
    """Cleans text by removing extra spaces, special characters, and unnecessary newlines."""
    text = text.strip()
    text = re.sub(r'\s+', ' ', text)
    text = re.sub(r'\n+', ' ', text)
    text = text.encode('utf-8', 'ignore').decode('utf-8')
    return text


def question_exists(question):
    """Checks if the question already exists in the c_questions table."""
    query = "SELECT COUNT(*) FROM c_questions WHERE question = %s"
    cursor.execute(query, (question,))
    return cursor.fetchone()[0] > 0


def fetch_and_store_questions():
    questions_answers = []

    for page in range(1, pages_to_scrape + 1):
        url = f"{base_url}{page}"
        print(f"Scraping: {url}")

        try:
            response = requests.get(url, verify=False)
            response.raise_for_status()
        except requests.exceptions.RequestException as e:
            print(f"Error fetching {url}: {e}")
            continue

        soup = BeautifulSoup(response.text, "html.parser")
        cards = soup.find_all("div", class_="card-style")

        for card in cards:
            qa_blocks = card.find_all("div", class_="bix-tech-qa")
            for qa in qa_blocks:
                question_div = qa.find("div", class_="bix-td-qtxt table-responsive w-100")
                answer_div = qa.find("div", class_="bix-tbl-answer")

                if question_div and answer_div:
                    question_text = clean_text(question_div.get_text())
                    answer_text = clean_text(answer_div.get_text(separator="\n"))

                    # Insert only if not already in the database
                    if not question_exists(question_text):
                        insert_query = """
                        INSERT INTO c_questions (question, answer)
                        VALUES (%s, %s);
                        """
                        try:
                            cursor.execute(insert_query, (question_text, answer_text))
                            db.commit()
                        except pymysql.MySQLError as e:
                            print(f"Error inserting data: {e}")
                        questions_answers.append({
                            "question": question_text,
                            "answer": answer_text
                        })

    return questions_answers


@app.route('/fetch_c_questions', methods=['GET'])
def fetch_questions_api():
    questions = fetch_and_store_questions()
    return jsonify(questions)


@app.route('/get_c_questions', methods=['GET'])
def get_questions_from_db():
    query = "SELECT question, answer FROM c_questions"  # Fetch from c_questions table
    cursor.execute(query)
    rows = cursor.fetchall()

    results = [{"question": row[0], "answer": row[1]} for row in rows]

    return jsonify(results)


if __name__ == "__main__":
    app.run(debug=True)
