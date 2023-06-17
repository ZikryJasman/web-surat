@if($_GET['keyword']=="cek-surat")
@include('desa/template/3/cek')
@elseif($_GET['keyword']=="print-surat")
@include('desa/template/3/print')
@else
<center><h1>Tidak ada data di Temukan</h1></center>
@endif