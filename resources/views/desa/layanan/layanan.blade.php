@extends('desa/layout/app')

@section('title','Data Waktu Pelayanan')

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
                Table With Data Waktu Pelayanan
                <button type="button" style="float: right;" class="btn btn-sm btn-outline-primary block" data-bs-toggle="modal"
                data-bs-target="#layanan">
                Tambah Data
            </button>
        </div>
        <div class="card-body" style="overflow-x:scroll;">
            <table class="table table-striped" id="table1">
                <thead>
                    <tr>
                        <th>No. </th>
                        <th>hari</th>
                        <th>Waktu Layanan</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; ?>
                    @foreach($data as $dt)
                    <tr>
                        <td>{{$no}}. </td>
                        <td>{{$dt->hari}}</td>
                        <td>{{$dt->waktu}} - {{$dt->sampai}}</td>
                        <td align="center">
                            <a href="" data-bs-toggle="modal"
                            data-bs-target="#edit{{$dt->id_layanan}}" class="btn btn-sm rounded-pill btn-success">
                            <i class="dripicons dripicons-document-edit"></i></a>
                            <a href="{{route('hapus_layanan',$dt->id_layanan)}}" onclick="return confirm('Lanjutkan Hapus Data?')" class="btn btn-sm rounded-pill btn-danger">
                                <i class="dripicons dripicons-trash"></i>
                            </a>
                        </td>
                    </tr>
                    @include('desa/layanan/update')
                    <?php $no++ ?>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</section>
</div>
@include('desa/layanan/tambah')
@endsection
