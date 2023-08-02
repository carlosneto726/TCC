@extends('templates.template')
@section('content')
<div class="navbar navbar-expand-lg bg-body-tertiary w-100 mb-5" style="margin-top: -25px; background-color: var(--light-gray);">
    <div class="container-fluid">
        <ul class="navbar-nav">
            <a href="{{url("/pesquisa?pesquisa=".request("pesquisa")."&orderby=preco")}}" class="text-decoration-none">
                <li class="nav-link @if($orderby == 'preco') active" aria-current='true' @endif">Preço</li>
            </a>
            <a href="{{url("/pesquisa?pesquisa=".request("pesquisa")."&orderby=avaliacao-produto")}}" class="text-decoration-none">
                <li class="nav-link @if($orderby == 'avaliacao-produto') active" aria-current='true' @endif">Avaliação do produto</li>
            </a>
            <a href="{{url("/pesquisa?pesquisa=".request("pesquisa")."&orderby=cooperativa")}}" class="text-decoration-none">
                <li class="nav-link @if($orderby == 'cooperativa') active" aria-current='true' @endif">Cooperativa</li>
            </a>
            <a href="{{url("/pesquisa?pesquisa=".request("pesquisa")."&orderby=localizacao")}}" class="text-decoration-none">
                <li class="nav-link @if($orderby == 'localizacao') active" aria-current='true' @endif">Localização</li>
            </a>

            <div class="dropdown dropend">
                <a class="text-decoration-none" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <li class="nav-link @if($orderby == 'data') active" aria-current='true' @endif">
                        Categoria
                    </li>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{url("/pesquisa/agropecuaria?pesquisa=".request("pesquisa"))}}">Agropecuária</a></li>
                    <li><a class="dropdown-item" href="{{url("/pesquisa/consumo?pesquisa=".request("pesquisa"))}}">Consumo</a></li>
                    <li><a class="dropdown-item" href="{{url("/pesquisa/credito?pesquisa=".request("pesquisa"))}}">Crédito</a></li>
                    <li><a class="dropdown-item" href="{{url("/pesquisa/educacao?pesquisa=".request("pesquisa"))}}">Educação</a></li>
                    <li><a class="dropdown-item" href="{{url("/pesquisa/especial?pesquisa=".request("pesquisa"))}}">Especial</a></li>
                    <li><a class="dropdown-item" href="{{url("/pesquisa/moradia?pesquisa=".request("pesquisa"))}}">Moradia</a></li>
                    <li><a class="dropdown-item" href="{{url("/pesquisa/minerios?pesquisa=".request("pesquisa"))}}">Minérios</a></li>
                    <li><a class="dropdown-item" href="{{url("/pesquisa/producao?pesquisa=".request("pesquisa"))}}">Produção</a></li>
                    <li><a class="dropdown-item" href="{{url("/pesquisa/infraestrutura?pesquisa=".request("pesquisa"))}}">Infraestrutura</a></li>
                    <li><a class="dropdown-item" href="{{url("/pesquisa/trabalho?pesquisa=".request("pesquisa"))}}">Trabalho</a></li>
                    <li><a class="dropdown-item" href="{{url("/pesquisa/saude?pesquisa=".request("pesquisa"))}}">Saúde</a></li>
                    <li><a class="dropdown-item" href="{{url("/pesquisa/transporte?pesquisa=".request("pesquisa"))}}">Transporte</a></li>
                    <li><a class="dropdown-item" href="{{url("/pesquisa/turismo-e-lazer?pesquisa=".request("pesquisa"))}}">Turismo e lazer</a></li>
                </ul>
            </div>
        </ul>
    </div>
</div>

<h2 class="container">Exibindo resultados @if(request("categoria")) da categoria {{request("categoria")}} @endif para "<span class="fw-bold">{{request("pesquisa")}}"</span></h2>
<div class="container mt-5">
    <div class="mx-auto">

        <div class="me-2 mb-auto p-3 w-25">
            <h4>Ordernar por</h4>

        </div>
        
        <div class="grid-container container p-3 mb-auto rounded" style="background-color: var(--light-gray);">
            @foreach ($produtos as $produto)
                <!-- Card dos produtos -->
                <div class="card m-1 rounded">
                    <!-- Imagem do produto com o botão de editar -->
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
        
                    <a class="text-decoration-none text-dark" href="{{url("/produto/".$produto->id)}}">
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
    </div>
</div>


<style>

    .grid-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(340px, 5fr));
    }

    #btn-comprar{
        background-color: #00FF33;
    }

</style>


@endsection