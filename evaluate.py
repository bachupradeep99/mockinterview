import cgi
import json
import mysql.connector
from sentence_transformers import SentenceTransformer, util

# Load model once
model = SentenceTransformer('all-mpnet-base-v2')

# Database configuration
DB_CONFIG = {
    'host': 'localhost',
    'user': 'root',
    'password': '',
    'database': 'mock_interview'
}

# Get data from request
form = cgi.FieldStorage()
user_id = form.getvalue("user_id")

def get_correct_answer(question_id, skill):
    """Fetches the correct answer from the skill-specific table."""
    try:
        with mysql.connector.connect(**DB_CONFIG) as conn:
            with conn.cursor() as cursor:
                questions_table = f"{skill}_questions"  # Assuming tables like html_questions, python_questions
                query = f"SELECT answer FROM {questions_table} WHERE id = %s"
                cursor.execute(query, (question_id,))
                result = cursor.fetchone()
                return result[0] if result else None
    except mysql.connector.Error as err:
        return None

def evaluate_answer(user_answer, correct_answer):
    """Evaluates using cosine similarity."""
    try:
        embeddings = model.encode([user_answer, correct_answer])
        similarity = util.cos_sim(embeddings[0], embeddings[1])
        return int(round(similarity.item() * 100))
    except:
        return 0

def get_feedback(score):
    """Returns feedback based on score."""
    if score >= 90:
        return "Excellent!"
    elif score >= 75:
        return "Good!"
    elif score >= 50:
        return "Needs Improvement!"
    else:
        return "Keep trying!"

def process_and_evaluate(user_id):
    """Evaluates all answers for the given user ID."""
    try:
        with mysql.connector.connect(**DB_CONFIG) as conn:
            with conn.cursor() as cursor:
                query = "SELECT question_id, skill, user_answer FROM user_answers WHERE user_id = %s"
                cursor.execute(query, (user_id,))
                user_answers = cursor.fetchall()

                results = []

                if user_answers:
                    for question_id, skill, user_answer in user_answers:
                        correct_answer = get_correct_answer(question_id, skill)
                        if correct_answer:
                            score = evaluate_answer(user_answer, correct_answer)
                            feedback = get_feedback(score)

                            update_query = """
                                UPDATE user_answers 
                                SET score = %s, feedback = %s
                                WHERE user_id = %s AND question_id = %s
                            """
                            cursor.execute(update_query, (score, feedback, user_id, question_id))
                            conn.commit()

                            results.append({
                                "question_id": question_id,
                                "skill": skill,
                                "user_answer": user_answer,
                                "correct_answer": correct_answer,
                                "score": score,
                                "feedback": feedback
                            })
                
                return json.dumps(results)
    except mysql.connector.Error as err:
        return json.dumps({"error": str(err)})

# Return response
print("Content-Type: application/json\n")
print(process_and_evaluate(user_id))
