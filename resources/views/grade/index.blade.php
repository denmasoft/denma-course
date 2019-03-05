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
			<div class="card-header">{{__('grade.list')}}
				<div class="card-header-actions">
					<a href="#" class="card-header-action btn-setting">
						<a  href="{{ url('/panel/estudios/create') }}"> <i class="icon-pencil"></i> {{__('grade.add')}}</a>
					</a>
				</div>
			</div>
			<div class="card-body">
			<table id="grade-table" class="table table-striped table-bordered table-hover dataTable no-footer">
				<thead class="thead-light">
					<tr>
						<th>{{__('grade.description')}}</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
				@foreach($estudios as $estudio)
					<tr>
						<td>{{ $estudio->description }}</td>
						<td style="text-align:center; vertical-align:middle;">
							<a href='{{url('/panel/estudios/'.$estudio->ID.'/edit')}}' title='Edit' ><span class='glyphicon glyphicon-list'></span></a>
							<a id='remove_link' href='{{url('/panel/estudios/'.$estudio->ID.'/remove')}}' title='Delete' ><span class='glyphicon glyphicon-edit'></span></a>
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
