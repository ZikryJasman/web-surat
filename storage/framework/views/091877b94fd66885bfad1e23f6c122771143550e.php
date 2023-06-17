<?php $__env->startSection('title', 'Dashboard Admin'); ?>

<?php $__env->startSection('content'); ?>
    <div class="page-heading">
        <h3>Dashboard Desa</h3>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-12 col-xl-12">
                <div class="row">
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon purple">
                                            <i class="dripicons dripicons-user-group"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Data User</h6>
                                        <h6 class="font-extrabold mb-0"><?php echo e($data['total_user']); ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon blue">
                                            <i class="dripicons dripicons-blog"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Data Surat</h6>
                                        <h6 class="font-extrabold mb-0"><?php echo e($data['total_surat']); ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon green">
                                            <i class="dripicons dripicons-clock"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Waktu Layanan</h6>
                                        <?php $__currentLoopData = $data['layanan']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $layanan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <h6 class="font-extrabold mb-1">
                                                <?php echo e($layanan->hari . ', ' . $layanan->waktu . ' - ' . $layanan->sampai); ?></h6>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon red">
                                            <i class="dripicons dripicons-store"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Prosedur Pengajuan</h6>
                                        <?php $__currentLoopData = $data['prosedur']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prosedur): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <h6 class="font-extrabold mb-1" style="white-space:pre-line">
                                                <?php echo $prosedur->prosedur; ?></h6>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('desa/layout/app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\web-surat\resources\views/desa/dashboard/dashboard.blade.php ENDPATH**/ ?>