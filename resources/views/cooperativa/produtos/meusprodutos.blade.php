@extends('templates.template')
@section('content')

<div class="nav-scroller bg-dark shadow-sm" data-bs-theme="dark" style="margin-top: -19px;">
    <nav class="nav container" aria-label="Secondary navigation">
        <a class="nav-link text-decoration-none" href="#">Recente</a>
        <a class="nav-link text-decoration-none" href="#">Antigo</a>
        <a class="nav-link text-decoration-none" href="#">Mais caro</a>
        <a class="nav-link text-decoration-none" href="#">Mais barato</a>
        <a class="nav-link text-decoration-none" href="#">Ordem alfabética</a>
    </nav>
</div>

<div class="container">
    <div class="d-flex align-items-center p-3 my-3 rounded shadow">
        <img class="me-3" src="{{asset("icons/shop.svg")}}" width="48" height="38">
        <div class="lh-1">
            <h1 class="h4 mb-0 lh-1">Meus Produtos</h1>
            <small>@if(request("orderby")) Ordenado por <span class="fw-bold">"{{request("orderby")}}"</span> @endif</small>
        </div>
    </div>

    <!-- Botão para o modal para adicionar mais produtos -->
    <a data-bs-toggle="modal" href="#produtoModal">
        <div class="d-flex p-3 my-3 rounded shadow">
            <img class="mx-auto" src="{{asset("icons/plus.svg")}}" width="48" height="38">
        </div>
    </a>
    @include('cooperativa.produtos.adicionarModal')

    @if(count($produtos) == 0)
        <div class="d-flex align-items-center p-3 my-3 rounded shadow">
            <div class="lh-1">
                <h1 class="h4 mb-0 lh-1">Você ainda não tem nenhum produto</h1>
                <small>Adicione produtos no simbolo de cruz acima</small>
            </div>
        </div>
    @endif
    
    @foreach ($produtos as $produto)
        <div class="my-3 p-3 bg-body rounded shadow">
            <h6 class="border-bottom pb-2 mb-0 d-flex">
                <span class="p-1 rounded @if($produto->quantidade <= 10) bg-danger text-light @else bg-light text-dark @endif">
                    Estoque: {{$produto->quantidade}}
                </span>

                <span class="rounded p-1 ms-3">
                    <img src="{{asset("icons/thumbs-up.svg")}}" width="16" height="16">
                    <span>{{$produto->likes}}</span>
                    <img src="{{asset("icons/thumbs-down.svg")}}" width="16" height="16">
                    <span>{{$produto->deslikes}}</span>
                </span>

                <span class="ms-auto fw-bold mt-1">
                    @if($produto->entrega) 
                        <small class="text-success">ENTREGA DISPONIVEL</small> 
                    @else 
                        <small class="text-danger">ENTREGA INDISPONIVÉL</small> 
                    @endif
                </span>
                <button type="button" 
                        class="btn btn-success btn-sm ms-3" 
                        data-bs-toggle="modal" 
                        data-bs-target="#produtoModal{{$produto->id}}">
                        Editar
                </button>
            </h6>
            <div class="d-flex text-body-secondary pt-3">
                <img 
                src="{{asset("storage/".$produto->imagem)}}" 
                class="bd-placeholder-img flex-shrink-0 me-2 rounded object-fit-contain @if($produto->quantidade < 1) opacity-50 @endif"
                width="128" 
                height="128">
                <div class="pb-3 mb-0 small lh-sm w-100">
                    <div class="d-flex justify-content-between">
                        <a class="text-gray-dark fw-bold fs-5" href="{{url("/produto/".$produto->id)}}">{{$produto->nome}}</a>
                        <strong class="fs-6">R$ {{number_format($produto->preco,2,",",".")}}</strong>
                    </div>
                    <span class="d-block">{{$produto->descricao}}</span>
                </div>
            </div>
        </div>
        @include('cooperativa.produtos.editarModal')
    @endforeach
</div>

@endsection