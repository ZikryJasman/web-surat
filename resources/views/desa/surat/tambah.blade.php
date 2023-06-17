<div class="modal fade text-left" id="default" tabindex="-1" role="dialog"
aria-labelledby="myModalLabel1" aria-hidden="true">
<div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="myModalLabel1">Menambah Data Surat</h5>
            <button type="button" class="close rounded-pill"
            data-bs-dismiss="modal" aria-label="Close">
            <i data-feather="x"></i>
        </button>
    </div>
    
    <div class="modal-body">
        <form method="post" action="{{route('tambah_surat')}}" enctype="multipart/form-data">
            @csrf
            <div class="row" id="after-add-more">
                <div class="col-12">
                    <div class="form-group">
                        <label>Pengajuan Surat yang di Sediakan</label>
                        <input type="text" required="" class="form-control" name="nama_surat[]">
                    </div>
                    <div class="form-group">
                        <label>Warna Background</label>
                        <input type="color" required="" class="form-control" name="bg[]">
                    </div> 
                    <div class="form-group">
                        <label>Persyaratan</label>
                        <textarea class="form-control" required="" rows="5" name="persyaratan[]"></textarea>
                    </div>  
                </div>
                <div class="col-12">
                    <button class="btn btn-sm btn-success form-control" id="add-more" type="button"><i class="dripicons dripicons-plus"></i></button>
                </div>
            </div>
            <button class="btn btn-sm btn-primary form-control mt-2">Tambah</button>
        </form>
        <div class="row" id="copy">
            <div class="row" id="control-group">
                <div class="col-12">
                    <div class="form-group">
                        <label>Pengajuan Surat yang di Sediakan</label>
                        <input type="text" required="" class="form-control" name="nama_surat[]">
                    </div>  
                </div>
                <div class="form-group">
                    <label>Warna Background</label>
                    <input type="color" required="" class="form-control" name="bg[]">
                </div> 
                <div class="form-group">
                    <label>Persyaratan</label>
                    <textarea class="form-control" required="" rows="5" name="persyaratan[]"></textarea>
                </div> 
                <div class="col-12">
                    <button class="btn btn-sm btn-danger form-control" id="remove" type="button"><i class="dripicons dripicons-trash"></i></button>
                </div>
            </div>
        </div>

    </div>
</div>
</div>
</div>