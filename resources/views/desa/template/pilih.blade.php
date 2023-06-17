@extends('desa/layout/app')

@section('title', 'Pilih Template Surat')

@section('content')
@foreach($surat as $srt)
<div class="page-heading">
	<div class="container">
		<div class="row">
			<h5>Template untuk : {{$srt->nama_surat}}</h5>
		</div>
		<div class="row">
			@foreach($data as $dt)
			<div class="col-xl-3 col-md-6 col-sm-12">
				<div class="card">
					<div class="card-content">
						<iframe src="{{asset('template-surat')}}/{{$dt->gambar_template}}" class="card-img-top img-fluid"
							alt="singleminded"></iframe>
						</div>
						<ul class="list-group list-group-flush">
							<form method="post" action="{{route('custom_template', $dt->id_template)}}">
								@csrf
								<li class="list-group-item">
									<a target="_blank" href="{{asset('template-surat')}}/{{$dt->gambar_template}}" class="btn btn-sm btn-primary rounded-pill">
										<i class="dripicons dripicons-preview"></i>
									</a>
									@if($srt->template_id==$dt->id_template)
									<input style="float: right;border: 1px solid blue;" checked="" type="radio" class="form-check-input">
									@else
									<input style="float: right;border: 1px solid blue;" type="hidden" class="form-check-input" value="{{$srt->id_surat}}" name="id_surat">
									<button class="btn btn-sm btn-transparent show_confirm" title="Ubah Template">
										<input style="float: right;border: 1px solid blue;" type="radio" class="form-check-input">
									</button>
									@endif
								</li>
							</form>
						</ul>
					</div>
				</div>
				@endforeach
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
  @endforeach
  @endsection