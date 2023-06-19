<?php $__env->startSection('title','Surat Permohonan'); ?>

<?php $__env->startSection('content'); ?>
<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title"><?php echo e(Auth::user()->name); ?> - Request</h4>
            <sup>FORM REQUEST PERMOHONAN</sup>
        </div>

        <div class="card-body">
            <form method="post" enctype="multipart/form-data" action="<?php echo e(route('add_request')); ?>">
                <?php echo csrf_field(); ?>
                <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="row">
                    <div class="col-xl-12">
                        <h6>Persyaratan Permohonan <?php echo e($surat->nama_surat); ?></h6>
                        <div class="form-group">
                            <?php
                            $array = explode(PHP_EOL, $surat->persyaratan);
                            $total = count($array);
                            foreach($array as $item) {
                              echo "<span>". $item . "</span><br>";
                          }
                          ?>
                      </div>
                  </div>
                  <hr>
                  <div class="col-md-6">
                    <h6>Nama Lengkap</h6>
                    <div class="form-group position-relative has-icon-left">
                        <input type="text" value="<?php echo e($dt->name); ?>" readonly="" style="background: transparent;" class="form-control"
                        placeholder="Lengkapi Biodata Anda" value="">
                        <div class="form-control-icon">
                            <i class="dripicons dripicons-information"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <h6>Tempat/Tanggal Lahir</h6>
                    <div class="form-group position-relative has-icon-left">
                        <input type="text" value="<?php echo e($dt->tempat); ?>/<?php echo e($dt->tgl_lahir); ?>" readonly="" style="background: transparent;" class="form-control"
                        placeholder="Lengkapi Biodata Anda" value="">
                        <div class="form-control-icon">
                            <i class="dripicons dripicons-information"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <h6>Nim</h6>
                    <div class="form-group position-relative has-icon-left">
                        <input type="text" value="<?php echo e($dt->nim); ?>" readonly="" style="background: transparent;" class="form-control"
                        placeholder="Lengkapi Biodata Anda" value="">
                        <div class="form-control-icon">
                            <i class="dripicons dripicons-information"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <h6>Program Studi</h6>
                    <div class="form-group position-relative has-icon-left">
                        <input type="text" value="<?php echo e($dt->program->nama ?? ''); ?>" readonly="" style="background: transparent;" class="form-control"
                        placeholder="Lengkapi Biodata Anda" value="">
                        <div class="form-control-icon">
                            <i class="dripicons dripicons-information"></i>
                        </div>
                    </div>
                </div>
                <input type="hidden" value="<?php echo e($surat->id_surat); ?>" name="id_surat">
                <input type="hidden" value="<?php echo e($surat->singkatan); ?>" name="singkatan">
                <div class="col-md-6">
                    <h6>Tahun Ajaran</h6>
                    <div class="form-group position-relative has-icon-left">
                        <input type="text" value="<?php echo e($dt->tahun_ajaran); ?>" readonly="" style="background: transparent;" class="form-control"
                        placeholder="Lengkapi Biodata Anda" value="">
                        <div class="form-control-icon">
                            <i class="dripicons dripicons-information"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <h6>Jenis Kelamin</h6>
                    <div class="form-group position-relative has-icon-left">
                        <input type="text" value="<?php echo e($dt->jenis_kelamin); ?>" readonly="" style="background: transparent;" class="form-control"
                        placeholder="Lengkapi Biodata Anda" value="">
                        <div class="form-control-icon">
                            <i class="dripicons dripicons-information"></i>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12">
                    <h6>Catatan Lain</h6>
                    <div class="form-group position-relative has-icon-left">
                        <input type="text" required="" class="form-control" name="keperluan" value="">
                        <div class="form-control-icon">
                            <i class="dripicons dripicons-document-edit"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" id="after-add-more">
                <div class="col-xl-12">
                    <h6>Berkas Persyaratan</h6>
                    <div class="form-group position-relative">
                        <input type="file" name="berkas[]" multiple id="images" class="form-control">
                    </div>
                </div>
                <div class="col-xl-12">
                    <button class="form-control btn btn-sm btn-success" id="add-more" type="button"><i class="dripicons dripicons-plus"></i></button>
                </div>
            </div>
            <div class="row" id="copy">
                <div class="row" id="control-group">
                    <div class="col-xl-12">
                        <h6>Berkas Persyaratan</h6>
                        <div class="form-group position-relative">
                            <input type="file" name="berkas[]" multiple class="form-control">
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <button class="btn btn-sm btn-danger form-control" id="remove" type="button"><i class="dripicons dripicons-trash"></i></button>
                    </div>
                </div>
            </div>
            <div class="col-xl-12 mt-2">
                <button class="btn btn-sm btn-primary form-control">Konfirmasi</button>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </form>
</div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('desa/layout/app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\web-surat\resources\views/pengaju/request/index.blade.php ENDPATH**/ ?>