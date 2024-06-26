@foreach ($data as $dt)
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>AUTH REGISTER | WEB SURAT PENGAJUAN</title>
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap"
            rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('template/dist/assets/css/bootstrap.css') }}">
        <link rel="stylesheet" href="{{ asset('template/dist/assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
        <link rel="stylesheet" href="{{ asset('template/dist/assets/css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('template/dist/assets/css/pages/auth.css') }}">
    </head>

    <body>
        <div id="auth">

            <div class="row h-100">
                <div class="col-lg-5 col-12">
                    <div id="auth-left">
                        <h1 class="auth-title">Register</h1>
                        <form action="{{ route('daftar') }}" method="post">
                            @csrf
                            <div class="form-group position-relative has-icon-left mb-4">
                                <input type="text" class="form-control form-control-xl" required="" name="name"
                                    placeholder="Nama Lengkap">
                                <div class="form-control-icon">
                                    <i class="bi bi-person"></i>
                                </div>
                            </div>
                            <input type="hidden" value="{{ $dt->id }}" name="desa_id">
                            <div class="form-group position-relative has-icon-left mb-4">
                                <input type="email" class="form-control form-control-xl" required="" name="email"
                                    placeholder="Email">
                                <div class="form-control-icon">
                                    <i class="bi bi-person"></i>
                                </div>
                            </div>
                            <div class="form-group position-relative has-icon-left mb-4">
                                <select class="form-control" required="" name="program_id">
                                    <option value="">-- Pilih Program --</option>
                                    @foreach ($program as $p)
                                        <option value="{{ $p->id }}">{{ $p->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group position-relative has-icon-left mb-4">
                                <input type="password" class="form-control form-control-xl" required=""
                                    name="password" placeholder="Password">
                                <div class="form-control-icon">
                                    <i class="bi bi-shield-lock"></i>
                                </div>
                            </div>
                            <div class="form-group position-relative has-icon-left mb-4">
                                <input type="password" class="form-control form-control-xl" required=""
                                    name="confirm" placeholder="Konfirmasi Password">
                                <div class="form-control-icon">
                                    <i class="bi bi-shield-lock"></i>
                                </div>
                            </div>
                            <button class="btn btn-primary btn-block btn-lg shadow-lg mt-2">Register</button>
                        </form>
                        <div class="text-center mt-3 text-lg fs-4">
                            <p class='text-gray-600'>Sudah punya Akun? <a href="{{ route('login', $dt->title_user) }}"
                                    class="font-bold">Login</a>.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 d-none d-lg-block">
                    <div id="auth-right">

                    </div>
                </div>
            </div>

        </div>
    </body>
    <script src="{{ asset('template/dist/assets/js/extensions/sweetalert2.js') }}"></script>
    <script src="{{ asset('template/dist/assets/vendors/sweetalert2/sweetalert2.all.min.js') }}"></script>
    @if (session('niksama'))
        <script type="text/javascript">
            document.getElementById('warning');
            Swal.fire({
                icon: "warning",
                title: "Email terdaftar",
                text: "Email telah terdaftar, coba gunakan Email Aktif lainnya."
            });
        </script>
    @endif
    @if (session('confirm'))
        <script type="text/javascript">
            document.getElementById('error');
            Swal.fire({
                icon: "error",
                title: "Konfirmasi Password Salah.",
            });
        </script>
    @endif

    </html>
@endforeach
