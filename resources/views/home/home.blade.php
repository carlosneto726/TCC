@extends('templates.template')
@section('content')

<link rel="stylesheet" href="{{asset('css/home.css')}}">

<div class="navbar navbar-expand-lg bg-dark w-100" data-bs-theme="dark" style="margin-top: -25px;">
    <div class="container">
        <ul class="navbar-nav">
            <a class="text-decoration-none" href="{{url("/pesquisa/agropecuaria")}}"><li class="nav-link">Agropecuária</li></a>
            <a class="text-decoration-none" href="{{url("/pesquisa/consumo")}}"><li class="nav-link">Consumo</li></a>
            <a class="text-decoration-none" href="{{url("/pesquisa/credito")}}"><li class="nav-link">Crédito</li></a>
            <a class="text-decoration-none" href="{{url("/pesquisa/educacao")}}"><li class="nav-link">Educação</li></a>
            <a class="text-decoration-none" href="{{url("/pesquisa/especial")}}"><li class="nav-link">Especial</li></a>
            <a class="text-decoration-none" href="{{url("/pesquisa/moradia")}}"><li class="nav-link">Moradia</li></a>
            <a class="text-decoration-none" href="{{url("/pesquisa/minerios")}}"><li class="nav-link">Minérios</li></a>
            <a class="text-decoration-none" href="{{url("/pesquisa/producao")}}"><li class="nav-link">Produção</li></a>
            <a class="text-decoration-none" href="{{url("/pesquisa/infraestrutura")}}"><li class="nav-link">Infraestrutura</li></a>
            <a class="text-decoration-none" href="{{url("/pesquisa/trabalho")}}"><li class="nav-link">Trabalho</li></a>
            <a class="text-decoration-none" href="{{url("/pesquisa/saude")}}"><li class="nav-link">Saúde</li></a>
            <a class="text-decoration-none" href="{{url("/pesquisa/transporte")}}"><li class="nav-link">Transporte</li></a>
            <a class="text-decoration-none" href="{{url("/pesquisa/turismo-e-lazer")}}"><li class="nav-link">Turismo elazer</li></a>
        </ul>
    </div>
</div>


<div id="carouselAutoplaying" class="carousel carousel-dark slide container" data-bs-ride="carousel">
    <div class="carousel-inner">

        <div class="carousel-item active">
            <img src="{{asset("images/carrossel_active.png")}}" class="carrosel-img d-block w-50 mx-auto">
        </div>

        @foreach ($home_data['carrosel'] as $carrossel)
            <div class="carousel-item">
                <a class="text-dark-emphasis" href="{{url('/produto/'.$carrossel->pid)}}">
                    <div class="produto-container position-relative d-block w-50 mx-auto">
                        <img src="{{asset('storage/'.$carrossel->imagem)}}" class="carrosel-img">
                        <h3 class="p-2 rounded bg-light shadow position-absolute top-0 start-0">{{$carrossel->nome}}</h3>
                        <p class="p-2 rounded bg-light shadow position-absolute bottom-0 end-0 fw-bold">R$ {{number_format($carrossel->preco,2,",",".")}}</p>
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

    @foreach ($home_data['produtos'] as $categoria)

        @if(count($categoria['produtos']) != 0)

            @if(count($categoria['produtos']) > 5)
                <div class="mt-5 pt-2 shadow rounded">
                    <h4 class="m-3 text-dark-emphasis">{{$categoria['categoria']}}</h4>
                    <div class="d-flex overflow-x-auto h-scroll">
                        @foreach ($categoria['produtos'] as $produto)
                            <a class="position-relative text-dark-emphasis ms-2 me-1" href="{{url('/produto/'.$produto->pid)}}">
                                <img class="produto-img mt-4" src="{{asset('storage/'.$produto->imagem)}}">
                                <small class="p-2 rounded bg-light shadow position-absolute top-0 start-0 fw-bold">{{$produto->nome}}</small>
                                <small class="p-2 rounded bg-light shadow position-absolute bottom-0 end-0 fw-bold">R$ {{number_format($produto->preco,2,",",".")}}</small>
                            </a>
                        @endforeach
                    </div>
                </div>

            @elseif(count($categoria['produtos'])  < 6)
                <div class="mt-5 pt-2 pb-2 shadow rounded">
                    <h4 class="m-3 dark-emphasis">{{$categoria['categoria']}}</h4>
                    <div class="row row-cols-2 row-cols-sm-{{intval(count($categoria['produtos']) / 2)}} row-cols-md-{{count($categoria['produtos'])}} g-3">
                        @foreach ($categoria['produtos'] as $produto)
                            <div class="col">
                                <a class="produto-container position-relative text-dark-emphasis d-flex mx-auto p-2" href="{{url('/produto/'.$produto->pid)}}">
                                    <img class="produto-img my-auto mt-3" src="{{asset('storage/'.$produto->imagem)}}">
                                    <small class="p-2 rounded bg-light shadow position-absolute top-0 start-0 fw-bold">{{$produto->nome}}</small>
                                    <small class="p-2 rounded bg-light shadow position-absolute bottom-0 end-0 fw-bold">R$ {{number_format($produto->preco,2,",",".")}}</small>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
            
        @endif
    @endforeach
</div>
@endsection