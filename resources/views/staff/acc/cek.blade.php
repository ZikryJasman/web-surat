@extends('desa/layout/app')

@section('title', 'Cek Pelengkap Permohonan')

@section('content')
    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-8">

                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="form-body">
                                <div class="row">
                                    {{-- @foreach ($data as $dt) --}}
                                    <div class="col-lg-6">
                                        <form class="form form-vertical" method="post"
                                            action="{{ route('keterangan', $data->id_pengajuan) }}"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label for="first-name-vertical">Keterangan</label>
                                                <select class="form-control" name="keterangan">
                                                    <option <?php if ($data->status_pengajuan == 'Data Sudah Lengkap') {
                                                        echo 'selected';
                                                    } ?> value="Data Sudah Lengkap">Data Sudah
                                                        Lengkap</option>
                                                    <option <?php if ($data->status_pengajuan == 'Data Belum Lengkap') {
                                                        echo 'selected';
                                                    } ?> value="Data Belum Lengkap">Data Belum
                                                        Lengkap</option>
                                                </select>
                                                <input type="hidden" value="{{ $data->singkatan }}" name="singkatan">
                                                <label for="first-name-vertical" style="color:red;padding-top: .5rem">Catatan
                                                    Staff(<span style="font-size: 12px">input jika berkas tidak
                                                        lengkap</span>)</label>
                                                <div class="form-group position-relative">
                                                    <textarea class="form-control text-black" name="note" id="note" rows="3">{{ $data->note }}</textarea>
                                                </div>
                                                <label for="first-name-vertical" style="padding-top: .5rem">Upload
                                                    Berkas Pdf (<span style="font-size: 12px">input jika berkas sudah
                                                        lengkap</span>)</label>
                                                <div class="form-group position-relative">
                                                    <input type="file" name="upload_berkas" id="upload_berkas"
                                                        class="form-control">
                                                </div>
                                                <button class="btn btn-sm btn-outline-primary rounded-pill mt-3"> <i
                                                        class="icon dripicons-document-edit"></i> Ubah</button>
                                            </div>

                                        </form>
                                    </div>
                                    {{-- @endforeach --}}
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="first-name-vertical">Konfirmasi</label>
                                            <a href="{{ route('konfirmasi', ['surat' => $data->singkatan, 'id_pengajuan' => $data->id_pengajuan]) }}"
                                                class="btn btn-sm btn-outline-success rounded-pill mt-2 form-control">
                                                <i class="icon dripicons-checkmark"></i> Confirm </a>
                                        </div>
                                    </div>
                                    <hr>
                                    {{-- @foreach ($data as $dt) --}}
                                    <div class="col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="email-id-vertical">NIM</label>
                                            <p class="text-black">{{ $data->nim }}</p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="email-id-vertical">Nama Lengkap</label>
                                            <p class="text-black">{{ $data->name }}</p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="email-id-vertical">Email</label>
                                            <p class="text-black">{{ $data->email }}</p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="email-id-vertical">Telepon</label>
                                            <p class="text-black">{{ $data->telepon }}</p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="email-id-vertical">Tahun Ajaran</label>
                                            <p class="text-black">{{ $data->tahun_ajaran }}</p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="email-id-vertical">Alamat</label>
                                            <p class="text-black">{{ $data->alamat }}</p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="email-id-vertical">Jenis Kelamin</label>
                                            <p class="text-black">{{ $data->jenis_kelamin }}</p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="email-id-vertical">Tempat Lahir</label>
                                            <p class="text-black">{{ $data->tempat }}</p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="email-id-vertical">Program Studi</label>
                                            <p class="text-black">{{ $data->program->nama ?? '' }}</p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="email-id-vertical">Tanggal Lahir</label>
                                            <p class="text-black">{{ parseDateId($data->tgl_lahir) }}</p>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="alamat" class="form-label">Alamat</label>
                                            <textarea class="form-control text-black" id="alamat" readonly rows="3">{{ $data->alamat }}</textarea>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="email-id-vertical">Status Pengajuan</label>
                                            <p class="text-black">{{ $data->status_pengajuan }}</p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="email-id-vertical">Keterangan</label>
                                            <p class="text-black">
                                                @if ($data->selesai == null)
                                                    Menunggu Konfirmasi
                                                @endif
                                                @if ($data->selesai !== null)
                                                    {{ $data->selesai }}
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="email-id-vertical">Request Surat</label>
                                            <p class="text-black">{{ $data->nama_surat }}</p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="email-id-vertical">Tanggal Request</label>
                                            <p class="text-black">{{ parseDateIdFull($data->tgl_req) . ' WIB' }}</p>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="email-id-vertical" class="form-label">Berkas Word</label>
                                            <a href="{{ 'https://indonesiasehat.org/web-surat/public/' . $data->path_upload }}"
                                                target="_blank">{{ $data->path_upload ?? '' }}</a>
                                            {{-- <textarea class="form-control text-black" id="alamat" readonly rows="3">{{ $data->keperluan }}</textarea> --}}
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="email-id-vertical" class="form-label">Catatan Lain</label>
                                            <textarea class="form-control text-black" id="alamat" readonly rows="3">{{ $data->keperluan }}</textarea>
                                        </div>
                                    </div>

                                    {{-- <div class="col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="email-id-vertical">Nomor Surat</label>
                                        <p class="text-black">{{$data->nomor_surat}}</p>
                                    </div>
                                </div> --}}
                                    {{-- @endforeach --}}
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
                                @foreach ($berkas as $brk)
                                    <div class="row mt-2">
                                        <a href="{{ 'https://indonesiasehat.org/web-surat/public/' . $brk->data_berkas }}"
                                            target="_blank">
                                            <img src="{{ 'https://indonesiasehat.org/web-surat/public/' . $brk->data_berkas }}"
                                                class="img-thumbnail">
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>
@endsection
