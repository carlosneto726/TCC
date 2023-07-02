
<nav class="navbar navbar-expand-lg fixed-top" id="navbar">
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
                    <a class="nav-link text-light" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="#">Carrinho</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="#">Favoritos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="#">Login/Cadastre-se</a>
                </li>
            </ul>

            <!-- Formulário para a caixa de pesquisa -->
            <form class="d-flex" role="search">
                <input class="form-control me-2" id="nav-input" type="search" placeholder="Procure por algum produto" aria-label="Search">
                <button class="btn btn-outline-light" type="submit"><img class="icons" src="{{asset("icons/search.svg")}}" alt="Pesquisa" style="fill: #FFFF;"></button>
            </form>
        </div>
    </div>
</nav>



<style>
    #navbar{
    background-color: #009241;
    }

    #nav-input{
        width: 450px;
    }
</style>
