<html lang="en"><head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
    <meta name="author" content="Łukasz Holeczek">
    <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
    <title>Axencia Local de Colocacion</title>
    
    <link href="{{ asset('dist/vendors/@coreui/icons/css/coreui-icons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/vendors/flag-icon-css/css/flag-icon.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/vendors/simple-line-icons/css/simple-line-icons.css') }}" rel="stylesheet">
    <!-- Main styles for this application-->
    <link href="{{ asset('dist/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/vendors/pace-progress/css/pace.min.css') }}" rel="stylesheet">
    
    
    <body class="app flex-row align-items-center  pace-done" cz-shortcut-listen="true"><div class="pace  pace-inactive"><div class="pace-progress" data-progress-text="100%" data-progress="99" style="transform: translate3d(100%, 0px, 0px);">
      <div class="pace-progress-inner"></div>
    </div>
    <div class="pace-activity"></div></div>
    <div class="container">
    <div class="row justify-content-center">
    <div class="col-md-5">
    <div class="card-group">
        <div class="card p-4">
            <div class="card-body">
            
            <form class="form-horizontal" method="POST" action="{{ route('login') }}">
             {{ csrf_field() }}
            <div class="input-group mb-3">
            <div class="input-group-prepend">
            <span class="input-group-text">
            <i class="icon-user"></i>
            </span>
            </div>
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
            
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
            </div>
            <div class="input-group mb-4">
            <div class="input-group-prepend">
            <span class="input-group-text">
            <i class="icon-lock"></i>
            </span>
            </div>
            <input id="password" type="password" class="form-control" name="password" required>
            
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
            </div>
            <div class="row">
            <div class="col-6">
            <button type="button" class="btn btn-primary px-4">Login</button>
            </div>
            <div class="col-6 text-right">
            <a href="{{ route('password.request') }}" class="btn btn-link px-0">Forgot password?</a>
            </div>
            </div>
            </form>
            </div>
            </div>
    
    </div>
    </div>
    </div>
    </div>
    
    <script src="{{ asset('dist/vendors/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('dist/vendors/popper.js/js/popper.min.js') }}"></script>
    <script src="{{ asset('dist/vendors/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('dist/vendors/pace-progress/pace.min.js') }}"></script>
    <script src="{{ asset('dist/vendors/perfect-scrollbar/dist/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('dist/vendors/@coreui/coreui/dist/js/coreui.min.js') }}"></script>
    <!-- Plugins and scripts required by this view-->
    <script src="{{ asset('dist/vendors/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('dist/vendors/@coreui/coreui-plugin-chartjs-custom-tooltips/dist/js/custom-tooltips.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script>
        $('#ui-view').ajaxLoad();
        $(document).ajaxComplete(function() {
          Pace.restart()
        });
      </script>
    
    
    <div id="naptha_container0932014_0707"></div></body></html>
