@extends('templates.template')
@section('content')

<div class="navbar navbar-expand-lg bg-dark w-100" data-bs-theme="dark" style="margin-top: -25px;">
    <div class="container-fluid">
        <ul class="navbar-nav">
            <a href="/foruns/?orderby=comentarios" class="text-decoration-none">
                <li class="nav-link @if($orderby == 'comentarios') active" aria-current='true' @endif">Comentários</li>
            </a>
            <a href="/foruns/?orderby=cooperativas" class="text-decoration-none">
                <li class="nav-link @if($orderby == 'cooperativas') active" aria-current='true' @endif">Cooperativas</li>
            </a>
            <a href="/foruns/?orderby=data" class="text-decoration-none">
                <li class="nav-link @if($orderby == 'data') active" aria-current='true' @endif">Data</li>
            </a>
            <a href="/foruns/?orderby=ordem_alfabetica" class="text-decoration-none">
                <li class="nav-link @if($orderby == 'ordem_alfabetica') active" aria-current='true' @endif">Ordem alfabética</li>
            </a>
            <a href="/foruns/?orderby=foruns_usuario" class="text-decoration-none">
                <li class="nav-link @if($orderby == 'foruns_usuario') active" aria-current='true' @endif">Seus Fóruns</li>
            </a>
            <a class="text-decoration-none" href="#forumModal" data-bs-toggle="modal">
                <li class="nav-link">Criar um tópico</li>
            </a>
        </ul>
    </div>
</div>


<div class="container">
    <div class="d-flex align-items-center p-3 my-3 rounded shadow-lg">
        <img class="me-3" src="{{asset("icons/chat-left-text.svg")}}" width="48" height="38">
        <div class="lh-1">
            <h1 class="h4 mb-0 lh-1">Fóruns</h1>
            <small>@if(request("orderby")) Ordenado por <span class="fw-bold">"{{request("orderby")}}"</span> @endif</small>
        </div>
    </div>

    <form class="mt-3 d-flex" role="search" method="GET" action="/foruns">
        <input class="form-control me-2 shadow" name="pesquisa" type="search" placeholder="Pesquise por um fórum" aria-label="Search">
        <button class="btn btn-outline-success shadow" type="submit">Buscar</button>
    </form>
    
    @if(count($foruns) == 0)
        <div class="d-flex align-items-center p-3 my-3 text-white bg-warning rounded shadow-sm">
            <img class="me-3" src="{{asset("icons/exclamation-triangle.svg")}}" width="48" height="38">
            <div class="lh-1">
                <h1 class="h4 mb-0 text-dark lh-1">Parce que achamos nenhum fórum</h1>
                <small><a href="#forumModal" data-bs-toggle="modal">Que tal criar um?</a></small>
            </div>
        </div>
    @endif

    @foreach ($foruns as $forum)
        <a class="text-decoration-none" href="{{url("/forum/?forum=".$forum->fid)}}">
            <div class="my-4 rounded p-2 shadow" style="background-color: var(--green); color: white;">
                <span class="fs-4 fw-bold">{{$forum->titulo}}</span>

                <div class="d-flex flex-row mb-3">
                    <div>{{$forum->fdescricao}}</div>
                    <div class="ms-auto" style="width: fit-content;">{{$forum->nome}}</div>
                    <div class="vr ms-2 me-2"></div>
                    <div style="width: fit-content;">{{$forum->data}}</div>
                </div>
            </div>
        </a>
    @endforeach

</div>




<!-- Modal -->
<div class="modal fade" id="forumModal" tabindex="-1" aria-labelledby="forumModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="forumModalLabel">Criar um tópico</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{url("/forum/adicionar_forum")}}">
                @csrf
                @method("POST")
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Titulo do tópico</label>
                        <input type="text" class="form-control" name="titulo" placeholder="Digite em poucas palavras o título do tópico">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Descrição do tópico</label>
                        <input type="text" class="form-control" name="descricao" placeholder="Digite um descrição explicando melhor o assunto">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn" style="background-color: var(--light-green);">Criar</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection