<?php $__env->startSection('title', 'Cek Pelengkap Permohonan'); ?>

<?php $__env->startSection('content'); ?>
    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-8">

                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="form-body">
                                <div class="row">
                                    
                                    <div class="col-lg-6">
                                        <form class="form form-vertical" method="post"
                                            action="<?php echo e(route('keterangan', $data->id_pengajuan)); ?>"
                                            enctype="multipart/form-data">
                                            <?php echo csrf_field(); ?>
                                            <div class="form-group">
                                                <label for="first-name-vertical">Keterangan</label>
                                                <select class="form-control" name="keterangan">
                                                    <option <?php if ($data->status_pengajuan == 'Data Sudah Lengkap') {
                                                        echo 'selected';
                                                    } ?> value="Data Sudah Lengkap">Data Sudah
                                                        Lengkap</option>
                                                    <option <?php if ($data->status_pengajuan == 'Data Belum Lengkap') {
                                                        echo 'selected';
                                                    } ?> value="Data Belum Lengkap">Data Belum
                                                        Lengkap</option>
                                                </select>
                                                <input type="hidden" value="<?php echo e($data->singkatan); ?>" name="singkatan">
                                                <label for="first-name-vertical" style="color:red;padding-top: .5rem">Catatan
                                                    Staff(<span style="font-size: 12px">input jika berkas tidak
                                                        lengkap</span>)</label>
                                                <div class="form-group position-relative">
                                                    <textarea class="form-control text-black" name="note" id="note" rows="3"><?php echo e($data->note); ?></textarea>
                                                </div>
                                                <label for="first-name-vertical" style="padding-top: .5rem">Upload
                                                    Berkas Pdf (<span style="font-size: 12px">input jika berkas sudah
                                                        lengkap</span>)</label>
                                                <div class="form-group position-relative">
                                                    <input type="file" name="upload_berkas" id="upload_berkas"
                                                        class="form-control">
                                                </div>
                                                <button class="btn btn-sm btn-outline-primary rounded-pill mt-3"> <i
                                                        class="icon dripicons-document-edit"></i> Ubah</button>
                                            </div>

                                        </form>
                                    </div>
                                    
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="first-name-vertical">Konfirmasi</label>
                                            <a href="<?php echo e(route('konfirmasi', ['surat' => $data->singkatan, 'id_pengajuan' => $data->id_pengajuan])); ?>"
                                                class="btn btn-sm btn-outline-success rounded-pill mt-2 form-control">
                                                <i class="icon dripicons-checkmark"></i> Confirm </a>
                                        </div>
                                    </div>
                                    <hr>
                                    
                                    <div class="col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="email-id-vertical">NIM</label>
                                            <p class="text-black"><?php echo e($data->nim); ?></p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="email-id-vertical">Nama Lengkap</label>
                                            <p class="text-black"><?php echo e($data->name); ?></p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="email-id-vertical">Email</label>
                                            <p class="text-black"><?php echo e($data->email); ?></p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="email-id-vertical">Telepon</label>
                                            <p class="text-black"><?php echo e($data->telepon); ?></p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="email-id-vertical">Tahun Ajaran</label>
                                            <p class="text-black"><?php echo e($data->tahun_ajaran); ?></p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="email-id-vertical">Alamat</label>
                                            <p class="text-black"><?php echo e($data->alamat); ?></p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="email-id-vertical">Jenis Kelamin</label>
                                            <p class="text-black"><?php echo e($data->jenis_kelamin); ?></p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="email-id-vertical">Tempat Lahir</label>
                                            <p class="text-black"><?php echo e($data->tempat); ?></p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="email-id-vertical">Program Studi</label>
                                            <p class="text-black"><?php echo e($data->program->nama ?? ''); ?></p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="email-id-vertical">Tanggal Lahir</label>
                                            <p class="text-black"><?php echo e(parseDateId($data->tgl_lahir)); ?></p>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="alamat" class="form-label">Alamat</label>
                                            <textarea class="form-control text-black" id="alamat" readonly rows="3"><?php echo e($data->alamat); ?></textarea>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="email-id-vertical">Status Pengajuan</label>
                                            <p class="text-black"><?php echo e($data->status_pengajuan); ?></p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="email-id-vertical">Keterangan</label>
                                            <p class="text-black">
                                                <?php if($data->selesai == null): ?>
                                                    Menunggu Konfirmasi
                                                <?php endif; ?>
                                                <?php if($data->selesai !== null): ?>
                                                    <?php echo e($data->selesai); ?>

                                                <?php endif; ?>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="email-id-vertical">Request Surat</label>
                                            <p class="text-black"><?php echo e($data->nama_surat); ?></p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="email-id-vertical">Tanggal Request</label>
                                            <p class="text-black"><?php echo e(parseDateIdFull($data->tgl_req) . ' WIB'); ?></p>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="email-id-vertical" class="form-label">Berkas Word</label>
                                            <a href="<?php echo e('https://indonesiasehat.org/web-surat/public/' . $data->path_upload); ?>"
                                                target="_blank"><?php echo e($data->path_upload ?? ''); ?></a>
                                            
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="email-id-vertical" class="form-label">Catatan Lain</label>
                                            <textarea class="form-control text-black" id="alamat" readonly rows="3"><?php echo e($data->keperluan); ?></textarea>
                                        </div>
                                    </div>

                                    
                                    
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
                                        <a href="<?php echo e('https://indonesiasehat.org/web-surat/public/' . $brk->data_berkas); ?>"
                                            target="_blank">
                                            <img src="<?php echo e('https://indonesiasehat.org/web-surat/public/' . $brk->data_berkas); ?>"
                                                class="img-thumbnail">
                                        </a>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('desa/layout/app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\web-surat\resources\views/staff/acc/cek.blade.php ENDPATH**/ ?>