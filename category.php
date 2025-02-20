<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mock Interview Categories</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            text-align: center;
            padding: 30px;
            border-radius: 20px;
            transition: 0.3s ease-in-out;
            border: none;
            box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.2);
            cursor: pointer;
        }
        .card:hover {
            transform: scale(1.05);
        }
        .icon {
            font-size: 40px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<div class="container my-5">
    <h2 class="text-center mb-4">Select Your Category</h2>
    <div class="row g-4">
        <!-- Technical -->
        <div class="col-md-6 col-lg-4">
            <div class="card bg-info text-white" onclick="location.href='tech.php'">
                <div class="card-body">
                    <i class="bi bi-code-slash icon"></i>
                    <h5 class="card-title">Technical</h5>
                    <p class="card-text">Coding, DSA, Algorithms</p>
                </div>
            </div>
        </div>
        <!-- General Knowledge -->
        <div class="col-md-6 col-lg-4">
            <div class="card bg-primary text-white" onclick="location.href='gk.php'">
                <div class="card-body">
                    <i class="bi bi-globe icon"></i>
                    <h5 class="card-title">General Knowledge</h5>
                    <p class="card-text">Current Affairs, GK Questions</p>
                </div>
            </div>
        </div>
        <!-- HR Round -->
        <div class="col-md-6 col-lg-4">
            <div class="card bg-danger text-white">
                <div class="card-body">
                    <i class="bi bi-people icon"></i>
                    <h5 class="card-title">HR Round</h5>
                    <p class="card-text">Personality, HR Questions</p>
                </div>
            </div>
        </div>
        <!-- Group Discussion -->
        <div class="col-md-6 col-lg-4">
            <div class="card bg-warning text-dark">
                <div class="card-body">
                    <i class="bi bi-chat-dots icon"></i>
                    <h5 class="card-title">Group Discussion</h5>
                    <p class="card-text">Teamwork & Communication</p>
                </div>
            </div>
        </div>
        <!-- Logical Reasoning -->
        <div class="col-md-6 col-lg-4">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <i class="bi bi-lightbulb icon"></i>
                    <h5 class="card-title">Logical Reasoning</h5>
                    <p class="card-text">Puzzles, Patterns, Logical Thinking</p>
                </div>
            </div>
        </div>
        <!-- Arithmetic Aptitude -->
        <div class="col-md-6 col-lg-4">
            <div class="card bg-secondary text-white">
                <div class="card-body">
                    <i class="bi bi-calculator icon"></i>
                    <h5 class="card-title">Arithmetic Aptitude</h5>
                    <p class="card-text">Maths, Problem Solving</p>
                </div>
            </div>
        </div>
        <!-- Verbal Reasoning -->
        <div class="col-md-6 col-lg-4">
            <div class="card bg-dark text-white">
                <div class="card-body">
                    <i class="bi bi-book icon"></i>
                    <h5 class="card-title">Verbal Reasoning</h5>
                    <p class="card-text">Critical Thinking, Logical Deduction</p>
                </div>
            </div>
        </div>
        <!-- Verbal Ability -->
        <div class="col-md-6 col-lg-4">
            <div class="card bg-light text-dark">
                <div class="card-body">
                    <i class="bi bi-chat-square-text icon"></i>
                    <h5 class="card-title">Verbal Ability</h5>
                    <p class="card-text">Grammar, Vocabulary, Comprehension</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
