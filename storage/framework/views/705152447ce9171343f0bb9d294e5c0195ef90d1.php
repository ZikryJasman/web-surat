<?php $__env->startSection('title','Data User Pengaju'); ?>

<?php $__env->startSection('content'); ?>

<div class="page-heading">

    <section class="section">
        <div class="card">
            <div class="card-header">
                Table Pengaju
            </div>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No. </th>
                            <th>Nama User</th>
                            <th>Email User</th>
                            <th>Nim</th>
                            <th>Level</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; ?>
                        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pgn): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <th><?=$no; ?>. </th>
                            <td>
                                <?php if($pgn->name==NULL): ?>
                                <span class="text text-danger">Tambahkan Nama?</span>
                                <?php endif; ?>
                                <?php if($pgn->name!==NULL): ?>
                                <?php echo e($pgn->name); ?>

                                <?php endif; ?>
                            </td>
                            <td><?php echo e($pgn->email); ?></td>
                            <td><?php echo e($pgn->nim); ?></td>
                            <td>
                                <?php if($pgn->level=="Pengaju"): ?>
                                <span class="badge bg-primary"><?php echo e($pgn->level); ?></span>
                                <?php else: ?>
                                <span class="badge bg-success"><?php echo e($pgn->level); ?></span>
                                <?php endif; ?>
                            </td>
                            <td align="center">
                                <!-- <a href="" class="btn btn-sm btn-danger rounded-pill"><i class="icon dripicons-trash"></i></a> -->
                                <a href="<?php echo e(route('cek_user',['title'=>Auth::user()->title_user,'id'=>$pgn->id])); ?>" class="btn btn-sm btn-primary rounded-pill"><i class="icon dripicons-preview"></i></a>
                            </td>
                        </tr>
                        <?php $no++; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>

    </section>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('desa/layout/app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\web-surat\resources\views/desa/user/pengaju.blade.php ENDPATH**/ ?>