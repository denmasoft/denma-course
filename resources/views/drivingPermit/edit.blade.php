@extends('layouts.app')

@section('titulo_pantalla')

@endsection

@section('content')
	@if ($errors->any())
		<div class="alert alert-danger alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<h4><i class="icon fa fa-ban"></i>{{__('drivingPermit.errors')}}</h4>
			@foreach ($errors->all() as $error)
				<p>{{ $error }}</p>
			@endforeach
		</div>
	@endif

	@if(Session::has('alert-success'))
		<div class="alert alert-success alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<h4><i class="icon fa fa-check"></i> {{ Session::get('alert-success') }}</h4>
		</div>
	@endif
	<form style="padding: 30px;" id="puestoForm" method="POST" action="{{route('permisos-conducir.update', $drivingPermit->id) }}" accept-charset="UTF-8" class="form-group">
			{{method_field('PATCH')}}
			{{ csrf_field() }}
			<div class="row">
				<div class="col-md-3"></div>
				<div class="col-md-6">
						<div class="card">
							<div class="card-header">
								<div>
										{{__('drivingPermit.new_permit_label')}}
								</div>
							</div>
							<div class="card-body">
								<fieldset id="" role="group" aria-labelledby="__BVID__232__BV_label_" aria-describedby="__BVID__232__BV_description_" class="b-form-group form-group">
									<legend id="__BVID__232__BV_label_" class="col-form-label pt-0">{{__('drivingPermit.code')}}</legend>
									<div role="group" aria-labelledby="__BVID__232__BV_label_" class="">
										<div role="group" class="input-group">								
											<input type="text" class="form-control" name="code" required value="{{ strtoupper($drivingPermit->code) }}">
										</div>
									</div>
								</fieldset>
								<fieldset id="" role="group" aria-labelledby="__BVID__232__BV_label_" aria-describedby="__BVID__232__BV_description_" class="b-form-group form-group">
										<legend id="__BVID__232__BV_label_" class="col-form-label pt-0">{{__('drivingPermit.description')}}</legend>
										<div role="group" aria-labelledby="__BVID__232__BV_label_" class="">
											<div role="group" class="input-group">								
												<input type="text" class="form-control" name="description" required value="{{ strtoupper($drivingPermit->description) }}">
											</div>
										</div>
								</fieldset>					
							</div>
							
							<div class="col-md-12">
									<div class="form-group">
										<button type="submit" class="btn btn-primary custom-btn" name="signup" value="Sign up">{{__('drivingPermit.save')}}</button>
									</div>
							</div>
					</div>
				</div>
			</div>
	</form>
	</div>
@endsection
