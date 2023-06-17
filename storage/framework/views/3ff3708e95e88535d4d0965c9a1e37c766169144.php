<div class="modal fade text-left" id="edit<?php echo e($dt->id_layanan); ?>" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel1">Update Data Pelayanan</h5>
                <button type="button" class="close rounded-pill"
                data-bs-dismiss="modal" aria-label="Close">
                <i data-feather="x"></i>
            </button>
        </div>

        <div class="modal-body">
            <form method="post" action="<?php echo e(route('edit_layanan',$dt->id_layanan)); ?>" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label>Hari</label>
                            <input type="text" value="<?php echo e($dt->hari); ?>" class="form-control" name="hari">
                        </div>
                        <div class="form-group">
                            <label>Jam Pelayanan</label>
                            <input type="time" class="form-control" name="waktu" value="<?php echo e($dt->waktu); ?>">
                            <input type="time" class="form-control mt-1" name="sampai" value="<?php echo e($dt->sampai); ?>">
                        </div>  
                    </div>
                </div>
                <button class="btn btn-sm btn-primary form-control mt-2">Ubah</button>
            </form>
        </div>
    </div>
</div>
</div><?php /**PATH C:\xampp\htdocs\web-surat\resources\views/desa/layanan/update.blade.php ENDPATH**/ ?>