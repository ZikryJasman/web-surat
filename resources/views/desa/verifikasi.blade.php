@foreach($data as $dt)
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AUTH LUPA PASSWORD | WEB SURAT PENGAJUAN</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('template/dist/assets/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('template/dist/assets/vendors/bootstrap-icons/bootstrap-icons.css')}}">
    <link rel="stylesheet" href="{{asset('template/dist/assets/css/app.css')}}">
    <link rel="stylesheet" href="{{asset('template/dist/assets/css/pages/auth.css')}}">
</head>

<body>
    <div id="auth">

        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <h1 class="auth-title mb-5">Lupa Password</h1>
                    <!-- <p class="auth-subtitle mb-5">Input your data to register to our website.</p> -->
                    <form action="{{route('proses_forgot')}}" method="post">
                        @csrf
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" required="" class="form-control form-control-xl" name="email" placeholder="Masukkan Email anda ... *">
                            <div class="form-control-icon">
                                <i class="bi bi-envelope"></i>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-2">Send Kode</button>
                    </form>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">

                </div>
            </div>
        </div>

    </div>
    @if(!empty(session('kodeverif')))
    <div class="modal fade text-left" id="mymodal" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel1">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel1">Masukkan Kode Verifikasi</h5>
                <button type="button" class="close rounded-pill"
                data-bs-dismiss="modal" aria-label="Close">
                <i data-feather="x"></i>
            </button>
        </div>
        <div class="modal-body">
            <form method="post" action="{{route('cek_verifikasi')}}">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label>Kode Verifikasi</label>
                            <input type="text" class="form-control" name="token">
                        </div>  
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" data-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Close</span>
                </button>
                <button name="ubah" class="btn btn-primary ml-1">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Accept</span>
                </button>
            </div>
        </form>
    </div>
</div>
</div>
@endif
@if(!empty(session('pss')))
<div class="modal fade text-left" id="mymodal" tabindex="-1" role="dialog"
aria-labelledby="myModalLabel1">
<div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="myModalLabel1">Ubah Password</h5>
            <button type="button" class="close rounded-pill"
            data-bs-dismiss="modal" aria-label="Close">
            <i data-feather="x"></i>
        </button>
    </div>
    <div class="modal-body">
        <form method="post" action="{{route('ubah_password',$dt->title_user)}}">
            @csrf
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label>Password Baru</label>
                        <input type="text" class="form-control" name="password">
                    </div>  
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn" data-dismiss="modal">
                <i class="bx bx-x d-block d-sm-none"></i>
                <span class="d-none d-sm-block">Close</span>
            </button>
            <button name="ubah" class="btn btn-primary ml-1">
                <i class="bx bx-check d-block d-sm-none"></i>
                <span class="d-none d-sm-block">Accept</span>
            </button>
        </div>
    </form>
</div>
</div>
</div>
@endif
</body>
<script src="{{asset('template/dist/assets/js/bootstrap.bundle.min.js')}}"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha384-tsQFqpEReu7ZLhBV2VZlAu7zcOV+rXbYlF2cqB8txI/8aZajjp4Bqd+V6D5IgvKT" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="{{asset('template/dist/assets/js/extensions/sweetalert2.js')}}"></script>
<script src="{{asset('template/dist/assets/vendors/sweetalert2/sweetalert2.all.min.js')}}"></script>
<script type="text/javascript">
   $(document).ready(function() {
    $("#mymodal").modal('show');
})
</script>
</html>
@endforeach
@if(session('benar'))
<script type="text/javascript">
    document.getElementById('success');
    Swal.fire({
        icon: "success",
        title: "Berhasil Send kode",
        text: "Masukkan Kode Verfikasi Lupa Password"
    });
</script>
@endif
@if(session('salah'))
<script type="text/javascript">
    document.getElementById('warning');
    Swal.fire({
        icon: "warning",
        title: "Verifikasi Gagal",
        text: "Email tidak sesuai"
    });
</script>
@endif
@if(session('tokensalah'))
<script type="text/javascript">
    document.getElementById('error');
    Swal.fire({
        icon: "error",
        title: "Verifikasi Kode Salah.",
    });
</script>
@endif
@if(session('tokenbenar'))
<script type="text/javascript">
    document.getElementById('success');
    Swal.fire({
        icon: "success",
        title: "Verifikasi Berhasil",
        text: "Masukkan Password Baru Anda"
    });
</script>
@endif