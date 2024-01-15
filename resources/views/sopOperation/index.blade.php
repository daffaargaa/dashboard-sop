@extends('layout.sidebar')

@section('sopOperationActive', 'active')

@section('content')
    <div class="container p-2">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>NRA</th>
                    <th>Judul</th>
                    <th>Tgl Release</th>
                    {{-- <th>Action</th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach($sop_opr as $item)
                    <tr>
                        <td>{{ $item->nra }}</td>
                        <td>{{ $item->judul }}</td>
                        <td>{{ $item->tgl_release }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection