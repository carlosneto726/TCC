@extends('templates.template')
@section('content')

<div class="container">
    <div class="forum-info container p-3 rounded shadow mb-4">
        <h1>{{$forum_info[0]->titulo}}</h1>
        <div class="descricao">
            <p>
                {{$forum_info[0]->fdescricao}}
            </p>
        </div>
        <div class="ms-auto" style="width: fit-content;">
            <a href="{{url("/cooperativa/".$nome_cooperativa)}}">{{$nome_cooperativa}}</a>
            <div class="vr"></div>
            {{$forum_info[0]->data}}
        </div>
    </div>
    
    @php
        function mostrarMensagens($comments, $indent = 0) {
            foreach ($comments as $message) {
                echo "
                <div class='bg-success text-light rounded shadow p-3' style='margin-left: ".($indent * 55)."px;'>
                    <span class='fw-bold'>".$message['content']."</span>
                    <div class='d-flex'>
                        <a class='mt-2 text-light' href='#modal".$message['id']."' data-bs-toggle='modal' role='button' aria-controls='modal".$message['id']."'>Responder</a>
                        <div class='ms-auto' style='width: fit-content;'>
                            <div class='ms-auto' style='width: fit-content;'>
                                <span style='font-size: 12px;'><a class='text-light' href='/cooperativa/".$message['author']."'>".$message['author']."</a></span>
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

    <form class="d-flex" action="{{url("/api/coments")}}" method="POST">
        @csrf
        @method("POST")
        <input type="text" name="id_cooperativa" value="{{$_COOKIE['cooperativa']}}" hidden>
        <input type="text" name="id_forum" value="{{$id_forum}}" hidden>
        <input type="text" name="id_parent" value="" hidden>
        <input class="form-control me-2 shadow" type="text" name="comentario" placeholder="Envie um comentário" required>
        <button class="btn btn-outline-success shadow" type="submit">Enviar</button>
    </form>
</div>

@endsection