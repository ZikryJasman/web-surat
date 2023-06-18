<div class="container mt-3" style="background: white;">
    <div class="row">
        <div class="col-lg-2">

        </div>
        <div class="col-lg-8">
            <?php $__currentLoopData = $desa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ds): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <center>
                <img src="<?php echo e(asset('foto')); ?>/<?php echo e($ds->logo); ?>" alt="avatar" class="img pt-3" width="50" style="float: left;">
                PEMERINTAHAN <?php echo e($ds->name_city); ?> <br>
                KECAMATAN <?php echo e($ds->name_district); ?>

                <h4>KELURAHAN <?php echo e($ds->name_village); ?></h4>
                <span><i><?php echo e($ds->lokasi_desa); ?></i></span>
            </center>
            <hr>
            <center>
                <h5 style="text-transform: uppercase;"><u><?php echo e($dt->nama_surat); ?></u></h5>
                Nomor : <?php echo e($dt->singkatan); ?> / <?php echo e($dt->nomor_surat); ?> / <?php echo e($dt->tgl_req); ?>

            </center>
            <p style="text-align: left;">
                &nbsp;&nbsp;&nbsp; Yang bertanda tangan di bawah ini Lurah <?php echo e($ds->name_village); ?> <?php echo e($ds->name_city); ?>, <br style="float: left;">Menerangkan bahwa :
            </p>
            <center>
                <table border="0">
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
                Adalah benar - benar penduduk asli Kampung <?php echo e($ds->nama_village); ?> Kecamatan <?php echo e($ds->name_district); ?>.
                <p>"Surat Keterangan ini digunakan untuk Keperluan <b><i><u><?php echo e($dt->keperluan); ?></u></i></b>"</p>
                <p>Demikian surat ini diberikan kepada yang bersangkutan agar dapat dipergunakan untuk sebagaimana mestinya.</p>
                <div class="row">
                    <div class="col-lg-6">
                        Tanda Tangan <br> Yang Bersangkutan
                        <p class="text" style="padding-top: 29%;">
                            <b><u><?php echo e($dt->name); ?></u></b>
                        </p>
                    </div>
                    <div class="col-lg-6">
                        <?php echo e($ds->name_city); ?> <br>
                        Kepala Desa Kelurahan <?php echo e($ds->name_village); ?>

                        <?php if($dt->ttd!==NULL): ?>
                        <br>
                        <img src="<?php echo e(asset($dt->ttd)); ?>" style="width: 60%;">
                        <?php else: ?>
                        <p class="text" style="padding-top: 23%;">
                        </p>
                        <?php endif; ?>
                        <p class="text">
                            <?php if(Auth::user()->level!=="Kepala Desa"): ?>
                            <?php $__currentLoopData = $kepala; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kpl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <b><u><?php echo e($kpl->name); ?></u></b>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                            <b><u><?php echo e(Auth::user()->name); ?></u></b>
                            <?php endif; ?>
                        </p>
                    </div>
                </div>
            </center>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\web-surat\resources\views/desa/template/1/cek.blade.php ENDPATH**/ ?>