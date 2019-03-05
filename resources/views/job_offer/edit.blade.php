@extends('layouts.app')

@section('titulo_pantalla')

@endsection

@section('content')
	@if ($errors->any())
		<div class="alert alert-danger alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<h4><i class="icon fa fa-ban"></i>{{__('offers.errors')}}</h4>
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
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<i class="icon-note"></i> {{__('offers.edit_offer_label')}}
				</div>
				<div class="container">
					<div class="row">

						<form style="padding: 30px;" id="offerForm" method="POST" novalidate action="{{route('ofertas.update', $job_offer->id) }}" accept-charset="UTF-8" class="form-horizontal">
							{{method_field('PATCH')}}
							{{ csrf_field() }}
							<div class="col-md-5">
								<div class="form-group">
									<label>{{__('offers.requested_job')}}</label>
									<input type="text" class="form-control" name="requested_job" required value="{{ strtoupper($job_offer->requested_job) }}">
								</div>
								<div class="form-group">
									<label>{{__('offers.vacancy')}}</label>
									<input type="number" class="form-control" name="vacancy" required value="{{ strtoupper($job_offer->vacancy) }}">
								</div>
								<div class="form-group">
									<label>{{__('offers.tasks')}}</label>
									<textarea class="form-control" name="tasks" required>
										{{ strtoupper($job_offer->tasks) }}
									</textarea>
								</div>

								<div class="form-group">
									<label>{{__('offers.due_date')}}</label>
									<input type="text" readonly class="form-control" id="due_date" name="due_date" required value="{{ strtoupper($job_offer->getDueDate()) }}">
								</div>
								<div class="form-group">
									<label>{{__('offers.contract_type')}}</label>
									<select name="contract_type" id="contract_type" required>
									<option value="">{{__('choose')}}</option>
										@foreach($contracts as $contract)
											<option value="{{$contract->id}}">{{$contract->nome}}</option>
										@endforeach
									</select>
								</div>

							</div>
							<div class="col-md-5">
								<div class="form-group">
									<label>{{__('offers.start_date')}}</label>
									<input type="text" readonly class="form-control" id="start_date" name="start_date" required value="{{ strtoupper($job_offer->getStartdate()) }}">
								</div>

								<div class="form-group">
									<label>{{__('offers.duration')}}</label>
									<input type="number" class="form-control" name="duration" required value="{{ strtoupper($job_offer->duration) }}">
								</div>
								<div class="form-group">
									<label>{{__('offers.locality')}}</label>
									<input type="text" class="form-control" name="locality" required value="{{ strtoupper($job_offer->locality) }}">
								</div>
								<div class="form-group">
									<label>{{__('offers.hours')}}</label>
									<input type="text" class="form-control" name="hours" required value="{{ strtoupper($job_offer->hours) }}">
								</div>
								<div class="form-group">
									<label>{{__('offers.salary')}}</label>
									<input type="number" class="form-control" name="salary" value="{{ strtoupper($job_offer->salary) }}">
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label>{{__('offers.requirements')}}</label>
									<div class="checkbox" style="width: 150px">
										<label>
											<input name="requirements[]" <?php echo $training?'checked':''?> type="checkbox" value="training" class="ace ace-checkbox-2" />
											<span class="lbl"> {{__('offers.training')}}</span>
										</label>
									</div>
									<div class="checkbox" style="width: 150px">
										<label>
											<input name="requirements[]" <?php echo $experience?'checked':''?>  class="ace ace-checkbox-2" value="experience" type="checkbox" />
											<span class="lbl">{{__('offers.experience')}}</span>
										</label>
									</div>
									<div class="checkbox" style="width: 150px">
										<label>
											<input id="others_check" <?php echo $others?'checked':''?> value="" name="requirements[]" class="ace ace-checkbox-2" type="checkbox" />
											<span class="lbl">{{__('offers.others')}}</span>
										</label>
									</div>
								</div>
								<div id="other_requirements_container" data-others="{{$others}}" style="display: <?php echo $others?'block':'none' ?>" class="form-group" style="width: 300px">

									<textarea class="form-control" name="requirements[]" style="height: 110px">
										{{$others_text}}
									</textarea>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<button type="submit" class="btn btn-primary" name="job_offer" value="Job offer">{{__('offers.save')}}</button>
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