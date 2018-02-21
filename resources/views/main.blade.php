<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Laravel</title>
    </head>
   <script>
       window.Laravel = <?php echo json_encode([
         'csrfToken' => csrf_token(),
       ]); ?>
   </script>
    @if(!auth()->guest())
        <script>
            window.userId = <?php echo auth()->user()['id']; ?>

        </script>
    @endif
    </head>

    <body>
    <div class="container">
            <div class="row">
                @yield('content')
            </div>
        </div>  
        <div class="container">
            <div class="row">
                <div id="app"></div>
            </div>
        </div>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
