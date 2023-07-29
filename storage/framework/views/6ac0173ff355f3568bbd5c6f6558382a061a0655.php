<?php $__env->startSection('title','Dashboard Staff'); ?>
<?php $__env->startSection('content'); ?>
<div class="page-content">
    <section class="row">
        <div class="col-12">
            <div class="row">
                <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                $jml=DB::table('surat')->join('pengajuan','pengajuan.surat_id','=','surat.id_surat')->where('id_surat',$dt->id_surat)->where('pengajuan.selesai','Sudah di Konfirmasi')->count();
                $jml2=DB::table('surat')->join('pengajuan','pengajuan.surat_id','=','surat.id_surat')->where('id_surat',$dt->id_surat)->where('pengajuan.selesai','Surat Selesai')->count();
                $jml3=DB::table('surat')->join('pengajuan','pengajuan.surat_id','=','surat.id_surat')->where('id_surat',$dt->id_surat)->where('pengajuan.status_pengajuan','Pengecekan Permohonan')->count();
                $jml4=DB::table('surat')->join('pengajuan','pengajuan.surat_id','=','surat.id_surat')->where('id_surat',$dt->id_surat)->where('pengajuan.status_pengajuan','Data Belum Lengkap')->where('pengajuan.selesai','Lengkapi data')->count();
                ?>
                <div class="col-sm-6 col-lg-3">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon" style="background: <?php echo e($dt->bg); ?>">
                                        <i class="dripicons dripicons-document-edit"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold"><a href=""><?php echo e($dt->singkatan); ?></a></h6>
                                    
                                    <hr>
                                    <h6 class="font-extrabold mb-0"><?php echo e($jml2 .' Selesai'); ?></h6>
                                    <hr>
                                    <h6 class="font-extrabold mb-0"><?php echo e($jml3 .' Menunggu Staff'); ?></h6>
                                    <hr>
                                    <h6 class="font-extrabold mb-0"><?php echo e($jml4 .' Ajukan Ulang'); ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <!--  -->
            <!--  -->
        </div>
    </section>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('desa/layout/app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\web-surat\resources\views/staff/home/home.blade.php ENDPATH**/ ?>