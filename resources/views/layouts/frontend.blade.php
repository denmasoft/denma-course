<!DOCTYPE html>
<html lang="en">
<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="Axencia local de colocacion">
    <meta name="author" content="DenmaSoft Inc">
    <meta name="keyword" content="Axencia, Colocacion, Santiago">
    <title>Axencia Local de Colocacion</title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset('assets/front/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/front/css/flaticon.css')}}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{asset('assets/front/css/carousel.css')}}" rel="stylesheet">
    <link href='//fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <link href="{{asset('assets/front/css/axencia.css')}}" rel="stylesheet">
    <style type="text/css">
        .bg-dark{
            background-color: rgb(119, 119, 119) !important;
        }
    </style>
</head>
<body>

<header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark top-header">
        <a class="navbar-brand lang" href="#">Español</a>
        <a class="navbar-brand phone" href="#"><i class="flaticon-phone"></i>981 543 060</a>
        <a class="navbar-brand email" href="#">axencialocaldecolocacion@santiagodecompostela.org</a>
        <a class="navbar-brand" href="#"><i class="flaticon-marcador-de-posicion"></i></a>
        <div class="social-container">
            <a><i class="flaticon-facebook"></i></a>
            <a><i class="flaticon-boton-de-logo-del-twitter"></i></a>
            <a><i class="flaticon-logo-linkedin"></i></a>
            <a><i class="flaticon-google-plus"></i></a>
            <a><i class="flaticon-youtube"></i></a>
            <a><i class="flaticon-podcast-boton-circular"></i></a>
        </div>
    </nav>

    <nav class="navbar navbar-expand-md navbar-dark nav-menu">
        <img class="menu-img" src="{{asset('assets/front/img/slides/logo-axencia-local-colocacion.png')}}" alt="" />
        <div class="container d-flex flex-column flex-md-row justify-content-between">
            <span class="py-2 d-none d-md-inline-block menu-spacer" href="#"></span>
            <a class="py-2 d-none d-md-inline-block menu-item" href="#">AXENCIA</a>
            <a class="py-2 d-none d-md-inline-block menu-item" href="#">OFERTAS</a>
            <a class="py-2 d-none d-md-inline-block menu-item" href="#">FORMACION</a>
            <a class="py-2 d-none d-md-inline-block menu-item" href="#">PROGRAMAS</a>
        </div>
    </nav>

</header>

<main role="main">

    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="first-slide" src="{{asset('assets/front/img/slides/slide-1.png')}}" alt="First slide">
                <div class="container">
                    <!--<div class="carousel-caption text-left">
                        <h1>Example headline.</h1>
                        <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                        <p><a class="btn btn-lg btn-primary" href="#" role="button">Sign up today</a></p>
                    </div>-->
                </div>
            </div>
            <div class="carousel-item">
                <img class="second-slide" src="{{asset('assets/front/img/slides/slide-2.png')}}" alt="Second slide">
                <div class="container">
                    <!--<div class="carousel-caption">
                        <h1>Another example headline.</h1>
                        <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                        <p><a class="btn btn-lg btn-primary" href="#" role="button">Learn more</a></p>
                    </div>-->
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <nav class="navbar navbar-expand-md navbar-dark inscribete-container">
        <span class="inscribete-span">Si xa eres usuario/a da Axencia: </span>
        <input type="text" class="" placeholder="   Usuario/a"/>
        <input type="text" class="" placeholder="   Contrasinal"/>
        <a class="btn btn-entra">Entra</a>

        <div class="novo-container">
            <span class="inscribete-novo">Eres novo/a na Axencia?</span>
            <a class="btn btn-inscribete">INSCRÍBETE AQUÍ</a>
        </div>

    </nav>


    <!-- Marketing messaging and featurettes
    ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->

    <div class="content container marketing">

        @yield('content')

    </div><!-- /.container -->


    <!-- FOOTER -->
    <footer class="py-5">
        <div class="container">
            <div class="row">

                <div class="col-6 col-md">

                    <ul class="list-unstyled text-small">
                        <li><a class="text-muted contact-text" href="#">Axencia</a></li>
                        <li><a class="text-muted contact-text" href="#">Ofertas</a></li>
                        <li><a class="text-muted contact-text" href="#">Formacion</a></li>
                        <li><a class="text-muted contact-text" href="#">Programas</a></li>
                        <br/>
                        <li><a class="text-muted contact-text" href="#">Accesibilidad</a></li>
                        <li><a class="text-muted contact-text" href="#">Aviso Legal</a></li>
                        <li><a class="text-muted contact-text" href="#">Contacto</a></li>
                    </ul>
                </div>
                <div class="col-8 col-md">
                    <h5 class="contacto-margin">CONTACTO</h5>
                    <ul class="list-unstyled text-small contacto-margin">
                        <li><a class="text-muted contact-text" href="#">Edificio Administrativo CERSIA</a></li>
                        <li><a class="text-muted contact-text" href="#">Rúa Alcalde Raimundo López Pol, s/n</a></li>
                        <li><a class="text-muted contact-text">Santiago de Compostela</a></li>
                        <li><a class="text-muted contact-text" href="#">Tlf. 981 543 060</a></li>
                        <li><a class="text-muted contact-text" href="#">Fax 981 542 407</a></li>
                    </ul>
                </div>

                <div class="col-4 col-md">
                    <img class="bottom-concello" src="{{asset('assets/front/img/logo-concello-santiago-compostela.png')}}">

                </div>
            </div>
        </div>

    </footer>

    <span class="bottom-footer">© 2018. Concello de Santiago. Concellaría de Igualdade, Desenvolvemento Económico e Turismo</span>
</main>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="{{asset('assets/front/js/vendor/jquery-slim.min.js')}}"><\/script>')</script>
<script src="{{asset('assets/front/js/bootstrap.bundle.min.js')}}"></script>
</body>
</html>
