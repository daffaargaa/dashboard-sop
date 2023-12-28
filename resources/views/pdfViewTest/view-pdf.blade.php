<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>View Pdf</title>
    <style>
        th {
            padding: 10px;
            border-top: 1px solid black;
        }
        td {
            padding: 10px;
            border-top: 1px solid black;
        }
        .baris-produk th, .baris-produk td {
            border-right: 1px solid black;
        }
        .kolom-ttd td {
            text-align: center;
            border-right: 1px solid black;
        }
        .kolom-ttd th {
            text-align: center;
            border-bottom: 1px solid black;
        }
        #isi-kolom-ttd {
            border-top: 0px solid black;
        }
        #keterangan {
            text-align:left;
            border: 0px solid black;
        }
        #keterangan-catatan {
            text-align:left;
            border-bottom: 0px solid black;
        }
        
    </style>
</head>

<body style="font-family: sans-serif;">
    <table style="width: 100%;  border: 1px solid black; padding: 10px; border-collapse: collapse;">
        <thead>
            {{-- Judul --}}
            <tr>
                <th colspan="6">FORM PENGAJUAN PRODUK SOP</th>
            </tr>
            {{-- row Nama --}}
            <tr>
                <td >Nama</td>
                <td colspan="5">: Muhammad Daffa Arga</td>
            </tr>
            {{-- row Divisi/Departemen --}}
            <tr>
                <td>Divisi/Departemen</td>
                <td colspan="5">: Internal Control</td>
            </tr>
            {{-- row Tipe Pengajuan --}}
            <tr>
                <td>Tipe Pengajuan</td>
                <td colspan="5">: Baru</td>
            </tr>
        </thead>
        {{-- tabel baris Produk --}}
        <thead class="baris-produk">
            <tr>
                <th>No</th>
                <th>NRA</th>
                <th>Nama Produk SOP</th>
                <th>Alasan Pengajuan SOP</th>
                <th colspan="2">Dokumen Pendukung</th>
            </tr>
        </thead>
        <tbody class="baris-produk">
            <tr>
                <td>1</td>
                <td>LWS/KEB/ICO/001</td>
                <td>Kebijakan Internal Control</td>
                <td>Butuh SOP Baru</td>
                <td colspan="2">File.pdf</td>
            </tr>
            <tr>
                <td>2</td>
                <td>LWS/SOP/ICO/001</td>
                <td>Prosedur Internal Control</td>
                <td>Butuh SOP Baru</td>
                <td colspan="2">File.pdf</td>
            </tr>
            <tr>
                <td colspan="6">Permintaan ini untuk diberlakukan tanggal : 13-DEC-23</td>
            </tr>
        </tbody>
        <thead class="kolom-ttd">
            <tr>
                <th colspan="2">Pemilik SOP</th>
                <th colspan="1">Atasan Pemilik SOP</th>
                <th colspan="3">Dept SOP</th>
            </tr>
            <tr>
                <td colspan="2" id="isi-kolom-ttd">Approved</td>
                <td colspan="1" id="isi-kolom-ttd">Approved</td>
                <td colspan="3" id="isi-kolom-ttd">Approved</td>
            </tr>
            <tr>
                <td colspan="2" id="isi-kolom-ttd">13-DEC-23</td>
                <td colspan="1" id="isi-kolom-ttd">20-DEC-23</td>
                <td colspan="3" id="isi-kolom-ttd">27-DEC-23</td>
            </tr>
            <tr>
                <td colspan="2" id="isi-kolom-ttd">MDA</td>
                <td colspan="1" id="isi-kolom-ttd">GNM</td>
                <td colspan="3" id="isi-kolom-ttd">AZN</td>
            </tr>
            <tr>
                <td colspan="2">Mgr</td>
                <td colspan="1">GM/Director</td>
                <td colspan="3">SOP Mgr</td>
            </tr>
            <tr>
                <td colspan="6">Untuk Upload Ulang (khusus untuk Dept SOP)</td>
            </tr>
            <tr>
                <td colspan="2">SOP Development Spc</td>
                <td colspan="1">ICON Mgr</td>
                <td colspan="3">SOP Mgr</td>
            </tr>
            <tr>
                <th colspan="6" id="keterangan-catatan">Catatan:</th>
            </tr>
            <tr>
                <td colspan="6" id="keterangan">1. Data pelengkap dapat dilampirkan bilamana deskripsi atau hal-hal yang menjadi catatan pada kolom di atas tidak mencukupi</td>
            </tr>
            <tr>
                <td colspan="6" id="keterangan">2. No. form diisi oleh SOP Development Specialist setelah kembali dari User</td>
            </tr>
        </thead>
    </table>
</body>

</html>
