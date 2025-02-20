<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>General Knowledge Questions</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(120deg, #f6d365 0%, #fda085 100%);
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #444;
        }
        .question {
            background: #f4f4f9;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .question p {
            font-weight: bold;
            color: #555;
        }
        .answer {
            background: #e8f5e9;
            border-left: 4px solid #66bb6a;
            padding: 10px;
            border-radius: 6px;
            margin-top: 10px;
        }
        @media (max-width: 600px) {
            .container {
                padding: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>General Knowledge </h1>
        <div id="questions">
            <!-- Questions will be loaded here by JavaScript -->
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            fetch('api/fetch_gkquestions.php')
                .then(response => response.json())
                .then(data => {
                    const questionContainer = document.getElementById('questions');
                    data.forEach((item, index) => {
                        const questionDiv = document.createElement('div');
                        questionDiv.classList.add('question');
                        questionDiv.innerHTML = `
                            <p>Q${index + 1}: ${item.question}</p>
                            <div class="answer">
                                <strong>Answer:</strong> ${item.answer}
                            </div>
                        `;
                        questionContainer.appendChild(questionDiv);
                    });
                })
                .catch(error => console.error('Error fetching questions:', error));
        });
    </script>
</body>
</html>
