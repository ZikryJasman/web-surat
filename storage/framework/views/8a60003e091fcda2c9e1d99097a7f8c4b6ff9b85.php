<?php $__env->startSection('title', 'Data User Pengaju'); ?>

<?php $__env->startSection('content'); ?>

    <div class="page-heading">
        <section class="section">
            <div class="card">
                <div class="card-header">
                    Table Program Studi
                    <button type="button" style="float: right;" class="btn btn-sm btn-outline-primary block"
                        data-bs-toggle="modal" data-bs-target="#programStudi">
                        Tambah Data
                    </button>
                </div>
                <div class="card-body" style="overflow-x:scroll;">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>No. </th>
                                <th>Nama Program Studi</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(count($data) > 0): ?>
                                <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pgn): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <th><?php echo e($loop->iteration); ?></th>
                                        <td>
                                            <?php echo e($pgn->nama); ?>

                                        </td>
                                        <td align="center">
                                            <!-- <a href="" class="btn btn-sm btn-danger rounded-pill"><i class="icon dripicons-trash"></i></a> -->
                                            <a href="" data-bs-toggle="modal"
                                                data-bs-target="#edit<?php echo e($pgn->id); ?>"
                                                class="btn btn-sm btn-primary rounded-pill"><i
                                                    class="icon dripicons-preview"></i></a>
                                            <a href="<?php echo e(route('program.delete', ['id' => $pgn->id])); ?>"
                                                onclick="return confirm('Lanjutkan Hapus Data?')"
                                                class="btn btn-sm rounded-pill btn-danger">
                                                <i class="dripicons dripicons-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php echo $__env->make('desa/program/update', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
    <?php echo $__env->make('desa/program/add', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('desa/layout/app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\web-surat\resources\views/desa/program/index.blade.php ENDPATH**/ ?>