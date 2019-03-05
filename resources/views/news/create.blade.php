@extends('layouts.app')

@section('titulo_pantalla')

@endsection

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-ban"></i>{{__('news.errors')}}</h4>
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
	<form style="padding: 30px;" id="newsForm" method="POST" novalidate action="{{url('/panel/noticias')}}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data>
		{{ csrf_field() }}
		<div class="row">
			<div class="col-md-3"></div>
				<div class="col-md-6">
					<div class="card">
						<div class="card-header">
							<div>
									{{__('news.new_news_label')}}
							</div>
						</div>
						<div class="card-body">
							<fieldset id="" role="group" aria-labelledby="__BVID__232__BV_label_" aria-describedby="__BVID__232__BV_description_" class="b-form-group form-group">
								<legend id="__BVID__232__BV_label_" class="col-form-label pt-0">{{__('news.title')}}</legend>
								<div role="group" aria-labelledby="__BVID__232__BV_label_" class="">
									<div role="group" class="input-group">								
										<input type="text" class="form-control" name="titulo" required>
									</div>
								</div>
							</fieldset>
							<fieldset id="" role="group" aria-labelledby="__BVID__232__BV_label_" aria-describedby="__BVID__232__BV_description_" class="b-form-group form-group">
									<legend id="__BVID__232__BV_label_" class="col-form-label pt-0">{{__('news.before_title')}}</legend>
									<div role="group" aria-labelledby="__BVID__232__BV_label_" class="">
										<div role="group" class="input-group">								
											<input type="text" class="form-control" name="antetitulo" required>
										</div>
									</div>
							</fieldset>

							<fieldset id="" role="group" aria-labelledby="__BVID__232__BV_label_" aria-describedby="__BVID__232__BV_description_" class="b-form-group form-group">
								<legend id="__BVID__232__BV_label_" class="col-form-label pt-0">{{__('news.entry')}}</legend>
								<div role="group" aria-labelledby="__BVID__232__BV_label_" class="">
									<div role="group" class="input-group">
										<textarea class="form-control" name="entradilla" required></textarea>
									</div>
								</div>
							</fieldset>
							<fieldset id="" role="group" aria-labelledby="__BVID__232__BV_label_" aria-describedby="__BVID__232__BV_description_" class="b-form-group form-group">
								<legend id="__BVID__232__BV_label_" class="col-form-label pt-0">{{__('news.body')}}</legend>
								<div role="group" aria-labelledby="__BVID__232__BV_label_" class="">
									<div role="group" class="input-group">
										<textarea class="form-control" name="noticia" required></textarea>
									</div>
								</div>
							</fieldset>

							<fieldset id="" role="group" aria-labelledby="__BVID__232__BV_label_" aria-describedby="__BVID__232__BV_description_" class="b-form-group form-group">
								<legend id="__BVID__232__BV_label_" class="col-form-label pt-0">{{__('news.publishedAt')}}</legend>
								<div role="group" aria-labelledby="__BVID__232__BV_label_" class="">
									<div role="group" class="input-group">
										<span class="input-group-prepend">
										<span class="input-group-text">
											<i class="fa fa-calendar"></i>
										</span>
										</span>
										<input type="text" id="fecha_publicacion" name="fecha_publicacion" value="" class="form-control">
									</div>
								</div>
							</fieldset>

							<fieldset id="" role="group" aria-labelledby="__BVID__232__BV_label_" aria-describedby="__BVID__232__BV_description_" class="b-form-group form-group">
								<legend id="__BVID__232__BV_label_" class="col-form-label pt-0">{{__('news.expiredAt')}}</legend>
								<div role="group" aria-labelledby="__BVID__232__BV_label_" class="">
									<div role="group" class="input-group">
										<span class="input-group-prepend">
										<span class="input-group-text">
											<i class="fa fa-calendar"></i>
										</span>
										</span>
										<input type="text" id="fecha_expiracion" name="fecha_expiracion" value="" class="form-control">
									</div>
								</div>
							</fieldset>
							<fieldset id="" role="group" aria-labelledby="__BVID__232__BV_label_" aria-describedby="__BVID__232__BV_description_" class="b-form-group form-group">
								<legend id="__BVID__232__BV_label_" class="col-form-label pt-0">{{__('news.outstanding_image')}}</legend>
								<div role="group" aria-labelledby="__BVID__232__BV_label_" class="">
									<div role="group" class="input-group">
										<input type="file" class="form-control" name="imagen_destacada" required>
									</div>
								</div>
							</fieldset>
							<fieldset id="" role="group" aria-labelledby="__BVID__232__BV_label_" aria-describedby="__BVID__232__BV_description_" class="b-form-group form-group">
								<legend id="__BVID__232__BV_label_" class="col-form-label pt-0">{{__('news.image_1')}}</legend>
								<div role="group" aria-labelledby="__BVID__232__BV_label_" class="">
									<div role="group" class="input-group">
										<input type="file" class="form-control" name="imagen_1" required>
									</div>
								</div>
							</fieldset>
							<fieldset id="" role="group" aria-labelledby="__BVID__232__BV_label_" aria-describedby="__BVID__232__BV_description_" class="b-form-group form-group">
								<legend id="__BVID__232__BV_label_" class="col-form-label pt-0">{{__('news.image_2')}}</legend>
								<div role="group" aria-labelledby="__BVID__232__BV_label_" class="">
									<div role="group" class="input-group">
										<input type="file" class="form-control" name="imagen_2" required>
									</div>
								</div>
							</fieldset>
						</div>

						<div class="col-md-12">
								<div class="form-group">
									<button type="submit" class="btn btn-primary custom-btn" name="signup" value="Sign up">{{__('news.save')}}</button>
								</div>
						</div>
				</div>
			</div>
		</div>
	</form>
</div>
@endsection
