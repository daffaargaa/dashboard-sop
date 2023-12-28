@extends('layout.sidebar')

@section('title', 'FPP SOP')

@section('sidebar-active')
    <li class=""><a href="/home" class="text-decoration-none px-3 py-2 d-block"><i class="fal fa-home"></i> Home</a>
    </li>

    <li class=""><a href="/masterUsersTafis" class="text-decoration-none px-3 py-2 d-block"><i class='bx bx-cog' ></i>
            Master Users Tafis</a>
    </li>

    <li class="active"><a href="/fppSop" class="text-decoration-none px-3 py-2 d-block"><i class="fal fa-list"></i>
            FPP SOP</a></li>
@endsection

@section('content')
    {{-- Add new Modal --}}
    <div class="container">
        @if (Session::has('input_success'))
            <div class="alert alert-success">
                {{ Session::get('input_success') }}
            </div>
        @elseif (Session::has('approve_success'))
            <div class="alert alert-success">
                {{ Session::get('approve_success') }}
            </div>
        @elseif (Session::has('delete_success'))
            <div class="alert alert-success">
                {{ Session::get('delete_success') }}
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
                        <h5 class="modal-title" id="exampleModalLabel">Pengajuan SOP Online</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form action="{{ route('fppSopStore') }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="" class="form-label">Nama</label>
                                <input type="text" class="form-control" value="{{ Auth::user()->name }}" disabled>
                                <input type="hidden" name="nama" value="{{ Auth::user()->name }}">
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label">Dept</label>
                                <input type="text" class="form-control" value="{{ Auth::user()->dept }}" disabled>
                                <input type="hidden" name="dept" value="{{ Auth::user()->dept }}">
                            </div>

                            <label for="" class="form-label">Tipe Pengajuan SOP</label>
                            <div class="mb-3">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" value="Baru" name="tipe_pengajuan">
                                    <label class="form-check-label" for="inlineradio1">Baru</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" value="Revisi" name="tipe_pengajuan">
                                    <label class="form-check-label" for="inlineradio2">Revisi</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" value="Hapus" name="tipe_pengajuan">
                                    <label class="form-check-label" for="inlineradio2">Hapus</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" value="Upload Ulang"
                                        name="tipe_pengajuan">
                                    <label class="form-check-label" for="inlineradio2">Upload Ulang</label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label">Pemilik SOP</label>
                                <input type="text" class="form-control"
                                    value="{{ Auth::user()->nik }} - {{ Auth::user()->name }}" disabled>
                                <input type="hidden" class="form-control" name="pemilik" value="{{ Auth::user()->nik }}">
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label">Atasan Pemilik SOP</label>
                                <select class="form-select" aria-label="Default select example" name="atasan_pemilik">
                                    <option selected>Pilih Atasan Pemilik SOP</option>
                                    @foreach ($users as $item)
                                        <option value="{{ $item->nik }}">{{ $item->nik }} - {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label">Dept SOP</label>
                                <select class="form-select" aria-label="Default select example" name="dept_sop">
                                    <option selected>Pilih Dept SOP</option>
                                    @foreach ($users as $item)
                                        <option value="{{ $item->nik }}">{{ $item->nik }} - {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
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
        <table class="table" style="margin-top: 10px;">
            <thead>
                <tr>
                    <th>Tgl</th>
                    <th>No Form</th>
                    <th>Nama</th>
                    <th>Dept</th>
                    <th>Tipe Pengajuan</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sop_fpp as $item)
                    <tr>
                        <td>{{ strtoupper(\Carbon\Carbon::parse($item->created_at)->format('d-M-y')) }}</td>
                        <td>{{ $item->no_form }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->dept }}</td>
                        <td>{{ $item->tipe_pengajuan }}</td>

                        @if ($item->status == '1')
                            <td><i class='bx bxs-time'></i> Waiting</td>
                        @elseif ($item->status == '2')
                            <td><i class='bx bxs-check-square'></i> Approved by Atasan</td>
                        @elseif ($item->status == 'T')
                            <td><i class='bx bxs-check-square'></i> Done</td>
                        @elseif ($item->status == 'F')
                            <td><i class='bx bxs-x-circle'></i> Rejected</td>
                        @endif


                        <td>
                            @if ($item->status != 'F' && $item->nik == Auth::user()->nik && $item->urutan == $item->status)
                                <a href="/fppSop/approve/{{ $item->id_sop_fpp }}/{{ Auth::user()->nik }}/approve"
                                    class="btn btn-success"><i class='bx bx-check'></i></a>
                                <a href="/fppSop/approve/{{ $item->id_sop_fpp }}/{{ Auth::user()->nik }}/reject"
                                    class="btn btn-danger"><i class='bx bxs-x-circle'></i></a>
                            @endif

                            <a href="/fppSop/details/{{ $item->id_sop_fpp }}" class="btn btn-secondary"><i
                                    class='bx bx-link-external'></i></a>

                            @if ($item->status == 'T')
                                <a href="/fppSop/export/{{ $item->id_sop_fpp }}" class="btn btn-info"><i
                                        class='bx bx-download'></i></a>
                            @endif

                            @if ($item->status == '1')
                                <a href="/fppSop/destroy/{{ $item->id_sop_fpp }}" class="btn btn-danger"><i
                                        class='bx bxs-trash'></i></a>
                            @endif

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
