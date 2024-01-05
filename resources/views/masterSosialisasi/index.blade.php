@extends('layout.sidebar')

@section('masterSosialisasiActive', 'active')

@section('content')
    <div class="container">
        @if (Session::has('input_success'))
            <div class="alert alert-success">
                {{ Session::get('input_success') }}
            </div>
        @endif
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Add New
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">New Sub Dept</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form action="{{ @route('masterUsersTafisStore') }}" method="post">
                        @csrf
                        <div class="modal-body">

                            <div class="mb-3">
                                <label for="" class="form-label">NRA</label>
                                <input type="text" class="form-control" name="nra">
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label">Keterangan</label>
                                <input type="text" class="form-control" name="keterangan">
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label">Slides</label>
                                <input type="file" class="form-control" name="slides">
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label">Text to Voice</label>
                                <input type="file" class="form-control" name="text_to_voice">
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label">Video</label>
                                <input type="file" class="form-control" name="video">
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label">Soal</label>
                                <input type="file" class="form-control" name="soal">
                            </div>

                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch"
                                        id="flexSwitchCheckChecked" name="active" value="ENABLED" checked>
                                    <label class="form-check-label" for="flexSwitchCheckChecked">Active</label>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Table --}}
    <div class="container p-2">
        <table class="table table-striped table-hover" style="margin-top: 10px;">
            <thead>
                <tr>
                    <th>NRA</th>
                    <th>Keterangan</th>
                    <th>Materi</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                {{-- @foreach ($tafis_ms_users_hdr as $item)
                    <tr>
                        <td>{{ $item->departemen }}</td>
                        <td>{{ $item->sub_dept }}</td>
                        <td>
                            @if ($item->status == 'ENABLED')
                                <div class="enabled">● Enabled</div>
                            @else
                                <div class="disabled">● Disabled</div>
                            @endif
                        </td>
                        <td>
                            <a href="/masterUsersTafis/destroy/{{ $item->id }}" class="btn btn-danger"><i
                                    class='bx bxs-trash'></i></a>
                        </td>
                    </tr>
                @endforeach --}}
            </tbody>
        </table>
    </div>
    
@endsection
