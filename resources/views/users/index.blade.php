@extends('layouts.app')

@section('title_pestaña')

@endsection

@section('titulo_pantalla')

@endsection
@section('breadcrumb')
<ol class="breadcrumb">
	<li class="breadcrumb-item">Home</li>
	<li class="breadcrumb-item active">{{__('users.list')}}</li>
	<!-- Breadcrumb Menu-->
  </ol>
@endsection
@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">{{__('users.list')}}</div>
			<div class="card-body">

			<div class="toolbar">
				<div class="btn-group">
					<a class="btn btn-block btn-outline-primary" href="usuarios/create"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>{{__('users.add')}}</a>
				</div>
			</div>
				<div class="row">
					<div class="col-sm-6 form-horizontal">
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> {{__('users.name')}} </label>
							<div class="col-sm-9">
								<input type="text" id="name" placeholder="{{__('users.name')}}" class="col-xs-10 col-sm-5">
							</div>

						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> {{__('users.last_name')}} </label>
							<div class="col-sm-9">
								<input type="text" id="surname" placeholder="{{__('users.last_name')}}" class="col-xs-10 col-sm-5">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> {{__('users.dni')}} </label>
							<div class="col-sm-9">
								<input type="text" name="dni" id="dni" placeholder="{{__('users.dni')}}" class="col-xs-10 col-sm-5" />
							</div>
						</div>


					</div>
					<div class="col-sm-6  form-horizontal">
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right">{{__('users.age')}}</label>
							<div class="col-sm-9">
								<span class="input-icon">
									<input type="text" id="min-age" placeholder="{{__('users.min_age')}}" />
								</span>

								<span class="input-icon input-icon-right">
									<input type="text" id="max-age" placeholder="{{__('users.max_age')}}" />
								</span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> {{__('users.email')}} </label>
							<div class="col-sm-9">
								<input type="text" name="email" id="email" placeholder="{{__('users.email')}}" class="col-xs-10 col-sm-5" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> {{__('users.phone')}} </label>
							<div class="col-sm-9">
								<input type="text" name="phone" id="phone" placeholder="{{__('users.phone')}}" class="col-xs-10 col-sm-5" />
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<a id="user-filter" class="btn btn-sm btn-success" style="float: right;margin-bottom: 15px;margin-top: 15px;">
							{{__('users.filter')}}
						</a>
					</div>
				</div>
			<table id="users-table" class="table table-striped table-bordered table-hover dataTable no-footer">
				<thead class="thead-light">
					<tr>
						<th>{{__('users.last_name')}}</th>
						<th>{{__('users.name')}}</th>
						<th>{{__('users.age')}}</th>
						<th>{{__('users.email')}}</th>
						<th>{{__('users.dni')}}</th>
						<th>{{__('users.phone')}}</th>
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
