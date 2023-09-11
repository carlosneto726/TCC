@extends('templates.template')
@section('content')
<div class="navbar navbar-expand-lg bg-dark w-100" data-bs-theme="dark" style="margin-top: -25px;">
    <div class="container">
        <ul class="navbar-nav">
            <a href="/chats/?orderby=data" class="text-decoration-none">
                <li class="nav-link  @if($orderby == 'data') active @endif">Data</li>
            </a>
            <a href="/chats/?orderby=ordem_alfabetica" class="text-decoration-none">
                <li class="nav-link  @if($orderby == 'ordem_alfabetica') active @endif">Ordem alfabética</li>
            </a>
        </ul>
    </div>
</div>

<div class="container">
    <div class="d-flex align-items-center p-3 my-3 rounded shadow-lg">
        <img class="me-3" src="{{asset("icons/chat.svg")}}" width="48" height="38">
        <div class="lh-1">
            <h1 class="h4 mb-0 lh-1">Seus Chats</h1>
            <small>@if(request("orderby")) Ordenado por <span class="fw-bold">"{{request("orderby")}}"</span> @endif</small>
        </div>
    </div>

    <form class="mt-3 d-flex" role="search" method="GET" action="/chats">
        <input class="form-control me-2 shadow" name="pesquisa" type="search" placeholder="Pesquise por um chat" aria-label="Search">
        <button class="btn btn-outline-success shadow" type="submit">Buscar</button>
    </form>
    
    @foreach ($chats as $chat)
        <a class="text-decoration-none" href="{{url("/chat/".$chat->chid)}}#footer">
            <div class="my-4 rounded p-3 bg-success text-light shadow">
                <span class="fs-4 fw-bold">@if(isset($_COOKIE['cooperativa'])) {{$chat->unome}} @elseif(isset($_COOKIE['usuario'])) {{$chat->cnome}} @endif</span>
            </div>
        </a>
    @endforeach

</div>

@endsection