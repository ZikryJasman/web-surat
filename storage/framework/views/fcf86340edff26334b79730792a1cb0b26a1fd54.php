            <div class="modal fade text-left" id="inlineForm" tabindex="-1"
            role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable"
            role="document">
            <div class="modal-content" style="border-bottom:1px solid blue;">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">SETING PROFIL </h4>
                    <button type="button" class="close" data-bs-dismiss="modal"
                    aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="<?php echo e(route('lengkapi',$cst->id)); ?>" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="col-lg-6">
                            <label>EMAIL:</label>
                            <div class="form-group">
                                <input type="email" name="email" value="<?php echo e($cst->email); ?>"
                                class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label>PONSEL:</label>
                            <div class="form-group">
                                <input type="number" name="telepon_desa" value="<?php echo e($cst->telepon_desa); ?>" 
                                class="form-control">
                            </div>
                        </div>
                        <div class="col-xl-12">
                            <label>LOGO:</label>
                            <div class="form-group">
                                <input type="file" name="foto"
                                class="form-control">
                            </div>
                        </div>
                        <div class="col-xl-12">
                            <label>LOKASI DESA: </label>
                            <div class="form-group">
                                <textarea class="form-control" rows="4" name="lokasi_desa"><?php echo e($cst->lokasi_desa); ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary"
                    data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Close</span>
                </button>
                <button type="submit" class="btn btn-primary ml-1">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Accept</span>
                </button>
            </div>
        </form>
    </div>
</div>
</div><?php /**PATH C:\xampp\htdocs\web-surat\resources\views/desa/profildesa/ubah.blade.php ENDPATH**/ ?>