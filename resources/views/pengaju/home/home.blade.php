@extends('desa/layout/app')

@section('title','Dashboard Pengaju')

@section('content')
<div class="row">
    @foreach($surat as $sur)
    <div class="col-lg-3">
        <div class="card" style="border: 1px solid {{$sur->bg}};border-left: none;border-right: none;">
            <div class="card-content">
                <div class="card-body" style="text-align: center;">
                    <p class="text-center"><sup style="text-transform: uppercase;">{{$sur->nama_surat}}</sup></p>
                    <p class="" style="font-size: 700%;border-bottom-right-radius: 40%;border-bottom-left-radius: 40%;">
                        <i class="bi bi-envelope-fill" style="color: {{$sur->bg}}"></i>
                    </p>
                </div>
            </div>
            <div class="card-footer" style="text-align: center">
                <a href="{{route('request',$sur->nama_surat)}}" class="btn rounded-pill" style="border: 1px solid {{$sur->bg}}"> REQUEST </a>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item" style="background: {{$sur->bg}}"></li>
            </ul>
        </div>
    </div>
    @endforeach
</div>
@endsection