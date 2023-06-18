<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Surat</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="<?php echo e(asset('template/dist/assets/css/bootstrap.css')); ?>">
    <!-- <link rel="stylesheet" href="<?php echo e(asset('template/dist/assets/vendors/dripicons/webfont.css')); ?>"> -->
    <link rel="stylesheet" href="<?php echo e(asset('template/dist/assets/css/pages/dripicons.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('template/dist/assets/vendors/bootstrap-icons/bootstrap-icons.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('template/dist/assets/css/app.css')); ?>">
</head>
<body style="background: white;color: black;">
    <?php $__currentLoopData = $data['user']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="container-fluid" style="background: white;">
        <div class="row">
            <div class="col-xl-12">
                <?php $__currentLoopData = $data['desa']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ds): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <center>
                    <img src="<?php echo e(asset('foto')); ?>/<?php echo e($ds->logo); ?>" alt="avatar" class="img pt-2" width="65" style="float: left;">
                    PEMERINTAHAN <?php echo e($ds->name_city); ?> <br>
                    KECAMATAN <?php echo e($ds->name_district); ?>

                    <h4>KELURAHAN <?php echo e($ds->name_village); ?></h4>
                    <span><i><?php echo e($ds->lokasi_desa); ?></i></span>
                </center>
                <hr>
                <center>
                    <h5 style="text-transform: uppercase;color: black;"><u><?php echo e($dt->nama_surat); ?></u></h5>
                    Nomor : <?php echo e($dt->singkatan); ?> / <?php echo e($dt->nomor_surat); ?> / <?php echo e($dt->tgl_req); ?>

                </center>
                <p style="text-align: left;">
                    &nbsp;&nbsp;&nbsp; Yang bertanda tangan di bawah ini Lurah <?php echo e($ds->name_village); ?> <?php echo e($ds->name_city); ?>, <br style="float: left;">Menerangkan bahwa :
                </p>
                <center>
                    <table border="0" align="center" class="text mt-2 mb-4">
                        <tr>
                            <td>Nama</td>
                            <td>:</td>
                            <td><?php echo e($dt->name); ?></td>
                        </tr>
                        <tr>
                            <td>Tempat, tanggal lahir</td>
                            <td>:</td>
                            <td><?php echo e($dt->tempat); ?>, <?php echo e($dt->tgl_lahir); ?></td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td>:</td>
                            <td><?php echo e($dt->jenis_kelamin); ?></td>
                        </tr>
                        <tr>
                            <td>Tahun Ajaran</td>
                            <td>:</td>
                            <td><?php echo e($dt->tahun_ajaran); ?></td>
                        </tr>
                        <tr>
                            <td>Program Studi</td>
                            <td>:</td>
                            <td><?php echo e($dt->program_studi); ?></td>
                        </tr>
                        <tr>
                            <td>No. NIM</td>
                            <td>:</td>
                            <td><?php echo e($dt->nim); ?></td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>:</td>
                            <td><?php echo e($dt->alamat); ?></td>
                        </tr>
                    </table>
                </center>
                <center>
                    Adalah benar - benar penduduk asli Kampung <?php echo e($ds->nama_village); ?> Kecamatan <?php echo e($ds->name_district); ?>.
                    <p>"Surat Keterangan ini digunakan untuk Keperluan <b><i><u><?php echo e($dt->keperluan); ?></u></i></b>"</p>
                    <p>Demikian surat ini diberikan kepada yang bersangkutan agar dapat dipergunakan untuk sebagaimana mestinya.</p>
                    <table class="table mt-5" align="center" style="color: black;">
                        <tr>
                            <td align="center">
                                Tanda Tangan <br> Yang Bersangkutan
                            </td>
                            <td align="center">
                                <?php echo e($ds->name_city); ?> <br>
                                Kepala Desa Kelurahan <?php echo e($ds->name_village); ?> <br>
                            </td>
                        </tr>
                        <tr>
                            <td align="center" class="text pt-5">
                                <p style="padding-top: 20%;"><b><u><?php echo e($dt->name); ?></u></b></p>
                            </td>
                            <td align="center" class="text">
                                <img src="<?php echo e(asset($dt->ttd)); ?>" class="text pt-1" height="95"> <br>
                                <?php if(Auth::user()->level!=="Kepala Desa"): ?>
                                <?php $__currentLoopData = $data['kepala']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kpl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <p><b><u><?php echo e($kpl->name); ?></u></b></p>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                <p><b><u><?php echo e(Auth::user()->name); ?></u></b></p>
                                <?php endif; ?>
                            </td>
                        </tr>
                    </table>
                </center>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\web-surat\resources\views/desa/template/1/print.blade.php ENDPATH**/ ?>