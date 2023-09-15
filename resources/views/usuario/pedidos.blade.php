@extends('templates.template')
@section('content')

<div class="navbar navbar-expand-lg bg-dark w-100" data-bs-theme="dark" style="margin-top: -25px;">
    <div class="container">
        <ul class="navbar-nav">
            <a href="/chats/?orderby=data" class="text-decoration-none">
                <li class="nav-link">Data</li>
            </a>
            <a href="/chats/?orderby=ordem_alfabetica" class="text-decoration-none">
                <li class="nav-link">Ordem alfabética</li>
            </a>
        </ul>
    </div>
</div>

<div class="container">
    <div class="d-flex align-items-center p-3 my-3 rounded shadow-lg">
        <img class="me-3" src="{{asset("icons/card-checklist.svg")}}" width="48" height="38">
        <div class="lh-1">
            <h1 class="h4 mb-0 lh-1">Seus pedidos</h1>
            <small></small>
        </div>
    </div>

    @if(count($pedidos) == 0)
        <div class="d-flex align-items-center p-3 rounded shadow-lg">
            <div class="lh-1">
                <h1 class="h4 mb-0 lh-1">Você não tem nenhum pedido</h1>
                <small>Veja o nosso <a href="{{url("/")}}">catálogo</a>.</small>
            </div>
        </div>
    @endif

    @foreach ($pedidos as $pedido)

        <div class="my-3 p-3 bg-body rounded shadow">
            <h6 class="border-bottom pb-2 mb-0 d-flex">
                ID: {{$pedido->id}}

                <span class="ms-auto fw-bold mt-1">
                    @if($pedido->status == "1") 
                        <span class="text-success">CONCLUÍDO</span> 
                    @elseif($pedido->status == "2") 
                        <span class="text-danger">CANCELADO</span> 
                    @else 
                        <span class="text-warning">PENDENTE</span> 
                    @endif 
                </span>
                <a class="btn btn-success btn-sm ms-3" href="{{url("/pedidos/chat/".$pedido->id)}}">Chat</a>
            </h6>

            @foreach ($pedido->produtos as $produto)
                <div class="d-flex text-body-secondary border-bottom pt-3 pb-3">
                    <img src="{{asset("storage/".$produto->pimg)}}" class="bd-placeholder-img flex-shrink-0 me-2 rounded object-fit-contain" width="64" height="64">
                    <div class="pb-3 mb-0 small lh-sm w-100">
                        <div class="d-flex justify-content-between">
                            <a class="text-gray-dark fw-bold" href="{{url("/produto/".$produto->pid)}}">{{$produto->pnome}}</a>
                            <span>{{$produto->pqtd}} X R$ {{number_format($produto->ppreco,2,",",".")}} (R$ {{number_format(($produto->ppreco * $produto->pqtd),2,",",".")}})</span>
                        </div>
                        <a class="d-block" href="{{url("/cooperativa/".$produto->coopnome)}}">{{$produto->coopnome}}</a>
                    </div>
                </div>
            @endforeach

            
            <small class="d-flex justify-content-between mt-3">
                <span>{{$pedido->data}}</span>
                <strong>Preço total do pedido: R$ {{number_format($pedido->preco_total,2,",",".")}}</strong>
            </small>
        </div>

    @endforeach
    
</div>
@endsection