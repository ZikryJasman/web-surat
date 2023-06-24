<?php $__env->startSection('title', 'Data Request Surat Permohonan'); ?>

<?php $__env->startSection('content'); ?>
    <section class="section">
        <div class="card">
            <div class="card-header">
                Data Request
            </div>
            <div class="card-body" style="overflow-x:scroll;">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No. </th>
                            <th>Tanggal Request</th>
                            <th>Request Surat</th>
                            <th>Status</th>
                            <th>Keterangan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($data) > 0): ?>
                            <?php $no = 1; ?>
                            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <th><?= $no ?>. </th>
                                    <td><?php echo e(parseDateIdFull($dt->tgl_req) . ' WIB'); ?></td>
                                    <td><?php echo e($dt->nama_surat); ?></td>
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
                                        <?php if($dt->selesai !== null && $dt->selesai == 'Lengkapi data'): ?>
                                            <span class="badge bg-danger">
                                                <?php echo e($dt->selesai); ?>

                                            </span>
                                        <?php endif; ?>
                                        <?php if($dt->selesai !== null && $dt->selesai != 'Lengkapi data'): ?>
                                            <span class="badge bg-success">
                                                <?php echo e($dt->selesai); ?>

                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td align="center">
                                        <a href="" data-bs-toggle="modal"
                                            data-bs-target="#detail<?php echo e($dt->id_pengajuan); ?>"
                                            class="btn btn-sm btn-primary rounded-pill"><i
                                                class="icon dripicons-document"></i></a>
                                        <?php if($dt->selesai !== null && $dt->selesai == 'Lengkapi data'): ?>
                                            <a href="<?php echo e(route('updateRequest', ['surat' => $dt->singkatan, 'idPengajuan' => $dt->id_pengajuan])); ?>"
                                                class="btn btn-sm btn-success rounded-pill"><i
                                                    class="icon dripicons-document-edit"></i></a>
                                        <?php endif; ?>
                                        <?php if($dt->selesai == 'Surat Selesai'): ?>
                                            <a href="<?php echo e($dt->upload_berkas); ?>"
                                                target="_blank" class="btn btn-sm btn-success rounded-pill"><i
                                                    class="icon dripicons-print"></i></a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php $no++; ?>
                                <?php echo $__env->make('pengaju/data/detail', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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

<?php echo $__env->make('desa/layout/app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\web-surat\resources\views/pengaju/data/data.blade.php ENDPATH**/ ?>