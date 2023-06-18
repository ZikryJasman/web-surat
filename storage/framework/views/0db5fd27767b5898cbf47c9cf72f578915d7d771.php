<?php $__env->startSection('title','Data Surat'); ?>

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
                Table With Data Surat yang di Sediakan
                <button type="button" style="float: right;" class="btn btn-sm btn-outline-primary block" data-bs-toggle="modal"
                data-bs-target="#default">
                Tambah Data
            </button>
        </div>
        <div class="card-body" style="overflow-x:scroll;">
            <table class="table table-striped" id="table1">
                <thead>
                    <tr>
                        <th>No. </th>
                        <th>Nama Surat</th>
                        <th>Singkatan</th>
                        
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; ?>
                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($no); ?>. </td>
                        <td><?php echo e($dt->nama_surat); ?></td>
                        <td><?php echo e($dt->singkatan); ?></td>
                        
                        <td align="center">
                            <a href="" data-bs-toggle="modal"
                            data-bs-target="#edit<?php echo e($dt->id_surat); ?>" class="btn btn-sm rounded-pill btn-success">
                            <i class="dripicons dripicons-document-edit"></i></a>
                            <a href="<?php echo e(route('hapus_surat',$dt->id_surat)); ?>" onclick="return confirm('Lanjut Hapus Surat <?php echo e($dt->nama_surat); ?>')" class="btn btn-sm rounded-pill btn-danger">
                                <i class="dripicons dripicons-trash"></i>
                            </a>
                            <a href="<?php echo e(route('template',['title'=>Auth::user()->title_user,'id_surat'=>$dt->id_surat])); ?>" class="btn btn-sm rounded-pill btn-primary">
                                <i class="dripicons dripicons-blog"></i>
                            </a>
                        </td>
                    </tr>
                    <?php echo $__env->make('desa/surat/update', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php $no++ ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>

</section>
</div>
<?php echo $__env->make('desa/surat/tambah', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('desa/layout/app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\web-surat\resources\views/desa/surat/surat.blade.php ENDPATH**/ ?>