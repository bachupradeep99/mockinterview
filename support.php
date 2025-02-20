<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Support - Prep Ace</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="mockinterview\css\style.css">

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
        .submit-btn {
            background-color: #17a2b8;
            color: white;
        }
    </style>
</head>
<body>

    <div class="container">
        <h3 class="text-center">Prep Ace</h3>
        <hr>
        <form>
            <div class="mb-3">
                <label class="form-label">Name:</label>
                <input type="text" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email:</label>
                <input type="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Phone Number:</label>
                <input type="tel" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Message:</label>
                <textarea class="form-control" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn submit-btn w-100">Submit</button>
        </form>
    </div>

</body>
</html>
