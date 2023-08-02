
<nav class="navbar navbar-expand-lg fixed-top shadow-lg" style="background-color: var(--green);">
    <div class="container-fluid">
        <!-- Titulo do site no navbar -->
        <a class="navbar-brand text-light" href="{{url("/")}}">Cooperativas unidas</a>

        <!-- botão hamburger para responsividade -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <li class="nav-item">
                    <a class="nav-link text-light" href="{{url("/")}}">Home</a>
                </li>
                @if (isset($_COOKIE["usuario"]))
                    @include('layout.nav_itens.usuario')

                @elseif (isset($_COOKIE["cooperativa"]))
                    @include('layout.nav_itens.cooperativa')
                @else
                    <li class="nav-item">
                        <a class="nav-link text-light" href="{{url("/entrar")}}">Login/Cadastre-se</a>
                    </li>
                @endif
            </ul>

            <!-- Formulário para a caixa de pesquisa -->
            <form class="d-flex" role="search" method="GET" action="{{url("/pesquisa/".request("categoria"))}}">
                <input class="form-control me-2" id="nav-input" name="pesquisa" type="search" placeholder="Procure por algum produto" aria-label="Search">
                <button class="btn btn-outline-light" type="submit">
                    <img class="icons" src="{{asset("icons/search.svg")}}" alt="Pesquisa" style="fill: white;">
                </button>
            </form>

        </div>
    </div>
</nav>



<style>
    .nav-link:hover {
        text-decoration: underline;
    }
</style>
