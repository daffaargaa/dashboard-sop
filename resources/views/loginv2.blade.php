<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="wrapper">
        <form action="{{ route('login') }}" method="post">
            @csrf
            <h1>Login</h1>
            @if (Session::has('error'))
                <div class="alert alert-danger">
                    {{ Session::get('error') }}
                </div>
            @endif
            <div class="input-box">
                <input type="email" name="email" id="#" placeholder="Email" required>
                <i class="bx bxs-user"></i>
            </div>
            <div class="input-box">
                <input type="password" name="password" placeholder="Password" required>
                <i class="bx bxs-lock-alt"></i>
            </div>

            <div class="remember-forgot">
                <label><input type="checkbox"> Remember me</label>
                <a href="#">Forgot password?</a>
            </div>

            <button type="submit" class="btn">Login</button>

            <div class="register-link">
                <p>Don't have an account? <a href="/register">Register</a></p>
            </div>

        </form>
    </div>
</body>

</html>
