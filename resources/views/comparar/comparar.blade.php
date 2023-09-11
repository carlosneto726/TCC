@extends('templates.template')
@section('content')

<div class="container">
    <div class="d-flex align-items-center p-3 my-5 rounded shadow">
        <img class="me-3" src="{{asset("icons/sliders.svg")}}" width="48" height="38">
        <div class="lh-1">
            <h1 class="h4 mb-0 lh-1">Comparar</h1>
        </div>
    </div>

    <div class="row align-items-md-stretch">
        <div class="col-md-6">
            <div class="h-100 p-5 rounded-3 border-0 shadow">
                <div class="d-flex gap-3 py-3">
                    <img src="{{asset("storage/".$produto1[0]->imagem)}}" width="128" height="128" class="rounded-circle flex-shrink-0 object-fit-contain">
                    <div class="d-flex gap-2 w-100 justify-content-between">
                        <div>
                            <h2 class="mb-0">{{$produto1[0]->pnome}}</h2>
                            <p class="mb-0 opacity-75">{{$produto1[0]->pdesc}}</p>
                        </div>
                        <small class="text-nowrap fw-bold">R$ {{number_format($produto1[0]->preco,2,",",".")}}</small>
                    </div>
                </div>
                <h6 class="d-flex">
                    <div>
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
                    </div>
                    <div class="d-inline-flex p-1 rounded ms-auto mt-auto">
                        <img src="{{asset("icons/thumbs-up.svg")}}">
                        <span class="me-1">{{$produto1[0]->likes}}</span>
                        <img class="ms-1" src="{{asset("icons/thumbs-down.svg")}}">
                        <span>{{$produto1[0]->deslikes}}</span>
                    </div>
                </h6>
                <div class="list-group">
                    <a href="{{url("/cooperativa/".$produto1[0]->cnome)}}" class="list-group-item list-group-item-action d-flex gap-3 py-1 border-0" aria-current="true">
                        <img class="rounded-circle flex-shrink-0 object-fit-cover" src="{{asset("storage/".$produto1[0]->perfil)}}" width="64" height="64">
                        <div class="d-flex gap-2 w-100 justify-content-between">
                            <div>
                                <h6 class="mb-0">{{$produto1[0]->cnome}}</h6>
                                <p class="mb-0 opacity-75">{{$produto1[0]->endereco}}</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>


        <div class="col-md-6">
            <div class="h-100 p-5 rounded-3 border-0 shadow">
                <div class="d-flex gap-3 py-3">
                    <img src="{{asset("storage/".$produto2[0]->imagem)}}" width="128" height="128" class="rounded-circle flex-shrink-0 object-fit-contain">
                    <div class="d-flex gap-2 w-100 justify-content-between">
                        <div>
                            <h2 class="mb-0">{{$produto2[0]->pnome}}</h2>
                            <p class="mb-0 opacity-75">{{$produto2[0]->pdesc}}</p>
                        </div>
                        <small class="text-nowrap fw-bold">R$ {{number_format($produto2[0]->preco,2,",",".")}}</small>
                    </div>
                </div>
                <h6 class="d-flex">
                    <div>
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
                    </div>
                    <div class="d-inline-flex p-1 rounded ms-auto mt-auto">
                        <img src="{{asset("icons/thumbs-up.svg")}}">
                        <span class="me-1">{{$produto2[0]->likes}}</span>
                        <img class="ms-1" src="{{asset("icons/thumbs-down.svg")}}">
                        <span>{{$produto2[0]->deslikes}}</span>
                    </div>
                </h6>
                <div class="list-group">
                    <a href="{{url("/cooperativa/".$produto2[0]->cnome)}}" class="list-group-item list-group-item-action d-flex gap-3 py-1 border-0" aria-current="true">
                        <img class="rounded-circle flex-shrink-0 object-fit-cover" src="{{asset("storage/".$produto2[0]->perfil)}}" width="64" height="64">
                        <div class="d-flex gap-2 w-100 justify-content-between">
                            <div>
                                <h6 class="mb-0">{{$produto2[0]->cnome}}</h6>
                                <p class="mb-0 opacity-75">{{$produto2[0]->endereco}}</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>


</div>
@php
    session_unset();
@endphp

@endsection