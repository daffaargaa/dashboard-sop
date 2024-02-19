<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Alert Confirmation</title>
</head>
<body>

    <form id="iktStoreAfterConfirmationForm" action="/iktStoreAfterConfirmation" method="post">
        @csrf
        <input type="hidden" name="iktStore" value="{{ json_encode($data) }}">
        {{-- <input type="hidden" name="tanggal" value="{{ json_encode($tanggal) }}"> --}}
    </form>
    

    <script>
        const confirmation = confirm('Data sudah ada, apakah ingin dilanjut?');

        if (confirmation) {
            document.getElementById('iktStoreAfterConfirmationForm').submit();
        }
        else {
            window.location.href = "http://127.0.0.1:8000/iktFina";
        }
    </script>
</body>
</html>