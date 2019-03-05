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
	<form style="padding: 30px;" id="enterpriseForm" method="POST" enctype="multipart/form-data" action="{{route('boletin-ofertas.update', $newsletter->id) }}" accept-charset="UTF-8" class="form-horizontal">
		{{method_field('PATCH')}}
		{{ csrf_field() }}
		<div class="row">
				<div class="col-md-6">
						<div class="card">
							<div class="card-header">
								<div>
										{{__('newsletter.edit_newsletter_label')}}
								</div>
							</div>
							<div class="card-body">
								<fieldset id="" role="group" aria-labelledby="__BVID__232__BV_label_" aria-describedby="__BVID__232__BV_description_" class="b-form-group form-group">
									<legend id="__BVID__232__BV_label_" class="col-form-label pt-0">{{__('newsletter.job_name')}}</legend>
									<div role="group" aria-labelledby="__BVID__232__BV_label_" class="">
										<div role="group" class="input-group">								
												<input type="text" class="form-control" name="name" required value="{{$newsletter->name}}">
										</div>
									</div>
								</fieldset>
								<fieldset id="" role="group" aria-labelledby="__BVID__232__BV_label_" aria-describedby="__BVID__232__BV_description_" class="b-form-group form-group">
										<legend id="__BVID__232__BV_label_" class="col-form-label pt-0">{{__('newsletter.publishedAt')}}</legend>
										<div role="group" aria-labelledby="__BVID__232__BV_label_" class="">
											<div role="group" class="input-group">								
													<input type="text" readonly class="form-control" name="publishedAt" id="publishedAt" required value="{{$newsletter->getPublishedAt()}}">
											</div>
										</div>
								</fieldset>
								<fieldset id="" role="group" aria-labelledby="__BVID__232__BV_label_" aria-describedby="__BVID__232__BV_description_" class="b-form-group form-group">
										<legend id="__BVID__232__BV_label_" class="col-form-label pt-0">{{__('newsletter.publishedIn')}}</legend>
										<div role="group" aria-labelledby="__BVID__232__BV_label_" class="">
											<div role="group" class="input-group">								
													<input type="text" class="form-control" name="publishedIn" id="publishedIn" required value="{{$newsletter->publishedIn}}">
											</div>
										</div>
								</fieldset>	
								<fieldset id="" role="group" aria-labelledby="__BVID__232__BV_label_" aria-describedby="__BVID__232__BV_description_" class="b-form-group form-group">
										<legend id="__BVID__232__BV_label_" class="col-form-label pt-0">{{__('newsletter.locality')}}</legend>
										<div role="group" aria-labelledby="__BVID__232__BV_label_" class="">
											<div role="group" class="input-group">								
													<input type="text" class="form-control" name="locality" id="locality" required value="{{$newsletter->locality}}">
											</div>
										</div>
								</fieldset>
								<fieldset id="" role="group" aria-labelledby="__BVID__232__BV_label_" aria-describedby="__BVID__232__BV_description_" class="b-form-group form-group">
										<legend id="__BVID__232__BV_label_" class="col-form-label pt-0">{{__('newsletter.contract_type')}}</legend>
										<div class="form-group">											
												<select name="contract_type" id="contract_type" required>
												<option value="">{{__('newsletter.choose')}}</option>
													@foreach($contracts as $contract)
														<option value="{{$contract->id}}">{{$contract->nome}}</option>
													@endforeach
												</select>
											</div>
								</fieldset>
								<fieldset id="" role="group" aria-labelledby="__BVID__232__BV_label_" aria-describedby="__BVID__232__BV_description_" class="b-form-group form-group">
										<legend id="__BVID__232__BV_label_" class="col-form-label pt-0">{{__('newsletter.contact')}}</legend>
										<div role="group" aria-labelledby="__BVID__232__BV_label_" class="">
											<div role="group" class="input-group">								
													<input type="text" class="form-control" name="contact" id="contact" required value="{{$newsletter->contact}}">
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
										{{__('newsletter.edit_newsletter_label')}}
								</div>
							</div>
							<div class="card-body">
								<fieldset id="" role="group" aria-labelledby="__BVID__232__BV_label_" aria-describedby="__BVID__232__BV_description_" class="b-form-group form-group">
									<legend id="__BVID__232__BV_label_" class="col-form-label pt-0">{{__('newsletter.description')}}</legend>
									<div role="group" aria-labelledby="__BVID__232__BV_label_" class="">
										<div role="group" class="input-group">								
												<textarea name="description" id="description" cols="30" rows="10">
														{{$newsletter->description}}
												</textarea>
										</div>
									</div>
								</fieldset>			
								<fieldset id="" role="group" aria-labelledby="__BVID__232__BV_label_" aria-describedby="__BVID__232__BV_description_" class="b-form-group form-group">
										<legend id="__BVID__232__BV_label_" class="col-form-label pt-0">{{__('newsletter.requirements')}}</legend>
										<div role="group" aria-labelledby="__BVID__232__BV_label_" class="">
											<div role="group" class="input-group">								
													<textarea name="requirements" id="requirements" cols="30" rows="10">
															{{$newsletter->requirements}}
													</textarea>
											</div>
										</div>
									</fieldset>			
							</div>
					</div>
			</div>
			<div class="col-md-12">
					<div class="form-group">
						<button type="submit" class="btn btn-primary custom-btn" name="signup" value="Sign up">{{__('sector.save')}}</button>
					</div>
			</div>
		</div>
	</form>
    
</div>
@endsection
