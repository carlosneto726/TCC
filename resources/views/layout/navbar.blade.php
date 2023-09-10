<nav class="container">
    <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="{{url("/")}}" class="d-flex align-items-center mb-2 mb-lg-0 link-body-emphasis text-decoration-none navbar-brand text-light fw-bold">
            Cooperativas Unidas
        </a>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
            <li><a href="{{url("/")}}" class="nav-link text-light px-2">Home</a></li>
        </ul>

        <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search" method="GET" action="{{url("/pesquisa/".request("categoria"))}}">
            <input type="search" name="pesquisa" class="form-control" placeholder="Procurar..." aria-label="Search">
        </form>

        @if (isset($_COOKIE["usuario"]))
            @include('layout.nav_itens.usuario')

        @elseif (isset($_COOKIE["cooperativa"]))
            @include('layout.nav_itens.cooperativa')
        @else
            <a class="nav-link text-light ms-2" href="{{url("/entrar")}}">Login/Cadastre-se</a>
        @endif
    </div>
</nav>

<style>
    .nav-link:hover {
        text-decoration: underline;
    }
</style>
