<div class="modal fade text-left" id="edit<?php echo e($dt->id_surat); ?>" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel1">Update Data Surat</h5>
                <button type="button" class="close rounded-pill"
                data-bs-dismiss="modal" aria-label="Close">
                <i data-feather="x"></i>
            </button>
        </div>
        <form method="post" action="<?php echo e(route('edit_surat',$dt->id_surat)); ?>" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label>Pengajuan Surat yang di Sediakan</label>
                            <input type="text" class="form-control" value="<?php echo e($dt->nama_surat); ?>" name="nama_surat">
                        </div>
                        <div class="form-group">
                            <label>Warna Background</label>
                            <input type="color" class="form-control" value="<?php echo e($dt->bg); ?>" name="bg">
                        </div>  
                        <div class="form-group">
                            <label>Persyaratan</label>
                            <textarea class="form-control" rows="5" name="persyaratan"><?php echo e($dt->persyaratan); ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Close</span>
                </button>
                <button class="btn btn-primary ml-1">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Accept</span>
                </button>
            </div>
        </form>
    </div>
</div>
</div><?php /**PATH C:\xampp\htdocs\web-surat\resources\views/desa/surat/update.blade.php ENDPATH**/ ?>