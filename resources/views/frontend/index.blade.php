@extends('layouts.frontend')
@section('content')
    <!-- Three columns of text below the carousel -->
    <div class="row">
        <div class="col-lg-4">
            <hr class="featurette-divider emprego-divider">
            <h4 class="content-h4"><strong>OFERTAS</strong> DE EMPREGO</h4>
            <div class="oferta-emprego">
                <span>7 de setembro de 2018</span>
                <span>OFERTA DO FIE</span>
                <p class="oferta-desc">Técnico de mantemento con experiencia (reparación de maquinaria industrial)</p>
                <p class="oferta-location">Santiago de Compostela </p>
            </div>

            <div class="oferta-emprego">
                <span>31 de agosto de 2018</span>
                <span>OFERTA DESTACADA</span>
                <p class="oferta-desc">Cociñeiro/a con ampla experiencia</p>
                <p class="oferta-location">Vedra </p>
            </div>
            <div class="oferta-emprego">
                <span>25 de agosto de 2018</span>

                <p class="oferta-desc">Creador de contidos dixitais en Administración</p>
                <p class="oferta-location">Brión </p>
            </div>
            <div class="oferta-emprego">
                <span>31 de agosto de 2018</span>
                <span>OFERTA DESTACADA</span>
                <p class="oferta-desc">Creador de contidos dixitais en Administración</p>
                <p class="oferta-location">Brión </p>
            </div>
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
            <hr class="featurette-divider formacion-divider">
            <h4 class="content-h4">FORMACIÓN</h4>

            <div class="oferta-formacion">
                <span>9 de setembro de 2018</span>
                <span>CURSO DO FIE</span>
                <p class="formacion-desc">Informática Básica para a Busca de Emprego e Inmersión Língüística</p>
                <p class="formacion-location">Aríns </p>
            </div>

            <div class="oferta-formacion">
                <span>2 de setembro de 2018</span>
                <span>CONFERENCIA</span>
                <p class="formacion-desc">Eficiencia no uso da auga en edificios, viabilidade de instalacións solares e promoción do uso eficiente da enerxía</p>
                <p class="formacion-location">Vedra </p>
            </div>

            <div class="oferta-formacion">
                <span>2 de setembro de 2018</span>

                <p class="formacion-desc">Informática Básica para a Busca de Emprego e Inmersión Língüística</p>
                <p class="formacion-location">Santiago de Compostela </p>
            </div>

        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
            <div class="boletin-tag">
                <span>BOLETÍN DE OFERTAS DE EMPREGO</span>
            </div>
            <div class="newsletter-container">
                <span>Descarga aquí o noso boletín de ofertas cada semana ou ben suscríbete para recibilo no teu correo electrónico:</span>
                <input type="text" class="" placeholder="   Escribe o teu mail"/>
                <a class="btn btn-subscribir">Subscribir</a>
            </div>
            <div class="ponteenmarcha-img">
                <img src="{{asset('assets/front/img/ponteenmarcha.png')}}" />
            </div>
        </div><!-- /.col-lg-4 -->
    </div><!-- /.row -->


    <!-- START THE FEATURETTES -->



    <!-- /END THE FEATURETTES -->
@endsection
