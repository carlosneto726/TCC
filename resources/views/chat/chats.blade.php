@extends('templates.template')
@section('content')

<div class="container mb-3 p-3 rounded" style="background-color: var(--light-gray);">
    <h3 class="text-center">Chats</h3>
    <form class="mt-3 d-flex" role="search" method="GET" action="/chats">
        <input class="form-control me-2" name="pesquisa" type="search" placeholder="Pesquise por um fórum" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Buscar</button>
    </form>

    <div class="hstack mx-auto">

        <div class="resumo me-2 mb-auto p-3 w-25">
            <h4>Ordernar por</h4>
            <ul class="list-group mt-4">
                <a href="/chats/?orderby=data" class="text-decoration-none">
                    <li class="rounded-top list-group-item-success list-group-item @if($orderby == 'data') active" aria-current='true' @endif">Data</li>
                </a>
                <a href="/chats/?orderby=ordem_alfabetica" class="text-decoration-none">
                    <li class="rounded-bottom list-group-item-success list-group-item @if($orderby == 'ordem_alfabetica') active" aria-current='true' @endif">Ordem alfabética</li>
                </a>
            </ul>
        </div>

        <div class="w-100">
            @foreach ($chats as $chat)
                <a class="text-decoration-none" href="{{url("/chat/?chat=".$chat->chid)}}#footer">
                    <div class="m-3 rounded p-2" style="background-color: var(--green); color: white;">
                        <span class="fs-4 fw-bold">@if(isset($_COOKIE['cooperativa'])) {{$chat->unome}} @elseif(isset($_COOKIE['usuario'])) {{$chat->cnome}} @endif</span>

                        <div class="d-flex flex-row mb-3">
                            <div class="ms-auto" style="width: fit-content;">Data</div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

    </div>

</div>

@endsection