<?php $__env->startSection('title','Dashboard Pengaju'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <?php $__currentLoopData = $surat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sur): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-lg-3">
        <div class="card" style="border: 1px solid <?php echo e($sur->bg); ?>;border-left: none;border-right: none;">
            <div class="card-content">
                <div class="card-body" style="text-align: center;">
                    <p class="text-center"><sup style="text-transform: uppercase;"><?php echo e($sur->nama_surat); ?></sup></p>
                    <p class="" style="font-size: 700%;border-bottom-right-radius: 40%;border-bottom-left-radius: 40%;">
                        <i class="bi bi-envelope-fill" style="color: <?php echo e($sur->bg); ?>"></i>
                    </p>
                </div>
            </div>
            <div class="card-footer" style="text-align: center">
                <a href="<?php echo e(route('request',$sur->nama_surat)); ?>" class="btn rounded-pill" style="border: 1px solid <?php echo e($sur->bg); ?>"> REQUEST </a>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item" style="background: <?php echo e($sur->bg); ?>"></li>
            </ul>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('desa/layout/app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\web-surat\resources\views/pengaju/home/home.blade.php ENDPATH**/ ?>