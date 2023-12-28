<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    </head>
<body>
    <div class="container p-2 col-md-3">
        <form action="/fpp-approval-input" method="POST">
            @csrf
            {{-- Nama Atasan --}}
            <div class="mb-3">
                <label for="" class="form-label">Atasan Pemilik SOP</label>
                <select class="form-select" aria-label="Default select example" name="atasan">
                    <option selected>Pilih Atasan</option>
                    @foreach($atasan as $item)
                        <option value="{{ $item->nik }}">{{ $item->nik }} - {{ $item->nama }}</option>
                    @endforeach
                </select>
            </div>
            {{-- Nama SOP --}}
            <div class="mb-3">
                <label for="" class="form-label">Dept SOP</label>
                <select class="form-select" aria-label="Default select example" name="sop">
                    <option selected>Pilih Dept SOP</option>
                    @foreach($sop as $item)
                        <option value="{{ $item->nik }}">{{ $item->nik }} - {{ $item->nama }}</option>
                    @endforeach
                </select>
            </div>
            {{-- Tombol Submit --}}
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</body>
</html>