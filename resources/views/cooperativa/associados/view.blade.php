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
            <h1 class="h4 mb-0 lh-1">Associados</h1>
            <small>@if(request("orderby")) Ordenado por <span class="fw-bold">"{{request("orderby")}}"</span> @endif</small>
        </div>
    </div>

    <!-- Botão para o modal para adicionar mais produtos -->
    <a data-bs-toggle="modal" href="#addAssociadoModal">
        <div class="d-flex p-3 my-3 rounded shadow">
            <img class="mx-auto" src="{{asset("icons/plus.svg")}}" width="48" height="38">
        </div>
    </a>

    @include('cooperativa.associados.adicionarAssociadoModal')

    @if(count($associados) == 0)
        <div class="d-flex align-items-center p-3 my-3 rounded shadow">
            <div class="lh-1">
                <h1 class="h4 mb-0 lh-1">Você ainda não tem nenhum associado</h1>
                <small>Adicione associados no simbolo de cruz acima</small>
            </div>
        </div>
    @endif

    @foreach ($associados as $associado)

        <div class="my-3 p-3 bg-body rounded shadow">
            <h6 class="border-bottom pb-2 mb-0">
                <div class="d-flex">
                    <span>ID: {{$associado->id}}</span>
                    <a class="btn btn-danger btn-sm ms-auto" href="#desassociar{{$associado->id}}" data-bs-toggle="modal">Desassociar</a>
                </div>
            </h6>
            
            <div class="d-flex text-body-secondary pt-3 border-bottom">
                <div class="pb-3 mb-0 small lh-sm w-100">
                    <div class="d-flex justify-content-between">
                        <strong class="text-gray-dark">{{$associado->nome}}</strong>
                        <div class="dropdown">
                            <button class="btn btn-success dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Produtos
                            </button>
                            <ul class="dropdown-menu">
                                @foreach ($associado->produtos as $produto)
                                    <li><a class="dropdown-item" href="{{url('produto/'.$produto->id)}}">{{$produto->nome}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <span class="d-block">{{$associado->email}}</span>
                </div>
            </div>
        </div>

        <!-- Modal para confirmar a Desassociação -->
        <div class="modal fade" id="desassociar{{$associado->id}}" tabindex="-1" aria-labelledby="addAssociadoModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="addAssociadoModalLabel">Desassociar</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <span class="h3">Você tem certeza que quer desassociar <span class="fw-bold">{{$associado->nome}}</span>?</span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não</button>
                        <a href="{{url('/remover/associado/'.$associado->id)}}" class="btn btn-danger">Sim</a>
                    </div>
                </div>
            </div>
        </div>

    @endforeach
</div>

@endsection