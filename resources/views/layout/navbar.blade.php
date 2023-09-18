<nav class="navbar navbar-expand-lg container" aria-label="Main navigation">
    <div class="container-fluid">
        <a href="{{url("/")}}" class="navbar-brand link-body-emphasis text-decoration-none text-light fw-bold">Cooperativas Unidas</a>
        <button class="navbar-toggler p-0 border-0" type="button" id="navbarSideCollapse" aria-label="Toggle navigation" data-bs-target="#navbarsExampleDefault">
            <span class="navbar-toggler-icon"></span>
        </button>
  
        <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0"></ul>
            <div class="d-flex">
                <form class="d-flex" role="search" method="GET" action="{{url("/pesquisa/".request("categoria"))}}">
                    <input class="form-control me-2" type="search" name="pesquisa" placeholder="Procurar..." aria-label="Search">
                    <button class="btn btn-outline-light" type="submit"><img src="{{asset("icons/search.svg")}}"></button>
                </form>

                @if (isset($_COOKIE["usuario"]))
                    @include('layout.nav_itens.usuario')

                @elseif (isset($_COOKIE["cooperativa"]))
                    @include('layout.nav_itens.cooperativa')
                @else
                    <a class="nav-link text-light ms-2 mt-2" href="{{url("/entrar")}}">Login/Cadastre-se</a>
                @endif
            </div>
        </div>
    </div>
</nav>