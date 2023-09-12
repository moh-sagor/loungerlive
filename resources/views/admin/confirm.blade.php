<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Email</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        img {
            height: 100px;
            width: 500px;
            filter: drop-shadow(10px 10px 10px rgba(0, 0, 0, 0.39));
        }
    </style>
</head>

<body>
    <div class="text-center">
        <img src="{{ asset('images/loungerlive.png') }}" alt="">
        <h1>Congratulation !</h1>
        <p>Your account has beed created successfully. Please verify Email to continue.</p>

        <a href="http://www.gmail.com/" class="btn btn-primary" target="_blank">Verify Email</a>
    </div>

    <!-- Bootstrap JS (optional, for Bootstrap features) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
