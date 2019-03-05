@extends('layouts.app')

@section('titulo_pantalla')

@endsection

@section('content')
	@if ($errors->any())
		<div class="alert alert-danger alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<h4><i class="icon fa fa-ban"></i>{{__('grade.errors')}}</h4>
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
	<form style="padding: 30px;" id="gradeForm" method="POST" action="{{route('estudios.update', $grade->ID) }}" accept-charset="UTF-8" class="form-group">
			{{method_field('PATCH')}}
			{{ csrf_field() }}
			<div class="row">
				<div class="col-md-3"></div>
				<div class="col-md-6">
						<div class="card">
							<div class="card-header">
								<div>
										{{__('grade.new_grade_label')}}
								</div>
							</div>
							<div class="card-body">
								<fieldset id="" role="group" aria-labelledby="__BVID__232__BV_label_" aria-describedby="__BVID__232__BV_description_" class="b-form-group form-group">
									<legend id="__BVID__232__BV_label_" class="col-form-label pt-0">{{__('contract.name')}}</legend>
									<div role="group" aria-labelledby="__BVID__232__BV_label_" class="">
										<div role="group" class="input-group">								
											<input type="text" class="form-control" name="description" required value="{{ strtoupper($grade->description) }}">
										</div>
									</div>
								</fieldset>
							</div>
							
							<div class="col-md-12">
									<div class="form-group">
										<button type="submit" class="btn btn-primary custom-btn" name="signup" value="Sign up">{{__('grade.save')}}</button>
									</div>
							</div>
					</div>
				</div>
			</div>
	</form>
	</div>
@endsection
