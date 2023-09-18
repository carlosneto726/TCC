@extends('templates.template')
@section('content')

<div class="nav-scroller bg-dark shadow-sm" data-bs-theme="dark" style="margin-top: -19px;">
    <nav class="nav container" aria-label="Secondary navigation">
        <a class="nav-link text-decoration-none" href="{{url('/chats/?orderby=data')}}">Data</a>
        <a class="nav-link text-decoration-none" href="{{url('/chats/?orderby=ordem_alfabetica')}}">Ordem alfabética</a>
    </nav>
</div>

<div class="container">
    <div class="d-flex align-items-center p-3 my-3 rounded shadow-lg">
        <img class="me-3" src="{{asset("icons/chat.svg")}}" width="48" height="38">
        <div class="lh-1">
            <h1 class="h4 mb-0 lh-1">Seus Chats</h1>
            <small>@if(request("orderby")) Ordenado por <span class="fw-bold">"{{request("orderby")}}"</span> @endif</small>
        </div>
    </div>

    <form class="mt-3 d-flex" role="search" method="GET" action="{{url('/chats')}}">
        <input class="form-control me-2 shadow" name="pesquisa" type="search" placeholder="Pesquise por um chat" aria-label="Search">
        <button class="btn btn-outline-success shadow" type="submit">Buscar</button>
    </form>

    @if(count($chats) == 0)
        <div class="d-flex align-items-center p-3 my-3 text-white bg-warning rounded shadow-sm">
            <img class="me-3" src="{{asset("icons/exclamation-triangle.svg")}}" width="48" height="38">
            <div class="lh-1">
                <h1 class="h4 mb-0 text-dark lh-1">Parce que achamos nenhum chat</h1>
            </div>
        </div>
    @endif
    
    @foreach ($chats as $chat)
        <a class="text-decoration-none" href="{{url("/chat/".$chat->chid)}}#footer">
            <div class="my-4 rounded p-3 bg-success text-light shadow">
                <span class="fs-4 fw-bold">@if(isset($_COOKIE['cooperativa'])) {{$chat->unome}} @elseif(isset($_COOKIE['usuario'])) {{$chat->cnome}} @endif</span>
            </div>
        </a>
    @endforeach

</div>

@endsection