<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prep Ace - Mock Interview Portal</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    
    <!-- FontAwesome for Icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    
    <!-- Custom CSS -->
    <style>
        /* Global Styles */
        body {
            font-family: 'Arial', sans-serif;
            background-color: white;
            margin: 0;
            padding: 0;
        }

        /* Navbar */
        .navbar {
            background-image: linear-gradient(to top, #88d3ce 0%, #6e45e2 100%);
            padding: 15px 30px;
        }

        .navbar .container {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            font-size: 26px;
            font-weight: bold;
            color: #000;
        }

        .logo {
            width: 50px;
            height: auto;
            margin-right: 10px;
        }

        /* Sign In Button */
        .btn-signin {
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 25px;
            padding: 8px 20px;
            font-size: 14px;
            font-weight: bold;
            transition: 0.3s;
            box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.2);
        }

        .btn-signin:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        /* Main Layout */
        .container-custom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 87vh;
            padding: 0 10%;
        }

        /* Left Section (Text) */
        .text-section {
            max-width: 50%;
        }

        .text-section h1 {
            font-size: 100px;
            font-weight: bold;
            line-height: 1.0;
            color: #00aaff;
        }

        .text-section p {
            font-size: 16px;
            color: #555;
            margin-top: 10px;
        }

        /* Button Styling */
        .btn-start {
            background: linear-gradient(to right, #ffcc00, #0088ff);
            border: none;
            padding: 12px 24px;
            font-size: 18px;
            color: white;
            border-radius: 50px;
            transition: 0.3s ease-in-out;
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
            box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.2);
        }

        .btn-start:hover {
            opacity: 0.8;
            transform: scale(1.05);
        }

        /* Right Section (Image) */
        .image-section img {
            max-width: 100%;
            height: auto;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container-custom {
                flex-direction: column;
                text-align: center;
                padding: 20px;
            }
            
            .text-section {
                max-width: 100%;
            }

            .text-section h1 {
                font-size: 60px; /* Reduce text size on smaller screens */
            }
            
            .image-section img {
                max-width: 300px;
                margin-top: 20px;
            }
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <div class="d-flex align-items-center">
                <img src="images/logo.png" class="logo img-thumbnail" alt="Logo">
                <a class="navbar-brand" href="#">Prep Ace</a>
            </div>

            <!-- Sign In Button -->
            <button class="btn btn-signin" id="signInButton">Sign In</button>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container-custom">
        <!-- Left: Text Content -->
        <div class="text-section">
            <h1>Prepare, <br> Perform, <br> Perfect!</h1>
            <p>Our Mock Interview Portal is an innovative platform designed to help students prepare for the competitive job market. 
                It provides a seamless way for students to enhance their skills, boost confidence, and get ready for real-world interviews
                 through tailored mock exams and interviews.</p>
            <a href="login.php" class="btn btn-start">Get Started →</a>
        </div>

        <!-- Right: Image -->
        <div class="image-section">
            <img src="images/welcome.png" alt="Mock Interview Portal">
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.getElementById("signInButton").addEventListener("click", function () {
            window.location.href = "login.php"; // Redirect to login page
        });
    </script>

</body>
</html>
