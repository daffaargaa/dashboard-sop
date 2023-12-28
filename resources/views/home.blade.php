@extends('layout.sidebar')

@section('title-content', 'Home')

@section('sidebar-active')

    <li class="active"><a href="/home" class="text-decoration-none px-3 py-2 d-block"><i class="fal fa-home"></i> Home</a>
    </li>

    <li class=""><a href="/masterUsersTafis" class="text-decoration-none px-3 py-2 d-block"><i class='bx bx-cog' ></i> Master Users Tafis</a>
    </li>

    <li class=""><a href="/fppSop" class="text-decoration-none px-3 py-2 d-block"><i class="fal fa-list"></i>
            FPP SOP</a></li>
@endsection

@section('content')
    <h4>Good Morning, Have a nice day!</h4>
@endsection