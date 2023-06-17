<div class="modal fade text-left" id="edit{{$dt->id_layanan}}" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel1">Update Data Pelayanan</h5>
                <button type="button" class="close rounded-pill"
                data-bs-dismiss="modal" aria-label="Close">
                <i data-feather="x"></i>
            </button>
        </div>

        <div class="modal-body">
            <form method="post" action="{{route('edit_layanan',$dt->id_layanan)}}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label>Hari</label>
                            <input type="text" value="{{$dt->hari}}" class="form-control" name="hari">
                        </div>
                        <div class="form-group">
                            <label>Jam Pelayanan</label>
                            <input type="time" class="form-control" name="waktu" value="{{$dt->waktu}}">
                            <input type="time" class="form-control mt-1" name="sampai" value="{{$dt->sampai}}">
                        </div>  
                    </div>
                </div>
                <button class="btn btn-sm btn-primary form-control mt-2">Ubah</button>
            </form>
        </div>
    </div>
</div>
</div>