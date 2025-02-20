<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Page - Prep Ace</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" /> 
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: url('images/review.bg.jpg') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
        }

        .navbar {
            background-color: rgba(0, 0, 0, 0.7);
            padding: 15px;
        }

        .navbar-brand {
            font-size: 26px;
            font-weight: bold;
            color: white;
        }

        .logo {
            width: 50px;
            margin-right: 10px;
        }

        .review-container {
            max-width: 400px;
            background: rgba(255, 255, 255, 0.85);
            border-radius: 10px;
            padding: 30px;
            text-align: center;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            position: absolute;
            top: 50%;
            left: 50%; /* Center horizontally */
            transform: translate(-50%, -50%); /* Center both horizontally and vertically */
        }

        .review-container h2 {
            font-weight: bold;
            color: #333;
        }

        .stars-container {
            display: flex;
            gap: 8px;
            margin-top: 20px;
            justify-content: center;
        }

        .stars-container i {
            font-size: 40px;
            cursor: pointer;
            color: lightgray;
            transition: 0.3s;
        }

        .stars-container i:hover,
        .stars-container i.active,
        .stars-container i.selected {
            color: #ffcc00;
            transform: scale(1.2);
        }

        .review-text {
            width: 100%;
            height: 120px;
            border-radius: 8px;
            border: 1px solid #ccc;
            padding: 10px;
            font-size: 14px;
            resize: none;
            margin-top: 10px;
        }

        .btn-submit {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            margin-top: 15px;
            transition: 0.3s;
        }

        .btn-submit:hover {
            background-color: #218838;
        }

        @media (max-width: 768px) {
            .review-container {
                position: static;
                width: 90%;
                margin: 30px auto;
                padding: 20px;
                transform: none;
            }
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <img src="images/logo.png" class="logo img-thumbnail" alt="Logo">
                <a class="navbar-brand" href="#">Prep Ace</a>
            </div>
        </div>
    </nav>

    <div class="review-container">
        <h2>We value your Opinion</h2>
        <p>How would you rate your overall experience?</p>

        <div class="stars-container">
            <i class="fa fa-star" data-value="1"></i>
            <i class="fa fa-star" data-value="2"></i>
            <i class="fa fa-star" data-value="3"></i>
            <i class="fa fa-star" data-value="4"></i>
            <i class="fa fa-star" data-value="5"></i>
        </div>

        <textarea class="review-text" placeholder="Kindly take a moment to tell us what you think..."></textarea>
        <button class="btn btn-submit">Submit</button>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const stars = document.querySelectorAll('.stars-container i');

        stars.forEach(star => {
            star.addEventListener('mouseover', function () {
                let value = this.getAttribute('data-value');
                stars.forEach(s => s.classList.remove('active'));
                for (let i = 0; i < value; i++) {
                    stars[i].classList.add('active');
                }
            });

            star.addEventListener('click', function () {
                let value = this.getAttribute('data-value');
                stars.forEach(s => s.classList.remove('selected'));
                for (let i = 0; i < value; i++) {
                    stars[i].classList.add('selected');
                }
            });

            star.addEventListener('mouseleave', function () {
                if (!document.querySelector('.stars-container i.selected')) {
                    stars.forEach(s => s.classList.remove('active'));
                }
            });
        });
    </script>

</body>
</html>