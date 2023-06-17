@extends('desa/layout/app')

@section('title','Cek Pelengkap Permohonan')

@section('content')
<div class="page-content">
    <section class="row">
        <div class="col-12 col-lg-8">

            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="form-body">
                            <div class="row">
                                @foreach($data as $dt)
                                <div class="col-lg-6">
                                    <form class="form form-vertical" method="post" action="{{route('keterangan',$dt->id_pengajuan)}}">
                                        @csrf
                                        <div class="form-group">
                                            <label for="first-name-vertical">Keterangan</label>
                                            <select class="form-control" name="keterangan">
                                                <option <?php if($dt->status_pengajuan=="Data Sudah Lengkap"){echo "selected";} ?> value="Data Sudah Lengkap">Data Sudah Lengkap</option>
                                                <option <?php if($dt->status_pengajuan=="Data Belum Lengkap"){echo "selected";} ?> value="Data Belum Lengkap">Data Belum Lengkap</option>
                                            </select>
                                            <button class="btn btn-sm btn-outline-primary rounded-pill mt-3"> <i class="icon dripicons-document-edit"></i> Ubah</button>
                                        </div>
                                    </form>
                                </div>
                                @endforeach
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="first-name-vertical">Konfirmasi</label>
                                        <a href="{{route('konfirmasi',['surat'=>$dt->singkatan,'id_pengajuan'=>$dt->id_pengajuan])}}" class="btn btn-sm btn-outline-success rounded-pill mt-2 form-control"> <i class="icon dripicons-checkmark"></i> Confirm </a>
                                    </div>
                                </div>
                                <hr>
                                @foreach($data as $dt)
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="email-id-vertical">NIK</label>
                                        <p>{{$dt->nik}}</p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="email-id-vertical">Nama Lengkap</label>
                                        <p>{{$dt->name}}</p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="email-id-vertical">Email</label>
                                        <p>{{$dt->email}}</p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="email-id-vertical">Telepon</label>
                                        <p>{{$dt->telepon}}</p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="email-id-vertical">Agama</label>
                                        <p>{{$dt->agama}}</p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="email-id-vertical">Alamat</label>
                                        <p>{{$dt->alamat}}</p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="email-id-vertical">Jenis Kelaminn</label>
                                        <p>{{$dt->jenis_kelamin}}</p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="email-id-vertical">Tempat Lahir</label>
                                        <p>{{$dt->tempat}}</p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="email-id-vertical">Pekerjaan</label>
                                        <p>{{$dt->pekerjaan}}</p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="email-id-vertical">Tanggal Lahir</label>
                                        <p>{{$dt->tgl_lahir}}</p>
                                    </div>
                                </div>
                                <hr>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="email-id-vertical">Keperluan</label>
                                        <p>{{$dt->keperluan}}</p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="email-id-vertical">Status Pengajuan</label>
                                        <p>{{$dt->status_pengajuan}}</p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="email-id-vertical">Keterangan</label>
                                        <p>
                                            @if($dt->selesai==NULL)
                                            Menunggu Konfirmasi
                                            @endif
                                            @if($dt->selesai!==NULL)
                                            {{$dt->keterangan}}
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="email-id-vertical">Request Surat</label>
                                        <p>{{$dt->nama_surat}}</p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="email-id-vertical">Tanggal Request</label>
                                        <p>{{$dt->tgl_req}}</p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="email-id-vertical">Nomor Surat</label>
                                        <p>{{$dt->nomor_surat}}</p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-12 col-lg-4">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h4 class="card-title">Berkas Pengajuan</h4>
                        <hr>
                        <div class="form-body">
                            @foreach($berkas as $brk)
                            <div class="row mt-2">
                                <img src="{{asset('pengajuan_berkas')}}/{{$brk->data_berkas}}" class="img-thumbnail">
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>
@endsection