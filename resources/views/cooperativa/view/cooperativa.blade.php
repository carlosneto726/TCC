@extends('templates.template')
@section('content')

@if (isset($_COOKIE["cooperativa"]))
    <div class="container">
        <button class="btn btn-success my-4 shadow" data-bs-toggle="modal" data-bs-target="#perfilModal">Configurar perfil</button>
    </div>
    <!-- Modal para editar perfil -->
    @include('cooperativa.view.editarModal')
@endif

<!-- 
    =========================== Disponibilização de informações sobre cooperativas ===========================
-->
<!-- Imagem do outdoor -->
@if($cooperativa[0]->outdoor != "")
    <img class="d-block container mx-auto m-5 img-fluid" src="{{asset("storage/".$cooperativa[0]->outdoor)}}">
@endif
<!-- Container que engloba as informações sobre a cooperativa -->
@include('cooperativa.view.sobre')

<!--
    =========================== Produtos sobre cooperativas ===========================
-->
<!-- Container com todos os produtos da cooperativa -->
<div class="grid-container container mt-4 rounded">
    <!-- Listando os produtos do banco de dados -->
    @foreach ($produtos as $produto)
        <a class="text-decoration-none text-dark @if($produto->quantidade <= 0 ) opacity-50 @endif" href="{{url("/produto/".$produto->id)}}">
            <div class="card m-1 rounded border-0 shadow">
                <!-- Imagem do produto com o botão de editar -->
                <img class="rounded card-img-top p-2" src="{{asset("storage/".$produto->imagem)}}" style="height: 200px; object-fit: contain;">
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
            </div>
        </a>
        @include('cooperativa.produtos.editarModal')
    @endforeach
</div>

<style>
    .grid-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    } 
</style>

@endsection