@extends('templates.template')
@section('content')


<div class="nav-scroller bg-dark shadow-sm" data-bs-theme="dark" style="margin-top: -19px;">
    <nav class="nav container" aria-label="Secondary navigation">
        <a class="nav-link text-decoration-none" href="{{url('/foruns/?orderby=comentarios')}}">Comentários</a>
        <a class="nav-link text-decoration-none" href="{{url('/foruns/?orderby=cooperativas')}}">Cooperativas</a>
        <a class="nav-link text-decoration-none" href="{{url('/foruns/?orderby=data')}}">Data</a>
        <a class="nav-link text-decoration-none" href="{{url('/foruns/?orderby=ordem_alfabetica')}}">Ordem alfabética</a>
        <a class="nav-link text-decoration-none" href="{{url('/foruns/?orderby=foruns_usuario')}}">Seus Fóruns</a>
        <a class="nav-link text-decoration-none" href="#forumModal" data-bs-toggle="modal">Criar um tópico</a>
    </nav>
</div>

<div class="container">
    <div class="d-flex align-items-center p-3 my-3 rounded shadow-lg">
        <img class="me-3" src="{{asset("icons/chat-left-text.svg")}}" width="48" height="38">
        <div class="lh-1">
            <h1 class="h4 mb-0 lh-1">Fóruns</h1>
            <small>@if(request("orderby")) Ordenado por <span class="fw-bold">"{{request("orderby")}}"</span> @endif</small>
        </div>
    </div>

    <form class="mt-3 d-flex" role="search" method="GET" action="{{url('/foruns')}}">
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
            <div class="bg-success text-light my-4 rounded p-2 shadow">
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
                    <button type="submit" class="btn btn-success">Criar Tópico</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection