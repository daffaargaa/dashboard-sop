@extends('layout.sidebar')

@section('sosialisasiSopActive', 'active')

@section('head')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
@endsection

@section('content')
    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

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
            background: #fff;
        }

        .card {
            cursor: pointer;
        }
    </style>

    <div class="container mb-2">
        @if (Session::has('input_success'))
            <div class="alert alert-success">
                {{ Session::get('input_success') }}
            </div>
        @elseif (Session::has('update_success'))
            <div class="alert alert-success">
                {{ Session::get('update_success') }}
            </div>
        @endif

        @if (Auth::user()->dept == 'Internal Control')
            <button class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#newSosialisasiSopModal">Add
                New</button>
        @endif
    </div>

    {{-- Add New Modal --}}
    <div class="modal fade" id="newSosialisasiSopModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-slideout " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title align-right" id="exampleModalLabel">New Sosialisasi SOP</h5>
                </div>
                <form action="{{ route('sosialisasiSopStore') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        {{-- Master Sosialisasi --}}
                        <div class="row g-3 align-items-center mb-3">
                            <div class="col-md-4">
                                <label for="" class="col-form-label">Master Sosialisasi</label>
                            </div>
                            <div class="col-md-8">
                                <select id="ms_sosialisasi" name="ms_sosialisasi" readonly>
                                    <option value="#" disabled selected hidden>Pilih Ms Sosialisasi</option>
                                    @foreach ($ms_sosialisasi as $item)
                                        <option value="{{ $item->id }}">{{ $item->nra }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- NRA --}}
                        <div class="row g-3 align-items-center mb-3">
                            <div class="col-md-4">
                                <label for="" class="col-form-label">NRA</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" name="nra" class="form-control">
                            </div>
                        </div>

                        {{-- Judul --}}
                        <div class="row g-3 align-items-center mb-3">
                            <div class="col-md-4">
                                <label for="" class="col-form-label">Judul</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" name="judul" class="form-control">
                            </div>
                        </div>

                        {{-- Peserta --}}
                        <div class="row g-3 align-items-center mb-3">
                            <div class="col-md-4">
                                <label for="" class="col-form-label">Peserta</label>
                            </div>
                            <div class="col-md-8">
                                <input type="file" name="peserta" class="form-control">
                            </div>
                        </div>

                        {{-- Tanggal mulai dan Tanggal selesai --}}
                        <div class="row g-3 align-items-center mb-3">
                            <div class="col-md-6">
                                <label for="" class="col-form-label">Tanggal Mulai</label>
                                <input type="date" name="tgl_mulai" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="" class="col-form-label">Tanggal Selesai</label>
                                <input type="date" name="tgl_selesai" class="form-control">
                            </div>
                        </div>

                        {{-- Re-Attempt TEst --}}
                        <div class="row g-3 align-items-center mb-3">
                            <div class="col-md-4">
                                <label for="" class="col-form-label">Re-Attempt Test</label>
                            </div>
                            <div class="col-md-8">
                                <input type="number" name="re_attempt_test" class="form-control">
                            </div>
                        </div>

                        {{-- Limit waktu test --}}
                        <div class="row g-3 align-items-center mb-3">
                            <div class="col-md-4">
                                <label for="" class="col-form-label">Limit Waktu Tes (menit)</label>
                            </div>
                            <div class="col-md-8">
                                <input type="number" name="limit_waktu_test" class="form-control">
                            </div>
                        </div>

                        {{-- Grade to Pass --}}
                        <div class="row g-3 align-items-center mb-3">
                            <div class="col-md-4">
                                <label for="" class="col-form-label">Grade to Pass</label>
                            </div>
                            <div class="col-md-8">
                                <input type="number" name="grade_to_pass" class="form-control">
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

    {{-- Datatable --}}
    <div class="container">
        <table id="example" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Tgl Mulai</th>
                    <th>Tgl Selesai</th>
                    <th>NRA</th>
                    <th>Judul</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if ($sop_sosialisasi->count() > 0)
                    @foreach ($sop_sosialisasi as $item)
                        <tr>
                            <td>{{ $item->tanggal_mulai }}</td>
                            <td>{{ $item->tanggal_selesai }}</td>
                            <td>{{ $item->nra }}</td>
                            <td>{{ $item->judul }}</td>
                            <td>
                                @if ($item->status == '0')
                                <div class="waiting">● Waiting</div>
                                @endif
                            </td>
                            <td>
                                <a href="/sosialisasiSop/details/{{ $item->id_ms_sosialisasi }}" class="btn btn-outline-secondary"><i class="bx bx-link-external"></i></a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>








@endsection


@section('script')
    <script>
        const select_box_element = document.querySelector('#ms_sosialisasi');

        dselect(select_box_element, {
            search: true
        })
    </script>

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

    <script>
        new DataTable('#example');
    </script>


@endsection
