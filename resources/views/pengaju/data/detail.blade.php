<div class="modal fade text-left" id="detail{{$dt->id_pengajuan}}" tabindex="-1"
    role="dialog" aria-labelledby="myModalLabel160"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
    role="document">
    <div class="modal-content">
        <div class="modal-header bg-primary">
            <h5 class="modal-title white" id="myModalLabel160">
                Detail Info
            </h5>
            <button type="button" class="close"
            data-bs-dismiss="modal" aria-label="Close">
            <i data-feather="x"></i>
        </button>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-lg-6">
                Request Surat
            </div>
            <div class="col-lg-6">
                {{$dt->nama_surat}}
            </div>
            <div class="col-lg-6">
                Nomor Surat
            </div>
            <div class="col-lg-6">
                {{$dt->nomor_surat}}
            </div>
            <div class="col-lg-6">
                Tanggal Request
            </div>
            <div class="col-lg-6">
                {{$dt->tgl_req}}
            </div>
            <div class="col-lg-6">
                Catatan Lain
            </div>
            <div class="col-lg-6">
                {{$dt->keperluan}}
            </div>
            <div class="col-lg-6">
                Nama Lengkap
            </div>
            <div class="col-lg-6">
                {{$dt->name}}
            </div>
            <div class="col-lg-6">
                NIM
            </div>
            <div class="col-lg-6">
                {{$dt->nim}}
            </div>
            <div class="col-lg-6">
                Status Pengajuan
            </div>
            <div class="col-lg-6">
                @if($dt->status_pengajuan=="Pengecekan Permohonan")
                Data Sedang di Periksa
                @else
                {{$dt->status_pengajuan}}
                @endif
            </div>
            <!-- <div class="col-lg-6 mt-5">
                <b><i>Note : </i></b>
            </div>
            <div class="col-lg-6">
                <i><b>SILAHKAN TUNGGU PENGAJUAN SEDANG DI VERIFIKASI, INFO AKAN DI KIRIM MELALUI EMAIL ANDA.</b></i>
            </div> -->
            <hr>
            @foreach($pelengkap as $br)
            @if($br->pengajuan_id==$dt->id_pengajuan)
            <div class="col-lg-2">
                <img src="{{asset('pengajuan_berkas')}}/{{$br->data_berkas}}" width="50">
            </div>
            @endif
            @endforeach
        </div>
    </div>
    <div class="modal-footer">
        <button type="button"
        class="btn btn-light-secondary"
        data-bs-dismiss="modal">
        <i class="bx bx-x d-block d-sm-none"></i>
        <span class="d-none d-sm-block">Close</span>
    </button>
    <!--  -->
</div>
</div>
</div>
</div>
