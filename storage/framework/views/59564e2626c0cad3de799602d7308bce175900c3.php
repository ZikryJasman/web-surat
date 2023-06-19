<div class="modal fade text-left" id="edit<?php echo e($pgn->id); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel1">Update Data Pelayanan</h5>
                <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>

            <div class="modal-body">
                <form method="post" action="<?php echo e(route('program.update', $pgn->id)); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Nama Program Studi</label>
                                <input type="text" value="<?php echo e($pgn->nama); ?>" class="form-control" name="nama">
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-sm btn-primary form-control mt-2">Ubah</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\web-surat\resources\views/desa/program/update.blade.php ENDPATH**/ ?>