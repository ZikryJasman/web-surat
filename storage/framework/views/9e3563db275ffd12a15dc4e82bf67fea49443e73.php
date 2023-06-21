            <div class="modal fade text-left" id="inlineFormprofil" tabindex="-1" role="dialog"
                aria-labelledby="myModalLabel33" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
                    <div class="modal-content" style="border-bottom:1px solid blue;">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel33">Ubah Profile </h4>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="<?php echo e(route('update_profil_pengurus')); ?>"
                                enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label>EMAIL:</label>
                                        <div class="form-group">
                                            <input type="email" value="<?php echo e($cst->email); ?>" name="email"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>NAME:</label>
                                        <div class="form-group">
                                            <input type="text" value="<?php echo e($cst->name); ?>" name="name"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <?php if(Auth::user()->level == 'Pengaju'): ?>
                                        <div class="col-lg-6">
                                            <label>Program Studi:</label>
                                            <div class="form-group">
                                                <select class="form-control" required="" name="program_id">
                                                    <option value="">-- Pilih Program --</option>
                                                    <?php $__currentLoopData = $program; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($p->id); ?>"
                                                            <?php echo e($cst->program_id == $p->id ? 'selected' : ''); ?>>
                                                            <?php echo e($p->nama); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        </div>
                                    <?php else: ?>
                                        <div class="col-lg-6">
                                            <label>JABATAN:</label>
                                            <div class="form-group">
                                                <select class="form-control" name="level">
                                                    <option <?php if ($cst->level == 'Staff') {
                                                        echo 'selected';
                                                    } ?> value="Staff">Staff</option>
                                                    <option <?php if ($cst->level == 'Kepala Desa') {
                                                        echo 'selected';
                                                    } ?> value="Kepala Desa">Wakil Dekan</option>
                                                </select>
                                            </div>
                                        </div>

                                    <?php endif; ?>
                                    <div class="col-lg-6">
                                        <label>Pangkat/Golongan:</label>
                                        <div class="form-group">
                                            <input type="text" value="<?php echo e($cst->pangkat); ?>" name="pangkat"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>PONSEL:</label>
                                        <div class="form-group">
                                            <input type="number" value="<?php echo e($cst->telepon); ?>" name="telepon"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>NIM:</label>
                                        <div class="form-group">
                                            <input type="text" name="nim" value="<?php echo e($cst->nim); ?>"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>TAHUN AJARAN:</label>
                                        <div class="form-group">
                                            <input type="text" name="tahun_ajaran" value="<?php echo e($cst->tahun_ajaran); ?>"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>TEMPAT LAHIR:</label>
                                        <div class="form-group">
                                            <input type="text" name="tempat" value="<?php echo e($cst->tempat); ?>"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>JENIS KELAMIN:</label>
                                        <div class="form-group">
                                            <select class="form-control" name="jenis_kelamin">
                                                <option <?php if ($cst->jenis_kelamin == 'Laki-Laki') {
                                                    echo 'selected';
                                                } ?> value="Laki-Laki">Laki-Laki</option>
                                                <option <?php if ($cst->jenis_kelamin == 'Perempuan') {
                                                    echo 'selected';
                                                } ?> value="Perempuan">Perempuan</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>TANGGAL LAHIR:</label>
                                        <div class="form-group">
                                            <input type="date" name="tgl_lahir" value="<?php echo e($cst->tgl_lahir); ?>"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <label>FOTO PROFIL:</label>
                                        <div class="form-group">
                                            <input type="file" name="foto" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <label>ALAMAT: </label>
                                        <div class="form-group">
                                            <textarea class="form-control" rows="4" name="alamat"><?php echo e($cst->alamat); ?></textarea>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                <i class="bx bx-x d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Tutup</span>
                            </button>
                            <button type="submit" class="btn btn-primary ml-1">
                                <i class="bx bx-check d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Simpan</span>
                            </button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
<?php /**PATH C:\xampp\htdocs\web-surat\resources\views/pengaju/profil/ubah.blade.php ENDPATH**/ ?>