@extends('desa/layout/app')

@section('title', 'Surat Selesai')

@section('content')
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
                Surat Selesai
            </div>
            <div class="card-body" style="overflow-x:scroll;">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No. </th>
                            <th>Tanggal Request</th>
                            <th>Program Studi</th>
                            <th>Request Surat</th>
                            <th>Nama Lengkap</th>
                            <th>Status</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($data) > 0)
                            <?php $no = 1; ?>
                            @foreach ($data as $dt)
                                <tr>
                                    <th><?= $no ?>. </th>
                                    <td>{{ parseDateIdFull($dt->tgl_req) . ' WIB' }}</td>
                                    <td>{{ $dt->program->nama ?? '' }}</td>
                                    <td>{{ $dt->nama_surat }}</td>
                                    <td>{{ $dt->name }}</td>
                                    <td>
                                        @if ($dt->status_pengajuan == 'Pengecekan Permohonan')
                                            <span class="badge bg-danger">Data Sedang <br>di Periksa</span>
                                        @elseif($dt->status_pengajuan == 'Data Belum Lengkap')
                                            <span class="badge bg-danger">{{ $dt->status_pengajuan }}</span>
                                        @else
                                            <span class="badge bg-success">{{ $dt->status_pengajuan }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($dt->selesai == null)
                                            Menunggu Konfirmasi
                                        @endif
                                        @if ($dt->selesai !== null)
                                            <span class="badge bg-success">
                                                {{ $dt->selesai }}
                                            </span>
                                        @endif
                                    </td>
                                    <td> <a href="{{ 'https://indonesiasehat.org/web-surat/public/' . $dt->upload_berkas }}"
                                            target="_blank" class="btn btn-sm btn-success rounded-pill"><i
                                                class="icon dripicons-print"></i></a></td>
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
@endsection
