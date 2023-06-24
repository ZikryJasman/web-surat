<?php $__env->startSection('title', 'Surat Selesai'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container mb-3">
        <div class="row">
            <div class="col-lg-5 pb-4" style="background: white;box-shadow:2px 2px grey;">
                <form method="get">
                    <?php echo csrf_field(); ?>
                    <label class="mt-4">Filter Berdasarkan Program</label>
                    <select class="form-control" name="program_id">
                        <option value="">-- Pilih Program --</option>
                        <?php $__currentLoopData = $program; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($p->id); ?>"><?php echo e($p->nama); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <label class="mt-2" for="">Berdasarkan Nama Pengaju</label>
                    <input type="text" class="form-control mt-1" name="search">
                    <button class="btn btn-sm btn-primary mt-2">Cari</button>
                </form>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                Surat Selesai
            </div>
            <div class="card-body" style="overflow-x:scroll;">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No. </th>
                            <th>Tanggal Request</th>
                            <th>Program Studi</th>
                            <th>Request Surat</th>
                            <th>Nama Lengkap</th>
                            <th>Status</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($data) > 0): ?>
                            <?php $no = 1; ?>
                            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <th><?= $no ?>. </th>
                                    <td><?php echo e(parseDateIdFull($dt->tgl_req) . ' WIB'); ?></td>
                                    <td><?php echo e($dt->program->nama ?? ''); ?></td>
                                    <td><?php echo e($dt->nama_surat); ?></td>
                                    <td><?php echo e($dt->name); ?></td>
                                    <td>
                                        <?php if($dt->status_pengajuan == 'Pengecekan Permohonan'): ?>
                                            <span class="badge bg-danger">Data Sedang <br>di Periksa</span>
                                        <?php elseif($dt->status_pengajuan == 'Data Belum Lengkap'): ?>
                                            <span class="badge bg-danger"><?php echo e($dt->status_pengajuan); ?></span>
                                        <?php else: ?>
                                            <span class="badge bg-success"><?php echo e($dt->status_pengajuan); ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if($dt->selesai == null): ?>
                                            Menunggu Konfirmasi
                                        <?php endif; ?>
                                        <?php if($dt->selesai !== null): ?>
                                            <span class="badge bg-success">
                                                <?php echo e($dt->selesai); ?>

                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td> <a href="<?php echo e($dt->upload_berkas); ?>" target="_blank"
                                            class="btn btn-sm btn-success rounded-pill"><i
                                                class="icon dripicons-print"></i></a></td>
                                </tr>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('desa/layout/app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\web-surat\resources\views/staff/selesai/index.blade.php ENDPATH**/ ?>