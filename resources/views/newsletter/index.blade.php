@extends('layouts.app')

@section('title_pestaña')

@endsection

@section('titulo_pantalla')

@endsection
@section('breadcrumb')
	<ol class="breadcrumb">
		<li class="breadcrumb-item">Home</li>
		<li class="breadcrumb-item active">Boletin de Ofertas</li>
		<!-- Breadcrumb Menu-->
	</ol>
@endsection
@section('content')
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">Boletines de Ofertas</div>
				<div class="card-body">

					<div class="toolbar">
						<div class="btn-group">
							<a class="btn btn-block btn-outline-primary" href="boletin-ofertas/create"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Nuevo</a>
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
								<label class="col-sm-3 control-label no-padding-right">Published At</label>
								<div class="col-sm-9">
								<span class="input-icon">
									<input type="text" readonly id="publishedAt_min" placeholder="Desde"/>
								</span>

									<span class="input-icon input-icon-right">
									<input type="text" readonly id="publishedAt_max" placeholder="Hasta" />
								</span>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Published In</label>
								<div class="col-sm-9">
									<input type="text" name="publishedIn" id="publishedIn" placeholder="Published In" class="col-xs-10 col-sm-5" />
								</div>
							</div>
						</div>
						<div class="col-sm-6  form-horizontal">
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Description </label>
								<div class="col-sm-9">
									<input type="text" name="description" id="description" placeholder="Description" class="col-xs-10 col-sm-5" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Requirements </label>
								<div class="col-sm-9">
									<input type="text" name="requirements" id="requirements" placeholder="Requirements" class="col-xs-10 col-sm-5" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Contract Type </label>
								<div class="col-sm-9">
									<select class="chosen-select" name="contract_type" id="contract_type" multiple="">
										<option value="">Choose contract type...</option>
										@foreach($contracts as $contract)
											<option value="{{$contract->id}}">{{$contract->nome}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Contact</label>
								<div class="col-sm-9">
									<input type="text" name="contact" id="contact" placeholder="Contact" class="col-xs-10 col-sm-5" />
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<a id="newsletter-filter" class="btn btn-sm btn-success" style="float: right;margin-bottom: 15px;margin-top: 15px;">
								Filter
							</a>
						</div>

					</div>
					<table id="newsletter-table" class="table table-striped table-bordered table-hover dataTable no-footer">
						<thead class="thead-light">
						<tr>
							<th>Nombre de puesto</th>
							<th>Fecha de publicacion</th>
							<th>Publicado en</th>
							<th>Localidad</th>
							<th>Descripcion</th>
							<th>Requisitos</th>
							<th>Tipo de Contrato</th>
							<th>Contacto</th>
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
