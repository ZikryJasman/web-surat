<!DOCTYPE html>
<html>

<head>
    <title>Export Laporan</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
        table tr td,
        table tr th {
            font-size: 10pt;
        }

        table {
            border-left: 0.01em solid #ccc;
            border-right: 0;
            border-top: 0.01em solid #ccc;
            border-bottom: 0;
            border-collapse: collapse;
        }

        table th {
            vertical-align: middle;
        }
        table td,
        table th {
            padding: .5rem;
            border-left: 0;
            border-right: 0.01em solid #ccc;
            border-top: 0;
            border-bottom: 0.01em solid #ccc;
        }
    </style>
</head>

<body>
    <center>
        <h5>{{ $count . ' Laporan Selesai' }}</h4>
    </center>

    <table class="table table-bordered table-hover" align="center">
        <thead>
            <tr>
                <th>No. </th>
                <th>Tanggal Request</th>
                <th>Program Studi</th>
                <th>Request Surat</th>
                <th>Nama Lengkap</th>
                <th>Status</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            @foreach ($user as $dt)
                <tr>
                    <th><?= $no ?>. </th>
                    <td>{{ parseDateIdFull($dt['tgl_req']) . ' WIB' }}</td>
                    <td>{{ $dt['program']['nama'] ?? '' }}</td>
                    <td>{{ $dt['nama_surat'] }}</td>
                    <td>{{ $dt['name'] }}</td>
                    <td  style="vertical-align: middle">
                        @if ($dt['status_pengajuan'] == 'Pengecekan Permohonan')
                            <span class="badge bg-danger">Data Sedang <br>di Periksa</span>
                        @elseif($dt['status_pengajuan'] == 'Data Belum Lengkap')
                            <span class="badge bg-danger">{{ $dt['status_pengajuan'] }}</span>
                        @else
                            <span class="badge bg-success">{{ $dt['status_pengajuan'] }}</span>
                        @endif
                    </td>
                    <td style="vertical-align: middle">
                        @if ($dt['selesai'] == null)
                            Menunggu Konfirmasi
                        @endif
                        @if ($dt['selesai'] !== null)
                            <span class="badge bg-success">
                                {{ $dt['selesai'] }}
                            </span>
                        @endif
                    </td>
                </tr>
                <?php $no++; ?>
            @endforeach
        </tbody>
    </table>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
