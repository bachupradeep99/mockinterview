<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>LOGIN PAGE</title>
    <link rel="stylesheet" href="css/login.css" />
    <style>
        /* Example CSS for sign-up mode */
        main.sign-up-mode .sign-in-form {
            display: none;
        }

        main.sign-up-mode .sign-up-form {
            display: block;
        }
    </style>
</head>

<body>
    <main>
        <div class="box">
            <div class="inner-box">
                <div class="forms-wrap">
                    <!-- Login Form -->
                    <form id="loginForm" method="post" enctype="multipart/form-data" autocomplete="off" class="sign-in-form">
                        <div class="logo">
                            <!-- Add logo here -->
                        </div>

                        <div class="heading">
                            <h2>Welcome Back</h2>
                            <h6>Not registered yet?</h6>
                            <a href="#" class="toggle">Sign up</a>
                        </div>

                        <div class="actual-form">
                            <div class="input-wrap">
                                <input type="email" name="email" minlength="4" class="input-field" autocomplete="off" required />
                                <label>Email</label>
                            </div>

                            <div class="input-wrap">
                                <input type="password" name="password" minlength="4" class="input-field" autocomplete="off" required />
                                <label>Password</label>
                            </div>

                            <input type="submit" value="Sign In" class="sign-btn" />
                        </div>
                    </form>

                    <!-- Register Form -->
                    <form id="registerForm" method="post" enctype="multipart/form-data" autocomplete="off" class="sign-up-form">
                        <div class="logo">
                        </div>

                        <div class="heading">
                            <h2>Get Started</h2>
                            <h6>Already have an account?</h6>
                            <a href="#" class="toggle">Sign in</a>
                        </div>

                        <div class="actual-form">
                            <div class="input-wrap">
                                <input type="text" minlength="2" name="first_name" class="input-field" autocomplete="off" required />
                                <label>First Name</label>
                            </div>

                            <div class="input-wrap">
                                <input type="text" minlength="2" name="last_name" class="input-field" autocomplete="off" required />
                                <label>Last Name</label>
                            </div>

                            <div class="input-wrap">
                                <input type="email" class="input-field" name="email" autocomplete="off" required />
                                <label>Email</label>
                            </div>

                            <div class="input-wrap">
                                <input type="tel" class="input-field" name="mobile" autocomplete="off" required />
                                <label>Mobile</label>
                            </div>

                            <div class="input-wrap">
                                <input type="password" minlength="4" name="password" class="input-field" autocomplete="off" required />
                                <label>Password</label>
                            </div>

                            <div class="input-wrap">
                                <input type="text" class="input-field" name="location" autocomplete="off" required />
                                <label>Location</label>
                            </div>

                          

                            <input type="submit" value="Sign Up" class="sign-btn" />
                        </div>
                    </form>
                </div>

                <div class="carousel">
                    <div class="images-wrapper">
                        <img src="images/login.png" class="image img-1 show" alt="Task Management" />
                    </div>

                    <div class="text-slider">
                        <div class="text-wrap">
                            <div class="text-group">
                                <h2>Streamline Your Tasks</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        const inputs = document.querySelectorAll(".input-field");
        const toggle_btn = document.querySelectorAll(".toggle");
        const main = document.querySelector("main");

        // Handle toggle between sign-in and sign-up
        toggle_btn.forEach((btn) => {
            btn.addEventListener("click", () => {
                main.classList.toggle("sign-up-mode");
            });
        });

       // Register Form Submission
$('#registerForm').on('submit', function (e) {
    e.preventDefault();
    const registerData = new FormData(this);

    $.ajax({
        url: 'api/register.php',
        type: 'POST',
        data: registerData,
        contentType: false,
        processData: false,
        success: function (response) {
            try {
                response = JSON.parse(response);
                if (response.success) {
                    alert(response.message);
                    window.location.href = 'login.php';
                } else {
                    alert(response.message);
                }
            } catch (error) {
                alert('Registration failed. Try again.');
            }
        },
        error: function () {
            alert('Server error. Try again.');
        }
    });
});

// Login Form Submission
$('#loginForm').on('submit', function (e) {
    e.preventDefault();
    const loginData = new FormData(this);

    $.ajax({
        url: 'api/login.php',
        type: 'POST',
        data: loginData,
        contentType: false,
        processData: false,
        success: function (response) {
            try {
                response = JSON.parse(response);
                if (response.success) {
                    alert(response.message);
                    window.location.href = 'home.php';
                } else {
                    alert(response.message);
                }
            } catch (error) {
                alert('Invalid response. Try again.');
            }
        },
        error: function () {
            alert('Server error. Try again.');
        }
    });
});

    </script>
</body>

</html>
