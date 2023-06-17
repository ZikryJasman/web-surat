<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tanda Tangan Kepala Desa | Web Surat Permohonan</title>
  <!-- CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
  <style type="text/css">
  .signature-pad{
    border: 1px solid #ccc;
    border-radius: 5px;
    width: 100% !important;
    height: 260px;
  }
</style>
</head>
@foreach($data as $dt)
<body>
  <div class="container">
    <h3>Tanda Tangan Surat</h3>
    <div class="row">
     <div class="col-md-6">
      <form method="POST" action="{{route('ttd_upload',$dt->id_pengajuan)}}">
        @csrf
        <div class="wrapper">
          <canvas id="signature-pad" class="signature-pad"></canvas>
        </div>
        <br>
        <input type="hidden" name="lama" value="{{$dt->ttd}}">
        <input type="hidden" name="singkatan" value="{{$dt->singkatan}}">
        <button type="button" class="btn btn-danger btn-sm" id="clear">HAPUS</button>
        <button type="submit" class="btn btn-success btn-sm" id="sub">GUNAKAN TTD</button>
        <button type="button" class="btn btn-primary btn-sm" id="konfirmasi">TERAPKAN</button>
        <div id="form-group"></div>
      </form>
    </div>
  </div>
</div>
<!-- Javascript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
<script>
  $("#sub").hide();

  var canvas = document.getElementById('signature-pad');
  function resizeCanvas() {
    var ratio =  Math.max(window.devicePixelRatio || 0.5, 0.5);
    canvas.width = canvas.offsetWidth * ratio;
    canvas.height = canvas.offsetHeight * ratio;
    canvas.getContext("2d").scale(ratio, ratio);
  }

  window.onresize = resizeCanvas;
  resizeCanvas();

  var signaturePad = new SignaturePad(canvas, {
  backgroundColor: 'rgb(255, 255, 255)' // necessary for saving image as JPEG; can be removed is only saving as PNG or SVG
});
  document.getElementById('konfirmasi').addEventListener('click', function () {
    if(signaturePad.isEmpty()){
      $("#signature-pad").required();
    }else{
      $("#sub").show();
      var data = signaturePad.toDataURL('image/png');
      console.log(data);
      $('#form-group').html('<img src="'+data+'" style="width:50%!important;height:90px;"><textarea id="signature64" name="ttd" style="display:none;">'+data+'</textarea>');
    }
  });
  document.getElementById('clear').addEventListener('click', function () {
    signaturePad.clear();
    $("#sub").hide();
  });
</script>
@endforeach
</body>
</html>