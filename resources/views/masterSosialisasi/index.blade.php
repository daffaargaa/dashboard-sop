@extends('layout.sidebar')

@section('masterSosialisasiActive', 'active')

@section('content')
    <style>
        .modal-dialog {
            max-width: 70%;
        }

        .modal-dialog-slideout {
            min-height: 100%;
            margin: 0 0 0 auto;
            background: #fff;
        }

        .modal.fade .modal-dialog.modal-dialog-slideout {
            -webkit-transform: translate(100%, 0)scale(1);
            transform: translate(100%, 0)scale(1);
        }

        .modal.fade.show .modal-dialog.modal-dialog-slideout {
            -webkit-transform: translate(0, 0);
            transform: translate(0, 0);
            display: flex;
            align-items: stretch;
            -webkit-box-align: stretch;
            height: 100%;
        }

        .modal.fade.show .modal-dialog.modal-dialog-slideout .modal-body {
            overflow-y: auto;
            overflow-x: hidden;
        }

        .modal-dialog-slideout .modal-content {
            border: 0;
        }

        .modal-dialog-slideout .modal-header,
        .modal-dialog-slideout .modal-footer {
            height: 4rem;
            display: block;
        }
    </style>

    <div class="container">
        @if (Session::has('input_success'))
            <div class="alert alert-success">
                {{ Session::get('input_success') }}
            </div>
        @elseif (Session::has('update_success'))
            <div class="alert alert-success">
                {{ Session::get('update_success') }}
            </div>
        @endif
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#newMateriModal">
            Add New
        </button>

        <!-- Modal Add New-->
        <div class="modal fade" id="newMateriModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-slideout" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title align-right" id="exampleModalLabel">New Materi</h5>

                    </div>
                    <form action="{{ route('masterSosialisasiStore') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            {{-- NRA --}}
                            <div class="row g-3 align-items-center mb-3">
                                <div class="col-md-4">
                                    <label for="" class="col-form-label">NRA</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="nra">
                                </div>
                            </div>

                            {{-- Keterangan --}}
                            <div class="row g-3 align-items-top mb-3">
                                <div class="col-md-4">
                                    <label for="" class="col-form-label">Keterangan</label>
                                </div>
                                <div class="col-md-8">
                                    <textarea name="keterangan" class="form-control"></textarea>
                                </div>
                            </div>

                            {{-- Slides --}}
                            <div class="row g-3 align-items-center mb-3">
                                <div class="col-md-4">
                                    <label for="" class="col-form-label">Slides</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="file" class="form-control" name="slides">
                                </div>
                            </div>

                            {{-- Text-to-voice --}}
                            <div class="row g-3 align-items-center mb-3">
                                <div class="col-md-4">
                                    <label for="" class="col-form-label">Text to Voice</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="file" class="form-control" name="text_to_voice">
                                </div>
                            </div>

                            {{-- Video --}}
                            <div class="row g-3 align-items-center mb-3">
                                <div class="col-md-4">
                                    <label for="" class="col-form-label">Video</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="file" class="form-control" name="video">
                                </div>
                            </div>

                            {{-- Soal --}}
                            <div class="row g-3 align-items-center mb-3">
                                <div class="col-md-4">
                                    <label for="" class="col-form-label">Soal</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="file" class="form-control" name="soal">
                                </div>
                            </div>

                            {{-- Active --}}
                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch"
                                        id="flexSwitchCheckChecked" name="active" value="Enabled" checked>
                                    <label class="form-check-label" for="flexSwitchCheckChecked">Enabled</label>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
                    <th>Active</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ms_sosialisasi as $item)
                    <tr>
                        <td>{{ $item->nra }}</td>
                        <td>{{ $item->keterangan }}</td>
                        <td>
                            @if ($item->file_video)
                                <i class='bx bx-slideshow' style='font-size: 24px;'></i>
                                <i class='bx bx-video' style='font-size: 24px;'></i>
                            @else
                                <i class='bx bx-slideshow' style='font-size: 24px;'></i>
                            @endif
                        </td>
                        <td>
                            @if ($item->status == 'Enabled')
                                <div class="enabled">● Enabled</div>
                            @else
                                <div class="disabled">● Disabled</div>
                            @endif
                        </td>
                        <td>
                            {{-- <a href="/masterSosialisasi/edit/{{ $item->id }}" class="btn btn-outline-secondary"><i
                                    class='bx bxs-edit' style='font-size: 20px;'></i></a> --}}

                            <button class="btn btn-outline-secondary" data-bs-toggle="modal"
                                data-bs-target="#editMateriModal_{{ $item->id }}"><i class="bx bxs-edit"
                                    style='font-size: 20px;'></i></button>

                            <a href="/masterSosialisasi/destroy/{{ $item->id }}" class="btn btn-outline-danger"><i
                                    class='bx bx-trash-alt' style='font-size: 20px; color:red;'></i></a>

                            {{-- Edit Modal --}}
                            <div class="modal fade" id="editMateriModal_{{ $item->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel2" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-slideout" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title align-right" id="exampleModalLabel">Edit Materi</h5>

                                        </div>
                                        <form action="{{ route('masterSosialisasiEdit', ['id' => $item->id]) }}"
                                            method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-body">
                                                {{-- NRA --}}
                                                <div class="row g-3 align-items-center mb-3">
                                                    <div class="col-md-4">
                                                        <label for="" class="col-form-label">NRA</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="text" class="form-control" name="nra"
                                                            value={{ $item->nra }}>
                                                    </div>
                                                </div>

                                                {{-- Keterangan --}}
                                                <div class="row g-3 align-items-top mb-3">
                                                    <div class="col-md-4">
                                                        <label for="" class="col-form-label">Keterangan</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <textarea name="keterangan" class="form-control">{{ $item->keterangan }}</textarea>
                                                    </div>
                                                </div>

                                                {{-- Slides --}}
                                                <div class="row g-3 align-items-center mb-3">
                                                    <div class="col-md-4">
                                                        <label for="" class="col-form-label">Slides</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="file" class="form-control" name="slides">
                                                    </div>
                                                </div>

                                                {{-- Text-to-voice --}}
                                                <div class="row g-3 align-items-center mb-3">
                                                    <div class="col-md-4">
                                                        <label for="" class="col-form-label">Text to Voice</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="file" class="form-control" name="text_to_voice">
                                                    </div>
                                                </div>

                                                {{-- Video --}}
                                                <div class="row g-3 align-items-center mb-3">
                                                    <div class="col-md-4">
                                                        <label for="" class="col-form-label">Video</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="file" class="form-control" name="video">
                                                    </div>
                                                </div>

                                                {{-- Soal --}}
                                                <div class="row g-3 align-items-center mb-3">
                                                    <div class="col-md-4">
                                                        <label for="" class="col-form-label">Soal</label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <input type="file" class="form-control" name="soal">
                                                    </div>
                                                </div>

                                                {{-- Active --}}
                                                <div class="mb-3">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" role="switch"
                                                            id="flexSwitchCheckChecked" name="active" value="Enabled"
                                                            checked>
                                                        <label class="form-check-label"
                                                            for="flexSwitchCheckChecked">{{ $item->status }}</label>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>


                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
