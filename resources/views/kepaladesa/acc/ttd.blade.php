@extends('desa/layout/app')

@section('title','Cek Surat Acc')

@section('content')
<div class="container">
    @foreach($data as $dt)
    <div class="row">
        <div class="col-lg-7 pb-4" style="background: white;box-shadow:2px 2px grey;">
            <form method="post" action="{{route('confirm_ttd',$dt->id_pengajuan)}}">
                @csrf
                <input type="hidden" value="{{$dt->singkatan}}" name="singkatan">
                <button class="btn btn-sm form-control btn-primary mt-2">Konfirmasi Surat Selesai</button>
            </form>
        </div>
        <div class="col-lg-7">
            <a href="{{route('form_ttd',$dt->id_pengajuan)}}" class="btn btn-sm form-control btn-success mt-2">Tanda Tangan</a>
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