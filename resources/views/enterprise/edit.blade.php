@extends('layouts.app')

@section('titulo_pantalla')

@endsection

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-ban"></i>Precauccion</h4>
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
	<form style="padding: 30px;" id="enterpriseForm" method="POST" enctype="multipart/form-data" action="{{route('empresas.update', $enterprise->id) }}" accept-charset="UTF-8" class="form-horizontal">
		{{method_field('PATCH')}}
		{{ csrf_field() }}
		<div class="row">
				<div class="col-md-6">
						<div class="card">
							<div class="card-header">
								<div>
									
								</div>
							</div>
							<div class="card-body">
								<fieldset id="" role="group" aria-labelledby="__BVID__232__BV_label_" aria-describedby="__BVID__232__BV_description_" class="b-form-group form-group">
									<legend id="__BVID__232__BV_label_" class="col-form-label pt-0">Nombre comercial</legend>
									<div role="group" aria-labelledby="__BVID__232__BV_label_" class="">
										<div role="group" class="input-group">								
											<input type="text" class="form-control" name="name" required value="{{ strtoupper($enterprise->name) }}">
										</div>
									</div>
								</fieldset>
								<fieldset id="" role="group" aria-labelledby="__BVID__232__BV_label_" aria-describedby="__BVID__232__BV_description_" class="b-form-group form-group">
										<legend id="__BVID__232__BV_label_" class="col-form-label pt-0">Denominación social</legend>
										<div role="group" aria-labelledby="__BVID__232__BV_label_" class="">
											<div role="group" class="input-group">								
												<input type="text" class="form-control" name="social" required value="{{ strtoupper($enterprise->social) }}">
											</div>
										</div>
								</fieldset>					
								<fieldset id="" role="group" aria-labelledby="__BVID__232__BV_label_" aria-describedby="__BVID__232__BV_description_" class="b-form-group form-group">
										<legend id="__BVID__232__BV_label_" class="col-form-label pt-0">NIF/CIF</legend>
										<div role="group" aria-labelledby="__BVID__232__BV_label_" class="">
											<div role="group" class="input-group">								
												<input type="text" class="form-control" name="nif" required value="{{ strtoupper($enterprise->nif) }}">
											</div>
										</div>
								</fieldset>
								<fieldset id="" role="group" aria-labelledby="__BVID__232__BV_label_" aria-describedby="__BVID__232__BV_description_" class="b-form-group form-group">
										<legend id="__BVID__232__BV_label_" class="col-form-label pt-0">Telefono</legend>
										<div role="group" aria-labelledby="__BVID__232__BV_label_" class="">
											<div role="group" class="input-group">								
												<input type="text" class="form-control" name="phone" required value="{{ strtoupper($enterprise->phone) }}">
											</div>
										</div>
								</fieldset>					
							</div>
						</div>
					</div>
					<div class="col-md-6">
							<div class="card">
								<div class="card-header">
									<div>
										
									</div>
								</div>
								<div class="card-body">
									<fieldset id="" role="group" aria-labelledby="__BVID__232__BV_label_" aria-describedby="__BVID__232__BV_description_" class="b-form-group form-group">
										<legend id="__BVID__232__BV_label_" class="col-form-label pt-0">Correo Electronico</legend>
										<div role="group" aria-labelledby="__BVID__232__BV_label_" class="">
											<div role="group" class="input-group">								
												<input type="email" class="form-control" name="email" required value="{{ strtoupper($enterprise->email) }}">
											</div>
										</div>
									</fieldset>
									<fieldset id="" role="group" aria-labelledby="__BVID__232__BV_label_" aria-describedby="__BVID__232__BV_description_" class="b-form-group form-group">
											<legend id="__BVID__232__BV_label_" class="col-form-label pt-0">Persona de Contacto</legend>
											<div role="group" aria-labelledby="__BVID__232__BV_label_" class="">
												<div role="group" class="input-group">								
													<input type="text" class="form-control" name="contact" required value="{{ strtoupper($enterprise->contact) }}">
												</div>
											</div>
									</fieldset>					
									<fieldset id="" role="group" aria-labelledby="__BVID__232__BV_label_" aria-describedby="__BVID__232__BV_description_" class="b-form-group form-group">
											<legend id="__BVID__232__BV_label_" class="col-form-label pt-0">Cargo en la Empresa</legend>
											<div role="group" aria-labelledby="__BVID__232__BV_label_" class="">
												<div role="group" class="input-group">								
													<input type="text" class="form-control" name="position" required value="{{ strtoupper($enterprise->position) }}">
												</div>
											</div>
									</fieldset>
									<fieldset id="" role="group" aria-labelledby="__BVID__232__BV_label_" aria-describedby="__BVID__232__BV_description_" class="b-form-group form-group">
											
											<div class="form-group" style="margin-top: 15px;">
													<div class="col-sm-3">
														<span>Aprobada</span>
													</div>
													<div class="col-sm-6">
														<label>
															<input name="approval" value="true" class="ace ace-switch" type="checkbox" />
															<span class="lbl" data-lbl="Si&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No"></span>
														</label>
													</div>
				
												</div>
									</fieldset>					
								</div>
							</div>
					</div>
					<div class="col-md-12">
							<div class="form-group">
								<button type="submit" class="btn btn-primary custom-btn" name="signup" value="Sign up">Guardar</button>
							</div>
						</div>
		</div>
	</form>
</div>
@endsection
