@extends('templates.template')
@section('content')

<div class="container mb-3 p-3 rounded" style="background-color: var(--light-gray);">

    <div class="forum-info container p-3 rounded bg-light">
        <h1>{{$forum_info[0]->titulo}}</h1>
        <div class="descricao">
            <p>
                {{$forum_info[0]->fdescricao}}
            </p>
        </div>
        <div class="ms-auto" style="width: fit-content;">
            <a href="/cooperativa/{{$nome_cooperativa}}">{{$nome_cooperativa}}</a>
            <div class="vr"></div>
            {{$forum_info[0]->data}}
        </div>
    </div>
    
    <div class="mensagens p-3" id="mensagens-container">
        @php            
            function mostrarMensagens($comments, $indent = 0) {
                foreach ($comments as $message) {

                    echo "
                    <div class='rounded p-3' style='background-color: var(--light-green); margin-left: ".($indent * 55)."px;'>
                        <span>".$message['content']."</span>
                        <div class='d-flex'>
                            <a class='mt-2' href='#modal".$message['id']."' data-bs-toggle='modal' role='button' aria-controls='modal".$message['id']."'>Responder</a>
                            <div class='ms-auto' style='width: fit-content;'>
                                <div class='ms-auto' style='width: fit-content;'>
                                    <span style='font-size: 12px;'><a href='/cooperativa/".$message['author']."'>".$message['author']."</a></span>
                                    <div class='vr'></div>
                                    <span style='font-size: 12px;'>".$message['created']."</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br/>

                    <div class='modal fade' id='modal".$message['id']."' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                        <div class='modal-dialog'>
                            <div class='modal-content'>
                                <div class='modal-header'>
                                    <h1 class='modal-title fs-5' id='exampleModalLabel'>Responder comentário</h1>
                                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                </div>
                                <form action='".url("/api/coments")."' method='POST'>
                                    <div class='modal-body'>
                                        ".$message['content']."
                                        <hr>
                                        <div class='mb-3'>
                                            <input type='text' name='id_cooperativa' value='".$_COOKIE['cooperativa']."' hidden>                                            
                                            <input type='text' name='id_forum' value='".$message['id_forum']."' hidden>
                                            <input type='text' name='id_parent' value='".$message['id']."' hidden>
                                            <label for='resposta' class='form-label'>Resposta</label>
                                            <input type='text' name='comentario' class='form-control' id='resposta' required>
                                        </div>

                                    </div>
                                    <div class='modal-footer'>
                                        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Fechar</button>
                                        <button type='submit' class='btn btn-primary'>Enviar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    ";
                    mostrarMensagens($message['replies'], $indent + 1);
                }
            }
            mostrarMensagens($comments);
        @endphp

    </div>

    <form class="container p-3 d-flex" action="/api/coments" method="POST">
        @csrf
        @method("POST")
        <input type="text" name="id_cooperativa" value="{{$_COOKIE['cooperativa']}}" hidden>
        <input type="text" name="id_forum" value="{{$id_forum}}" hidden>
        <input type="text" name="id_parent" value="" hidden>
        <input class="form-control me-2" type="text" name="comentario" placeholder="Envie um comentário" required>
        <button class="btn btn-outline-success" type="submit">Enviar</button>
    </form>
</div>

@endsection