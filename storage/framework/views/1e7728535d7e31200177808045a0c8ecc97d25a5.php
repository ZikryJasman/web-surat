

<?php $__env->startSection('title','Cek Surat Cetak'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="row">
       <div class="col-lg-5 pb-4" style="background: white;box-shadow:2px 2px grey;">
       <!--  <form method="get" target="_blank" action="<?php echo e(route('cetak_surat',['surat'=>$dt->singkatan,'id_pengajuan'=>$dt->id_pengajuan])); ?>">
        <?php echo csrf_field(); ?> -->
        <a href="<?php echo e(route('cetak_surat',['surat'=>$dt->singkatan,'id_pengajuan'=>$dt->id_pengajuan])); ?>?keyword=print-surat" class="btn btn-sm form-control btn-primary mt-2"><i class="dripicons dripicons-print"></i></a>
        <!-- </form> -->
    </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php  
$nama_template='desa/template/'.$dt->nama_template.'/'.$dt->nama_template;
?>
<?php echo $__env->make($nama_template, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('desa/layout/app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\web-surat\resources\views/staff/cetak/cek.blade.php ENDPATH**/ ?>