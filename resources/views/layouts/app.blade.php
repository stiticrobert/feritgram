
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Feritgram @yield('title')</title>

    {!! HTML::style('https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css') !!}
    {!! HTML::style('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css') !!}
    {!! HTML::style('/css/style.css') !!}

    <!-- Scripts -->
    <script>
        window.Feritgram = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    Feritgram
                </a>

                @if(Auth::user())
                    <a href="{{ url('upload') }}">
                        <button style="margin: 10px" class="btn btn-primary">Upload</button>
                    </a>
                @endif
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">&nbsp;</ul>
                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('login') }}">Prijava</a></li>
                        <li><a href="{{ url('register') }}">Registracija</a></li>
                    @else
                        <li><a href="{{ route('profile', Auth::user()->name) }}">Moj profil</a></li>
                        <li><a href="{{ url('logout') }}">Odjava</a></li>
                    @endif
            </div>
        </div>
    </nav>

    <div class="container">
        @if(Session::has('success'))
            <div class="alert alert-success">
                <strong> {{ Session::get('success') }} </strong>
            </div>
        @endif
        @yield('content')
    </div>

{!! HTML::script('/js/app.js') !!}
{!! HTML::script('https://code.jquery.com/jquery-2.1.4.min.js') !!}
{!! HTML::script('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js') !!}
{!! HTML::script('//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-58286ec900fbd29b') !!}
   
</body>

<footer class="footer">
    <div class="col-md-12">
        <hr>
        <p class="text-center">&copy; PHP Akademija, 2016</p>
    </div>
</footer>

</html>