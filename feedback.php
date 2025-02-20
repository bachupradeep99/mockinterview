<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback - Prep Ace</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="mockinterview\css\style.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <style>
        body {
            background-color: #f5f5f5;
        }
        .container {
            max-width: 500px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }
        .star-rating {
            display: flex;
            justify-content: center;
            font-size: 24px;
            color: gray;
        }
        .star-rating i {
            cursor: pointer;
        }
        .star-rating i.active {
            color: gold;
        }
        .submit-btn {
            background-color: #28a745;
            color: white;
        }
    </style>
</head>
<body>

    <div class="container">
        <h3 class="text-center">Prep Ace</h3>
        <hr>
        <h5 class="text-center">We value your Opinion</h5>
        <p class="text-center">How would you rate your overall experience?</p>
        
        <div class="star-rating mb-3">
            <i class="fa fa-star" data-value="1"></i>
            <i class="fa fa-star" data-value="2"></i>
            <i class="fa fa-star" data-value="3"></i>
            <i class="fa fa-star" data-value="4"></i>
            <i class="fa fa-star" data-value="5"></i>
        </div>

        <textarea class="form-control mb-3" placeholder="Kindly take a moment to tell us what you think." rows="4"></textarea>
        <button class="btn submit-btn w-100">Submit</button>
    </div>

    <script>
        const stars = document.querySelectorAll('.star-rating i');
        stars.forEach(star => {
            star.addEventListener('click', function() {
                let rating = this.getAttribute('data-value');
                stars.forEach(s => s.classList.remove('active'));
                for (let i = 0; i < rating; i++) {
                    stars[i].classList.add('active');
                }
            });
        });
    </script>

</body>
</html>
