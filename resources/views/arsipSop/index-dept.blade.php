@extends('layout.sidebar')

@section('arsipSopActive', 'active')

@section('head')
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@2.0.1/dist/css/multi-select-tag.css">
@endsection

@section('content')

    <div class="container">
        <a href="/arsipSop" class="" style="text-decoration:none; color: black;">
            <h3>
                < {{ $id_dept->dept }} </h3>
        </a>
        <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#newArchive">Add New Archive</button>
    </div>

    <div class="container mt-2">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>NRA</th>
                    <th>Produk</th>
                    <th>Keterangan</th>

                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if (count($sop_arsip) > 0)
                    @foreach ($sop_arsip as $item)
                        <tr>
                            <td>{{ $item->nra }}</td>
                            <td>{{ $item->produk }}</td>
                            <td>{{ $item->keterangan }}</td>
                            <td>
                                <a href="#" class="btn btn-secondary"><i class="bx bx-link-external"></i></a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td></td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    {{-- ADD NEW ARCHIVE MODAL --}}
    <div class="modal fade" id="newArchive" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Jenis</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                {{-- Your body goes here --}}
                <form action="{{ route('arsipSopNewArchiveStore') }}" method="POST">
                    @csrf
                    <div class="modal-body">

                        <div class="mb-3">
                            <label for="" class="form-label">Dept</label>
                            <input type="text" class="form-control" value="{{ $id_dept->dept }}" disabled>
                            <input type="hidden" class="form-control" value="{{ $id_dept->id }}" name="dept">
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Jenis</label>
                            <select class="form-select" aria-label="Default select example" name="jenis">
                                <option selected>-- Pilih Jenis --</option>
                                @foreach ($ms_jenis as $item)
                                    <option value="{{ $item->id }}">{{ $item->jenis_arsip }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">NRA</label>
                            <input type="text" class="form-control" name="nra">
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Product</label>
                            <select aria-label="Default select example" class="form-select" name="produk">
                                <option selected>-- Pilih Product --</option>
                                @foreach ($ms_produk as $item)
                                    <option value="{{ $item->id }}">{{ $item->produk }}
                                    </option>
                                @endforeach
                            </select>

                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Dept Terkait</label>
                            <select id="countries" name="dept_terkait[]" multiple>
                                @foreach ($ms_dept as $item)
                                    <option value="{{ $item->id }}">{{ $item->dept }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Judul</label>
                            <input type="text" class="form-control" name="judul">
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Keterangan</label>
                            <input type="textarea" class="form-control" name="keterangan">
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Tanggal Release</label>
                            <input type="date" class="form-control" name="tgl_release">
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">File</label>
                            <input type="file" class="form-control" name="file">
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Flag OPR</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked"
                                    name="active" value="ENABLED" checked>
                                <label class="form-check-label" for="flexSwitchCheckChecked">Active</label>
                            </div>
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



    <script>
        // Get the checkbox and label elements
        var checkbox = document.getElementById('flexSwitchCheckChecked');
        var label = document.querySelector('.form-check-label');

        // Add an event listener to detect changes in the checkbox state
        checkbox.addEventListener('change', function() {
            // Check if the checkbox is checked
            if (this.checked) {
                // If checked, set the label text to 'Active'
                label.textContent = 'Active';
            } else {
                // If not checked, set the label text to 'Inactive'
                label.textContent = 'Inactive';
            }
        });

        // Optional: You can define functions to enable/disable functionality
        function enableFunctionality() {
            // Your code to enable functionality goes here
            console.log('Functionality enabled');
        }

        function disableFunctionality() {
            // Your code to disable functionality goes here
            console.log('Functionality disabled');
        }
    </script>



@endsection


@section('script')
    <script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@2.0.1/dist/js/multi-select-tag.js"></script>
    <script>
        new MultiSelectTag('countries') // id
    </script>
@endsection
