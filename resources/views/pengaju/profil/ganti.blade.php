<div class="modal fade text-left" id="ganti" tabindex="-1"
role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
<div class="modal-dialog modal-sm modal-dialog-centered modal-dialog-scrollable"
role="document">
<div class="modal-content" style="border-bottom:1px solid blue;">
    <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel33">UBAH PASSWORD </h4>
        <button type="button" class="close" data-bs-dismiss="modal"
        aria-label="Close">
        <i data-feather="x"></i>
    </button>
</div>
<form method="post" action="{{route('ganti_password',$cst->id)}}">
    @csrf
    <div class="modal-body">
        <div class="row">
            <div class="col-xl-12">
                <label>PASSWORD:</label>
                <div class="form-group">
                    <input type="text" name="password"
                    class="form-control">
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-light-secondary"
        data-bs-dismiss="modal">
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
