<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pengajuan Surat</title>

    <link rel="stylesheet" href="{{asset('print.css')}}">
</head>
<style type="text/css">
    @page {
        margin: 100px 25px;
    }

    header {
      position: fixed;
      top: -100px;
      left: 0px;
      right: 0px;
      height: 50px;
      font-size: 20px !important;

      /** Extra personal styles **/
      /*background-color: #008B8B;*/
      /*color: white;*/
      text-align: center;
      line-height: 35px;
  }

  footer {
    position: fixed;
    bottom: -30px;
    left: 0px;
    right: 0px;
    height: 50px;
    font-size: 20px !important;

    /** Extra personal styles **/
    /*background-color: #008B8B;*/
    /*color: white;*/
    text-align: center;
    line-height: 35px;
}
</style>
<body>

    <header>
        <center>
            <img src="{{asset('foto')}}/{{$desa->logo}}" alt="avatar" class="img pt-3" width="65" style="float: left;">
            KANTOR DESA {{$desa->name_village}} KECAMATAN {{$desa->name_district}} <br>{{$desa->name_city}} <br>
            <sup><small>{{$desa->lokasi_desa}}
                | {{$desa->telepon_desa}}</small></sup>
            </center>
        </header>
        <footer>
         <center>
            <img src="{{asset('foto')}}/{{$desa->logo}}" alt="avatar" class="img pt-3" width="65" style="float: left;">
            KANTOR DESA {{$desa->name_village}} KECAMATAN {{$desa->name_district}} <br>{{$desa->name_city}} <br>
            <sup><small>{{$desa->lokasi_desa}}
                | {{$desa->telepon_desa}}</small></sup>
            </center>
        </footer>

        <main>
            <div class="card-body" style="overflow-x:scroll;font-family: times new roman;">
                <table class="table table-bordered" id="table1">
                    <thead>
                        <tr>
                            <tr>
                                <th>No. </th>
                                <th>Tanggal Request</th>
                                <th>Nomor Surat</th>
                                <th>NIM</th>
                                <th>Nama</th>
                                <th>Catatan Lain</th>
                                <th>Pengajuan</th>
                            </tr>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; ?>
                        @foreach($data as $dt)
                        <tr>
                            <td>{{$no}}.</td>
                            <td>{{$dt->tgl_req}}</td>
                            <td>{{$dt->singkatan}} / {{$dt->nomor_surat}}</td>
                            <td>{{$dt->nim}}</td>
                            <td>{{$dt->name}}</td>
                            <td>{{$dt->keperluan}}</td>
                            <td>{{$dt->nama_surat}}</td>
                        </tr>
                        <?php $no++; ?>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </main>
    </body>
    </html>
