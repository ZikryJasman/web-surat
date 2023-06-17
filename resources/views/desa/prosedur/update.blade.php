<div class="modal fade text-left" id="edit{{$dt->id_prosedur}}" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel1">Ubah Data Prosedur</h5>
                <button type="button" class="close rounded-pill"
                data-bs-dismiss="modal" aria-label="Close">
                <i data-feather="x"></i>
            </button>
        </div>
        
        <div class="modal-body">
            <form method="post" action="{{route('edit_prosedur',$dt->id_prosedur)}}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label>Isi Prosedur</label>
                            <textarea class="form-control" rows="5" name="prosedur">{{$dt->prosedur}}</textarea>
                        </div> 
                    </div>
                </div>
                <button class="btn btn-sm btn-primary form-control mt-2">Ubah</button>
            </form>
        </div>
    </div>
</div>
</div>