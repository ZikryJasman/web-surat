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
                                    @foreach ($data as $dt)
                                        <div class="col-lg-6">
                                            <form class="form form-vertical" method="post"
                                                action="{{ route('keterangan', $dt->id_pengajuan) }}"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="first-name-vertical">Keterangan</label>
                                                    <select class="form-control" name="keterangan">
                                                        <option <?php if ($dt->status_pengajuan == 'Data Sudah Lengkap') {
                                                            echo 'selected';
                                                        } ?> value="Data Sudah Lengkap">Data Sudah
                                                            Lengkap</option>
                                                        <option <?php if ($dt->status_pengajuan == 'Data Belum Lengkap') {
                                                            echo 'selected';
                                                        } ?> value="Data Belum Lengkap">Data Belum
                                                            Lengkap</option>
                                                    </select>
                                                    <input type="hidden" value="{{ $dt->singkatan }}" name="singkatan">
                                                    <label for="first-name-vertical" style="padding-top: .5rem">Upload
                                                        Berkas Word (<span style="font-size: 12px">input jika berkas sudah
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
                                    @endforeach
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="first-name-vertical">Konfirmasi</label>
                                            <a href="{{ route('konfirmasi', ['surat' => $dt->singkatan, 'id_pengajuan' => $dt->id_pengajuan]) }}"
                                                class="btn btn-sm btn-outline-success rounded-pill mt-2 form-control">
                                                <i class="icon dripicons-checkmark"></i> Confirm </a>
                                        </div>
                                    </div>
                                    <hr>
                                    @foreach ($data as $dt)
                                        <div class="col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="email-id-vertical">NIM</label>
                                                <p class="text-black">{{ $dt->nim }}</p>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="email-id-vertical">Nama Lengkap</label>
                                                <p class="text-black">{{ $dt->name }}</p>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="email-id-vertical">Email</label>
                                                <p class="text-black">{{ $dt->email }}</p>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="email-id-vertical">Telepon</label>
                                                <p class="text-black">{{ $dt->telepon }}</p>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="email-id-vertical">Tahun Ajaran</label>
                                                <p class="text-black">{{ $dt->tahun_ajaran }}</p>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="email-id-vertical">Alamat</label>
                                                <p class="text-black">{{ $dt->alamat }}</p>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="email-id-vertical">Jenis Kelamin</label>
                                                <p class="text-black">{{ $dt->jenis_kelamin }}</p>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="email-id-vertical">Tempat Lahir</label>
                                                <p class="text-black">{{ $dt->tempat }}</p>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="email-id-vertical">Program Studi</label>
                                                <p class="text-black">{{ $dt->program->nama ?? '' }}</p>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="email-id-vertical">Tanggal Lahir</label>
                                                <p class="text-black">{{ parseDateId($dt->tgl_lahir) }}</p>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="alamat" class="form-label">Alamat</label>
                                                <textarea class="form-control text-black" id="alamat" readonly rows="3">{{ $dt->alamat }}</textarea>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="email-id-vertical">Status Pengajuan</label>
                                                <p class="text-black">{{ $dt->status_pengajuan }}</p>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="email-id-vertical">Keterangan</label>
                                                <p class="text-black">
                                                    @if ($dt->selesai == null)
                                                        Menunggu Konfirmasi
                                                    @endif
                                                    @if ($dt->selesai !== null)
                                                        {{ $dt->selesai }}
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="email-id-vertical">Request Surat</label>
                                                <p class="text-black">{{ $dt->nama_surat }}</p>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-12">
                                            <div class="form-group">
                                                <label for="email-id-vertical">Tanggal Request</label>
                                                <p class="text-black">{{ parseDateIdFull($dt->tgl_req) . ' WIB' }}</p>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="email-id-vertical" class="form-label">Catatan Lain</label>
                                                <textarea class="form-control text-black" id="alamat" readonly rows="3">{{ $dt->keperluan }}</textarea>
                                            </div>
                                        </div>

                                        {{-- <div class="col-sm-6 col-12">
                                    <div class="form-group">
                                        <label for="email-id-vertical">Nomor Surat</label>
                                        <p class="text-black">{{$dt->nomor_surat}}</p>
                                    </div>
                                </div> --}}
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
                                @foreach ($berkas as $brk)
                                    <div class="row mt-2">
                                        <img src="{{ 'https://indonesiasehat.org/web-surat/public/' . $brk->data_berkas }}"
                                            class="img-thumbnail">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>
@endsection
