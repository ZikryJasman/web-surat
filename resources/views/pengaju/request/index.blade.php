@extends('desa/layout/app')

@section('title', 'Surat Permohonan')

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{ Auth::user()->name }} - Request</h4>
                <sup>FORM REQUEST PERMOHONAN</sup>
            </div>

            <div class="card-body">
                <form method="post" enctype="multipart/form-data" action="{{ route('add_request') }}">
                    @csrf
                    @foreach ($data as $dt)
                        <div class="row">
                            <div class="col-xl-12">
                                <h6>Persyaratan Permohonan {{ $surat->nama_surat }}</h6>
                                <div class="form-group">
                                    <?php
                                    $array = explode(PHP_EOL, $surat->persyaratan);
                                    $total = count($array);
                                    foreach ($array as $item) {
                                        echo '<span>' . $item . '</span><br>';
                                    }
                                    ?>
                                </div>
                            </div>
                            @if ($surat->singkatan == 'SKMK')
                                <a class="btn btn-primary col-lg-4 col-sm-6 col-12 mx-2 mb-4" href="https://indonesiasehat.org/web-surat/public/Format_Surat/Surat_Keterangan_Masih_Kuliah.docx"
                                    target="_blank">Download Surat</a>
                            @elseif($surat->singkatan == 'SRB')
                                <a class="btn btn-primary col-lg-4 col-sm-6 col-12 mx-2 mb-4" href="https://indonesiasehat.org/web-surat/public/Format_Surat/Surat_Rekomendasi.docx"
                                    target="_blank">Download Surat</a>
                            @elseif($surat->singkatan == 'SD')
                                <a class="btn btn-primary col-lg-4 col-sm-6 col-12 mx-2 mb-4" href="https://indonesiasehat.org/web-surat/public/Format_Surat/Surat_Dispensasi_Kuliah.docx"
                                    target="_blank">Download Surat</a>
                            @elseif($surat->singkatan == 'STM')
                                <a class="btn btn-primary col-lg-4 col-sm-6 col-12 mx-2 mb-4" href="https://indonesiasehat.org/web-surat/public/Format_Surat/Surat_Tugas_Mahasiswa.docx"
                                    target="_blank">Download Surat</a>
                            @elseif($surat->singkatan == 'SPTMB')
                                <a class="btn btn-primary col-lg-4 col-sm-6 col-12 mx-2 mb-4" href="https://indonesiasehat.org/web-surat/public/Format_Surat/Surat_Pernyataan_Tidak_Menerima_Beasiswa_Manapun.docx"
                                    target="_blank">Download Surat</a>
                            @elseif($surat->singkatan == 'SRMB')
                                <a class="btn btn-primary col-lg-4 col-sm-6 col-12 mx-2 mb-4" href="https://indonesiasehat.org/web-surat/public/Format_Surat/Surat_Rekomendasi_Magang_Studi_Independen_Bersertifikat.docx"
                                    target="_blank">Download Surat</a>
                            @endif
                            <hr>
                            <div class="col-md-6">
                                <h6>Nama Lengkap</h6>
                                <div class="form-group position-relative has-icon-left">
                                    <input type="text" value="{{ $dt->name }}" readonly=""
                                        style="background: transparent;" class="form-control"
                                        placeholder="Lengkapi Biodata Anda" value="">
                                    <div class="form-control-icon">
                                        <i class="dripicons dripicons-information"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h6>Tempat/Tanggal Lahir</h6>
                                <div class="form-group position-relative has-icon-left">
                                    <input type="text" value="{{ $dt->tempat }}/{{ $dt->tgl_lahir }}" readonly=""
                                        style="background: transparent;" class="form-control"
                                        placeholder="Lengkapi Biodata Anda" value="">
                                    <div class="form-control-icon">
                                        <i class="dripicons dripicons-information"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h6>Nim</h6>
                                <div class="form-group position-relative has-icon-left">
                                    <input type="text" value="{{ $dt->nim }}" readonly=""
                                        style="background: transparent;" class="form-control"
                                        placeholder="Lengkapi Biodata Anda" value="">
                                    <div class="form-control-icon">
                                        <i class="dripicons dripicons-information"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h6>Program Studi</h6>
                                <div class="form-group position-relative has-icon-left">
                                    <input type="text" value="{{ $dt->program->nama ?? '' }}" readonly=""
                                        style="background: transparent;" class="form-control"
                                        placeholder="Lengkapi Biodata Anda" value="">
                                    <div class="form-control-icon">
                                        <i class="dripicons dripicons-information"></i>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" value="{{ $surat->id_surat }}" name="id_surat">
                            <input type="hidden" value="{{ $surat->singkatan }}" name="singkatan">
                            <div class="col-md-6">
                                <h6>Tahun Ajaran</h6>
                                <div class="form-group position-relative has-icon-left">
                                    <input type="text" value="{{ $dt->tahun_ajaran }}" readonly=""
                                        style="background: transparent;" class="form-control"
                                        placeholder="Lengkapi Biodata Anda" value="">
                                    <div class="form-control-icon">
                                        <i class="dripicons dripicons-information"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h6>Jenis Kelamin</h6>
                                <div class="form-group position-relative has-icon-left">
                                    <input type="text" value="{{ $dt->jenis_kelamin }}" readonly=""
                                        style="background: transparent;" class="form-control"
                                        placeholder="Lengkapi Biodata Anda" value="">
                                    <div class="form-control-icon">
                                        <i class="dripicons dripicons-information"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <h6>Catatan Lain</h6>
                                <div class="form-group position-relative has-icon-left">
                                    <input type="text" required="" class="form-control" name="keperluan"
                                        value="">
                                    <div class="form-control-icon">
                                        <i class="dripicons dripicons-document-edit"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <h6>Upload berkas Ms.Word</h6>
                                <div class="form-group position-relative">
                                    <input type="file" required name="path_upload" class="form-control">
                                </div>

                            </div>
                        </div>
                        <div class="row" id="after-add-more">
                            <div class="col-xl-12">
                                <h6>Berkas Persyaratan (format png,jpg,webp)</h6>
                                <div class="form-group position-relative">
                                    <input type="file" name="berkas[]" multiple id="images" class="form-control">
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <button class="form-control btn btn-sm btn-success" id="add-more" type="button"><i
                                        class="dripicons dripicons-plus"></i></button>
                            </div>
                        </div>
                        <div class="row" id="copy">
                            <div class="row" id="control-group">
                                <div class="col-xl-12">
                                    <h6>Berkas Persyaratan</h6>
                                    <div class="form-group position-relative">
                                        <input type="file" name="berkas[]" multiple class="form-control">
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <button class="btn btn-sm btn-danger form-control" id="remove" type="button"><i
                                            class="dripicons dripicons-trash"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 mt-2">
                            <button class="btn btn-sm btn-primary form-control">Konfirmasi</button>
                        </div>
                    @endforeach
            </div>
            </form>
        </div>
    </section>
@endsection
