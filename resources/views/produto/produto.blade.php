@extends('templates.template')
@section('content')

<div class="container">
    <!-- Parte de detalhes sobre o produto / cooperativa -->
    <div class="row g-5">
        <!-- Div com as informações mais detalhadas do produto -->
        <div class="col-md-7 col-lg-8">
            <div class="me-3 p-3 mb-auto rounded shadow">
                <div class="row g-5">
                    <!-- Botões superiores e imagem do produto -->
                    <div class="col-md-5 col-lg-4 order-md-first">
                        <a href="{{url("/produto/".$id_produto."/favoritar/".$favorito)}}" class="text-decoration-none text-dark">
                            @if(isset($_COOKIE["usuario"]))
                                @if($favorito)
                                    <img src="{{asset("icons/heart-fill.svg")}}"> Favoritar
                                @else
                                    <img src="{{asset("icons/heart.svg")}}"> Favoritar
                                @endif
                            @endif
                        </a>
                        <a href="{{url("/comparar/".$id_produto)}}" class="text-decoration-none text-dark ms-3">
                            <img src="{{asset("icons/sliders.svg")}}"> Comparar
                        </a>
                        <div class="flex-shrink-0 mt-1">
                            <img class="item-img img-fluid rounded object-fit-contain" src="{{asset("storage/".$produto[0]->imagem)}}">
                        </div>
                    </div>
                    <!-- Informações do produto e da cooperativa -->
                    <div class="col-md-7 col-lg-8">
                        <div class="flex-grow-1 ms-3 mb-auto">
                            <h4>{{$produto[0]->pnome}}</h4>
                            <small>
                                {{$produto[0]->pdescricao}}
                            </small>
                            <div class="d-flex my-3">
                                <img src="{{asset("icons/thumbs-up-fill.svg")}}">
                                <span class="ms-1 me-3">{{$produto[0]->likes}}</span>
                                <img src="{{asset("icons/thumbs-down-fill.svg")}}">
                                <span class="ms-1 me-3">{{$produto[0]->deslikes}}</span>
                                ({{$produto[0]->deslikes + $produto[0]->likes}} avaliações)
                            </div>
                            <hr>
                            <div class="list-group">
                                <a href="{{url("/cooperativa/".$produto[0]->cnome)}}" class="list-group-item list-group-item-action d-flex gap-3 py-1 border-0" aria-current="true">
                                    <img class="rounded-circle flex-shrink-0 object-fit-cover" src="{{asset("storage/".$produto[0]->perfil)}}" width="64" height="64">
                                    <div class="d-flex gap-2 w-100 justify-content-between">
                                        <div>
                                            <h6 class="mb-0">{{$produto[0]->cnome}}</h6>
                                            <p class="mb-0 opacity-75">{{$produto[0]->endereco}}</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- Div com o preço do produto e o botão de comprar -->
        <div class="col-md-5 col-lg-4 order-md-last">
            <ul class="list-group mb-3 shadow">
                <li class="list-group-item d-flex justify-content-between lh-sm">
                    <h1 class="my-0">R$ {{number_format($produto[0]->preco,2,",",".")}}</h1>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                    <span>
                        @if($produto[0]->quantidade <= 0 && $produto[0]->quantidade != false)
                            <span class="fw-bold text-danger">indisponível para compra</span>
                        @else
                            <span class="fw-bold text-success">disponível para compra</span>
                        @endif
                    </span>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                    <span>
                        @if($produto[0]->entrega) 
                            <span class="text-success">entrega disponível</span> 
                        @else 
                            <span class="text-danger">entrega indisponível</span> 
                        @endif
                    </span>
                </li>
            </ul>

            <span class="card p-2 shadow">
                <a class="btn w-100  @if($produto[0]->quantidade <= 0 && $produto[0]->quantidade != false) d-none @endif" id="btn-comprar" @if(!isset($_COOKIE['usuario'])) href="{{url("/entrar")}}" @else href="{{url("/carrinho/add?id_produto=".$id_produto)}}" @endif
                    style="background-color: var(--light-green);">
                    Adicionar ao carrinho
                </a>
            </form>
        </div>

    </div>

    @include('produto.avaliacoes')
</div>

<style>
    .item-img{
        height: 250px;
    }
</style>

@endsection

