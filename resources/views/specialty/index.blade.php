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
			<div class="card-header">{{__('specialty.list')}}
				<div class="card-header-actions">
					<a href="#" class="card-header-action btn-setting">
						<a  href="{{ url('/panel/especialidades/create') }}"> <i class="icon-pencil"></i> {{__('specialty.add')}}</a>
					</a>
				</div>
			</div>
			<div class="card-body">
			<table id="specialty-table" class="table table-striped table-bordered table-hover dataTable no-footer">
				<thead class="thead-light">
					<tr>
						<th>{{__('specialty.description')}}</th>
						<th>{{__('specialty.grade')}}</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
				@foreach($specialties as $specialty)
					<tr>
						<td>{{ $specialty->description }}</td>
						<td>{{ $specialty->Study->description }}</td>
						<td style="text-align:center; vertical-align:middle;">
							<a href='{{url('/panel/especialidades/'.$specialty->ID.'/edit')}}' title='Edit' ><span class='glyphicon glyphicon-list'></span></a>
							<a id='remove_link' href='{{url('/panel/especialidades/'.$specialty->ID.'/remove')}}' title='Delete' ><span class='glyphicon glyphicon-edit'></span></a>
						</td>
					</tr>
				@endforeach	
				</tbody>
			</table>
			</div>
		</div>
	</div>
	<!-- /.col-->
</div>
<!-- /.row-->
@endsection
