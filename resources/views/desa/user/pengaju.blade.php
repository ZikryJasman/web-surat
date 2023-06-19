@extends('desa/layout/app')

@section('title', 'Data User Pengaju')

@section('content')

    <div class="page-heading">
        <div class="container mb-3">
            <div class="row">
                <div class="col-lg-5 pb-4" style="background: white;box-shadow:2px 2px grey;">
                    <form method="get">
                        @csrf
                        <label class="mt-4">Filter Berdasarkan Program</label>
                        <select class="form-control" name="program_id">
                            <option value="">-- Pilih Program --</option>
                            @foreach ($program as $p)
                                <option value="{{ $p->id }}">{{ $p->nama }}</option>
                            @endforeach
                        </select>
                        <label class="mt-2" for="">Berdasarkan Nama Pengaju</label>
                        <input type="text" class="form-control mt-1" name="search">
                        <button class="btn btn-sm btn-primary mt-2">Cari</button>
                    </form>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header">
                    Table Pengaju
                </div>
                <div class="card-body" style="overflow-x:scroll;">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>No. </th>
                                <th>Nama Pengaju</th>
                                <th>Email</th>
                                <th>Nim</th>
                                <th>Program Studi</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($data) > 0)
                                <?php $no = 1; ?>
                                @foreach ($data as $pgn)
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
                                            {{ $pgn->program->nama ?? '-' }} </td>
                                        <td align="center">
                                            <!-- <a href="" class="btn btn-sm btn-danger rounded-pill"><i class="icon dripicons-trash"></i></a> -->
                                            <a href="{{ route('cek_user', ['title' => Auth::user()->title_user, 'id' => $pgn->id]) }}"
                                                class="btn btn-sm btn-primary rounded-pill"><i
                                                    class="icon dripicons-preview"></i></a>
                                        </td>
                                    </tr>
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
@endsection
