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
			<div class="card-header">{{__('contract.contracts')}}
				<div class="card-header-actions">
					<a href="#" class="card-header-action btn-setting">
						<a  href="{{ url('/panel/contratos/create') }}"> <i class="icon-pencil"></i> {{__('contract.add')}}</a>
					</a>
				</div>
			</div>
			<div class="card-body">
			<table id="contract-table" class="table table-striped table-bordered table-hover dataTable no-footer">
				<thead class="thead-light">
					<tr>
						<th>{{__('contract.name')}}</th>
						<th>{{__('contract.name_gl')}}</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
				@foreach($contracts as $contract)
					<tr>
						<td>{{ $contract->nombre }}</td>
						<td>{{ $contract->nome }}</td>
						<td style="text-align:center; vertical-align:middle;">
							<a href='{{url('/panel/contratos/'.$contract->id.'/edit')}}' title='Edit' ><span class='glyphicon glyphicon-list'></span></a>
							<a id='remove_link' href='{{url('/panel/contratos/'.$contract->id.'/remove')}}' title='Delete' ><span class='glyphicon glyphicon-edit'></span></a>
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
