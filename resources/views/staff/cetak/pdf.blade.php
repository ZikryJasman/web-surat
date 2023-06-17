
@foreach($data as $dt)
<?php  
$nama_template='desa/template/'.$dt->nama_template.'/'.$dt->nama_template;
?>
@include($nama_template)
@endforeach
