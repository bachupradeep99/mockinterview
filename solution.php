<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Solutions</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-image: linear-gradient(to top, #d5dee7 0%, rgb(226, 227, 232) 0%, #c9ffbf 100%);
            color: #333;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }
        h1 {
            text-align: center;
            color: #444;
            margin-bottom: 20px;
        }
        .question {
            margin-bottom: 20px;
            padding: 15px;
            background: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .question p {
            font-weight: bold;
            color: #555;
        }
        .answer {
            margin: 10px 0;
            padding: 10px;
            border-radius: 6px;
            background: #eef2f3;
            border-left: 4px solid #ccc;
        }
        .correct-answer {
            background-image: linear-gradient(-60deg, #16a085 0%, #f4d03f 100%);
            border-left-color: #66bb6a;
        }
        .user-answer {
            background-image: linear-gradient(to right, #e84d21 0%, #f9d423 100%);
            border-left-color: #ffeb3b;
        }
        .result {
            font-weight: bold;
            padding: 5px 10px;
            border-radius: 4px;
            display: inline-block;
            margin-top: 10px;
        }
        .correct {
            color: #fff;
            background: #4caf50;
        }
        .incorrect {
            color: #fff;
            background: #f44336;
        }
        @media (max-width: 600px) {
            .container {
                padding: 15px;
                margin: 10px;
            }
            .question {
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Test Solutions</h1>
        <div id="solutions">
            <p>Loading solutions...</p>
        </div>
    </div>

    <script>
       $(document).ready(function() {
        $.ajax({
    url: "api/fetch_solution.php", // Path to your PHP file
    method: "GET",
    dataType: "json",
    success: function(response) {
    console.log(response);

    if (response.error) {
        $("#solutions").html(`<p>${response.error}</p>`);
        return;
    }

    let html = "";
    if (response.length > 0) {
        response.forEach(answer => {
            html += `
                <div class="question">
                    <div class="result">
                        <strong>Feedback:</strong> ${answer.feedback}
                    </div>
                    <div class="result ${answer.result === 'Pass' ? 'correct' : 'incorrect'}">
                        <strong>Result:</strong> ${answer.result}
                    </div>
                </div>
            `;
        });
    } else {
        html = "<p>No answers found.</p>";
    }

    $("#solutions").html(html);
},   error: function(xhr, status, error) {
        console.log("AJAX Error: " + error); // Debugging AJAX error
        $("#solutions").html("<p>Failed to load answers.</p>");
    }
});


});

    </script>
</body>
</html> 
