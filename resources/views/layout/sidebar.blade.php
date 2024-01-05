<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard SOP</title>

    {{-- Bootstrap CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/style_layout.css') }}">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
</head>

<body>
    <div class="main-container d-flex">
        <div class="sidebar" id="side_nav">
            <div class="header-box px-2 pt-3 pb-4 d-flex justify-content-between">
                <h1 class="fs-4"><span class="bg-white text-dark rounded shadow px-2 me-2">SOP</span> <span
                        class="text-white">Dept</span></h1>
                <button class="btn d-md-none d-block close-btn px-1 py-0 text-white"><i
                        class="fal fa-stream"></i></button>
            </div>

            {{-- Sidebar list --}}
            <ul class="list-unstyled px-2">
                {{-- @yield('sidebar-active') --}}
                <li class="@yield('homeActive')"><a href="/home" class="text-decoration-none px-3 py-2 d-block"><i
                            class="fal fa-home"></i> Home</a>
                </li>

                <li class="@yield('masterUsersTafisActive')"><a href="/masterUsersTafis"
                        class="text-decoration-none px-3 py-2 d-block"><i class='bx bx-cog'></i> Master Users
                        Tafis</a>
                </li>

                <li class="@yield('masterSosialisasiActive')"><a href="/masterSosialisasi"
                        class="text-decoration-none px-3 py-2 d-block"><i class='bx bx-desktop'></i> Master Sosialisasi</a>
                </li>

                <li class="@yield('fppSopActive')"><a href="/fppSop" class="text-decoration-none px-3 py-2 d-block"><i
                            class="fal fa-list"></i>
                        FPP SOP</a></li>

                <li class="@yield('approvalSopActive')"><a href="/approvalSop" class="text-decoration-none px-3 py-2 d-block"><i
                            class='bx bx-calendar-check'></i>
                        Approval SOP</a></li>

            </ul>
            <hr class="h-color mx-2">

        </div>

        {{-- Isi dari konten --}}
        <div class="content">
            <nav class="navbar navbar-expand-md navbar-light bg-light">
                <div class="container-fluid">
                    <div class="d-flex justify-content-between d-md-none d-block">
                        <button class="btn px-1 py-0 open-btn me-2"><i class="fal fa-stream"></i></button>
                        <a class="navbar-brand fs-4" href="#"><span
                                class="bg-dark rounded px-2 py-0 text-white">CL</span></a>

                    </div>
                    <button class="navbar-toggler p-0 border-0" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fal fa-bars"></i>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                        <ul class="navbar-nav mb-2 mb-lg-0 px-4 align-items-center">
                            <li class="nav-item d-flex justify-content-center align-items-center">
                                <h5>
                                    {{ Auth::user()->name }}
                                    {{ Auth::user()->nik }}
                                </h5>
                            </li>
                        </ul>

                        <ul class="navbar-nav mb-2 mb-lg-0">
                            <li class="nav-item">
                                <form action="{{ route('logout') }}" method="post" class="d-flex" role="search">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-secondary" type="submit">Logout</button>
                                </form>
                            </li>

                        </ul>

                    </div>
                </div>
            </nav>

            <div class="dashboard-content px-3 pt-4">
                <h2 class="fs-5">@yield('title-content')</h2>
                @yield('content')
            </div>
        </div>
    </div>


    <script>
        $(".sidebar ul li").on('click', function() {
            $(".sidebar ul li.active").removeClass('active');
            $(this).addClass('active');
        });

        $('.open-btn').on('click', function() {
            $('.sidebar').addClass('active');

        });


        $('.close-btn').on('click', function() {
            $('.sidebar').removeClass('active');

        })
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</body>

</html>
