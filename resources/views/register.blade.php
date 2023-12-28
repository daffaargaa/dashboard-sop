<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <div class="wrapper">
        <form action="{{ route('register') }}" method="post">
            @csrf
            <h1>Register</h1>
            @if (Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            @endif
            <div class="input-box">
                <input type="text" name="nik" id="#" placeholder="NIK" required>
                <i class="bx bxs-user"></i>
            </div>
            <div class="input-box">
                <input type="text" name="name" id="#" placeholder="Name" required>
                <i class="bx bxs-user"></i>
            </div>

            <div class="input-box">
                <input type="text" name="inisial" id="#" placeholder="Inisial" required>
                <i class="bx bxs-user"></i>
            </div>

            <div class="input-box">
                <input type="email" placeholder="Email" name="email" required>
                <i class='bx bxs-envelope'></i>
            </div>

            <div class="input-box">
                <input type="password" placeholder="Password" name="password" required>
                <i class="bx bxs-lock-alt"></i>
            </div>

            <div class="input-box">
                <input type="text" placeholder="Dept" name="dept" required>
                <i class='bx bxs-group' ></i>
            </div>

            <button type="submit" class="btn">Register</button>

            <div class="register-link">
                <p>Already have Account? <a href="/login">Login</a></p>
            </div>

        </form>
    </div>
</body>

</html>