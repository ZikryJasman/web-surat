<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <?php
                    $desaporfil = DB::table('profil_desa')
                        ->where('user_id', Auth::user()->id)
                        ->get();
                    $request = DB::table('surat')->get();
                    $logoutuser = DB::table('users')->get();
                    $userporfil = DB::table('info_lengkap')
                        ->where('user_id', Auth::user()->id)
                        ->get();
                ?>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div class="avatar avatar-xl">

                    <?php if(Auth::user()->level == 'Desa'): ?>
                        <?php $__currentLoopData = $desaporfil; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dpf): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($dpf->logo == null): ?>
                                <a href="<?php echo e(route('profil_desa', Auth::user()->title_user)); ?>"><img
                                        src="<?php echo e(asset('template/dist/assets/images/faces/1.jpg')); ?>" alt="Face 1"></a>
                            <?php else: ?>
                                <a href="<?php echo e(route('profil_desa', Auth::user()->title_user)); ?>"><img
                                        src="<?php echo e(asset('foto')); ?>/<?php echo e($dpf->logo); ?>" alt="Face 1"></a>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <?php $__currentLoopData = $userporfil; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $usp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($usp->foto_profil == null): ?>
                                <a href="<?php echo e(route('profil_pengaju')); ?>"><img
                                        src="<?php echo e(asset('template/dist/assets/images/faces/1.jpg')); ?>" alt="Face 1"></a>
                            <?php else: ?>
                                <a href="<?php echo e(route('profil_pengaju')); ?>"><img
                                        src="<?php echo e(asset('profil')); ?>/<?php echo e($usp->foto_profil); ?>" alt="Face 1"></a>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                    <?php if(Auth::user()->level == 'Admin'): ?>
                        <a href=""><img src="<?php echo e(asset('template/dist/assets/images/faces/1.jpg')); ?>"
                                alt="Face 1"></a>
                    <?php endif; ?>

                </div>
                <div class="ms-3 name overflow-hidden">
                    <h5 class="font-bold">
                        <?php if(Auth::user()->level == 'Desa'): ?>
                            ADMIN
                        <?php else: ?>
                            <?php echo e(Auth::user()->name); ?>

                        <?php endif; ?>
                    </h5>
                    <h6 class="text-muted mb-0 pe-2"><?php echo e(Auth::user()->email); ?></h6>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>

                <?php if(Auth::user()->level == 'Desa'): ?>
                    <li class="sidebar-item <?php echo e(Route::currentRouteName() == 'dashboard' ? 'active' : ''); ?> ">
                        <a href="<?php echo e(route('dashboard', Auth::user()->title_user)); ?>" class='sidebar-link'>
                            <i class="bi bi-grid-fill"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="sidebar-item <?php echo e(Route::currentRouteName() == 'program.index' ? 'active' : ''); ?> ">
                        <a href="<?php echo e(route('program.index')); ?>" class='sidebar-link'>
                            <i class="bi bi-grid-fill"></i>
                            <span>Program Studi</span>
                        </a>
                    </li>
                    <li
                        class="sidebar-item  has-sub <?php echo e(in_array(Route::currentRouteName(), ['user_pengaju', 'user_pengurus']) ? 'active' : ''); ?>">
                        <a href="#" class='sidebar-link'>
                            <i class="dripicons dripicons-user-group"></i>
                            <span>Data User</span>
                        </a>
                        <ul class="submenu ">
                            <li class="submenu-item <?php echo e(Route::currentRouteName() == 'user_pengaju' ? 'active' : ''); ?>">
                                <a href="<?php echo e(route('user_pengaju', Auth::user()->title_user)); ?>">Pengaju</a>
                            </li>
                            <li
                                class="submenu-item <?php echo e(Route::currentRouteName() == 'user_pengurus' ? 'active' : ''); ?>">
                                <a href="<?php echo e(route('user_pengurus', Auth::user()->title_user)); ?>">Pengurus</a>
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-item  has-sub <?php echo e(Route::currentRouteName() == 'data_surat' ? 'active' : ''); ?>">
                        <a href="#" class='sidebar-link'>
                            <i class="dripicons dripicons-archive"></i>
                            <span>Data Surat</span>
                        </a>
                        <ul class="submenu ">
                            <li class="submenu-item <?php echo e(Route::currentRouteName() == 'data_surat' ? 'active' : ''); ?>">
                                <a href="<?php echo e(route('data_surat', Auth::user()->title_user)); ?>">Surat</a>
                            </li>
                        </ul>
                    </li>
                    <li
                        class="sidebar-item  has-sub <?php echo e(Route::currentRouteName() == 'waktu_layanan' ? 'active' : ''); ?>">
                        <a href="#" class='sidebar-link'>
                            <i class="dripicons dripicons-information"></i>
                            <span>Layanan</span>
                        </a>
                        <ul class="submenu ">
                            <li
                                class="submenu-item <?php echo e(Route::currentRouteName() == 'waktu_layanan' ? 'active' : ''); ?>">
                                <a href="<?php echo e(route('waktu_layanan', Auth::user()->title_user)); ?>">Waktu Pelayanan</a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item  has-sub <?php echo e(Route::currentRouteName() == 'prosedur' ? 'active' : ''); ?>">
                        <a href="#" class='sidebar-link'>
                            <i class="dripicons dripicons-toggles"></i>
                            <span>Prosedur</span>
                        </a>
                        <ul class="submenu ">
                            <li class="submenu-item <?php echo e(Route::currentRouteName() == 'prosedur' ? 'active' : ''); ?>">
                                <a href="<?php echo e(route('prosedur', Auth::user()->title_user)); ?>">Prosedur Pengajuan</a>
                            </li>
                        </ul>
                    </li>
                <?php elseif(Auth::user()->level == 'Pengaju'): ?>
                    <li class="sidebar-item <?php echo e(Route::currentRouteName() == 'dashboard_pengaju' ? 'active' : ''); ?> ">
                        <a href="<?php echo e(route('dashboard_pengaju')); ?>" class='sidebar-link'>
                            <i class="bi bi-grid-fill"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li
                        class="sidebar-item  has-sub <?php echo e(Route::currentRouteName() == 'data_request' ? 'active' : ''); ?>">
                        <a href="#" class='sidebar-link'>
                            <i class="dripicons dripicons-document-remove"></i>
                            <span>Data Request </span>
                        </a>
                        <ul class="submenu ">
                            <?php $__currentLoopData = $request; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $req): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li
                                    class="submenu-item <?php echo e(Route::currentRouteName() == 'data_request' ? 'active' : ''); ?>">
                                    <a href="<?php echo e(route('data_request', $req->singkatan)); ?>"><?php echo e($req->singkatan); ?></a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </li>
                <?php elseif(Auth::user()->level == 'Staff'): ?>
                    <li class="sidebar-item <?php echo e(Route::currentRouteName() == 'dashboard_staff' ? 'active' : ''); ?> ">
                        <a href="<?php echo e(route('dashboard_staff')); ?>" class='sidebar-link'>
                            <i class="bi bi-grid-fill"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="sidebar-item  has-sub <?php echo e(Route::currentRouteName() == 'staff_acc' ? 'active' : ''); ?>">
                        <a href="#" class='sidebar-link'>
                            <i class="dripicons dripicons-document-edit"></i>
                            <span>Belum Acc</span>
                        </a>
                        <ul class="submenu ">
                            <?php $__currentLoopData = $request; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $req): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="submenu-item">
                                    <a href="<?php echo e(route('staff_acc', $req->singkatan)); ?>"><?php echo e($req->singkatan); ?></a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </li>
                    
                    <li class="sidebar-item <?php echo e(Route::currentRouteName() == 'surat_selesai' ? 'active' : ''); ?> ">
                        <a href="<?php echo e(route('surat_selesai')); ?>" class='sidebar-link'>
                            <i class="dripicons dripicons-checkmark"></i>
                            <span>Surat Selesai</span>
                        </a>
                    </li>
                    <li class="sidebar-item <?php echo e(Route::currentRouteName() == 'laporan' ? 'active' : ''); ?> ">
                        <a href="<?php echo e(route('laporan')); ?>" class='sidebar-link'>
                            <i class="dripicons dripicons-to-do"></i>
                            <span>Laporan</span>
                        </a>
                    </li>
                <?php elseif(Auth::user()->level == 'Kepala Desa'): ?>
                    <li
                        class="sidebar-item <?php echo e(Route::currentRouteName() == 'dashboard_kepaladesa' ? 'active' : ''); ?> ">
                        <a href="<?php echo e(route('dashboard_kepaladesa')); ?>" class='sidebar-link'>
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
                            <?php $__currentLoopData = $request; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $req): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="submenu-item ">
                                    <a
                                        href="<?php echo e(route('kepaladesa_acc', $req->singkatan)); ?>"><?php echo e($req->singkatan); ?></a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </li>
                <?php endif; ?>
                <?php if(Auth::user()->level == 'Desa'): ?>
                    <li class="sidebar-item  <?php echo e(Route::currentRouteName() == 'profil_desa' ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('profil_desa', Auth::user()->title_user)); ?>" class='sidebar-link'>
                            <i class="dripicons dripicons-store"></i>
                            <span>Profil</span>
                        </a>
                    </li>
                <?php else: ?>
                    <li class="sidebar-item  <?php echo e(Route::currentRouteName() == 'profil_pengaju' ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('profil_pengaju')); ?>" class='sidebar-link'>
                            <i class="dripicons dripicons-store"></i>
                            <span>Profil</span>
                        </a>
                    </li>
                <?php endif; ?>
                <li class="sidebar-item  ">
                    <a href="<?php echo e(route('logout')); ?>" class='sidebar-link'>
                        <i class="dripicons dripicons-exit"></i>
                        <span>Keluar</span>
                    </a>
                </li>

            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\web-surat\resources\views/desa/layout/sidebar.blade.php ENDPATH**/ ?>