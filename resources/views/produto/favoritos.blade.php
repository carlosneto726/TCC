@extends('templates.template')
@section('content')
<div class="navbar navbar-expand-lg bg-body-tertiary w-100" style="margin-top: -25px; background-color: var(--light-gray);">
    <div class="container-fluid">
        <ul class="navbar-nav">
            <a href="{{url("/favoritos?orderby=preco")}}" class="text-decoration-none">
                <li class="nav-link @if($orderby == 'preco') active" aria-current='true' @endif">Preço</li>
            </a>
            <a href="{{url("/favoritos?orderby=avaliacao-produto")}}" class="text-decoration-none">
                <li class="nav-link @if($orderby == 'avaliacao-produto') active" aria-current='true' @endif">Avaliação do produto</li>
            </a>
            <a href="{{url("/favoritos?orderby=cooperativa")}}" class="text-decoration-none">
                <li class="nav-link @if($orderby == 'cooperativa') active" aria-current='true' @endif">Cooperativa</li>
            </a>
            <a href="{{url("/favoritos?orderby=localizacao")}}" class="text-decoration-none">
                <li class="nav-link @if($orderby == 'localizacao') active" aria-current='true' @endif">Localização</li>
            </a>
        </ul>
    </div>
</div>

<div class="container">
    <div class="d-flex align-items-center p-3 my-3 rounded shadow-lg">
        <img class="me-3" src="{{asset("icons/heart-fill.svg")}}" width="48" height="38">
        <div class="lh-1">
            <h1 class="h4 mb-0 lh-1">Seus favoritos</h1>
            <small>@if(request("orderby")) Ordenado por <span class="fw-bold">"{{request("orderby")}}"</span> @endif</small>
        </div>
    </div>

    <div class="grid-container">
        @foreach ($produtos as $produto)
            <!-- Card dos produtos -->
            <div class="card m-1 rounded border-0 shadow">
                <!-- Imagem do produto com o botão de editar -->
                <img src="{{asset("storage/".$produto->imagem)}}" class="rounded card-img-top" style="height: 200px; object-fit: contain;">
    
                <div class="card-img-overlay" style="height: 200px;">
    
                    <div class="d-flex" style="height: 170px;">
                        <a href="{{url("/produto/".$produto->pid."/favoritar/".$produto->fid)}}" class="text-decoration-none text-dark">
                            <img src="{{asset("icons/heart-fill.svg")}}">
                        </a>
        
    
                        <div class="d-inline-flex p-1 rounded ms-auto mt-auto" style="background-color: white;">
                            <img src="{{asset("icons/thumbs-up.svg")}}">
                            <span class="me-1">{{$produto->likes}}</span>
                            <img class="ms-1" src="{{asset("icons/thumbs-down.svg")}}">
                            <span>{{$produto->deslikes}}</span>
                        </div>
                    </div>    
                </div>
    
                <a class="text-decoration-none text-dark" href="{{url("/produto/".$produto->pid)}}">
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

<style>
    .grid-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    }
</style>

@endsection