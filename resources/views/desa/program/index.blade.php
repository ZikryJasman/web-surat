@extends('desa/layout/app')

@section('title', 'Data User Pengaju')

@section('content')

    <div class="page-heading">
        <section class="section">
            <div class="card">
                <div class="card-header">
                    Table Program Studi
                    <button type="button" style="float: right;" class="btn btn-sm btn-outline-primary block"
                        data-bs-toggle="modal" data-bs-target="#programStudi">
                        Tambah Data
                    </button>
                </div>
                <div class="card-body" style="overflow-x:scroll;">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>No. </th>
                                <th>Nama Program Studi</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($data) > 0)
                                @foreach ($data as $pgn)
                                    <tr>
                                        <th>{{ $loop->iteration }}</th>
                                        <td>
                                            {{ $pgn->nama }}
                                        </td>
                                        <td align="center">
                                            <!-- <a href="" class="btn btn-sm btn-danger rounded-pill"><i class="icon dripicons-trash"></i></a> -->
                                            <a href="" data-bs-toggle="modal"
                                                data-bs-target="#edit{{ $pgn->id }}"
                                                class="btn btn-sm btn-primary rounded-pill"><i
                                                    class="icon dripicons-preview"></i></a>
                                            <a href="{{ route('program.delete', ['id' => $pgn->id]) }}"
                                                onclick="return confirm('Lanjutkan Hapus Data?')"
                                                class="btn btn-sm rounded-pill btn-danger">
                                                <i class="dripicons dripicons-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @include('desa/program/update')
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
    @include('desa/program/add')

@endsection
