<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pengajuan Surat</title>

    <link rel="stylesheet" href="<?php echo e(asset('print.css')); ?>">
</head>
<style type="text/css">
    @page  {
        margin: 100px 25px;
    }

    header {
      position: fixed;
      top: -100px;
      left: 0px;
      right: 0px;
      height: 50px;
      font-size: 20px !important;

      /** Extra personal styles **/
      /*background-color: #008B8B;*/
      /*color: white;*/
      text-align: center;
      line-height: 35px;
  }

  footer {
    position: fixed;
    bottom: -30px;
    left: 0px;
    right: 0px;
    height: 50px;
    font-size: 20px !important;

    /** Extra personal styles **/
    /*background-color: #008B8B;*/
    /*color: white;*/
    text-align: center;
    line-height: 35px;
}
</style>
<body>

    <header>
        <center>
            <img src="<?php echo e(asset('foto')); ?>/<?php echo e($desa->logo); ?>" alt="avatar" class="img pt-3" width="65" style="float: left;">
            KANTOR DESA <?php echo e($desa->name_village); ?> KECAMATAN <?php echo e($desa->name_district); ?> <br><?php echo e($desa->name_city); ?> <br>
            <sup><small><?php echo e($desa->lokasi_desa); ?>

                | <?php echo e($desa->telepon_desa); ?></small></sup>
            </center>
        </header>
        <footer>
         <center>
            <img src="<?php echo e(asset('foto')); ?>/<?php echo e($desa->logo); ?>" alt="avatar" class="img pt-3" width="65" style="float: left;">
            KANTOR DESA <?php echo e($desa->name_village); ?> KECAMATAN <?php echo e($desa->name_district); ?> <br><?php echo e($desa->name_city); ?> <br>
            <sup><small><?php echo e($desa->lokasi_desa); ?>

                | <?php echo e($desa->telepon_desa); ?></small></sup>
            </center>
        </footer>

        <main>
            <div class="card-body" style="overflow-x:scroll;font-family: times new roman;">
                <table class="table table-bordered" id="table1">
                    <thead>
                        <tr>
                            <tr>
                                <th>No. </th>
                                <th>Tanggal Request</th>
                                <th>Nomor Surat</th>
                                <th>NIM</th>
                                <th>Nama</th>
                                <th>Catatan Lain</th>
                                <th>Pengajuan</th>
                            </tr>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; ?>
                        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($no); ?>.</td>
                            <td><?php echo e(parseDateIdFull($dt->tgl_req).' WIB'); ?></td>
                            <td><?php echo e($dt->singkatan); ?> / <?php echo e($dt->nomor_surat); ?></td>
                            <td><?php echo e($dt->nim); ?></td>
                            <td><?php echo e($dt->name); ?></td>
                            <td><?php echo e($dt->keperluan); ?></td>
                            <td><?php echo e($dt->nama_surat); ?></td>
                        </tr>
                        <?php $no++; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </main>
    </body>
    </html>
<?php /**PATH C:\xampp\htdocs\web-surat\resources\views/staff/selesai/print.blade.php ENDPATH**/ ?>