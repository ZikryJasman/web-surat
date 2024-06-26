<div class="modal fade text-left" id="detail{{ $dt->id_pengajuan }}" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel160" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title white" id="myModalLabel160">
                    Detail Info
                </h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6 mb-1">
                        Nama Lengkap :
                    </div>
                    <div class="col-lg-6 mb-1 text-black">
                        {{ $dt->name }}
                    </div>
                    <div class="col-lg-6 mb-1">
                        Request Surat :
                    </div>
                    <div class="col-lg-6 mb-1 text-black">
                        {{ $dt->nama_surat }}
                    </div>
                    {{-- <div class="col-lg-6 mb-1">
                        Nomor Surat :
                    </div>
                    <div class="col-lg-6 mb-1 text-black">
                        {{ $dt->nomor_surat }}
                    </div> --}}
                    <div class="col-lg-6 mb-1">
                        Tanggal Request :
                    </div>
                    <div class="col-lg-6 mb-1 text-black">
                        {{ parseDateIdFull($dt->tgl_req) . ' WIB' }}
                    </div>
                    <div class="col-lg-6 mb-1">
                        Catatan Lain :
                    </div>
                    <div class="col-lg-6 mb-1 text-black">
                        {{ $dt->keperluan }}
                    </div>
                    <div class="col-lg-6 mb-1">
                        NIM :
                    </div>
                    <div class="col-lg-6 mb-1 text-black">
                        {{ $dt->nim }}
                    </div>
                    <div class="col-lg-6 mb-1">
                        Status Pengajuan :
                    </div>
                    <div class="col-lg-6 mb-1 text-black">
                        @if ($dt->status_pengajuan == 'Pengecekan Permohonan')
                            Data Sedang di Periksa
                        @else
                            {{ $dt->status_pengajuan }}
                        @endif
                    </div>
                    <div class="col-lg-6 mb-1">
                        Berkas Word :
                    </div>
                    <div class="col-lg-6 mb-1 text-black">
                        <a href="{{ 'https://indonesiasehat.org/web-surat/public/' . $dt->path_upload }}"
                            target="_blank"> {{ 'https://indonesiasehat.org/web-surat/public/' . $dt->path_upload }}</a>
                    </div>
                    @if ($dt->status_pengajuan == 'Data Belum Lengkap')
                        <div class="col-lg-6 mb-1" style="color:red">
                            Catatan dari staff :
                        </div>
                        <div class="col-lg-6 mb-1 text-black">
                            <textarea class="form-control text-black" id="note" readonly rows="3">{{ $dt->note }}</textarea>
                        </div>
                    @endif
                    <!-- <div class="col-lg-6 mt-5">
                <b><i>Note : </i></b>
            </div>
            <div class="col-lg-6">
                <i><b>SILAHKAN TUNGGU PENGAJUAN SEDANG DI VERIFIKASI, INFO AKAN DI KIRIM MELALUI EMAIL ANDA.</b></i>
            </div> -->
                    <hr>
                    <div class="col-lg-2">
                        @foreach ($pelengkap as $br)
                            @if ($br->pengajuan_id == $dt->id_pengajuan)
                                <a href="{{ 'https://indonesiasehat.org/web-surat/public/' . $br->data_berkas }}"
                                    target="_blank">
                                    <img src="{{ 'https://indonesiasehat.org/web-surat/public/' . $br->data_berkas }}">
                                </a>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Tutup</span>
                </button>
                <!--  -->
            </div>
        </div>
    </div>
</div>
