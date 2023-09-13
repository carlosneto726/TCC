@extends('templates.template')
@section('content')

<div id="carouselAutoplaying" class="carousel carousel-dark slide container" data-bs-ride="carousel">
    <div class="carousel-inner">

        <div class="carousel-item active">
            <img src="{{asset("images/carrossel_active.png")}}" class="carrosel-img card-img d-block w-50 mx-auto">
        </div>

        @foreach ($produtos_carrossel as $carrossel)
            <div class="carousel-item">
                <a class="text-decoration-none text-dark" href="{{url("/produto/".$carrossel->pid)}}">                
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

<div class="container mt-5">



    @foreach ($produtos_categorias as $categoria)

        @if(count($categoria) != 0)

            @if(count($categoria) > 4)
                <div class="mt-5 pt-2 shadow rounded">
                    <h4 class="m-3">produtos_categorias</h4>
                    <div class="d-flex overflow-x-auto">
                        @foreach ($categoria as $produto)
                            <a class="text-decoration-none ms-1 me-1" href="{{url("/produto/".$produto->pid)}}">
                                <img class="object-fit-contain" src="{{asset("storage/".$produto->imagem)}}" style="height: 200px;">
                            </a>
                        @endforeach
                    </div>
                </div>

            @elseif(count($categoria)  <= 5)
                <div class="mt-5 pt-2 pb-2 shadow rounded">
                    <h4 class="m-3">produtos_categorias</h4>
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-{{count($categoria)}} g-3">
                        @foreach ($categoria as $produto)
                            <div class="col">
                                <a class="text-decoration-none d-flex p-2" href="{{url("/produto/".$produto->pid)}}">
                                    <img class="mx-auto object-fit-contain" src="{{asset("storage/".$produto->imagem)}}" style="height: 200px;">
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
            
        @endif
    @endforeach










    <h3 class="mt-5 text-center">Categorias</h3>
    <div class="mx-auto d-flex justify-content-center p-3 mt-4 rounded shadow">

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
            <a href="{{url("/pesquisa/producao")}}">
                <img class="categoria-img img-fluid" src="{{asset("icons/factory.svg")}}" title="Produção">
            </a>
        </div>

        <div class="flex-categoria p-3 ms-1 me-1">
            <a href="{{url("/pesquisa/infraestrutura")}}">
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
</style>

@endsection