@extends('desa/layout/app')

@section('title', 'Data Request Surat Permohonan')

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
                                        <a href="" data-bs-toggle="modal"
                                            data-bs-target="#detail{{ $dt->id_pengajuan }}"
                                            class="btn btn-sm btn-primary rounded-pill"><i
                                                class="icon dripicons-document"></i></a>
                                        @if ($dt->selesai == 'Surat Selesai')
                                            <a href="{{asset('pengajuan_berkas')}}/{{$dt->upload_berkas}}" target="_blank"
                                                class="btn btn-sm btn-success rounded-pill"><i
                                                    class="icon dripicons-print"></i></a>
                                        @endif
                                    </td>
                                </tr>
                                <?php $no++; ?>
                                @include('pengaju/data/detail')
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
