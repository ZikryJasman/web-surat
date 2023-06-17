     @extends('desa/layout/app')
     @section('title','Biodata Profil Desa')
     @section('content')
     <div class="page-heading">

        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h2>Profil</h2>
                    <button type="button" class="btn rounded-pill btn-sm btn-warning block" style="float: right;" data-bs-toggle="modal" data-bs-target="#inlineForm">
                        <i class="icon dripicons-document-edit"></i> Lengkapi
                    </button>
                    <button type="button" class="btn rounded-pill btn-sm btn-primary block" style="float: right;" data-bs-toggle="modal" data-bs-target="#password">
                        <i class="bi bi-shield-lock"></i> Ganti Password
                    </button>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tbody>
                            @foreach($data as $cst)
                            <tr>
                                <td>EMAIL</td>
                                <td>:</td>
                                <td>{{$cst->email}}</td>
                            </tr>
                            <tr>
                                <td>TELEPON</td>
                                <td>:</td>
                                <td>{{$cst->telepon_desa}}</td>
                            </tr>
                            <tr>
                                <td>PROVISI</td>
                                <td>:</td>
                                <td>{{$cst->name_province}}</td>
                            </tr>
                            <tr>
                                <td>KOTA</td>
                                <td>:</td>
                                <td>{{$cst->name_city}}</td>
                            </tr>
                            <tr>
                                <td>KECAMATAN</td>
                                <td>:</td>
                                <td>{{$cst->name_district}}</td>
                            </tr>
                            <tr>
                                <td>KELURAHAN</td>
                                <td>:</td>
                                <td>{{$cst->name_village}}</td>
                            </tr>
                            <tr>
                                <td>LOKASI DESA</td>
                                <td>:</td>
                                <td>{{$cst->lokasi_desa}}</td>
                            </tr>
                            <tr>
                                <td>LOGO</td>
                                <td>:</td>
                                <td>
                                    <img src="{{asset('foto')}}/{{$cst->logo}}" width="70">
                                </td>
                            </tr>
                            @include('desa/profildesa/ganti')
                            @include('desa/profildesa/ubah')
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </section>
    </div>
    <div class="row mb-4">
        @foreach($data as $cst)
        @if($cst->lokasi_desa==NULL)
        <div class="alert alert-light-danger color-danger"><i
            class="bi bi-exclamation-circle"></i> ALAMAT TIDAK DI KETAHUI</div>
            @else
            <div class="col-12"><iframe class="form-control" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=720&amp;height=600&amp;hl=en&amp;q=Kantor+Kelurahan+{{$cst->name_village}}+{{$cst->name_district}}+{{$cst->name_city}}+(My%20Business%20Name)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>
            </div>
            @endif

            @endforeach
        </div>
        @endsection