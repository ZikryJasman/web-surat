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
                        <td>Tahun Ajaran</td>
                        <td>:</td>
                        <td>{{$dt->tahun_ajaran}}</td>
                    </tr>
                    <tr>
                        <td>Program Studi</td>
                        <td>:</td>
                        <td>{{$dt->program_studi}}</td>
                    </tr>
                    <tr>
                        <td>No. NIM</td>
                        <td>:</td>
                        <td>{{$dt->nim}}</td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>:</td>
                        <td>{{$dt->alamat}}</td>
                    </tr>
                </table>
            </center>
            <br>
            Orang tersebut di atas adalah benar penduduk Desa Kami yang berdomisili di alamat diatas serta kami menerangkan bahwa orang tersebut benar berkelakuan baik dan belum pernah tersangkut perkara Polisi. Surat keterangan ini kami berikan untuk memenuhi salah satu persyaratan Surat Keterangan Catatan Kepolisian ({{$dt->singkatan}}).
            <center>
                <p class="text mt-4">Demikian surat ini diberikan kepada yang bersangkutan agar dapat dipergunakan untuk sebagaimana mestinya.</p>
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
