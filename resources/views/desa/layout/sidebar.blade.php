<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                @php
                $desaporfil=DB::table('profil_desa')->where('user_id',Auth::user()->id)->get();
                $request=DB::table('surat')->get();
                $logoutuser=DB::table('users')->get();
                $userporfil=DB::table('info_lengkap')->where('user_id',Auth::user()->id)->get();
                @endphp
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="avatar avatar-xl">

                    @if(Auth::user()->level=="Desa")
                    @foreach($desaporfil as $dpf)
                    @if($dpf->logo==NULL)
                    <a href="{{route('profil_desa',Auth::user()->title_user)}}"><img src="{{asset('template/dist/assets/images/faces/1.jpg')}}" alt="Face 1"></a>
                    @else
                    <a href="{{route('profil_desa',Auth::user()->title_user)}}"><img src="{{asset('foto')}}/{{$dpf->logo}}" alt="Face 1"></a>
                    @endif
                    @endforeach
                    @else
                    @foreach($userporfil as $usp)
                    @if($usp->foto_profil==NULL)
                    <a href="{{route('profil_pengaju')}}"><img src="{{asset('template/dist/assets/images/faces/1.jpg')}}" alt="Face 1"></a>
                    @else
                    <a href="{{route('profil_pengaju')}}"><img src="{{asset('profil')}}/{{$usp->foto_profil}}" alt="Face 1"></a>
                    @endif
                    @endforeach
                    @endif
                    @if(Auth::user()->level=="Admin")
                    <a href=""><img src="{{asset('template/dist/assets/images/faces/1.jpg')}}" alt="Face 1"></a>
                    @endif
                    
                </div>
                <div class="ms-3 name">
                    <h5 class="font-bold">
                        @if(Auth::user()->level=="Desa")
                        ADMIN DESA
                        @else
                        {{Auth::user()->name}}
                        @endif
                    </h5>
                    <h6 class="text-muted mb-0">{{Auth::user()->email}}</h6>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>

                @if(Auth::user()->level=="Desa")
                <li class="sidebar-item active ">
                    <a href="{{route('dashboard',Auth::user()->title_user)}}" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="dripicons dripicons-user-group"></i>
                        <span>Data User</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item ">
                            <a href="{{route('user_pengaju',Auth::user()->title_user)}}">Pengaju</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="{{route('user_pengurus',Auth::user()->title_user)}}">Pengurus</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="dripicons dripicons-archive"></i>
                        <span>Data Surat</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item ">
                            <a href="{{route('data_surat',Auth::user()->title_user)}}">Surat</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="dripicons dripicons-information"></i>
                        <span>Layanan</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item ">
                            <a href="{{route('waktu_layanan',Auth::user()->title_user)}}">Waktu Pelayanan</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="dripicons dripicons-toggles"></i>
                        <span>Prosedur</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item ">
                            <a href="{{route('prosedur',Auth::user()->title_user)}}">Prosedur Pengajuan</a>
                        </li>
                    </ul>
                </li>
                
                @elseif(Auth::user()->level=="Pengaju")
                <li class="sidebar-item active ">
                    <a href="{{route('dashboard_pengaju')}}" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="dripicons dripicons-document-remove"></i>
                        <span>Data Request </span>
                    </a>
                    <ul class="submenu ">
                        @foreach($request as $req)
                        <li class="submenu-item ">
                            <a href="{{route('data_request',$req->singkatan)}}">{{$req->singkatan}}</a>
                        </li>
                        @endforeach
                    </ul>
                </li>
                @elseif(Auth::user()->level=="Staff")
                <li class="sidebar-item active ">
                    <a href="{{route('dashboard_staff')}}" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="dripicons dripicons-document-edit"></i>
                        <span>Belum Acc</span>
                    </a>
                    <ul class="submenu ">
                        @foreach($request as $req)
                        <li class="submenu-item ">
                            <a href="{{route('staff_acc',$req->singkatan)}}">{{$req->singkatan}}</a>
                        </li>
                        @endforeach
                    </ul>
                </li>
                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="dripicons dripicons-print"></i>
                        <span>Cetak Surat</span>
                    </a>
                    <ul class="submenu ">
                        @foreach($request as $req)
                        <li class="submenu-item ">
                            <a href="{{route('staff_cetak',$req->singkatan)}}">{{$req->singkatan}}</a>
                        </li>
                        @endforeach
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="{{route('surat_selesai')}}" class='sidebar-link'>
                        <i class="dripicons dripicons-checkmark"></i>
                        <span>Surat Selesai</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{route('laporan')}}" class='sidebar-link'>
                        <i class="dripicons dripicons-to-do"></i>
                        <span>Laporan</span>
                    </a>
                </li>
                @elseif(Auth::user()->level=="Kepala Desa")
                <li class="sidebar-item active ">
                    <a href="{{route('dashboard_kepaladesa')}}" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="dripicons dripicons-graph-pie"></i>
                        <span>ACC dan TTD</span>
                    </a>
                    <ul class="submenu ">
                        @foreach($request as $req)
                        <li class="submenu-item ">
                            <a href="{{route('kepaladesa_acc',$req->singkatan)}}">{{$req->singkatan}}</a>
                        </li>
                        @endforeach
                    </ul>
                </li>
                @endif
                <li class="sidebar-item  ">
                    <a href="{{route('logout')}}" class='sidebar-link'>
                        <i class="dripicons dripicons-exit"></i>
                        <span>Keluar</span>
                    </a>
                </li>

            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>