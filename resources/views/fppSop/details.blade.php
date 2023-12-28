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

        .baris-produk th,
        .baris-produk td {
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
            text-align: left;
            border: 0px solid black;
        }

        #keterangan-catatan {
            text-align: left;
            border-bottom: 0px solid black;
        }

        .approved {
            display: inline;
            padding: 5px;
            border-radius: 10px;
            background-color: #12B76A;
            color: #FFFFFF;
        }

        .rejected {
            display: inline;
            padding: 5px;
            border-radius: 10px;
            background-color: #F04438;
            color: #FFFFFF;
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
                <td>No Form</td>
                <td colspan="5">: {{ $sop_fpp->no_form }}</td>
            </tr>
            {{-- row Nama --}}
            <tr>
                <td>Nama</td>
                <td colspan="5">: {{ $sop_fpp->nama }}</td>
            </tr>
            {{-- row Divisi/Departemen --}}
            <tr>
                <td>Divisi/Departemen</td>
                <td colspan="5">: {{ $sop_fpp->dept }}</td>
            </tr>
            {{-- row Tipe Pengajuan --}}
            <tr>
                <td>Tipe Pengajuan</td>
                <td colspan="5">: {{ ucwords($sop_fpp->tipe_pengajuan) }}</td>
            </tr>
        </thead>
        {{-- tabel baris Produk MASIH MANUAL --}}
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
        {{-- BAGIAN APPROVAL --}}
        <thead class="kolom-ttd">
            <tr>
                <th colspan="2">Pemilik SOP</th> {{-- Pengaju --}}
                <th colspan="1">Atasan Pemilik SOP</th>
                <th colspan="3">Dept SOP</th>
            </tr>

            {{-- =========================================================== --}}
            <tr>
                {{-- Pengaju --}}
                <td colspan="2" id="isi-kolom-ttd">
                    <div class="approved">Approved</div>
                </td>
                @foreach ($sop_fpp_form_approval as $item)
                    {{-- Approved Atasan Pemilik --}}
                    @if ($item->jenis == 'Atasan Pemilik' && $item->is_approve == '1')
                        <td colspan="1" id="isi-kolom-ttd">
                            <div class="approved">Approved</div>
                        </td>
                    @elseif ($item->jenis == 'Atasan Pemilik' && $item->is_approve == '0')
                        <td colspan="1" id="isi-kolom-ttd"></td>
                    @elseif ($item->jenis == 'Atasan Pemilik' && $item->is_approve == '2')
                        <td colspan="1" id="isi-kolom-ttd">
                            <div class="rejected">Rejected</div>
                        </td>
                    @endif

                    {{-- Approved Dept SOP --}}
                    @if ($item->jenis == 'Dept SOP' && $item->is_approve == '1')
                        <td colspan="3" id="isi-kolom-ttd">
                            <div class="approved">Approved</div>
                        </td>
                    @elseif ($item->jenis == 'Dept SOP' && $item->is_approve == '0')
                        <td colspan="3" id="isi-kolom-ttd"></td>
                    @elseif ($item->jenis == 'Dept SOP' && $item->is_approve == '2')
                        <td colspan="3" id="isi-kolom-ttd">
                            <div class="rejected">Rejected</div>
                        </td>
                    @endif
                @endforeach
            </tr>

            {{-- Tgl Approve/Reject SOP --}}
            <tr>
                <td colspan="2" id="isi-kolom-ttd">
                    {{ strtoupper(\Carbon\Carbon::parse($sop_fpp->updated_at)->format('d-M-y')) }}</td>
                @foreach ($sop_fpp_form_approval as $item)
                    {{-- Tgl Approve Atasan Pemilik --}}
                    @if ($item->jenis == 'Atasan Pemilik' && $item->is_approve == '1')
                        <td colspan="1" id="isi-kolom-ttd">
                            {{ strtoupper(\Carbon\Carbon::parse($item->updated_at)->format('d-M-y')) }}
                        </td>
                    @elseif ($item->jenis == 'Atasan Pemilik' && $item->is_approve == '0')
                        <td colspan="1" id="isi-kolom-ttd"></td>
                    @elseif ($item->jenis == 'Atasan Pemilik' && $item->is_approve == '2')
                        <td colspan="1" id="isi-kolom-ttd">
                            {{ strtoupper(\Carbon\Carbon::parse($item->updated_at)->format('d-M-y')) }}
                        </td>
                    @endif

                    {{-- Tgl Approve Dept SOP --}}
                    @if ($item->jenis == 'Dept SOP' && $item->is_approve == '1')
                        <td colspan="3" id="isi-kolom-ttd">
                            {{ strtoupper(\Carbon\Carbon::parse($item->updated_at)->format('d-M-y')) }}</td>
                    @elseif ($item->jenis == 'Dept SOP' && $item->is_approve == '0')
                        <td colspan="3" id="isi-kolom-ttd"></td>
                    @elseif ($item->jenis == 'Dept SOP' && $item->is_approve == '2')
                        <td colspan="3" id="isi-kolom-ttd">
                            {{ strtoupper(\Carbon\Carbon::parse($item->updated_at)->format('d-M-y')) }}</td>
                    @endif
                @endforeach
            </tr>

            {{-- Inisial --}}
            <tr>
                <td colspan="2" id="isi-kolom-ttd">{{ $sop_fpp->inisial }}</td>
                @foreach ($sop_fpp_form_approval as $item)
                    {{-- Atasan Pemilik --}}
                    @if ($item->jenis == 'Atasan Pemilik' && $item->is_approve == '1')
                        <td colspan="1" id="isi-kolom-ttd">{{ $item->inisial }}</td>
                    @elseif ($item->jenis == 'Atasan Pemilik' && $item->is_approve == '0')
                        <td colspan="1" id="isi-kolom-ttd">{{ $item->inisial }}</td>
                    @elseif ($item->jenis == 'Atasan Pemilik' && $item->is_approve == '2')
                        <td colspan="1" id="isi-kolom-ttd">{{ $item->inisial }}</td>
                    @endif
                    {{-- Dept SOP --}}
                    @if ($item->jenis == 'Dept SOP' && $item->is_approve == '1')
                        <td colspan="3" id="isi-kolom-ttd">{{ $item->inisial }}</td>
                    @elseif ($item->jenis == 'Dept SOP' && $item->is_approve == '0')
                        <td colspan="3" id="isi-kolom-ttd">{{ $item->inisial }}</td>
                    @elseif ($item->jenis == 'Dept SOP' && $item->is_approve == '2')
                        <td colspan="3" id="isi-kolom-ttd">{{ $item->inisial }}</td>
                    @endif
                @endforeach
            </tr>
            {{-- ================================================================== --}}
            
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
                <td colspan="6" id="keterangan">1. Data pelengkap dapat dilampirkan bilamana deskripsi atau hal-hal
                    yang menjadi catatan pada kolom di atas tidak mencukupi</td>
            </tr>
            <tr>
                <td colspan="6" id="keterangan">2. No. form diisi oleh SOP Development Specialist setelah kembali
                    dari User</td>
            </tr>
        </thead>
    </table>
</body>

</html>
