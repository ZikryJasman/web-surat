@if($_GET['keyword']=="cek-surat")
@include('desa/template/2/cek')
@elseif($_GET['keyword']=="print-surat")
@include('desa/template/2/print')
@else
<center><h1>Tidak ada data di Temukan</h1></center>
@endif