@extends('templates.template')
@section('content')

@if (isset($_COOKIE["cooperativa"]))
    <div class="container">
        <button class="btn btn-editar" data-bs-toggle="modal" data-bs-target="#perfilModal">Configurar perfil</button>
    </div>
    <!-- Modal para editar perfil -->
    @include('cooperativa.view.editarModal')
@endif

<!-- 
    =========================== Disponibilização de informações sobre cooperativas ===========================
-->
<!-- Imagem do outdoor -->
<img class="d-block container mx-auto m-5 img-fluid shadow-lg" src="{{asset("storage/".$cooperativa[0]->outdoor)}}">
<!-- Titulo -->
<h2 class="container text-center mt-5">Sobre a cooperativa</h2>
<!-- Container que engloba as informações sobre a cooperativa -->
<div class="container p-3 rounded" style="background-color: var(--light-gray);">
    @include('cooperativa.view.sobre')
</div>


<!-- 
    =========================== Produtos sobre cooperativas ===========================
-->

<!-- Titulo -->
<h3 class="mt-5 text-center">Produtos / serviços da Cooperativa </h3>
<!-- Container com todos os produtos da cooperativa -->
<div class="grid-container container mt-4 p-3 rounded">
    <!-- Caso o usuário logado seja um cooperando -->
    @if (isset($_COOKIE["cooperativa"]))
        <!-- Primeiro card da lista de produtos é um Modal para adicionar mais produtos -->
        <a class="p-1 w-100 h-100 rounded" data-bs-toggle="modal" href="#produtoModal">
            <div class="rounded card mb-3 w-100 h-100">
                <div class="mx-auto my-auto">
                    <img src="{{asset("icons/plus.svg")}}" style="width: 5rem;">
                </div>
            </div>
        </a>
        @include('cooperativa.produtos.adicionarModal')
    @endif
    <!-- Listando os produtos do banco de dados -->
    @foreach ($produtos as $produto)
        @include('cooperativa.produtos.card')
        @include('cooperativa.produtos.editarModal')
    @endforeach
</div>

<style>
    .grid-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        background-color: var(--light-gray);
    }

    .btn-editar{
        background-color: var(--light-green);
    }        
</style>

@endsection