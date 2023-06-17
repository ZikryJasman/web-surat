            <div class="modal fade text-left" id="inlineFormprofil" tabindex="-1"
            role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable"
            role="document">
            <div class="modal-content" style="border-bottom:1px solid blue;">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Ubah Profile </h4>
                    <button type="button" class="close" data-bs-dismiss="modal"
                    aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('update_profil_pengurus')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <label>EMAIL:</label>
                            <div class="form-group">
                                <input type="email" value="{{$cst->email}}" name="email"
                                class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label>NAME:</label>
                            <div class="form-group">
                                <input type="text" value="{{$cst->name}}" name="name"
                                class="form-control">
                            </div>
                        </div>
                        @if(Auth::user()->level=="Pengaju")
                        <div class="col-lg-6">
                            <label>Program Studi:</label>
                            <div class="form-group">
                                <input type="text" value="{{$cst->program_studi}}" name="program_studi"
                                class="form-control">
                            </div>
                        </div>
                        @else
                        <div class="col-lg-6">
                            <label>JABATAN:</label>
                            <div class="form-group">
                                <select class="form-control" name="level">
                                    <option <?php if($cst->level=="Staff"){echo "selected";} ?> value="Staff">Staff</option>
                                    <option <?php if($cst->level=="Kepala Desa"){echo "selected";} ?> value="Kepala Desa">Wakil Dekan</option>
                                </select>
                            </div>
                        </div>

                        @endif
                        <div class="col-lg-6">
                            <label>Pangkat/Golongan:</label>
                            <div class="form-group">
                                <input type="text" value="{{$cst->pangkat}}" name="pangkat"
                                class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label>PONSEL:</label>
                            <div class="form-group">
                                <input type="number" value="{{$cst->telepon}}" name="telepon"
                                class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label>NIM:</label>
                            <div class="form-group">
                                <input type="number" name="nim" value="{{$cst->nim}}"
                                class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label>TAHUN AJARAN:</label>
                            <div class="form-group">
                                <input type="text" name="tahun_ajaran" value="{{$cst->tahun_ajaran}}"
                                class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <label>TEMPAT LAHIR:</label>
                            <div class="form-group">
                                <input type="text" name="tempat" value="{{$cst->tempat}}"
                                class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <label>JENIS KELAMIN:</label>
                            <div class="form-group">
                                <select class="form-control" name="jenis_kelamin">
                                    <option <?php if($cst->jenis_kelamin=="Laki-Laki"){echo "selected";} ?> value="Laki-Laki">Laki-Laki</option>
                                    <option <?php if($cst->jenis_kelamin=="Perempuan"){echo "selected";} ?> value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <label>TANGGAL LAHIR:</label>
                            <div class="form-group">
                                <input type="date" name="tgl_lahir" value="{{$cst->tgl_lahir}}"
                                class="form-control">
                            </div>
                        </div>
                        <div class="col-xl-12">
                            <label>FOTO PROFIL:</label>
                            <div class="form-group">
                                <input type="file" name="foto"
                                class="form-control">
                            </div>
                        </div>
                        <div class="col-xl-12">
                            <label>ALAMAT: </label>
                            <div class="form-group">
                                <textarea class="form-control" rows="4" name="alamat">{{$cst->alamat}}</textarea>
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
