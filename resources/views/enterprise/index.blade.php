@extends('layouts.app')

@section('title_pestaña')

@endsection

@section('titulo_pantalla')

@endsection
@section('breadcrumb')
	<ol class="breadcrumb">
		<li class="breadcrumb-item">Home</li>
		<li class="breadcrumb-item active">Empresas</li>
		<!-- Breadcrumb Menu-->
	</ol>
@endsection
@section('content')
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">Empresas</div>
				<div class="card-body">

					<div class="toolbar">
						<div class="btn-group">
							<a class="btn btn-block btn-outline-primary" href="empresas/create"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Nuevo</a>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6 form-horizontal">
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Name </label>
								<div class="col-sm-9">
									<input type="text" id="name" placeholder="Name" class="col-xs-10 col-sm-5">
								</div>

							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Social </label>
								<div class="col-sm-9">
									<input type="text" id="social" placeholder="social" class="col-xs-10 col-sm-5">
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> DNI/NIE </label>
								<div class="col-sm-9">
									<input type="text" name="dni" id="dni" placeholder="DNI/NIE" class="col-xs-10 col-sm-5" />
								</div>
							</div>
						</div>
						<div class="col-sm-6  form-horizontal">
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Contact </label>
								<div class="col-sm-9">
									<input type="text" name="contact" id="contact" placeholder="Contact" class="col-xs-10 col-sm-5" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Email </label>
								<div class="col-sm-9">
									<input type="text" name="email" id="email" placeholder="Email" class="col-xs-10 col-sm-5" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Telephone </label>
								<div class="col-sm-9">
									<input type="text" name="phone" id="phone" placeholder="Telephone" class="col-xs-10 col-sm-5" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Position</label>
								<div class="col-sm-9">
									<input type="text" name="position" id="position" placeholder="Position" class="col-xs-10 col-sm-5" />
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<a id="user-filter" class="btn btn-sm btn-success" style="float: right;margin-bottom: 15px;margin-top: 15px;">
								Filter
							</a>
						</div>

					</div>
					<table id="enterprise-table" class="table table-striped table-bordered table-hover dataTable no-footer">
						<thead class="thead-light">
						<tr>
							<th>Nombre comercial</th>
							<th>Denominación social</th>
							<th>NIF/CIF</th>
							<th>Persona de contacto</th>
							<th>Cargo en la empresa</th>
							<th>Teléfono</th>
							<th>Correo electrónico</th>
							<th>Empresa aprobada</th>
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
