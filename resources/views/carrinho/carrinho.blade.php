@extends('templates.template')
@section('content')

<div class="container">
    <div class="d-flex align-items-center p-3 my-5 rounded shadow-lg">
        <img class="me-3" src="{{asset("icons/cart.svg")}}" width="48" height="38">
        <div class="lh-1">
            <h1 class="h4 mb-0 lh-1">Seu Carrinho</h1>
        </div>
    </div>

    <div class="row g-5">
        <div class="col-md-5 col-lg-4 order-md-last">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-success">Resumo do pedido</span>
                <span class="badge bg-success rounded-pill">{{$quantidade_produtos}}</span>
            </h4>
            <ul class="list-group mb-3 shadow">
                @foreach ($produtos as $produto)
                    <li class="list-group-item d-flex justify-content-between lh-sm">
                        <div>
                            <h6 class="my-0">{{$produto->nome}}</h6>
                            <small class="text-body-secondary">{{$produto->descricao}}</small>
                        </div>
                        <span class="text-body-secondary">{{$produto->qtd}} X R$ {{number_format($produto->preco,2,",",".")}} (R$ {{number_format(($produto->preco * $produto->qtd),2,",",".")}})</span>
                    </li>
                @endforeach
                <li class="list-group-item d-flex justify-content-between">
                    <span>Total (R$)</span>
                    <strong>{{number_format($total,2,",",".")}}</strong>
                </li>
            </ul>

            <form class="card p-2 shadow" action="{{url("/carrinho/finalizar")}}" method="POST">
                @csrf
                @method("POST")
                <button class="btn btn-success w-100" type="submit">Fazer Pedido</button>
            </form>
        </div>

        <div class="col-md-7 col-lg-8">
            <h4 class="mb-3">Produtos</h4>
            @if (count($produtos) == 0)
                <h5>Parece que você ainda não tem nenhum produto no carrinho. Veja o nosso <a href="{{url("/")}}">catálogo</a></h5>                
            @endif
            <div class="row g-3">
                <div class="col-12">
                    @foreach ($produtos as $produto)
                        <div class="card mb-3 border-0 shadow" style="max-width: 1200px;">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="{{asset("storage/".$produto->imagem)}}" class="img-fluid rounded" style="height: 150px; object-fit: contain;">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title"><a href="{{url("/produto/".$produto->id)}}">{{$produto->nome}}</a></h5>
                                        <p class="card-text text-truncate">{{$produto->descricao}}</p>
                                        <div class="d-flex">
                                            <form action="{{url("/carrinho/update")}}" method="POST">
                                                @csrf
                                                @method("POST")
                                                <input type="text" name="id_produto" value="{{$produto->pid}}" hidden>
                                                <div class="dropdown">
                                                    <button class="btn border border-1 border-dark-subtle dropdown-toggle ms-1" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        {{$produto->qtd}}
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        @for ($i = 1; $i < $produto->pqtd; $i++)
                                                            <li>
                                                                <button class="dropdown-item" type="submit" name="quantidade" value="{{$i}}">
                                                                    {{$i}}
                                                                </button>
                                                            </li>
                                                            @if($i == 9)
                                                                @break
                                                            @endif
                                                        @endfor
                                                    </ul>
                                                </div>
                                            </form>
                                            <form action="{{url("/carrinho/del")}}" method="POST">
                                                @csrf
                                                @method("POST")
                                                <input type="text" name="id_produto" value="{{$produto->pid}} hidden" hidden>
                                                <button type="submit" class="btn btn-danger ms-3">Excluir</button>
                                            </form>
                                            <p class="card-text ms-auto">
                                                <small class="fw-bold">
                                                    R$ {{number_format($produto->preco,2,",",".")}}
                                                </small>
                                                <small>
                                                    (R$ {{number_format(($produto->preco * $produto->qtd),2,",",".")}})
                                                </small>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@endsection