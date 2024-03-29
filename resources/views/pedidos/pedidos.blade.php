@extends('templates.template')
@section('content')

<div class="nav-scroller bg-dark shadow-sm" data-bs-theme="dark" style="margin-top: -19px;">
    <nav class="nav container" aria-label="Secondary navigation">
        <a class="nav-link text-decoration-none" id="filterCancelado" href="#">Cancelado</a>
        <a class="nav-link text-decoration-none" id="filterConcluido" href="#">Concluído</a>
    </nav>
</div>

<div class="container">
    <div class="input-group my-3 rounded shadow-lg">
        <input type="text" class="form-control" placeholder="Ex: Fulano da Silva" id="pesquisa" aria-label="Example text with button addon" aria-describedby="button-addon1">
        <button class="btn btn-outline-success" type="button" id="button-addon1" onclick="filtrarPedidos()">Pesquisar</button>
    </div>
    

    <div class="d-flex align-items-center p-3 my-3 rounded shadow-lg">
        <img class="me-3" src="{{asset("icons/hourglass-split.svg")}}" width="48" height="38">
        <div class="lh-1">
            <h1 class="h4 mb-0 lh-1">Pedidos Pendentes</h1>
            <small></small>
        </div>
    </div>

    @if(count($pedidos_pendentes) == 0)
        <div class="d-flex align-items-center p-3 my-3 rounded shadow-lg">
            <div class="lh-1">
                <h1 class="h5 mb-0 lh-1">Você não possui nenhum pedido pendente</h1>
                <small>Recarregue a pagina ou clique <a href="{{url("/pedidos/cooperativa")}}">aqui</a></small>
            </div>
        </div>
    @endif

    @foreach ($pedidos_pendentes as $pedido)

        <div class="my-3 p-3 bg-body rounded shadow order">
            <h6 class="border-bottom pb-2 mb-0">
                <div class="d-flex">
                    <span>ID: {{$pedido->id}}</span>
                    <a class="btn btn-success btn-sm ms-auto" href="{{url("/pedidos/concluir?id_pedido=".$pedido->id)}}">Concluir pedido</a>
                    <a class="btn btn-danger btn-sm ms-1" href="{{url("/pedidos/cancelar?id_pedido=".$pedido->id)}}">Cancelar pedido</a>
                </div>
            </h6>

            @foreach ($pedido->produtos as $produto)
                <div class="d-flex text-body-secondary pt-3 border-bottom">
                    <img 
                    src="{{asset("storage/".$produto->pimg)}}" 
                    class="bd-placeholder-img flex-shrink-0 me-2 rounded object-fit-contain mb-2" 
                    width="64" 
                    height="64">
                    <div class="pb-3 mb-0 small lh-sm w-100">
                        <div class="d-flex justify-content-between">
                            <strong class="text-gray-dark">{{$produto->pnome}}</strong>
                            <strong>
                                R$ {{number_format($produto->ppreco,2,",",".")}} X {{$produto->pqtd}} (R$ {{number_format(($produto->ppreco * $produto->pqtd),2,",",".")}})
                            </strong>
                        </div>
                        <span class="d-block">Estoque: {{$produto->pestoque}}</span>
                    </div>
                </div>
            @endforeach

            <small class="d-flex mt-3">
                <span><a class="client-name" href="{{url("/pedidos/chat/usuario/".$pedido->id)}}">{{$pedido->nome_usuario}}</a> | {{$pedido->data}}</span>
                <strong class="ms-auto">Total: R${{number_format($pedido->preco_total,2,",",".")}}</strong>
            </small>
        </div>
    @endforeach


    <hr> <!-- =============================================================================================================== -->

    <div class="d-flex align-items-center p-3 my-3 rounded shadow-lg">
        <img class="me-3" src="{{asset("icons/check.svg")}}" width="48" height="38">
        <div class="lh-1">
            <h1 class="h4 mb-0 lh-1">Pedidos Encerrados</h1>
            <small></small>
        </div>
    </div>

    @if(count($pedidos_concluidos) == 0)
        <div class="d-flex align-items-center p-3 my-3 rounded shadow-lg">
            <div class="lh-1">
                <h1 class="h5 mb-0 lh-1">Você ainda não possui nenhum pedido encerrado</h1>
            </div>
        </div>
    @endif

    @foreach ($pedidos_concluidos as $pedido)

        <div class="my-3 p-3 bg-body rounded shadow order">
            <h6 class="border-bottom pb-2 mb-0">
                <div class="d-flex">
                    <span>ID: {{$pedido->id}}</span>
                    <span class="ms-auto fw-bold status">@if($pedido->status == "1") CONCLUÍDO @elseif($pedido->status == "2") CANCELADO @endif</span>
                </div>
            </h6>

            @foreach ($pedido->produtos as $produto)
                <div class="d-flex text-body-secondary pt-3 border-bottom">
                    <img src="{{asset("storage/".$produto->pimg)}}" class="bd-placeholder-img flex-shrink-0 me-2 rounded object-fit-contain mb-2 opacity-25" width="64" height="64">
                    <div class="pb-3 mb-0 small lh-sm w-100">
                        <div class="d-flex justify-content-between">
                            <strong class="text-gray-dark">{{$produto->pnome}}</strong>
                            <strong>
                                R$ {{number_format($produto->ppreco,2,",",".")}} X {{$produto->pqtd}} (R$ {{number_format(($produto->ppreco * $produto->pqtd),2,",",".")}})
                            </strong>
                        </div>
                        <span class="d-block">Estoque: {{$produto->pestoque}}</span>
                    </div>
                </div>
            @endforeach

            <small class="d-flex mt-3">
                <span><a class="client-name" href="{{url("/pedidos/chat/usuario/".$pedido->id)}}">{{$pedido->nome_usuario}}</a> | {{$pedido->data}}</span>
                <strong class="ms-auto">Total: R${{number_format($pedido->preco_total,2,",",".")}}</strong>
            </small>
        </div>

        
    @endforeach
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const orders = document.querySelectorAll('.order');
        
        function filterOrders(filterType) {
            orders.forEach(order => {
                const status = order.querySelector('.status').innerText.toLowerCase();
                
                if (filterType === 'todos' || status.includes(filterType)) {
                    order.style.display = 'block';
                } else {
                    order.style.display = 'none';
                }
            });
        }

        document.getElementById('filterCancelado').addEventListener('click', () => filterOrders('cancelado'));
        document.getElementById('filterConcluido').addEventListener('click', () => filterOrders('concluído'));
    });


    function filtrarPedidos() {
        const orders = document.querySelectorAll('.order');
        var nomeFiltro = document.getElementById("pesquisa").value.toLowerCase();
        //var nomeFiltro = document.getElementById('filtroNome').value.toUpperCase();

        orders.forEach(order => {
            const name = order.querySelector('.client-name').innerText.toLowerCase();
            if (nomeFiltro === 'todos' || name.includes(nomeFiltro)) {
                order.style.display = 'block';
            } else {
                order.style.display = 'none';
            }
        });
    }

</script>

@endsection