<?php $__env->startSection('title','Cek Pelengkap Permohonan'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-content">
    <section class="row">
        <div class="col-12 col-lg-8">

            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="form-body">
                            <div class="row">
                                <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-lg-6">
                                    <form class="form form-vertical" method="post" action="<?php echo e(route('keterangan',$dt->id_pengajuan)); ?>">
                                        <?php echo csrf_field(); ?>
                                        <div class="form-group">
                                            <label for="first-name-vertical">Keterangan</label>
                                            <select class="form-control" name="keterangan">
                                                <option <?php if($dt->status_pengajuan=="Data Sudah Lengkap"){echo "selected";} ?> value="Data Sudah Lengkap">Data Sudah Lengkap</option>
                                                <option <?php if($dt->status_pengajuan=="Data Belum Lengkap"){echo "selected";} ?> value="Data Belum Lengkap">Data Belum Lengkap</option>
                                            </select>
                                            <button class="btn btn-sm btn-outline-primary rounded-pill mt-3"> <i class="icon dripicons-document-edit"></i> Ubah</button>
                                        </div>
                                    </form>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Konfirmasi</label>
                                        <a href="<?php echo e(route('konfirmasi',['surat'=>$dt->singkatan,'id_pengajuan'=>$dt->id_pengajuan])); ?>" class="btn btn-sm btn-outline-success rounded-pill mt-2 form-control"> <i class="icon dripicons-checkmark"></i> Confirm </a>
                                    </div>
                                </div>
                                <hr>
                                <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="email-id-vertical">NIM</label>
                                        <p><?php echo e($dt->nim); ?></p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="email-id-vertical">Nama Lengkap</label>
                                        <p><?php echo e($dt->name); ?></p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="email-id-vertical">Email</label>
                                        <p><?php echo e($dt->email); ?></p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="email-id-vertical">Telepon</label>
                                        <p><?php echo e($dt->telepon); ?></p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="email-id-vertical">Tahun Ajaran</label>
                                        <p><?php echo e($dt->tahun_ajaran); ?></p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="email-id-vertical">Alamat</label>
                                        <p><?php echo e($dt->alamat); ?></p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="email-id-vertical">Jenis Kelamin</label>
                                        <p><?php echo e($dt->jenis_kelamin); ?></p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="email-id-vertical">Tempat Lahir</label>
                                        <p><?php echo e($dt->tempat); ?></p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="email-id-vertical">Program Studi</label>
                                        <p><?php echo e($dt->program_studi); ?></p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="email-id-vertical">Tanggal Lahir</label>
                                        <p><?php echo e($dt->tgl_lahir); ?></p>
                                    </div>
                                </div>
                                <hr>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="email-id-vertical">Catatan Lain</label>
                                        <p><?php echo e($dt->keperluan); ?></p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="email-id-vertical">Status Pengajuan</label>
                                        <p><?php echo e($dt->status_pengajuan); ?></p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="email-id-vertical">Keterangan</label>
                                        <p>
                                            <?php if($dt->selesai==NULL): ?>
                                            Menunggu Konfirmasi
                                            <?php endif; ?>
                                            <?php if($dt->selesai!==NULL): ?>
                                            <?php echo e($dt->keterangan); ?>

                                            <?php endif; ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="email-id-vertical">Request Surat</label>
                                        <p><?php echo e($dt->nama_surat); ?></p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="email-id-vertical">Tanggal Request</label>
                                        <p><?php echo e(parseDateIdFull($dt->tgl_req).' WIB'); ?></p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="email-id-vertical">Nomor Surat</label>
                                        <p><?php echo e($dt->nomor_surat); ?></p>
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-12 col-lg-4">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h4 class="card-title">Berkas Pengajuan</h4>
                        <hr>
                        <div class="form-body">
                            <?php $__currentLoopData = $berkas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="row mt-2">
                                <img src="<?php echo e(asset('pengajuan_berkas')); ?>/<?php echo e($brk->data_berkas); ?>" class="img-thumbnail">
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('desa/layout/app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\web-surat\resources\views/staff/acc/cek.blade.php ENDPATH**/ ?>