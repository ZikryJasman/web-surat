<div class="container mt-3" style="background: white;">
    <div class="row">
        <div class="col-lg-2">

        </div>
        <div class="col-lg-8">
            @foreach($desa as $ds)
            <center>
                <img src="{{asset('foto')}}/{{$ds->logo}}" alt="avatar" class="img pt-3" width="50" style="float: left;">
                PEMERINTAHAN {{$ds->name_city}} <br>
                KECAMATAN {{$ds->name_district}}
                <h4>KELURAHAN {{$ds->name_village}}</h4>
                <span><i>{{$ds->lokasi_desa}}</i></span>
            </center>
            <hr>
            <center>
                <h5 style="text-transform: uppercase;"><u>{{$dt->nama_surat}}</u></h5>
                Nomor : {{$dt->singkatan}} / {{$dt->nomor_surat}} / {{$dt->tgl_req}}
            </center>
            <p style="text-align: left;">
                &nbsp;&nbsp;&nbsp; Yang bertanda tangan di bawah ini Lurah {{$ds->name_village}} {{$ds->name_city}}, <br style="float: left;">Menerangkan bahwa :
            </p>
            <center>
                <table border="0">
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
            <p>
                Adalah benar benar penduduk yang berdomisili di Desa {{$ds->name_village}}, Kecamatan {{$ds->name_district}},
                {{$ds->name_city}}.
            </p>
            <p>
                Adapun {{$dt->nama_surat}} ini di buat guna melengkapi persyaratan Pengajuan.
            </p>
            <p>
                Demikian {{$dt->nama_surat}} ini kami keluarkan untuk dapat dipergunakan sebagaimana mestinya dan bagi instansi yang berkepentingan menjadi bahan perikasa adanya.
            </p>
            <p>
                Dikeluarkan di : {{$ds->name_village}} <br>
                Pada Tanggal : <?php echo date('m F Y') ?>
            </p>
            <center>
                <div class="row">
                    <div class="col-lg-6">
                        Tanda Tangan <br> Yang Bersangkutan 
                        <p class="text" style="padding-top: 29%;">
                            <b><u>{{$dt->name}}</u></b>
                        </p>
                    </div>
                    <div class="col-lg-6">
                        {{$ds->name_city}} <br>
                        Kepala Desa Kelurahan {{$ds->name_village}} <br>
                        <img src="{{asset($dt->ttd)}}" style="width: 60%;">
                        <p class="text">
                           @if(Auth::user()->level!=="Kepala Desa")
                           @foreach($kepala as $kpl)
                           <b><u>{{$kpl->name}}</u></b>
                           @endforeach
                           @else
                           <b><u>{{Auth::user()->name}}</u></b>
                           @endif
                       </p>
                   </div>
               </div>
           </center>
           @endforeach
       </div>
       <div class="col-lg-2">

       </div>
   </div>
</div>