

<?php $__env->startSection('title','Data Prosedur'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data Table</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                Table With Data Prosedur
                <?php if($cek=='0'): ?>
                <button type="button" style="float: right;" class="btn btn-sm btn-outline-primary block" data-bs-toggle="modal"
                data-bs-target="#default">
                Tambah Data
            </button>
            <?php endif; ?>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="table1">
                <thead>
                    <tr>
                        <th>Prosedur</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; ?>
                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td>
                            <?php
                            $array = explode(PHP_EOL, $dt->prosedur);
                            $total = count($array);
                            foreach($array as $item) {
                                echo "<span>". $item . "</span><br>";
                            }
                            ?>
                        </td>
                        <td align="center">
                            <a href="" data-bs-toggle="modal"
                            data-bs-target="#edit<?php echo e($dt->id_prosedur); ?>" class="btn btn-sm rounded-pill btn-success">
                            <i class="dripicons dripicons-document-edit"></i></a>
                            <a href="<?php echo e(route('hapus_prosedur',$dt->id_prosedur)); ?>" onclick="return confirm('Lanjutkan Hapus Data?')" class="btn btn-sm rounded-pill btn-danger">
                                <i class="dripicons dripicons-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php echo $__env->make('desa/prosedur/update', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php $no++ ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>

</section>
</div>
<?php echo $__env->make('desa/prosedur/tambah', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('desa/layout/app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\web-surat\resources\views/desa/prosedur/prosedur.blade.php ENDPATH**/ ?>