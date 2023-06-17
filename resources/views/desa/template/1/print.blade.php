<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Surat</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="{{asset('template/dist/assets/css/bootstrap.css')}}">
    <!-- <link rel="stylesheet" href="{{asset('template/dist/assets/vendors/dripicons/webfont.css')}}"> -->
    <link rel="stylesheet" href="{{asset('template/dist/assets/css/pages/dripicons.css')}}">
    <link rel="stylesheet" href="{{asset('template/dist/assets/vendors/bootstrap-icons/bootstrap-icons.css')}}">
    <link rel="stylesheet" href="{{asset('template/dist/assets/css/app.css')}}">
</head>

<body style="background: white;color: black;">
    @foreach($data as $dt)
    <div class="container-fluid" style="background: white;">
        <div class="row">
            <div class="col-xl-12">
                @foreach($desa as $ds)
                <center>
                    <img src="{{asset('foto')}}/{{$ds->logo}}" alt="avatar" class="img pt-2" width="65" style="float: left;">
                    PEMERINTAHAN {{$ds->name_city}} <br>
                    KECAMATAN {{$ds->name_district}}
                    <h4>KELURAHAN {{$ds->name_village}}</h4>
                    <span><i>{{$ds->lokasi_desa}}</i></span>
                </center>
                <hr>
                <center>
                    <h5 style="text-transform: uppercase;color: black;"><u>{{$dt->nama_surat}}</u></h5>
                    Nomor : {{$dt->singkatan}} / {{$dt->nomor_surat}} / {{$dt->tgl_req}}
                </center>
                <p style="text-align: left;">
                    &nbsp;&nbsp;&nbsp; Yang bertanda tangan di bawah ini Lurah {{$ds->name_village}} {{$ds->name_city}}, <br style="float: left;">Menerangkan bahwa :
                </p>
                <center>
                    <table border="0" align="center" class="text mt-2 mb-4">
                        <tr>
                            <td>Nama</td>
                            <td>:</td>
                            <td>{{$dt->name}}</td>
                        </tr>
                        <tr>
                            <td>Tempat, tanggal lahir</td>
                            <td>:</td>
                            <td>{{$dt->tempat}}, {{$dt->tgl_lahir}}</td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td>:</td>
                            <td>{{$dt->jenis_kelamin}}</td>
                        </tr>
                        <tr>
                            <td>Agama</td>
                            <td>:</td>
                            <td>{{$dt->agama}}</td>
                        </tr>
                        <tr>
                            <td>Pekerjaan</td>
                            <td>:</td>
                            <td>{{$dt->pekerjaan}}</td>
                        </tr>
                        <tr>
                            <td>No. NIK</td>
                            <td>:</td>
                            <td>{{$dt->nik}}</td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>:</td>
                            <td>{{$dt->alamat}}</td>
                        </tr>
                    </table>
                </center>
                <center>
                    Adalah benar - benar penduduk asli Kampung {{$ds->nama_village}} Kecamatan {{$ds->name_district}}.
                    <p>"Surat Keterangan ini digunakan untuk Keperluan <b><i><u>{{$dt->keperluan}}</u></i></b>"</p>
                    <p>Demikian surat ini diberikan kepada yang bersangkutan agar dapat dipergunakan untuk sebagaimana mestinya.</p>
                    <table class="table mt-5" align="center" style="color: black;">
                        <tr>
                            <td align="center">
                                Tanda Tangan <br> Yang Bersangkutan
                            </td>
                            <td align="center">
                                {{$ds->name_city}} <br>
                                Kepala Desa Kelurahan {{$ds->name_village}} <br>
                            </td>
                        </tr>
                        <tr>
                            <td align="center" class="text pt-5">
                                <p style="padding-top: 20%;"><b><u>{{$dt->name}}</u></b></p>
                            </td>
                            <td align="center" class="text">
                                <img src="{{asset($dt->ttd)}}" class="text pt-1" height="95"> <br>
                                @if(Auth::user()->level!=="Kepala Desa")
                                @foreach($kepala as $kpl)
                                <p><b><u>{{$kpl->name}}</u></b></p>
                                @endforeach
                                @else
                                <p><b><u>{{Auth::user()->name}}</u></b></p>
                                @endif
                            </td>
                        </tr>
                    </table>
                </center>
                @endforeach
            </div>
        </div>
    </div>
    @endforeach
</body>
</html>