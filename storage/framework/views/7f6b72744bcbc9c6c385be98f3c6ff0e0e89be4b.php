<div class="modal fade text-left" id="detail<?php echo e($dt->id_pengajuan); ?>" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel160" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title white" id="myModalLabel160">
                    Detail Info
                </h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6 mb-1">
                        Nama Lengkap :
                    </div>
                    <div class="col-lg-6 mb-1 text-black">
                        <?php echo e($dt->name); ?>

                    </div>
                    <div class="col-lg-6 mb-1">
                        Request Surat :
                    </div>
                    <div class="col-lg-6 mb-1 text-black">
                        <?php echo e($dt->nama_surat); ?>

                    </div>
                    <div class="col-lg-6 mb-1">
                        Nomor Surat :
                    </div>
                    <div class="col-lg-6 mb-1 text-black">
                        <?php echo e($dt->nomor_surat); ?>

                    </div>
                    <div class="col-lg-6 mb-1">
                        Tanggal Request :
                    </div>
                    <div class="col-lg-6 mb-1 text-black">
                        <?php echo e(parseDateIdFull($dt->tgl_req) . ' WIB'); ?>

                    </div>
                    <div class="col-lg-6 mb-1">
                        Catatan Lain :
                    </div>
                    <div class="col-lg-6 mb-1 text-black">
                        <?php echo e($dt->keperluan); ?>

                    </div>
                    <div class="col-lg-6 mb-1">
                        NIM :
                    </div>
                    <div class="col-lg-6 mb-1 text-black">
                        <?php echo e($dt->nim); ?>

                    </div>
                    <div class="col-lg-6 mb-1">
                        Status Pengajuan :
                    </div>
                    <div class="col-lg-6 mb-1 text-black">
                        <?php if($dt->status_pengajuan == 'Pengecekan Permohonan'): ?>
                            Data Sedang di Periksa
                        <?php else: ?>
                            <?php echo e($dt->status_pengajuan); ?>

                        <?php endif; ?>
                    </div>
                    <div class="col-lg-6 mb-1">
                        Berkas Word :
                    </div>
                    <div class="col-lg-6 mb-1 text-black">
                        <a href="<?php echo e('https://indonesiasehat.org/web-surat/public/' . $dt->path_upload); ?>"
                            target="_blank"> <?php echo e($dt->path_upload); ?></a>
                    </div>
                    <!-- <div class="col-lg-6 mt-5">
                <b><i>Note : </i></b>
            </div>
            <div class="col-lg-6">
                <i><b>SILAHKAN TUNGGU PENGAJUAN SEDANG DI VERIFIKASI, INFO AKAN DI KIRIM MELALUI EMAIL ANDA.</b></i>
            </div> -->
                    <hr>
                    <div class="col-lg-2">
                        <?php $__currentLoopData = $pelengkap; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $br): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($br->pengajuan_id == $dt->id_pengajuan): ?>
                                <img src="<?php echo e('https://indonesiasehat.org/web-surat/public/' . $br->data_berkas); ?>"
                                    width="50">
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Tutup</span>
                </button>
                <!--  -->
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\web-surat\resources\views/pengaju/data/detail.blade.php ENDPATH**/ ?>