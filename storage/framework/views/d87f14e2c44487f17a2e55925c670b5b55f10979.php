     
     <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cst): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
         <?php $__env->startSection('title', "$cst->name"); ?>
         <?php $__env->startSection('content'); ?>
             <div class="page-heading">

                 <section class="section">
                     <div class="card">
                         <div class="card-header">
                             <h2>Detail Profil</h2>
                             <button type="button" class="btn rounded-pill btn-sm btn-warning block" style="float: right;"
                                 data-bs-toggle="modal" data-bs-target="#inlineFormprofil">
                                 <i class="icon dripicons-document-edit"></i> Ubah
                             </button>
                             <button type="button" class="btn rounded-pill btn-sm btn-primary block" style="float: right;"
                                 data-bs-toggle="modal" data-bs-target="#ganti">
                                 <i class="bi bi-shield-lock"></i> Ganti Password
                             </button>
                         </div>
                         <div class="card-body" style="overflow-x:scroll;">
                             <table class="table table-bordered">
                                 <tbody>
                                     <tr>
                                         <td>EMAIL</td>
                                         <td>:</td>
                                         <td><?php echo e($cst->email); ?></td>
                                     </tr>
                                     <tr>
                                         <td>NAMA</td>
                                         <td>:</td>
                                         <td><?php echo e($cst->name); ?></td>
                                     </tr>
                                     <tr>
                                         <td>NIM</td>
                                         <td>:</td>
                                         <td><?php echo e($cst->nim); ?></td>
                                     </tr>
                                     <tr>
                                         <td>TAHUN AJARAN</td>
                                         <td>:</td>
                                         <td><?php echo e($cst->tahun_ajaran); ?></td>
                                     </tr>
                                     <tr>
                                         <td>TEMPAT LAHIR</td>
                                         <td>:</td>
                                         <td><?php echo e($cst->tempat); ?></td>
                                     </tr>
                                     <tr>
                                         <td>TANGGAL LAHIR</td>
                                         <td>:</td>
                                         <td><?php echo e(parseDateId($cst->tgl_lahir)); ?></td>
                                     </tr>
                                     <tr>
                                         <td>JENIS KELAMIN</td>
                                         <td>:</td>
                                         <td><?php echo e($cst->jenis_kelamin); ?></td>
                                     </tr>
                                     <tr>
                                         <td>Pangkat</td>
                                         <td>:</td>
                                         <td><?php echo e($cst->pangkat ?? '-'); ?></td>
                                     </tr>
                                     <?php if($cst->level == 'Pengaju'): ?>
                                         <tr>
                                             <td>PROGRAM STUDI</td>
                                             <td>:</td>
                                             <td><?php echo e($cst->program->nama ?? ''); ?></td>
                                         </tr>
                                     <?php endif; ?>
                                     <tr>
                                         <td>PONSEL</td>
                                         <td>:</td>
                                         <td>
                                             <?php if(substr($cst->telepon, 0, 1) == '0'): ?>
                                                 <a href="https://wa.me/62<?php echo e(substr($cst->telepon, 1)); ?>" target="_blank">
                                                     +62 <?php echo e(substr($cst->telepon, 1)); ?>

                                                 </a>
                                             <?php endif; ?>
                                         </td>
                                     </tr>
                                     <tr>
                                         <td>ALAMAT</td>
                                         <td>:</td>
                                         <td><?php echo e($cst->alamat); ?></td>
                                     </tr>
                                     <tr>
                                         <td>FOTO PROFIL</td>
                                         <td>:</td>
                                         <td>
                                             <?php if(empty($cst->foto_profil)): ?>
                                                 Tidak ada gambar
                                             <?php else: ?>
                                                 <img src="<?php echo e($cst->foto_profil); ?>" width="70">
                                             <?php endif; ?>
                                         </td>
                                     </tr>
                                     <?php echo $__env->make('pengaju/profil/ganti', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                     <?php echo $__env->make('pengaju/profil/ubah', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                 </tbody>
                             </table>
                         </div>
                     </div>

                 </section>
             </div>
             <div class="row mb-4">
                 <?php if($cst->alamat == null): ?>
                     <div class="alert alert-light-danger color-danger"><i class="bi bi-exclamation-circle"></i> ALAMAT
                         TIDAK DI KETAHUI</div>
                 <?php else: ?>
                     <div class="col-12"><iframe class="form-control" height="400" frameborder="0" scrolling="no"
                             marginheight="0" marginwidth="0"
                             src="https://maps.google.com/maps?width=720&amp;height=600&amp;hl=en&amp;q=<?php echo e($cst->alamat); ?>+(My%20Business%20Name)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>
                     </div>
                 <?php endif; ?>

             </div>
         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
     <?php $__env->stopSection(); ?>

<?php echo $__env->make('desa/layout/app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\web-surat\resources\views/pengaju/profil/profil.blade.php ENDPATH**/ ?>