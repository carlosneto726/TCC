@extends('templates.template')
@section('content')

<h2 class="container">Seus pedidos</h2>

<div class="container mt-5">
    
    @foreach ($pedidos as $pedido)
        <div class="container p-3 mb-5 rounded" style="background-color: var(--light-gray);">
            <div class="d-flex m-2">
                <span class="me-2">ID: {{$pedido->id}}</span>                
                <span class="ms-auto fw-bold mt-1">
                    @if($pedido->status == "1") 
                        <span class="text-success">CONCLUÍDO</span> 
                    @elseif($pedido->status == "2") 
                        <span class="text-danger">CANCELADO</span> 
                    @else 
                        <span class="text-warning">PENDENTE</span> 
                    @endif 
                </span>
                <a class="btn btn btn-sm ms-3" href="{{url("/pedidos/chat/".$pedido->id)}}" style="background-color: var(--light-green);">Conversar</a>
            </div>
            @foreach ($pedido->produtos as $produto)
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="{{asset("storage/".$produto->pimg)}}" class="img-fluid rounded" style="height: 150px; object-fit: contain;">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{$produto->pnome}}</h5>
                                
                                <div class="d-flex">                                        
                                    {{$produto->pqtd}}
                                    <p class="card-text ms-auto">
                                        <small class="fw-bold">
                                            R$ {{number_format($produto->ppreco,2,",",".")}}
                                        </small>
                                        <small>
                                            (R$ {{number_format(($produto->ppreco * $produto->pqtd),2,",",".")}})
                                        </small>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="d-flex">
                <span class="me-auto">{{$pedido->data}}</span>
                <span class="ms-auto">Preço total do pedido: R$ {{number_format($pedido->preco_total,2,",",".")}}</span>                
            </div>
        </div>
    @endforeach
    
</div>

<style>
    #btn-comprar{
        background-color: #00FF33;
    }
</style>


@endsection