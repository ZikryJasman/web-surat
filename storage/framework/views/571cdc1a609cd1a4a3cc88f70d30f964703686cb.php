<?php $__env->startSection('title', 'Data User Pengurus'); ?>

<?php $__env->startSection('content'); ?>

    <div class="page-heading">
        <div class="container mb-3">
            <div class="row">
                <div class="col-lg-5 pb-4" style="background: white;box-shadow:2px 2px grey;">
                    <form method="get">
                        <?php echo csrf_field(); ?>
                        <label class="mt-4" for="">Berdasarkan Nama Pengurus</label>
                        <input type="text" class="form-control mt-1" name="search">
                        <button class="btn btn-sm btn-primary mt-2">Cari</button>
                    </form>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header">
                    Table Pengurus
                    <button type="button" style="float: right;" class="btn btn-sm btn-outline-primary block"
                        data-bs-toggle="modal" data-bs-target="#default">
                        Tambah Data
                    </button>
                </div>
                <div class="card-body" style="overflow-x:scroll;">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>No. </th>
                                <th>Nama Pengurus</th>
                                <th>Email</th>
                                <th>Nim</th>
                                <th>Level</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(count($data) > 0): ?>
                                <?php $no = 1; ?>
                                <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pgn): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($pgn->level == 'Staff' or $pgn->level == 'Kepala Desa'): ?>
                                        <tr>
                                            <th><?= $no ?>. </th>
                                            <td>
                                                <?php if($pgn->name == null): ?>
                                                    <span class="text text-danger">Tambahkan Nama?</span>
                                                <?php endif; ?>
                                                <?php if($pgn->name !== null): ?>
                                                    <?php echo e($pgn->name); ?>

                                                <?php endif; ?>
                                            </td>
                                            <td><?php echo e($pgn->email); ?></td>
                                            <td><?php echo e($pgn->nim); ?></td>
                                            <td>
                                                <?php if($pgn->level == 'Kepala Desa'): ?>
                                                    <span class="badge bg-success">Wakil Dekan</span>
                                                <?php else: ?>
                                                    <span class="badge bg-success"><?php echo e($pgn->level); ?></span>
                                                <?php endif; ?>
                                            </td>
                                            <td align="center">
                                                <!-- <a href="" class="btn btn-sm btn-danger rounded-pill"><i class="icon dripicons-trash"></i></a> -->
                                                <a href="<?php echo e(route('cek_user', ['title' => Auth::user()->title_user, 'id' => $pgn->id])); ?>"
                                                    class="btn btn-sm btn-success rounded-pill"><i
                                                        class="icon dripicons-preview"></i></a>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                    <?php $no++; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <tr class="no-data">
                                    <td class="text-center" colspan="14"><?php echo e($data->onEachSide(5)->links()); ?></td>
                                </tr>
                            <?php else: ?>
                                <tr class="no-data">
                                    <td class="text-center" colspan="14">Tidak ada data</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
    <?php echo $__env->make('desa/user/tambah', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('desa/layout/app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\web-surat\resources\views/desa/user/pengurus.blade.php ENDPATH**/ ?>