@extends('layouts.app')

@section('titulo_pantalla')

@endsection

@section('content')
	@if ($errors->any())
		<div class="alert alert-danger alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<h4><i class="icon fa fa-ban"></i>{{__('sector.errors')}}</h4>
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
	<form style="padding: 30px;" id="sectorForm" method="POST" novalidate action="{{route('sectores.update', $sector->id) }}" accept-charset="UTF-8" class="form-horizontal">
			{{method_field('PATCH')}}
			{{ csrf_field() }}
		<div class="row">
				<div class="col-sm-3"></div>
				<div class="col-md-6">
						<div class="card">
							<div class="card-header">
								<div>
										{{__('sector.new_sector_label')}}
								</div>
							</div>
							<div class="card-body">
								<fieldset id="" role="group" aria-labelledby="__BVID__232__BV_label_" aria-describedby="__BVID__232__BV_description_" class="b-form-group form-group">
									<legend id="__BVID__232__BV_label_" class="col-form-label pt-0">{{__('sector.name')}}</legend>
									<div role="group" aria-labelledby="__BVID__232__BV_label_" class="">
										<div role="group" class="input-group">								
											<input type="text" class="form-control" name="name" required value="{{ strtoupper($sector->nombre) }}">
										</div>
									</div>
								</fieldset>
								<fieldset id="" role="group" aria-labelledby="__BVID__232__BV_label_" aria-describedby="__BVID__232__BV_description_" class="b-form-group form-group">
										<legend id="__BVID__232__BV_label_" class="col-form-label pt-0">{{__('sector.name_gl')}}</legend>
										<div role="group" aria-labelledby="__BVID__232__BV_label_" class="">
											<div role="group" class="input-group">								
												<input type="text" class="form-control" name="name_gl" required value="{{ strtoupper($sector->nombre) }}">
											</div>
										</div>
								</fieldset>					
							</div>
							
							<div class="col-md-12">
									<div class="form-group">
										<button type="submit" class="btn btn-primary custom-btn" name="signup" value="Sign up">{{__('sector.save')}}</button>
									</div>
							</div>
						</div>
					</div>
		</div>
	</form>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<i class="icon-note"></i>{{__('sector.edit_sector_label')}}
				</div>
				<div class="container">
					<div class="row">
						<div class="col-sm-3"></div>
						<form style="padding: 30px;" id="sectorForm" method="POST" novalidate action="{{route('sectores.update', $sector->id) }}" accept-charset="UTF-8" class="form-horizontal">
							{{method_field('PATCH')}}
							{{ csrf_field() }}
							<div class="col-md-6">
								<div class="form-group">
									<label>{{__('sector.name')}}</label>
									<input type="text" class="form-control" name="name" required value="{{ strtoupper($sector->nombre) }}">
								</div>
								<div class="form-group">
									<label>{{__('sector.name_gl')}}</label>
									<input type="text" class="form-control" name="name_gl" required value="{{ strtoupper($sector->nome) }}">
								</div>

							</div>

							<div class="col-md-12">
								<div class="form-group">
									<button type="submit" class="btn btn-primary" name="signup" value="Sign up">{{__('sector.save')}}</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
@endsection
