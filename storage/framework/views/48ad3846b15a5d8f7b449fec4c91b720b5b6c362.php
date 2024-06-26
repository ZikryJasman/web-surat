<?php $__env->startSection('title', 'Cek Surat Acc'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="row">
                <div class="col-lg-7 pb-4" style="background: white;box-shadow:2px 2px grey;">
                    <form method="post" action="<?php echo e(route('confirm_ttd', $dt->id_pengajuan)); ?>">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" value="<?php echo e($dt->singkatan); ?>" name="singkatan">
                        <button class="btn btn-sm form-control btn-primary mt-2">Konfirmasi Surat Selesai</button>
                    </form>
                </div>
                <div class="col-lg-7">
                    

                    <iframe style="width:400px;height:700px" src="<?php echo e($dt->upload_berkas); ?>" frameborder="0"></iframe>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('desa/layout/app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\web-surat\resources\views/kepaladesa/acc/ttd.blade.php ENDPATH**/ ?>