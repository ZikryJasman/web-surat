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
        <h5><?php echo e($count . ' Laporan Selesai'); ?></h4>
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
            <?php $__currentLoopData = $user; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <th><?= $no ?>. </th>
                    <td><?php echo e(parseDateIdFull($dt['tgl_req']) . ' WIB'); ?></td>
                    <td><?php echo e($dt['program']['nama'] ?? ''); ?></td>
                    <td><?php echo e($dt['nama_surat']); ?></td>
                    <td><?php echo e($dt['name']); ?></td>
                    <td  style="vertical-align: middle">
                        <?php if($dt['status_pengajuan'] == 'Pengecekan Permohonan'): ?>
                            <span class="badge bg-danger">Data Sedang <br>di Periksa</span>
                        <?php elseif($dt['status_pengajuan'] == 'Data Belum Lengkap'): ?>
                            <span class="badge bg-danger"><?php echo e($dt['status_pengajuan']); ?></span>
                        <?php else: ?>
                            <span class="badge bg-success"><?php echo e($dt['status_pengajuan']); ?></span>
                        <?php endif; ?>
                    </td>
                    <td style="vertical-align: middle">
                        <?php if($dt['selesai'] == null): ?>
                            Menunggu Konfirmasi
                        <?php endif; ?>
                        <?php if($dt['selesai'] !== null): ?>
                            <span class="badge bg-success">
                                <?php echo e($dt['selesai']); ?>

                            </span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php $no++; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php /**PATH C:\xampp\htdocs\web-surat\resources\views/pdf/exports.blade.php ENDPATH**/ ?>