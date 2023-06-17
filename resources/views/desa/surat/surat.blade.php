@extends('desa/layout/app')

@section('title','Data Surat')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data Table</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                Table With Data Surat yang di Sediakan
                <button type="button" style="float: right;" class="btn btn-sm btn-outline-primary block" data-bs-toggle="modal"
                data-bs-target="#default">
                Tambah Data
            </button>
        </div>
        <div class="card-body" style="overflow-x:scroll;">
            <table class="table table-striped" id="table1">
                <thead>
                    <tr>
                        <th>No. </th>
                        <th>Nama Surat</th>
                        <th>Singkatan</th>
                        {{-- <th>Template</th> --}}
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; ?>
                    @foreach($data as $dt)
                    <tr>
                        <td>{{$no}}. </td>
                        <td>{{$dt->nama_surat}}</td>
                        <td>{{$dt->singkatan}}</td>
                        {{-- <td>
                            @if($dt->template_id==NULL)
                            <span class="badge bg-danger">Belum Memilih</span>
                            @else
                            <span class="badge bg-success">Sudah Memilih</span>
                            @endif
                        </td> --}}
                        <td align="center">
                            <a href="" data-bs-toggle="modal"
                            data-bs-target="#edit{{$dt->id_surat}}" class="btn btn-sm rounded-pill btn-success">
                            <i class="dripicons dripicons-document-edit"></i></a>
                            <a href="{{route('hapus_surat',$dt->id_surat)}}" onclick="return confirm('Lanjut Hapus Surat {{$dt->nama_surat}}')" class="btn btn-sm rounded-pill btn-danger">
                                <i class="dripicons dripicons-trash"></i>
                            </a>
                            <a href="{{route('template',['title'=>Auth::user()->title_user,'id_surat'=>$dt->id_surat])}}" class="btn btn-sm rounded-pill btn-primary">
                                <i class="dripicons dripicons-blog"></i>
                            </a>
                        </td>
                    </tr>
                    @include('desa/surat/update')
                    <?php $no++ ?>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</section>
</div>
@include('desa/surat/tambah')
@endsection
