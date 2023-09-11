<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <link rel="stylesheet" href="{{asset("css\app.css")}}">
    <link rel="stylesheet" href="{{asset("css\bootstrap\bootstrap.css")}}">
    <title>Cooperativas Unidas</title>
</head>
<body>

    <header class="fixed-top shadow-lg">
        @include('layout.navbar')
    </header>

    @if(@$_SESSION['mensagem'] != "")
        <div class="mt-5 w-100 z-3 position-absolute top-0 start-50 translate-middle-x">
            <div id="alerta">
                <div class="alert alert-{{@$_SESSION['tipo']}} alert-dismissible" role="alert">
                    <div>{{$_SESSION['mensagem']}}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
        @php
            @$_SESSION['mensagem'] = "";
            @$_SESSION['tipo'] = "";
        @endphp
    @endif

    <section>
        @yield('content')
    </section>

    <footer class="footer mt-auto py-3">
        @include('layout.footer')
    </footer>


    <!-- Javascript -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/desvg@1.0.2/desvg.min.js"></script>
    
    <script>
        window.addEventListener('load', function(){
            deSVG('.icons', true);
        });
    </script>

</body>
</html>