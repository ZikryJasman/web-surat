     
     <?php $__env->startSection('title','Biodata Profil Desa'); ?>
     <?php $__env->startSection('content'); ?>
     <div class="page-heading">

        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h2>Profil</h2>
                    <button type="button" class="btn rounded-pill btn-sm btn-warning block" style="float: right;" data-bs-toggle="modal" data-bs-target="#inlineForm">
                        <i class="icon dripicons-document-edit"></i> Lengkapi
                    </button>
                    <button type="button" class="btn rounded-pill btn-sm btn-primary block" style="float: right;" data-bs-toggle="modal" data-bs-target="#password">
                        <i class="bi bi-shield-lock"></i> Ganti Password
                    </button>
                </div>
                <div class="card-body" style="overflow-x:scroll;">
                    <table class="table table-bordered">
                        <tbody>
                            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cst): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>EMAIL</td>
                                <td>:</td>
                                <td><?php echo e($cst->email); ?></td>
                            </tr>
                            <tr>
                                <td>TELEPON</td>
                                <td>:</td>
                                <td><?php echo e($cst->telepon_desa); ?></td>
                            </tr>
                            <tr>
                                <td>PROVISI</td>
                                <td>:</td>
                                <td><?php echo e($cst->name_province); ?></td>
                            </tr>
                            <tr>
                                <td>KOTA</td>
                                <td>:</td>
                                <td><?php echo e($cst->name_city); ?></td>
                            </tr>
                            <tr>
                                <td>KECAMATAN</td>
                                <td>:</td>
                                <td><?php echo e($cst->name_district); ?></td>
                            </tr>
                            <tr>
                                <td>KELURAHAN</td>
                                <td>:</td>
                                <td><?php echo e($cst->name_village); ?></td>
                            </tr>
                            <tr>
                                <td>LOKASI DESA</td>
                                <td>:</td>
                                <td><?php echo e($cst->lokasi_desa); ?></td>
                            </tr>
                            <tr>
                                <td>LOGO</td>
                                <td>:</td>
                                <td>
                                    <img src="<?php echo e(asset('foto')); ?>/<?php echo e($cst->logo); ?>" width="70">
                                </td>
                            </tr>
                            <?php echo $__env->make('desa/profildesa/ganti', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php echo $__env->make('desa/profildesa/ubah', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </section>
    </div>
    <div class="row mb-4">
        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cst): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if($cst->lokasi_desa==NULL): ?>
        <div class="alert alert-light-danger color-danger"><i
            class="bi bi-exclamation-circle"></i> ALAMAT TIDAK DI KETAHUI</div>
            <?php else: ?>
            <div class="col-12"><iframe class="form-control" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=720&amp;height=600&amp;hl=en&amp;q=Kantor+Kelurahan+<?php echo e($cst->name_village); ?>+<?php echo e($cst->name_district); ?>+<?php echo e($cst->name_city); ?>+(My%20Business%20Name)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>
            </div>
            <?php endif; ?>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php $__env->stopSection(); ?>

<?php echo $__env->make('desa/layout/app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\web-surat\resources\views/desa/profildesa/profil.blade.php ENDPATH**/ ?>