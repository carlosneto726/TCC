@extends('templates.template')
@section('content')

<div id="carouselAutoplaying" class="carousel carousel-dark slide" data-bs-ride="carousel">
    <div class="carousel-inner">

        <div class="carousel-item active">
            <img src="{{asset("images/carrossel_active.png")}}" class="carrosel-img card-img d-block w-50 mx-auto">
        </div>

        @foreach ($produtos_carrossel as $carrossel)
            <div class="carousel-item">
                <a class="text-decoration-none text-dark" href="{{url("/produto/".$carrossel->id)}}">                
                    <img src="{{asset("storage/".$carrossel->imagem)}}" class="carrosel-img card-img d-block w-50 mx-auto" style="width: fit-content;">
                    <div class="card-img-overlay mx-auto d-flex flex-column" style="width: fit-content;">
                        <h3 class="card-title me-5">{{$carrossel->nome}}</h3>
                        <p class="card-text mt-auto text-end fw-bold">R$ {{number_format($carrossel->preco,2,",",".")}}</p>
                    </div>
                </a>
            </div>
        @endforeach
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#carouselAutoplaying" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>

    <button class="carousel-control-next" type="button" data-bs-target="#carouselAutoplaying" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>


<!-- Titulo -->
<h3 class="mt-5 text-center">Produtos em destaque</h3>
<!-- Container com todos os produtos da cooperativa -->
<div class="grid-container rounded container mt-4 p-3" style="background-color: var(--light-gray);">
    <!-- Listando os produtos do banco de dados -->
    @foreach ($produtos as $produto)
        <!-- Card dos produtos -->
            <div class="card m-1 rounded">
                <!-- Imagem do produto com o botão de editar -->
                <a class="text-decoration-none text-dark" href="{{url("/produto/".$produto->id)}}">
                <img src="{{asset("storage/".$produto->imagem)}}" class="rounded card-img-top" style="height: 200px; object-fit: contain;">

                <div class="card-img-overlay" style="height: 200px;">

                    <div class="d-flex" style="height: 170px;">
                        <div class="d-inline-flex p-1 rounded ms-auto mt-auto" style="background-color: white;">
                            <img src="{{asset("icons/thumbs-up.svg")}}">
                            <span class="me-1">{{$produto->likes}}</span>
                            <img class="ms-1" src="{{asset("icons/thumbs-down.svg")}}">
                            <span>{{$produto->deslikes}}</span>
                        </div>
                    </div>    
                </div>

            
                <div class="card-body p-2 rounded">
                    <!-- Iformações do produto -->
                    <div class="w-100 text-truncate">
                        <span class="fs-3">{{$produto->nome}}</span>
                    </div>
                    <div class="w-100">
                        <span class="fw-bold text-wrap">R$ {{number_format($produto->preco,2,",",".")}}</span>
                    </div>
                    <div class="w-100 text-truncate">
                        <span class="">{{$produto->descricao}}</span>
                    </div>
                </div>
            </a>
        </div>
    @endforeach
</div>


<div class="mt-5">
    <h3 class="mt-5 text-center">Categorias</h3>
    <div class="container mx-auto d-flex justify-content-center p-3 mt-4 rounded" style="background-color: var(--light-gray);">

        <div class="flex-categoria p-3 ms-1 me-1">
            <a href="{{url("/pesquisa/agropecuaria")}}">
                <img class="categoria-img img-fluid" src="{{asset("icons/farming-tractor.svg")}}" title="Agropecuária">
            </a>
        </div>
        
        <div class="flex-categoria p-3 ms-1 me-1">
            <a href="{{url("/pesquisa/consumo")}}">
                <img class="categoria-img img-fluid" src="{{asset("icons/cup-straw.svg")}}" title="Consumo">
            </a>
        </div>

        <div class="flex-categoria p-3 ms-1 me-1">
            <a href="{{url("/pesquisa/credito")}}">
                <img class="categoria-img img-fluid" src="{{asset("icons/cash-coin.svg")}}" title="Crédito">
            </a>
        </div>

        <div class="flex-categoria p-3 ms-1 me-1">
            <a href="{{url("/pesquisa/educacao")}}">
                <img class="categoria-img img-fluid" src="{{asset("icons/book.svg")}}" title="Educação">
            </a>
        </div>

        <div class="flex-categoria p-3 ms-1 me-1">
            <a href="{{url("/pesquisa/especial")}}">
                <img class="categoria-img img-fluid" src="{{asset("icons/universal-access-circle.svg")}}" title="Especial">
            </a>
        </div>

        <div class="flex-categoria p-3 ms-1 me-1">
            <a href="{{url("/pesquisa/moradia")}}">
                <img class="categoria-img img-fluid" src="{{asset("icons/house-door.svg")}}" title="Moradia">
            </a>
        </div>

        <div class="flex-categoria p-3 ms-1 me-1">
            <a href="{{url("/pesquisa/minerios")}}">
                <img class="categoria-img img-fluid" src="{{asset("icons/minecart-loaded.svg")}}" title="Minérios">
            </a>
        </div>

        <div class="flex-categoria p-3 ms-1 me-1">
            <a href="{{url("/pesquisa/categoria/producao")}}">
                <img class="categoria-img img-fluid" src="{{asset("icons/factory.svg")}}" title="Produção">
            </a>
        </div>

        <div class="flex-categoria p-3 ms-1 me-1">
            <a href="{{url("/pesquisa/categoria/infraestrutura")}}">
                <img class="categoria-img img-fluid" src="{{asset("icons/building.svg")}}" title="Infraestrutura">
            </a>            
        </div>

        <div class="flex-categoria p-3 ms-1 me-1">
            <a href="{{url("/pesquisa/trabalho")}}">
                <img class="categoria-img img-fluid" src="{{asset("icons/person-workspace.svg")}}" title="Trabalho">
            </a>
        </div>

        <div class="flex-categoria p-3 ms-1 me-1">
            <a href="{{url("/pesquisa/saude")}}">
                <img class="categoria-img img-fluid" src="{{asset("icons/bandaid.svg")}}" title="Saúde">
            </a>
        </div>

        <div class="flex-categoria p-3 ms-1 me-1">
            <a href="{{url("/pesquisa/transporte")}}">
                <img class="categoria-img img-fluid" src="{{asset("icons/bus-front.svg")}}" title="Transporte">
            </a>
        </div>

        <div class="flex-categoria p-3 ms-1 me-1">
            <a href="{{url("/pesquisa/turismo-e-lazer")}}">
                <img class="categoria-img img-fluid" src="{{asset("icons/emoji-sunglasses.svg")}}" title="Turismo e lazer">
            </a>
        </div>
    </div>
</div>


<style>
    .carrosel-img {
        object-fit: contain;
        width: 100%;
        height: 275px;
    }

    .carousel {
        margin-top: 70px;
    }

    .grid-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    }

</style>

@endsection