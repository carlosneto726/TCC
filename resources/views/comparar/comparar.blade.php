@extends('templates.template')
@section('content')

<h1 class="container fw-bold">Comparar</h1>
<hr class="container">

<div class="container hstack rounded" style="width: fit-content;">
    <div class="card m-1 rounded">
        <!-- Imagem do produto com o botão de editar -->
        <a class="text-decoration-none text-dark" href="{{url("/produto/".$produto1[0]->pid)}}">
            <img src="{{asset("storage/".$produto1[0]->imagem)}}" class="rounded card-img-top" style="height: 350px; object-fit: contain;">

            <div class="card-img-overlay" style="height: 350px;">

                <div class="d-flex" style="height: 350px;">
                    <div class="d-inline-flex p-1 rounded ms-auto mt-auto" style="background-color: white;">
                        <img src="{{asset("icons/thumbs-up.svg")}}">
                        <span class="me-1">{{$produto1[0]->likes}}</span>
                        <img class="ms-1" src="{{asset("icons/thumbs-down.svg")}}">
                        <span>{{$produto1[0]->deslikes}}</span>
                    </div>
                </div>    
            </div>

        
            <div class="card-body p-2 rounded">
                <!-- Iformações do produto -->
                <div class="w-100 text-truncate">
                    <span class="fs-3">{{$produto1[0]->pnome}}</span>
                </div>
                <div class="w-100">
                    <span class="fw-bold text-wrap">R$ {{number_format($produto1[0]->preco,2,",",".")}}</span>
                </div>
                <div class="w-100 text-truncate">
                    <span class="">{{$produto1[0]->descricao}}</span>
                </div>
                @if($produto1[0]->quantidade <= 0)
                    <span class="fw-bold text-danger"> NÃO POSSUI ESTOQUE </span>
                @else
                    <span class="fw-bold text-success"> EM ESTOQUE </span>
                @endif
                <br/>
                @if($produto1[0]->entrega) 
                    <span class="text-success fw-bold">ENTREGA DISPONIVEL</span> 
                @else 
                    <span class="text-danger fw-bold">ENTREGA INDISPONIVÉL</span> 
                @endif
                <br/>
                {{$produto1[0]->cnome}}
            </div>
        </a>
    </div>


    <div class="card m-1 rounded">
        <!-- Imagem do produto com o botão de editar -->
        <a class="text-decoration-none text-dark" href="{{url("/produto/".$produto2[0]->pid)}}">
            <img src="{{asset("storage/".$produto2[0]->imagem)}}" class="rounded card-img-top" style="height: 350px; object-fit: contain;">

            <div class="card-img-overlay" style="height: 350px;">

                <div class="d-flex" style="height: 350px;">
                    <div class="d-inline-flex p-1 rounded ms-auto mt-auto" style="background-color: white;">
                        <img src="{{asset("icons/thumbs-up.svg")}}">
                        <span class="me-1">{{$produto2[0]->likes}}</span>
                        <img class="ms-1" src="{{asset("icons/thumbs-down.svg")}}">
                        <span>{{$produto2[0]->deslikes}}</span>
                    </div>
                </div>    
            </div>

        
            <div class="card-body p-2 rounded">
                <!-- Iformações do produto -->
                <div class="w-100 text-truncate">
                    <span class="fs-3">{{$produto2[0]->pnome}}</span>
                </div>
                <div class="w-100">
                    <span class="fw-bold text-wrap">R$ {{number_format($produto2[0]->preco,2,",",".")}}</span>
                </div>
                <div class="w-100 text-truncate">
                    <span class="">{{$produto2[0]->descricao}}</span>
                </div>
                @if($produto2[0]->quantidade <= 0)
                    <span class="fw-bold text-danger"> NÃO POSSUI ESTOQUE </span>
                @else
                    <span class="fw-bold text-success"> EM ESTOQUE </span>
                @endif
                <br/>
                @if($produto2[0]->entrega) 
                    <span class="text-success fw-bold">ENTREGA DISPONIVEL</span> 
                @else 
                    <span class="text-danger fw-bold">ENTREGA INDISPONIVÉL</span> 
                @endif
                <br/>
                {{$produto2[0]->cnome}}
            </div>
        </a>
    </div>

</div>
@php
    session_unset();
@endphp

@endsection