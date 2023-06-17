<div class="modal fade text-left" id="default" tabindex="-1" role="dialog"
aria-labelledby="myModalLabel1" aria-hidden="true">
<div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="myModalLabel1">Menambah Data Prosedur</h5>
            <button type="button" class="close rounded-pill"
            data-bs-dismiss="modal" aria-label="Close">
            <i data-feather="x"></i>
        </button>
    </div>
    
    <div class="modal-body">
        <form method="post" action="{{route('tambah_prosedur')}}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label>Isi Prosedur</label>
                        <textarea required="" class="form-control" rows="5" name="prosedur"></textarea>
                    </div> 
                </div>
            </div>
            <button class="btn btn-sm btn-primary form-control mt-2">Tambah</button>
        </form>
    </div>
</div>
</div>
</div>