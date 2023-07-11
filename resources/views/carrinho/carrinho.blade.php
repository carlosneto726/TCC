@extends('templates.template')
@section('content')

<h2 class="container">Meu carrinho</h2>

<div class="container mt-5">
    <div class="hstack">
        <div class="container me-3 p-3 mb-auto rounded" style="background-color: var(--light-gray);">
            @if (count($produtos) == 0)
                <h5>Parece que você ainda não tem nenhum produto no carrinho. Veja o nosso <a href="{{url("/")}}">catálogo</a></h5>                
            @endif

            @foreach ($produtos as $produto)
                <div class="card mb-3" style="max-width: 1200px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="{{asset("storage/".$produto->imagem)}}" class="img-fluid rounded" style="height: 150px; object-fit: contain;">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{$produto->nome}}</h5>
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
                                                <li><button class="dropdown-item" type="submit" name="quantidade" value="1">1</button></li>
                                                <li><button class="dropdown-item" type="submit" name="quantidade" value="2">2</button></li>
                                                <li><button class="dropdown-item" type="submit" name="quantidade" value="3">3</button></li>
                                                <li><button class="dropdown-item" type="submit" name="quantidade" value="4">4</button></li>
                                                <li><button class="dropdown-item" type="submit" name="quantidade" value="5">5</button></li>
                                                <li><button class="dropdown-item" type="submit" name="quantidade" value="6">6</button></li>
                                                <li><button class="dropdown-item" type="submit" name="quantidade" value="7">7</button></li>
                                                <li><button class="dropdown-item" type="submit" name="quantidade" value="8">8</button></li>
                                                <li><button class="dropdown-item" type="submit" name="quantidade" value="9">9</button></li>
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
    
        <div class="resumo ms-auto mb-auto p-3 rounded w-50" style="background-color: var(--light-gray);">
            <h2>Resumo do pedido</h2>
            <div class="d-flex mt-4">
                <div class="flex-grow-1">({{$quantidade_produtos}}) Itens</div> 
                <div class="">Preço total: R$ {{number_format($total,2,",",".")}}</div> 
            </div>
            <hr>
            <div class="d-flex mt-4">
                <div class="flex-grow-1">Total</div> 
                <div class="">preço total</div> 
            </div>
            <form action="{{url("/carrinho/finalizar")}}" method="POST">
                @csrf
                @method("POST")
                <button class="btn mt-4 w-100" id="btn-comprar" type="submit">Comprar</button>
            </form>
        </div>

    </div>

</div>


<style>



    #btn-comprar{
        background-color: #00FF33;
    }

</style>


@endsection