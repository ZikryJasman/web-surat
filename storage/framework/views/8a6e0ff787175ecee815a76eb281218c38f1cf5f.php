
<?php $__currentLoopData = $data['user']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php
$nama_template='desa/template/'.$dt->nama_template.'/'.$dt->nama_template;
?>
<?php echo $__env->make($nama_template, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH C:\xampp\htdocs\web-surat\resources\views/staff/cetak/pdf.blade.php ENDPATH**/ ?>