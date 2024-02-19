@extends('layout.sidebar')

@section('iktFinaActive', 'active')

@section('head')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"
        rel="stylesheet">
@endsection


@section('content')
    <div class="container mb-3">
        <form id="iktPreviewForm" action="/iktPreview" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-3">
                    <a href="{{ asset('storage/ikt.csv') }}" class="btn btn-outline-success btn-sm">Template Upload
                        (.csv)</a>
                </div>
                <div class="col-md-3">
                    <label class="form-label"> Input Tanggal</label>
                    <input type="date" name="tanggal_target" class="form-control" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label"> Input File</label>
                    <input id="fileIkt" type="file" name="file_ikt" class="form-control" required>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-outline-primary">Process</button>
                </div>
            </div>
        </form>
    </div>

    @if ($data)
        <div class="container mb-3">
            <form action="/iktStore" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <input type="hidden" name="data" value="{{ json_encode($data) }}">
                        <input type="hidden" name="tanggal" value="{{ json_encode($tanggal) }}">
                        <button type="submit" class="btn btn-success btn-sm" onclick="confirm('Apakah anda yakin data sudah benar?')">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    @endif


    <div class="container mb-3">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Kode Store</th>
                    <th>Nama Store</th>
                    <th>Net Sales</th>
                    <th>Net Profit</th>
                    <th>Rp Margin</th>
                    <th>% GM</th>
                    <th>Musnah</th>
                    <th>Product Loss</th>
                </tr>
            </thead>
            <tbody>
                @if ($data)
                    @foreach ($data as $item)
                        <tr>
                            <td>{{ $item['kd_store'] }}</td>
                            <td>{{ $item['nama_store'] }}</td>
                            <td>{{ $item['net_sales'] }}</td>
                            <td>{{ $item['net_profit'] }}</td>
                            <td>{{ $item['rp_margin'] }}</td>
                            <td>{{ $item['prcn_margin'] }}</td>
                            <td>{{ $item['musnah'] }}</td>
                            <td>{{ $item['product_loss'] }}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>

    <script>
        // document.getElementById('fileIkt').addEventListener('change', () => {
        //     const tanggal = document.getElementById('tanggal');

        //     if (tanggal.value != '') {
        //             document.getElementById('iktPreviewForm').submit();
        //     }
        //     else {
        //         alert('Tolong input tanggal terlebih dahulu!');
        //     }
            
        // });
    </script>

@endsection

@section('script')
    <script>
        // $(document).ready(function(){
        // $('#datePicker').datepicker({
        //     format: 'yyyy-mm-dd',
        //     autoclose: true,
        //     maxdate: new Date() // Prevent future dates
        // });
        // });
    </script>
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
@endsection
