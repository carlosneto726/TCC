@extends('templates.template')
@section('content')

<div class="container mb-3 p-3 rounded" style="background-color: var(--light-gray);">
    <h3 class="text-center">Fóruns</h3>

    <div class="hstack mx-auto">

        <div class="resumo me-2 mb-auto p-3 w-25">
            <h4>Ordernar por</h4>

            <ul class="list-group mt-4">
                <a href="/foruns/?orderby=comentarios" class="text-decoration-none">
                    <li class="list-group-item-success rounded-top list-group-item @if($orderby == 'comentarios') active" aria-current='true' @endif">Comentários</li>
                </a>
                <a href="/foruns/?orderby=cooperativas" class="text-decoration-none">
                    <li class="list-group-item-success list-group-item @if($orderby == 'cooperativas') active" aria-current='true' @endif">Cooperativas</li>
                </a>
                <a href="/foruns/?orderby=data" class="text-decoration-none">
                    <li class="list-group-item-success list-group-item @if($orderby == 'data') active" aria-current='true' @endif">Data</li>
                </a>
                <a href="/foruns/?orderby=ordem_alfabetica" class="text-decoration-none">
                    <li class="list-group-item-success list-group-item @if($orderby == 'ordem_alfabetica') active" aria-current='true' @endif">Ordem alfabética</li>
                </a>
                <a href="/foruns/?orderby=foruns_usuario" class="text-decoration-none">
                    <li class="list-group-item-success rounded-bottom list-group-item @if($orderby == 'foruns_usuario') active" aria-current='true' @endif">Seus Fóruns</li>
                </a>
            </ul>
    
            <!-- Button trigger modal -->
            <button type="button" class="btn mt-3" data-bs-toggle="modal" data-bs-target="#forumModal" style="background-color: var(--light-green);">
                Criar um tópico
            </button>
            
            <!-- Modal -->
            <div class="modal fade" id="forumModal" tabindex="-1" aria-labelledby="forumModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="forumModalLabel">Criar um tópico</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="POST" action="forum/adicionar_forum">
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


        </div>

        <div class="w-100">
            @foreach ($foruns as $forum)
                <a class="text-decoration-none" href="{{url("/forum/?forum=".$forum->fid)}}">
                    <div class="m-3 rounded p-2" style="background-color: var(--green); color: white;">
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

    </div>

</div>

@endsection