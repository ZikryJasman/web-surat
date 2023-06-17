@extends('desa/layout/app')

@section('title', 'Cek Surat Acc')

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                Table Data
            </div>
            <div class="card-body" style="overflow-x:scroll;">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No. </th>
                            <th>Tanggal Request</th>
                            <th>Request Surat</th>
                            <th>Nama Lengkap</th>
                            <th>Status</th>
                            <th>Keterangan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($data) > 0)
                            <?php $no = 1; ?>
                            @foreach ($data as $dt)
                                <tr>
                                    <th><?= $no ?>. </th>
                                    <td>{{ parseDateIdFull($dt->tgl_req) .' WIB'}}</td>
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
                                    <td align="center">
                                        <a href="{{ route('ttd', ['surat' => $dt->singkatan, 'id_pengajuan' => $dt->id_pengajuan]) }}?keyword=cek-surat"
                                            class="btn btn-sm btn-primary rounded-pill"><i
                                                class="icon dripicons-document-edit"></i></a>
                                    </td>
                                </tr>
                                <?php $no++; ?>
                            @endforeach
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
