@extends('layout.sidebar')

@section('knowledgeSopActive', 'active')

@section('head')
    
@endsection

@section('content')
    {{-- Bootstrap Slider Modal --}}
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

        .card {
            cursor: pointer;
        }
    </style>


    <div class="container mb-3">
        @if (Session::has('input_success'))
            <div class="alert alert-success">
                {{ Session::get('input_success') }}
            </div>
        @elseif (Session::has('update_success'))
            <div class="alert alert-success">
                {{ Session::get('update_success') }}
            </div>
        @endif

        <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#newKnowledgeSopModal">Add New</button>
    </div>

    <div class="container">
        <div class="row">
            @foreach ($sop_knowledge as $item)
                <div class="col-md-4 mb-3">
                    <div class="card" style="width: 18rem;"
                        onclick="sopKnowledgeDetails('{{ str_replace('/', '_', $item->nra) }}')">
                        <img src="{{ asset('storage/masterSosialisasi/' . str_replace('/', '_', $item->nra) . '/slides/-0.png') }}"
                            class="card-img-top">
                        <div class="card-body">
                            <h6 class="card-title">{{ $item->nra }}</h6>
                            <p class="card-text">{{ $item->judul }}</p>
                            <p class="card-text">
                                <i class='bx bx-calendar-alt'></i> {{ $item->tgl_efektif }} <br>
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>




    {{-- Add New Modal --}}
    <div class="modal fade" id="newKnowledgeSopModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-slideout" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title align-right" id="exampleModalLabel">New Knowledge SOP</h5>
                </div>
                <form action="{{ route('knowledgeSopStore') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        {{-- Master Sosialisasi --}}
                        <div class="row g-3 align-items-center mb-3">
                            <div class="col-md-4">
                                <label for="" class="col-form-label">Master Sosialisasi</label>
                            </div>
                            <div class="col-md-8">
                                <select id="ms_sosialisasi" name="ms_sosialisasi" class="form_control" readonly>
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

                        {{-- Tanggal Efektif --}}
                        <div class="row g-3 align-items-center mb-3">
                            <div class="col-md-4">
                                <label for="" class="col-form-label">Tanggal Efektif</label>
                            </div>
                            <div class="col-md-8">
                                <input type="date" name="tgl_efektif" class="form-control">
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
@endsection

@section('script')
    <script>
        const select_box_element = document.querySelector('#ms_sosialisasi');

        dselect(select_box_element, {
            search: true
        })
    </script>

    <script>
        function sopKnowledgeDetails(nra) {
            window.location.href = 'http://127.0.0.1:8000/knowledgeSop/' + nra;
        }
    </script>
@endsection
