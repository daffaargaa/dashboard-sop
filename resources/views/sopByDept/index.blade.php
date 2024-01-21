@extends('layout.sidebar')

@section('sopByDeptActive', 'active')

@section('content')
    <div class="container p-2">
        <h3>SOP by Dept</h3>
    </div>
    <div class="container p-2">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>NRA</th>
                    <th>Judul</th>
                    <th>Tgl Release</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sop_by_dept as $item)
                    <tr>
                        <td>{{ $item->nra }}</td>
                        <td>{{ $item->judul }}</td>
                        <td>{{ $item->tgl_release }}</td>
                        <td>
                            <a href="#" class="btn btn-secondary"><i class="bx bx-link-external"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
