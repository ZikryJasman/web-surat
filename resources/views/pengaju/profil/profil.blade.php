     @extends('desa/layout/app')
     @foreach($data as $cst)
     @section('title',"$cst->name")
     @section('content')
     <div class="page-heading">

        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h2>Detail Profile</h2>
                    <button type="button" class="btn rounded-pill btn-sm btn-warning block" style="float: right;" data-bs-toggle="modal" data-bs-target="#inlineFormprofil">
                        <i class="icon dripicons-document-edit"></i> Update
                    </button>
                    <button type="button" class="btn rounded-pill btn-sm btn-primary block" style="float: right;" data-bs-toggle="modal" data-bs-target="#ganti">
                        <i class="bi bi-shield-lock"></i> Ganti Password
                    </button>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td>EMAIL</td>
                                <td>:</td>
                                <td>{{$cst->email}}</td>
                            </tr>
                            <tr>
                                <td>NAMA</td>
                                <td>:</td>
                                <td>{{$cst->name}}</td>
                            </tr>
                            <tr>
                                <td>NIK</td>
                                <td>:</td>
                                <td>{{$cst->nik}}</td>
                            </tr>
                            <tr>
                                <td>AGAMA</td>
                                <td>:</td>
                                <td>{{$cst->agama}}</td>
                            </tr>
                            <tr>
                                <td>TEMPAT LAHIR</td>
                                <td>:</td>
                                <td>{{$cst->tempat}}</td>
                            </tr>
                            <tr>
                                <td>TANGGAL LAHIR</td>
                                <td>:</td>
                                <td>{{$cst->tgl_lahir}}</td>
                            </tr>
                            <tr>
                                <td>JENIS KELAMIN</td>
                                <td>:</td>
                                <td>{{$cst->jenis_kelamin}}</td>
                            </tr>
                            @if($cst->level=="Pengaju")
                            <tr>
                                <td>PEKERJAAN</td>
                                <td>:</td>
                                <td>{{$cst->pekerjaan}}</td>
                            </tr>
                            @endif
                            <tr>
                                <td>PONSEL</td>
                                <td>:</td>
                                <td>
                                    @if(substr($cst->telepon,0,1)=='0')
                                    <a href="https://wa.me/62{{substr($cst->telepon,1)}}" target="_blank">
                                        +62 {{substr($cst->telepon,1)}}
                                    </a>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>ALAMAT</td>
                                <td>:</td>
                                <td>{{$cst->alamat}}</td>
                            </tr>
                            <tr>
                                <td>FOTO PROFIL</td>
                                <td>:</td>
                                <td>
                                    <img src="{{asset('profil')}}/{{$cst->foto_profil}}" width="70">
                                </td>
                            </tr>
                            @include('pengaju/profil/ganti')
                            @include('pengaju/profil/ubah')
                        </tbody>
                    </table>
                </div>
            </div>

        </section>
    </div>
    <div class="row mb-4">
        @if($cst->alamat==NULL)
        <div class="alert alert-light-danger color-danger"><i
            class="bi bi-exclamation-circle"></i> ALAMAT TIDAK DI KETAHUI</div>
            @else
            <div class="col-12"><iframe class="form-control" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=720&amp;height=600&amp;hl=en&amp;q={{$cst->alamat}}+(My%20Business%20Name)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>
            </div>
            @endif

        </div>
        @endforeach
        @endsection