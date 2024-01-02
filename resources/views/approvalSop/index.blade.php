@extends('layout.sidebar')

@section('approvalSopActive', 'active')

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
                        <h5 class="modal-title" id="exampleModalLabel">New Draft SOP</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form action="{{ @route('approvalSopStore') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">

                            <div class="mb-3">
                                <label for="" class="form-label">NRA</label>
                                <input type="text" class="form-control" name="nra">
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label">Title</label>
                                <input type="text" class="form-control" name="judul_produk">
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label">File Draft</label>
                                <input type="file" class="form-control" name="file_draft">
                            </div>

                            {{-- Sampe File Draft dulu, ubah ke .png lalu simpan ke folder --}}

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
        <table class="table" style="margin-top: 10px;">
            <thead>
                <tr>
                    <th>NRA</th>
                    <th>Judul</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sop_approval_draft as $item)
                    <tr>
                        <td>{{ $item->nra }}</td>
                        <td>{{ $item->judul }}</td>
                        <td>{{ $item->status }}</td>
                        <td>
                            <a href="/approvalSop/download/{{ $item->id }}" target="_blank" class="btn btn-info"><i
                                    class='bx bx-download'></i></a>
                        </td>
                    </tr>
                @endforeach
                <tr>
                </tr>
            </tbody>
        </table>
    </div>

@endsection
