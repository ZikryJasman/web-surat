@extends('desa/layout/app')

@section('title','Cek Surat Cetak')

@section('content')
<div class="container">
    @foreach($data as $dt)
    <div class="row">
       <div class="col-lg-5 pb-4" style="background: white;box-shadow:2px 2px grey;">
       <!--  <form method="get" target="_blank" action="{{route('cetak_surat',['surat'=>$dt->singkatan,'id_pengajuan'=>$dt->id_pengajuan])}}">
        @csrf -->
        <a href="{{route('cetak_surat',['surat'=>$dt->singkatan,'id_pengajuan'=>$dt->id_pengajuan])}}?keyword=print-surat" class="btn btn-sm form-control btn-primary mt-2"><i class="dripicons dripicons-print"></i></a>
        <!-- </form> -->
    </div>
</div>
@endforeach
</div>
@foreach($data as $dt)
<?php  
$nama_template='desa/template/'.$dt->nama_template.'/'.$dt->nama_template;
?>
@include($nama_template)
@endforeach
@endsection