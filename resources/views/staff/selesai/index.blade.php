@extends('desa/layout/app')

@section('title','Surat Selesai')

@section('content')
<section class="section">
    <div class="card">
        <div class="card-header">
            Table Data
        </div>
        <div class="card-body">
            <table class="table table-striped" id="table1">
                <thead>
                    <tr>
                        <th>No. </th>
                        <th>Tanggal Request</th>
                        <th>Nomor Surat</th>
                        <th>Request Surat</th>
                        <th>Nama Lengkap</th>
                        <th>Status</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; ?>
                    @foreach($data as $dt)
                    <tr>
                        <th><?=$no; ?>. </th>
                        <td>{{$dt->tgl_req}}</td>
                        <td>{{$dt->nomor_surat}}</td>
                        <td>{{$dt->nama_surat}}</td>
                        <td>{{$dt->name}}</td>
                        <td>
                            @if($dt->status_pengajuan=="Pengecekan Permohonan")
                            <span class="badge bg-danger">Data Sedang <br>di Periksa</span>
                            @elseif($dt->status_pengajuan=="Data Belum Lengkap")
                            <span class="badge bg-danger">{{$dt->status_pengajuan}}</span>
                            @else
                            <span class="badge bg-success">{{$dt->status_pengajuan}}</span>
                            @endif
                        </td>
                        <td>
                            @if($dt->selesai==NULL)
                            Menunggu Konfirmasi
                            @endif
                            @if($dt->selesai!==NULL)
                            <span class="badge bg-success">
                                {{$dt->selesai}}
                            </span>
                            @endif
                        </td>
                    </tr>
                    <?php $no++ ?>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</section>
@endsection