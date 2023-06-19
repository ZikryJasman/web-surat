            <div class="modal fade text-left" id="default" tabindex="-1"
            role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable"
            role="document">
            <div class="modal-content" style="border-bottom:1px solid blue;">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Tambah Data Pengurus </h4>
                    <button type="button" class="close" data-bs-dismiss="modal"
                    aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="<?php echo e(route('tambah_pengurus')); ?>" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="col-lg-6">
                            <label>EMAIL:</label>
                            <div class="form-group">
                                <input type="email" required name="email" value=""
                                class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label>PASSWORD:</label>
                            <div class="form-group">
                                <input type="password" required name="password" value=""
                                class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <label>NAMA:</label>
                            <div class="form-group">
                                <input type="text" required name="name" value=""
                                class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <label>JABATAN:</label>
                            <div class="form-group">
                                <select class="form-control" required="" name="level">
                                    <option value="">-- PILIH JABATAN --</option>
                                    <option value="Staff">STAFF</option>
                                    <option value="Kepala Desa">Wakil Dekan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <label>Pangkat / Golongan:</label>
                            <div class="form-group">
                                <input type="text" required name="pangkat" value=""
                                class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <label>PONSEL:</label>
                            <div class="form-group">
                                <input type="number" required name="telepon" value=""
                                class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label>NIM:</label>
                            <div class="form-group">
                                <input type="number" required name="nim" value=""
                                class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label>TAHUN AJARAN:</label>
                            <div class="form-group">
                                <input type="number" required name="tahun_ajaran" value=""
                                class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <label>TEMPAT LAHIR:</label>
                            <div class="form-group">
                                <input type="text" required name="tempat"
                                class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <label>JENIS KELAMIN:</label>
                            <div class="form-group">
                                <select class="form-control" name="jenis_kelamin" required="">
                                    <option value="">-- PILIH JENIS KELAMIN --</option>
                                    <option value="Laki-Laki">Laki-Laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <label>TANGGAL LAHIR:</label>
                            <div class="form-group">
                                <input type="date" required="" name="tgl_lahir" value=""
                                class="form-control">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>FOTO PROFIL</label>
                                <div class="file-upload" style="width:100%;">
                                    <div class="image-upload-wrap">
                                        <input class="file-upload-input" name="foto" type='file' onchange="readURL(this);" accept="image/*" />
                                        <div class="drag-text">
                                            <h3>Tarik Foto ke sini</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="file-upload-content">
                                    <img class="file-upload-image" src="#" alt="your image" />
                                    <div class="image-title-wrap">
                                        <button type="button" onclick="removeUpload()" class="remove-image">Hapus <span class="image-title">Uploaded Image</span></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12">
                            <label>ALAMAT: </label>
                            <div class="form-group">
                                <textarea class="form-control" required="" rows="4" name="alamat"></textarea>
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
</div>
<?php /**PATH C:\xampp\htdocs\web-surat\resources\views/desa/user/tambah.blade.php ENDPATH**/ ?>