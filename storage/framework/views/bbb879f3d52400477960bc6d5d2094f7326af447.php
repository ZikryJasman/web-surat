

<?php $__env->startSection('title', 'Pilih Template Surat'); ?>

<?php $__env->startSection('content'); ?>
<?php $__currentLoopData = $surat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $srt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="page-heading">
	<div class="container">
		<div class="row">
			<h5>Template untuk : <?php echo e($srt->nama_surat); ?></h5>
		</div>
		<div class="row">
			<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<div class="col-xl-3 col-md-6 col-sm-12">
				<div class="card">
					<div class="card-content">
						<iframe src="<?php echo e(asset('template-surat')); ?>/<?php echo e($dt->gambar_template); ?>" class="card-img-top img-fluid"
							alt="singleminded"></iframe>
						</div>
						<ul class="list-group list-group-flush">
							<form method="post" action="<?php echo e(route('custom_template', $dt->id_template)); ?>">
								<?php echo csrf_field(); ?>
								<li class="list-group-item">
									<a target="_blank" href="<?php echo e(asset('template-surat')); ?>/<?php echo e($dt->gambar_template); ?>" class="btn btn-sm btn-primary rounded-pill">
										<i class="dripicons dripicons-preview"></i>
									</a>
									<?php if($srt->template_id==$dt->id_template): ?>
									<input style="float: right;border: 1px solid blue;" checked="" type="radio" class="form-check-input">
									<?php else: ?>
									<input style="float: right;border: 1px solid blue;" type="hidden" class="form-check-input" value="<?php echo e($srt->id_surat); ?>" name="id_surat">
									<button class="btn btn-sm btn-transparent show_confirm" title="Ubah Template">
										<input style="float: right;border: 1px solid blue;" type="radio" class="form-check-input">
									</button>
									<?php endif; ?>
								</li>
							</form>
						</ul>
					</div>
				</div>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</div>
		</div>
	</div>
	<script type="text/javascript">
  // function send() {
  	$('.show_confirm').click(function(event) {
  		var form =  $(this).closest("form");
  		event.preventDefault();
  		let timerInterval

  		Swal.fire({
  			type: 'success',
  			icon: 'success',
  			title: 'Berhasil Custom',
  			text: 'Anda berhasil mengubah Format Surat.',
  			showConfirmButton: false,
  			timer: 1500,
  		}).then((willDelete) => {
  			if (willDelete) {
  				form.submit();
  			}
  		})
  	});
  </script>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  <?php $__env->stopSection(); ?>
<?php echo $__env->make('desa/layout/app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\web-surat\resources\views/desa/template/pilih.blade.php ENDPATH**/ ?>