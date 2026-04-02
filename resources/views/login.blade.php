<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card p-4 shadow" style="width: 300px;">
            <h3 class="text-center mb-3">Login</h3>

            <form action="/login" method="POST">
                @csrf

                <input type="email" name="email" class="form-control mb-3" placeholder="Email">
                <input type="password" name="password" class="form-control mb-3" placeholder="Password">

                <button class="btn btn-primary w-100">Login</button>
            </form>
        </div>
    </div>

</body>
</html>