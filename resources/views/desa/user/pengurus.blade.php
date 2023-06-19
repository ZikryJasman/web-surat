@extends('desa/layout/app')

@section('title', 'Data User Pengurus')

@section('content')

    <div class="page-heading">
        <div class="container mb-3">
            <div class="row">
                <div class="col-lg-5 pb-4" style="background: white;box-shadow:2px 2px grey;">
                    <form method="get">
                        @csrf
                        <label class="mt-4" for="">Berdasarkan Nama Pengurus</label>
                        <input type="text" class="form-control mt-1" name="search">
                        <button class="btn btn-sm btn-primary mt-2">Cari</button>
                    </form>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header">
                    Table Pengurus
                    <button type="button" style="float: right;" class="btn btn-sm btn-outline-primary block"
                        data-bs-toggle="modal" data-bs-target="#default">
                        Tambah Data
                    </button>
                </div>
                <div class="card-body" style="overflow-x:scroll;">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>No. </th>
                                <th>Nama Pengurus</th>
                                <th>Email</th>
                                <th>Nim</th>
                                <th>Level</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($data) > 0)
                                <?php $no = 1; ?>
                                @foreach ($data as $pgn)
                                    @if ($pgn->level == 'Staff' or $pgn->level == 'Kepala Desa')
                                        <tr>
                                            <th><?= $no ?>. </th>
                                            <td>
                                                @if ($pgn->name == null)
                                                    <span class="text text-danger">Tambahkan Nama?</span>
                                                @endif
                                                @if ($pgn->name !== null)
                                                    {{ $pgn->name }}
                                                @endif
                                            </td>
                                            <td>{{ $pgn->email }}</td>
                                            <td>{{ $pgn->nim }}</td>
                                            <td>
                                                @if ($pgn->level == 'Kepala Desa')
                                                    <span class="badge bg-success">Wakil Dekan</span>
                                                @else
                                                    <span class="badge bg-success">{{ $pgn->level }}</span>
                                                @endif
                                            </td>
                                            <td align="center">
                                                <!-- <a href="" class="btn btn-sm btn-danger rounded-pill"><i class="icon dripicons-trash"></i></a> -->
                                                <a href="{{ route('cek_user', ['title' => Auth::user()->title_user, 'id' => $pgn->id]) }}"
                                                    class="btn btn-sm btn-success rounded-pill"><i
                                                        class="icon dripicons-preview"></i></a>
                                            </td>
                                        </tr>
                                    @endif
                                    <?php $no++; ?>
                                @endforeach
                                <tr class="no-data">
                                    <td class="text-center" colspan="14">{{ $data->onEachSide(5)->links() }}</td>
                                </tr>
                            @else
                                <tr class="no-data">
                                    <td class="text-center" colspan="14">Tidak ada data</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
    @include('desa/user/tambah')
@endsection
