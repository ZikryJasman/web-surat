@extends('desa/layout/app')
@section('title','Dashboard Wakil Dekan')
@section('content')
<div class="page-content">
    <section class="row">
        <div class="col-12">
            <div class="row">
                @foreach($data as $dt)
                <?php
                $jml=DB::table('surat')->join('pengajuan','pengajuan.surat_id','=','surat.id_surat')->where('id_surat',$dt->id_surat)->where('pengajuan.selesai','=','Sudah di Konfirmasi')->count();
                $jml2=DB::table('surat')->join('pengajuan','pengajuan.surat_id','=','surat.id_surat')->where('id_surat',$dt->id_surat)->where('pengajuan.selesai','Surat Selesai')->count();
                $jml3=DB::table('surat')->join('pengajuan','pengajuan.surat_id','=','surat.id_surat')->where('id_surat',$dt->id_surat)->where('pengajuan.status_pengajuan','Pengecekan Permohonan')->count();
                $jml4=DB::table('surat')->join('pengajuan','pengajuan.surat_id','=','surat.id_surat')->where('id_surat',$dt->id_surat)->where('pengajuan.status_pengajuan','Data Belum Lengkap')->where('pengajuan.selesai','Lengkapi data')->count();

                ?>
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon" style="background: {{$dt->bg}}">
                                        <i class="dripicons dripicons-document-edit"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold"><a href="">{{$dt->singkatan}}</a></h6>
                                    <h6 class="font-extrabold mb-0">{{$jml .' Menunggu Approve'}}</h6>
                                    <hr>
                                    <h6 class="font-extrabold mb-0">{{$jml2 .' Selesai'}}</h6>
                                    <hr>
                                    <h6 class="font-extrabold mb-0">{{$jml3 .' Menunggu Staff'}}</h6>
                                    <hr>
                                    <h6 class="font-extrabold mb-0">{{$jml4 .' Ajukan Ulang'}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <!--  -->
            <!--  -->
        </div>
    </section>
</div>
@endsection
