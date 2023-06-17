<div class="modal fade text-left" id="layanan" tabindex="-1" role="dialog"
aria-labelledby="myModalLabel1" aria-hidden="true">
<div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="myModalLabel1">Menambah Data Pelayanan</h5>
            <button type="button" class="close rounded-pill"
            data-bs-dismiss="modal" aria-label="Close">
            <i data-feather="x"></i>
        </button>
    </div>

    <div class="modal-body">
        <form method="post" action="<?php echo e(route('tambah_layanan')); ?>" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="row" id="after-add-more">
                <div class="col-12">
                    <div class="form-group">
                        <label>Hari</label>
                        <input type="text" required="" class="form-control" name="hari[]">
                    </div>
                    <div class="form-group">
                        <label>Jam Pelayanan</label>
                        <input type="time" required="" class="form-control" name="waktu[]">
                        <input type="time" required="" class="form-control mt-1" name="sampai[]">
                    </div>  
                </div>
                <div class="col-12">
                    <button class="btn btn-sm btn-success form-control" id="add-more" type="button"><i class="dripicons dripicons-plus"></i></button>
                </div>
            </div>
            <button class="btn btn-sm btn-primary form-control mt-2">Tambah</button>
        </form>
        <div class="row" id="copy">
            <div class="row" id="control-group">
                <div class="form-group">
                    <label>Hari</label>
                    <input type="text" required="" class="form-control" name="hari[]">
                </div>
                <div class="form-group">
                    <label>Jam Pelayanan</label>
                    <input type="time" required="" class="form-control" name="waktu[]">
                    <input type="time" required="" class="form-control mt-1" name="sampai[]">
                </div> 
                <div class="col-12">
                    <button class="btn btn-sm btn-danger form-control" id="remove" type="button"><i class="dripicons dripicons-trash"></i></button>
                </div>
            </div>
        </div>

    </div>
</div>
</div>
</div><?php /**PATH C:\xampp\htdocs\web-surat\resources\views/desa/layanan/tambah.blade.php ENDPATH**/ ?>