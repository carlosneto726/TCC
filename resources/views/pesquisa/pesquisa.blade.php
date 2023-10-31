@extends('templates.template')
@section('content')


<div class="nav-scroller bg-dark shadow-sm" data-bs-theme="dark" style="margin-top: -19px;">
    <nav class="nav container" aria-label="Secondary navigation">
        <a class="nav-link text-decoration-none" href="{{url("/pesquisa?pesquisa=".request("pesquisa")."&orderby=preco")}}">Preço</a>
        <a class="nav-link text-decoration-none" href="{{url("/pesquisa?pesquisa=".request("pesquisa")."&orderby=avaliacao-produto")}}">Avaliação do produto</a>
        <a class="nav-link text-decoration-none" href="{{url("/pesquisa?pesquisa=".request("pesquisa")."&orderby=cooperativa")}}">Cooperativa</a>
        <a class="nav-link text-decoration-none" href="{{url("/pesquisa?pesquisa=".request("pesquisa")."&orderby=localizacao")}}">Localização</a>
        <a class="nav-link text-decoration-none" href="{{url("/pesquisa/frutas-verduras?pesquisa=".request("pesquisa"))}}">Frutas e Verduras</a>
        <a class="nav-link text-decoration-none" href="{{url("/pesquisa/consumo?pesquisa=".request("pesquisa"))}}">Consumo</a>
        <a class="nav-link text-decoration-none" href="{{url("/pesquisa/credito?pesquisa=".request("pesquisa"))}}">Crédito</a>
        <a class="nav-link text-decoration-none" href="{{url("/pesquisa/educacao?pesquisa=".request("pesquisa"))}}">Educação</a>
        <a class="nav-link text-decoration-none" href="{{url("/pesquisa/especial?pesquisa=".request("pesquisa"))}}">Especial</a>
        <a class="nav-link text-decoration-none" href="{{url("/pesquisa/moradia?pesquisa=".request("pesquisa"))}}">Moradia</a>
        <a class="nav-link text-decoration-none" href="{{url("/pesquisa/minerios?pesquisa=".request("pesquisa"))}}">Minérios</a>
        <a class="nav-link text-decoration-none" href="{{url("/pesquisa/producao?pesquisa=".request("pesquisa"))}}">Produção</a>
        <a class="nav-link text-decoration-none" href="{{url("/pesquisa/infraestrutura?pesquisa=".request("pesquisa"))}}">Infraestrutura</a>
        <a class="nav-link text-decoration-none" href="{{url("/pesquisa/trabalho?pesquisa=".request("pesquisa"))}}">Trabalho</a>
        <a class="nav-link text-decoration-none" href="{{url("/pesquisa/saude?pesquisa=".request("pesquisa"))}}">Saúde</a>
        <a class="nav-link text-decoration-none" href="{{url("/pesquisa/transporte?pesquisa=".request("pesquisa"))}}">Transporte</a>
        <a class="nav-link text-decoration-none" href="{{url("/pesquisa/turismo-e-lazer?pesquisa=".request("pesquisa"))}}">Turismo e lazer</a>
    </nav>
</div>

<div class="container">
    <div class="d-flex align-items-center p-3 my-3 rounded shadow-lg">
        <img class="me-3" src="{{asset("icons/search.svg")}}" width="48" height="38">
        <div class="lh-1">
            <h1 class="h4 mb-0 lh-1">
                Exibindo resultados para "<span class="fw-bold">{{request("pesquisa")}}"</span>
            </h1>
            <small>
                @if(request("categoria")) Categoria: {{request("categoria")}} @endif
                @if(request("orderby")) Ordenado por: {{request("orderby")}} @endif
            </small>
        </div>
    </div>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        @foreach ($produtos as $produto)
            <div class="col">
                <!-- Card dos produtos -->
                <div class="card m-1 rounded border-0 shadow">
                    <a class="text-decoration-none text-dark" href="{{url("/produto/".$produto->pid)}}">
                        <!-- Imagem do produto com o botão de editar -->
                        <img src="{{asset("storage/".$produto->pimg)}}" class="rounded card-img-top" style="height: 200px; object-fit: contain;">
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
                            <div class="d-flex text-body-secondary pt-3">
                                <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
                                    <div class="d-flex justify-content-between">
                                        <strong class="h5 text-gray-dark">{{$produto->pnome}}</strong>
                                        <span class="h6">R$ {{number_format($produto->preco,2,",",".")}}</span>
                                    </div>
                                    <span class="h6 d-block">{{$produto->pdesc}}</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-flex gap-3 p-2 border-0" aria-current="true">
                            <img class="rounded-circle flex-shrink-0 object-fit-cover" src="{{asset("storage/".$produto->cimg)}}" width="64" height="64">
                            <div class="d-flex gap-2 w-100 justify-content-between">
                                <div>
                                    <h6 class="mb-0">{{$produto->cnome}}</h6>
                                    <p class="mb-0 opacity-75">{{$produto->endereco}}</p>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>
@endsection
