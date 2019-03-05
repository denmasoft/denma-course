@extends('layouts.app')

@section('title_pestaña')
| Elegir Evento
@endsection

@section('titulo_pantalla')

@endsection

@section('content')
@if(Session::has('alert-success'))
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-check"></i> {{ Session::get('alert-success') }}</h4>
</div>
@endif
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
				<div class="toolbar">
					<div class="btn-group">
						<a class="btn btn-block btn-outline-primary" href="{{ url('/panel/ofertas/create') }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>{{__('offers.add')}}</a>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6 form-horizontal">
						<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> {{__('offers.requested_job')}}</label>
							<div class="col-sm-9">
								<input type="text" id="requested_job" placeholder="Requested Job" class="col-xs-10 col-sm-5">
							</div>

						</div>
						<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1">{{__('offers.vacancy')}}</label>
							<div class="col-sm-9">
								<input type="text" id="vacancy" placeholder="vacancy" class="col-xs-10 col-sm-5">
							</div>
						</div>
						<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1">{{__('offers.tasks')}}</label>
							<div class="col-sm-9">
								<input type="text" name="tasks" id="tasks" placeholder="Task" class="col-xs-10 col-sm-5" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="form-field-1">{{__('offers.contract_type')}}</label>
							<div class="col-sm-9">
								<select class="chosen-select" name="contract_type" id="contract_type" multiple="">
								<option value="">{{__('offers.choose')}}</option>
									@foreach($contracts as $contract)
										<option value="{{$contract->id}}">{{$contract->nome}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> {{__('offers.locality')}} </label>
							<div class="col-sm-9">
								<input type="text" name="locality" id="locality" placeholder="Contract Type" class="col-xs-10 col-sm-5" />
							</div>
						</div>
					</div>
					<div class="col-sm-6  form-horizontal">
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right">{{__('offers.due_date')}}</label>
							<div class="col-sm-9">
								<span class="input-icon">
									<input type="text" readonly id="due_date_min" placeholder="{{__('offers.from')}}"/>
								</span>

								<span class="input-icon input-icon-right">
									<input type="text" readonly id="due_date_max" placeholder="{{__('offers.to')}}"/>
								</span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right">{{__('offers.start_date')}}</label>
							<div class="col-sm-9">
								<span class="input-icon">
									<input type="text" readonly id="start_date_min" placeholder="{{__('offers.from')}}"/>
								</span>

								<span class="input-icon input-icon-right">
									<input type="text" readonly id="start_date_max"  placeholder="{{__('offers.to')}}"/>
								</span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right">{{__('offers.duration')}}</label>
							<div class="col-sm-9">
								<span class="input-icon">
									<input type="text" id="duration_min" placeholder="Min"/>
								</span>

								<span class="input-icon input-icon-right">
									<input type="text" id="duration_max"  placeholder="Max" />
								</span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right">{{__('offers.salary')}}</label>
							<div class="col-sm-9">
								<span class="input-icon">
									<input type="number" id="salary_min" placeholder="Min"/>
								</span>

								<span class="input-icon input-icon-right">
									<input type="number" id="salary_max"  placeholder="Max"/>
								</span>
							</div>
						</div>

					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<a id="offer-filter" class="btn btn-sm btn-success" style="float: right;margin-bottom: 15px;margin-top: 15px;">
							{{__('offers.filter')}}
						</a>
					</div>

				</div>
			<table id="offer-table" class="table table-striped table-bordered table-hover dataTable no-footer">
				<thead class="thead-light">
					<tr>
						<th>{{__('offers.requested_job')}}</th>
						<th>{{__('offers.vacancy')}}</th>
						<th>{{__('offers.tasks')}}</th>
						<th>{{__('offers.due_date')}}</th>
						<th>{{__('offers.contract_type')}}</th>
						<th>{{__('offers.start_date')}}</th>
						<th>{{__('offers.duration')}}</th>
						<th>{{__('offers.locality')}}</th>
						<th>{{__('offers.hours')}}</th>
						<th>{{__('offers.salary')}}</th>
						<th>{{__('offers.requirements')}}</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>

			</div>
		</div>
	</div>
	<!-- /.col-->
</div>
<!-- /.row-->
@endsection
