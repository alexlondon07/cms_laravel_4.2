<html lang="en"><head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<meta name="description" content="">
<meta name="author" content="">
<link rel="icon" type="image/x-icon" href="{{ URL::to('/') }}/images/favicon.ico" />
<title>CMS ::</title>
<!-- Bootstrap core CSS -->
<link rel="stylesheet" type="text/css" href="{{ URL::to('/') }}/css/bootstrap/bootstrap.css?v={{ Util::version() }}" />
<!-- Custom styles for this template -->
<link rel="stylesheet" type="text/css" href="{{ URL::to('/') }}/css/bootstrap/dashboard.css?v={{ Util::version() }}" />

<!-- css de bootstrap datepicker-->
<link rel="stylesheet" type="text/css" href="{{ URL::to('/') }}/js/bootstrap/datepicker/css/datepicker.css?v={{ Util::version() }}" />

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
          <![endif]-->

          <!-- Font -->
        @yield('head_content')
      </head>
      <body>
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{URL::to('/')}}">CMS Laravel 4.2</a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    @if(Auth::check())
                    <ul class="nav navbar-nav navbar-right">

                        @if(Auth::user()->hasRole('1'))
                        <li><a href="{{URL::to('/')}}/admin/user" title="Usuarios"><i class="glyphicon glyphicon-user"></i> Usuarios</a></li>
                        @endif

                        @if(Auth::user()->hasRole('2'))
                        <li><a href="{{URL::to('/')}}/admin/category" title="Categorias"><i class="glyphicon glyphicon-list"></i> Categoria</a></li>
                        @endif

                        @if(Auth::user()->hasRole('3'))
                        <li><a href="{{URL::to('/')}}/admin/subcategory" title="Sub Categorias"><i class="glyphicon glyphicon-list"></i> Subcategoria</a></li>
                        @endif

                        @if(Auth::user()->hasRole('4'))
                        <li><a href="{{URL::to('/')}}/admin/product" title="Productos"><i class="glyphicon glyphicon-oil"></i> Productos</a></li>
                        @endif

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Bienvenido : {{ Auth::user()->username }} <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{URL::to('/')}}/logout" title="Cerrar sesión">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                    @endif
                </div> <!-- end of ".navbar-collapse" -->
            </div> <!-- end of ".container" -->
        </nav>
        <div id="body_wrapper">
            @yield('body_content')
        </div>
        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        {{ HTML::script('js/jquery/jquery-1.11.3.min.js') }}
        <script type="text/javascript" src="{{ URL::to('js/bootstrap/bootstrap.min.js') }}?v={{ Util::version() }}"></script>
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script type="text/javascript" src="{{ URL::to('/') }}/js/jquery/ie10-viewport-bug-workaround.js?v={{ Util::version() }}"></script>
        <!-- js de bootstrap 3 datepicker-->
        <script type="text/javascript" src="{{ URL::to('/') }}/js/bootstrap/datepicker/js/bootstrap-datepicker.js?v={{ Util::version() }}"></script>
        <script type="text/javascript">var rootUrl = "{{ URL::to('/') }}/";</script>
        <script type="text/javascript" src="{{ URL::to('/') }}/js/Util.js?v={{ Util::version() }}"></script>
        @yield('javascript_content')
    </body>
    </html>