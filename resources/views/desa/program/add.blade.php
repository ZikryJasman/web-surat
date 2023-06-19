<div class="modal fade text-left" id="programStudi" tabindex="-1" role="dialog" aria-labelledby="myModalProgramStudi"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalProgramStudi">Menambah Data Program Studi</h5>
                <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>

            <div class="modal-body">
                <form method="post" action="{{ route('program.store') }}">
                    @csrf
                    <div class="row" id="after-add-more">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Nama Program Studi</label>
                                <input type="text" required="" class="form-control" name="nama">
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-sm btn-primary form-control mt-2">Tambah</button>
                </form>

            </div>
        </div>
    </div>
</div>
