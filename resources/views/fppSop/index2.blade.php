@extends('layout.sidebar')

@section('title', 'FPP SOP')

@section('sidebar-active')
    <li class=""><a href="/home" class="text-decoration-none px-3 py-2 d-block"><i class="fal fa-home"></i> Home</a>
    </li>

    <li class="active"><a href="/fppSop/no-form" class="text-decoration-none px-3 py-2 d-block"><i class="fal fa-list"></i>
            FPP SOP</a></li>
@endsection

@section('content')
    <div class="container p-2">
        <a href="generate-no-form" class="btn btn-primary">Generate</a>
        <table class="table" style="width: 25%; margin-top: 10px;">
            <thead>
                <tr>
                    <th>No. Form</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($no_form as $item)
                    <tr>
                        <td>{{ $item->no_form }}</td>
                        <td>{{ $item->tanggal }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
