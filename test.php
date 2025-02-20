<?php 
session_start();
$skill = isset($_GET["skills"]) ? $_GET["skills"] : ''; 

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skill Test</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: #f0f2f5;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            background: #e6e1e1;
            padding: 30px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            background-image: linear-gradient(to top, #d9afd9 0%, #97d9e1 100%);
        }
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        .question {
            margin-bottom: 20px;
        }
        .question p {
            font-weight: bold;
            color: #444;
        }
        .question textarea {
            width: 100%;
            height: 100px;
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
            resize: vertical;
            transition: border-color 0.3s;
        }
        .question textarea:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0,123,255,0.5);
        }
        button {
            display: block;
            width: 100%;
            padding: 12px;
            background: #007bff;
            color: #fff;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            transition: background 0.3s, transform 0.3s;
        }
        button:hover {
            background: #0056b3;
            transform: translateY(-2px);
        }
        button:active {
            transform: translateY(0);
        }
        @media (max-width: 600px) {
            .container {
                padding: 15px;
                margin: 20px;
            }
            button {
                font-size: 14px;
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Skill Test</h2>
        <form id="testForm">
            <input type="hidden" id="user_id" value="<?php echo htmlspecialchars($_SESSION['user_id'], ENT_QUOTES, 'UTF-8'); ?>">
            <div id="questions">
                <!-- Questions will be dynamically loaded here -->
            </div>
            <button type="button" onclick="submitAnswers()">Submit Answers</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        const skill = "<?php echo htmlspecialchars($skill, ENT_QUOTES, 'UTF-8'); ?>";

        if (skill) {
            $.ajax({
                url: 'api/fetch_questions.php',
                type: 'GET',
                data: { skills: skill },
                dataType: 'json',
                success: function(data) {
                    if (data.error) {
                        console.error("Error:", data.error);
                        return;
                    }
                    const questionContainer = $('#questions');
                    questionContainer.empty();
                    $.each(data, function(index, item) {
                        questionContainer.append(`
                            <div class="question">
                                <p>Q${index + 1}: ${item.question}</p>
                                <textarea name="answer[]" data-id="${item.id}" data-skill="${item.skills}" placeholder="Your answer..."></textarea>
                            </div>
                        `);
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching questions:', error);
                }
            });
        } else {
            console.error('No skill selected.');
        }
    });

    function submitAnswers() {
        const user_id_input = $('#user_id');
        if (!user_id_input.length) {
            console.error('User ID input not found.');
            return;
        }
        const user_id = user_id_input.val();

        const formData = new FormData();
        formData.append('user_id', user_id);

        $('textarea').each(function() {
            formData.append('question_id[]', $(this).attr('data-id'));
            formData.append('skill[]', $(this).attr('data-skill'));
            formData.append('user_answer[]', $(this).val());
        });

        if ($('textarea').length === 0) {
            alert('No questions loaded. Please try again.');
            return;
        }

        $.ajax({
            url: 'api/save_answers.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    evaluateAnswers(user_id);
                } else {
                    alert('Failed to submit answers: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('Request Error:', error);
                alert('An error occurred while submitting. Please try again.');
            }
        });
    }

    function evaluateAnswers(user_id) {
        $.ajax({
            url: 'api/run_evaluation.php',
            type: 'POST',
            data: { user_id: user_id },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    alert('Answers evaluated successfully!');
                    window.location.href = 'solution.php';
                } else {
                    alert('Evaluation failed: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('Evaluation Error:', error);
                alert('Error during evaluation. Please try again.');
            }
        });
    }
</script>
</body>
</html>
