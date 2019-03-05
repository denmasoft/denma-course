@extends('layouts.app')

@section('titulo_pantalla')

@endsection

@section('content')
	<style>
		.tags{
			width: 100% !important;
		}
	</style>
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-ban"></i></h4>
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
    <div class="row">
	    <div class="col-md-12">
		    <div class="card">
				<div class="card-header">
					<i class="icon-note"></i> Nuevo Usuario
				</div>
				<div class="card-body">
					<div class="row">
							<form method="POST" novalidate action="{{url('/panel/usuarios')}}" accept-charset="UTF-8" class="form-horizontal" id="userForm">
								{{ csrf_field() }}
								<div class="col-sm-6">
								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Nombre </label>
									<div class="col-sm-6">
										<input type="text" name="name" id="name" placeholder="Nombre" class="col-xs-10 col-sm-5" />
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Apellidos </label>
									<div class="col-sm-6">
										<input type="text" name="last_name" id="last_name" placeholder="Apellidos" class="col-xs-10 col-sm-5" />
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> DNI/NIE </label>
									<div class="col-sm-6">
										<input type="text" name="dni" id="dni" placeholder="DNI/NIE" class="col-xs-10 col-sm-5" />
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right">Genero</label>
									<div class="col-sm-6">
	
										<div class="radio">
											<label>
												<input name="gender" type="radio" class="ace" value="Hombre" checked/>
												<span class="lbl"> Hombre</span>
											</label>
										</div>
	
										<div class="radio">
											<label>
												<input name="gender" type="radio" class="ace" value="Mujer" />
												<span class="lbl"> Mujer</span>
											</label>
										</div>
	
										<div class="radio">
											<label>
												<input name="gender" type="radio" class="ace" value="None" />
												<span class="lbl"> Prefiero no responder</span>
											</label>
										</div>
									</div>
								</div>

								<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right">Fecha de Nacimiento</label>
										<div class="col-sm-6">
												<div class="input-group">
														<input class="form-control date-picker" id="birth" name="birth" type="text" data-date-format="dd-mm-yyyy" />
														
													</div>	
										</div>
										
								</div>

								<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right">Provincia</label>
										<div class="col-sm-6">
												<div class="input-group">
														<select name="province" id="province">
                                                            @foreach($provinces as $province)
                                                                <option value="{{$province->pk}}">{{$province->name}}</option>
                                                            @endforeach
														</select>

													<input style="margin-top: 5px;display: none;" class="form-control" id="other_province" name="other_province" type="text" />
														
													</div>	
										</div>
										
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right">Ayuntamientos</label>
									<div class="col-sm-6">
										<div class="input-group">
											<select name="hall" id="hall" class="chosen-select" data-placeholder="Seleccione ayuntamiento..."></select>
											<input style="margin-top: 5px;display: none;" class="form-control" id="other_hall" name="other_hall" type="text" />
											</div>
									</div>
								</div>
								</div>

								<div class="col-sm-6">
										<div class="form-group">
												<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Direccion</label>
												<div class="col-sm-6">
													<input type="text" name="address" id="address" placeholder="Direccion" class="col-xs-10 col-sm-5" />
												</div>
											</div>
											<div class="form-group">
													<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Codigo Postal</label>
													<div class="col-sm-6">
														<input type="number" name="postal_code" id="postal_code" placeholder="Codigo Postal" class="col-xs-10 col-sm-5" />
													</div>
												</div>
												<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Telefono</label>
														<div class="col-sm-6">
															<input type="number" name="phone" id="phone" maxlength=9 placeholder="Telefono" class="col-xs-10 col-sm-5" />
														</div>
													</div>	
												<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Otro Telefono</label>
														<div class="col-sm-6">
															<input type="number" name="other_phone" id="other_phone" maxlength=9 placeholder="Otro Telefono" class="col-xs-10 col-sm-5" />
														</div>
													</div>
													<div class="form-group">
														<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Correo Electronico</label>
														<div class="col-sm-6">
															<input type="email" name="email" id="email" placeholder="Correo electronico" class="col-xs-10 col-sm-5" />
														</div>
													</div>
												<div class="form-group">
													<label class="col-sm-8 control-label no-padding-right">Discapacidad reconocida (igual o superior al 33%)</label>
												<div class="col-sm-1">									
				
													<div class="radio">
														<label>
															<input name="disability" type="radio" checked class="ace" />
															<span class="lbl"></span>
														</label>
													</div>
												</div>
											</div>
								</div>
								<div class="hr hr-16 hr-dotted"></div>
								<div class="col-sm-6">
										<div class="form-group">
												<label class="col-sm-3 control-label no-padding-right">Estudios Finalizados</label>
												<div class="col-sm-6">
														<div class="input-group">
																<select name="studies" id="studies">

																	@foreach($grades as $grade)
																		<option value="{{$grade->ID}}">{{$grade->description}}</option>
																	@endforeach
																</select>
															</div>
												</div>
												
										</div>
								</div>
								<div class="col-sm-6" id="specialtyC">
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right">Especialidad</label>
										<div class="col-sm-6">
											<div class="input-group">
												<select name="specialty" id="specialty"></select>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right">Otros Cursos:</label>
										<div class="col-sm-6">
											<div class="input-group">
												<textarea name="others_courses" id="others_courses"></textarea>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right">Puestos de Trabajo</label>
										<div class="col-sm-6">
											<div class="input-group">
												<select name="job_posts" id="job_posts">
													@foreach($jobPosts as $jobPost)
														<option value="{{$jobPost->id}}">{{$jobPost->nome}}</option>
													@endforeach
												</select>
												<input type="checkbox" id="no_experience" name="no_experience">NO tengo experiencia profesional
											</div>
										</div>

									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right">Idiomas</label>
										<div class="col-sm-6">
											<div class="input-group">
												<input type="text" name="languages" id="languages" placeholder="Ingles avanzado..." />
												<!--<select name="langs" id="langs">
													@foreach($langs as $lang)
														<option value="{{$lang->id}}">{{$lang->name}}</option>
													@endforeach
												</select>
												<select name="lang_level" id="lang_level" style="margin-top: 5px;">
													<option value="native">Nativo</option>
													<option value="fluid">Avanzado</option>
													<option value="intermediate">Intermedio</option>
													<option value="basic">Basico</option>
												</select>-->

											</div>
										</div>

									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right">Informatica</label>
										<div class="col-sm-6">
											<div class="input-group">
												<input type="text" name="computer_skills" id="computer_skills" placeholder="Microsoft Access avanzado..." />
												<!--<select name="computer" id="computer">
													<option value="access">Microsoft Access</option>
													<option value="excel">Microsoft Excel</option>
													<option value="word">Microsoft Word</option>
													<option value="powerpoint">Microsoft PowerPoint</option>
													<option value="photoshop">Microsoft PhotoShop</option>
													<option value="dreamweaver">Microsoft Dreamweaver</option>
													<option value="corel_draw">Corel Draw</option>
												</select>
												<select name="computer_level" id="computer_level" style="margin-top: 5px;">
													<option value="fluid">Avanzado</option>
													<option value="intermediate">Intermedio</option>
													<option value="basic">Basico</option>
												</select>-->
											</div>
										</div>

									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right">Permisos de Conducir</label>
										<div class="col-sm-6">
											<div class="input-group">
												<select class="chosen-select" name="driving_permit" id="driving_permit" multiple data-placeholder="Seleccione permisos de conducir...">
													@foreach($permits as $permit)
														<option value="{{$permit->id}}">{{$permit->description}}</option>
													@endforeach

												</select>
											</div>
										</div>

									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right">Intereses Profesionales</label>
										<div class="col-sm-6">
											<div class="input-group">
												<select class="chosen-select" name="sectors[]" id="sectors" multiple data-placeholder="Seleccione sectores...">
													@foreach($sectors as $sector)
														<option value="{{$sector->id}}">{{$sector->nome}}</option>
													@endforeach
												</select>
											</div>
										</div>

									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right">Puestos</label>
										<div class="col-sm-6">
											<div class="input-group">
												<select name="posts" id="posts">
													@foreach($jobPosts as $jobPost)
														<option value="{{$jobPost->id}}">{{$jobPost->nome}}</option>
													@endforeach
												</select>
											</div>
										</div>

									</div>
								</div>
                                <button type="submit" class="btn btn-success" name="Guardar">Guardar</button>
							</form>						
					</div>
				</div>
			</div>
	    </div>
    </div>
</div>
@endsection
