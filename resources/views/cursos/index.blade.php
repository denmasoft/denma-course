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
			<div class="card-header">Cursos de formacion
				<div class="card-header-actions">
					<a href="#" class="card-header-action btn-setting">
						<a  href="{{ url('/panel/cursos/create') }}"> <i class="icon-pencil"></i> Nuevo</a>
					</a>
				</div>
			</div>
			<div class="card-body">
			@if($cursos->count())
			<form action="/panel/cursos/busquedaAvanzada" method="POST" class="form-horizontal">
				{{ csrf_field() }}
				<div class="form-group row">
					<div class="col-md-2">
						<div class="form-group">
							<label>Nombre</label>
							<input type="text" class="form-control" value="{{ old('nombre') }}" name="nombre">
						</div>						
					</div>
					<div class="col-md-2">	
						<div class="form-group">
							<label>Ubicacion</label>
							<input type="text" class="form-control" name="ubicacion">
						</div>	
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<label>Plazas total:</label>
							<input type="text" class="form-control" name="plazas" placeholder="Mayor a ..">
						</div>					
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<label>Edad Minima:</label>
							<input type="text" class="form-control" name="edades_recomendadas" placeholder="Mayor a ..">
						</div>					
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<label>Dispnobilidad:</label><br>
							<label class="switch switch-label switch-outline-danger">
								<input type="checkbox" name="plazas_disponibles" value="true" class="switch-input">
								<span class="switch-slider" data-checked="✓" data-unchecked="✕"></span>									
							</label>
						</div>	
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<label style="visibility:hidden;">..</label><br>
							<button type="submit" class="btn btn-primary" value="Sign up">Filtrar</button>
						</div>	
						
					</div>
				</div>
			</form>
			<table class="table table-responsive-sm table-hover table-outline mb-0">
				<thead class="thead-light">
					<tr>
						<th>Descripccion</th>
						<th>Duracion</th>
						<th class="text-center">Plazas</th>
						<th>Disponibilidad</th>
						<th>Edades Recomendadas</th>							
						<th></th>
					</tr>
				</thead>
				<tbody>
				@foreach($cursos as $curso)
					<tr>
						<td><b>{{ $curso->nombre }}</b><br>
						{{ $curso->lugar_celebracion }}</td>
						<td>{{ $curso->duracion_horas }} Horas</td>
						<td>{{ $curso->plazas_total }}</td>
						<td>{{ $curso->plazas_disponibles }} Cupos</td>
						<td>{{ $curso->edades_recomendadas }}</td>
						<td style="text-align:center; vertical-align:middle;">							
							<a type="button" href="{{ url('/panel/cursos/'.$curso->id) }}" class="btn btn-block btn-outline-primary active" aria-pressed="true"><i class="fa fa-eye" aria-hidden="true"></i></a>	  
							<a type="button" href="{{ url('/panel/cursos/'.$curso->id.'/edit') }}" class="btn btn-block btn-outline-primary active" aria-pressed="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>	  
							<a type="button" href="{{ url('/panel/cursos/'.$curso->id.'/inscripcion') }}" class="btn btn-block btn-outline-primary active" aria-pressed="true">Inscribirme</a>							
						</td>
					</tr>
				@endforeach	
				</tbody>
			</table>
			@else
			   <p style="text-align:center;">{{ $mensaje_empty }}</p>
			@endif
			</div>
		</div>
	</div>
	<!-- /.col-->
</div>
<!-- /.row-->
@endsection
