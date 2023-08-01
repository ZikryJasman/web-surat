<div class="modal fade text-left" id="edit{{ $pgn->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel1">Update Data Pelayanan</h5>
                <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>

            <div class="modal-body">
                <form method="post" action="{{ route('program.update', $pgn->id) }}">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Nama Program Studi</label>
                                <input type="text" value="{{ $pgn->nama }}" class="form-control" name="nama">
                            </div>
                            {{-- <div class="form-group">
                                <label>Nama Fakultas</label>
                                <input type="text" value="{{ $pgn->fakultas }}" required="" class="form-control" name="fakultas">
                            </div>
                            <div class="form-group">
                                <label>Nama Dosen Pembimbing</label>
                                <input type="text" value="{{ $pgn->dosen }}" required="" class="form-control" name="dosen">
                            </div> --}}
                        </div>
                    </div>
                    <button class="btn btn-sm btn-primary form-control mt-2">Ubah</button>
                </form>
            </div>
        </div>
    </div>
</div>
