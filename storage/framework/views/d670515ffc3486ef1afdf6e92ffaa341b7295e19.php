<?php if($_GET['keyword']=="cek-surat"): ?>
<?php echo $__env->make('desa/template/3/cek', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php elseif($_GET['keyword']=="print-surat"): ?>
<?php echo $__env->make('desa/template/3/print', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php else: ?>
<center><h1>Tidak ada data di Temukan</h1></center>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\web-surat\resources\views/desa/template/3/3.blade.php ENDPATH**/ ?>