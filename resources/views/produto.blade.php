@extends('templates.template')
@section('content')

<div class="container">
    <div class="hstack mx-auto">
        <div class="container me-3 p-3 mb-auto rounded" style="background-color: var(--light-gray);">

            <img src="{{asset("icons/heart-fill.svg")}}"> Favoritar

            <div class="d-flex align-items-center">
                <div class="flex-shrink-0">
                      <img class="item-img rounded" src="{{asset("storage/".$produto[0]->imagem)}}">
                </div>
                <div class="flex-grow-1 ms-3 mb-auto">
                    <h3>{{$produto[0]->pnome}}</h3>
                    <div class="d-flex">
                        <img src="{{asset("icons/thumbs-up.svg")}}">
                        <span class="me-3">{{$produto[0]->likes}}</span>
                        <img src="{{asset("icons/thumbs-down.svg")}}">
                        <span>{{$produto[0]->deslikes}}</span>
                    </div>
                    (quantidade de avaliações)

                    <p class="mt-3">
                        {{$produto[0]->pdescricao}}
                    </p>

                    <hr>

                    <div class="hstack">
                        <a href="{{url("/cooperativa?cooperativa_id=".$produto[0]->id_cooperativa)}}" class="text-decoration-none text-dark">
                            <img class="img-cooperativa rounded" src="{{asset("storage/".$produto[0]->perfil)}}" alt="">
                            <span class="m-2">
                                {{$produto[0]->cnome}}
                                <br>
                                {{$produto[0]->endereco}}
                            </span>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    
        <div class="ms-auto mb-auto p-3 rounded" style="background-color: var(--light-gray); width: 400px;">
            <h2>R$ {{number_format($produto[0]->preco,2,",",".")}}</h2>
            <hr>
            <a class="btn mt-4 w-100" id="btn-comprar" href="{{url("/carrinho/add?id_produto=".$id_produto)}}">Adicionar ao carrinho</a>
        </div>
    </div>
</div>


<div class="container p-2 mt-5 rounded" style="background-color: var(--light-gray);">

    <h3 class="container">Avaliações</h3>
    <div class="hstack mx-auto p-3">

        <div class="avaliacao mb-auto p-3 rounded" style="background-color: var(--green);">
            <button class="btn mt-1 mb-2 w-100" type="button" id="btn-comprar" data-bs-toggle="modal" data-bs-target="#avaliacaoModal">Avaliar produto</button>

            <div class="container nota p-2 rounded">
                <div class="d-flex">
                    <img src="{{asset("icons/thumbs-up.svg")}}">
                    <span>{{$produto[0]->likes}}</span>
                    <img class="ms-auto" src="{{asset("icons/thumbs-down.svg")}}">
                    <span>{{$produto[0]->deslikes}}</span>
                </div>

            </div>
        </div>


        <div class="container p-3 mb-auto rounded ms-3" style="background-color: var(--green);">

            <div class="mt-2">
                <span class="fw-bold fs-5">Comentários</span>
            </div>

            @if (count($comentarios) == 0)
                <h5 class="m-2 p-2 rounded" style="background-color: var(--light-gray); color: black !important;">
                    Parece que este produto ainda não tem avaliações. Seja o primerio a 
                    <a href="#avaliacaoModal" data-bs-toggle="modal">avaliar.</a>
                </h5>
            @else
                @foreach ($comentarios as $comentario)
                    <div class="m-2 p-2 rounded" style="background-color: var(--light-gray); color: black !important;">
                        <h5>{{$comentario->titulo}}</h5>
                        <p>
                            {{$comentario->comentario}}
                        </p>
                        <div class="d-flex">
                            <img src="{{asset("icons/thumbs-up.svg")}}">
                            <span class="me-3">{{$comentario->likes}}</span>
                            <img src="{{asset("icons/thumbs-down.svg")}}">
                            <span>{{$comentario->deslikes}}</span>

                            <span class="ms-auto">{{$comentario->nome}} | {{$comentario->data}}</|>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="avaliacaoModal" tabindex="-1" aria-labelledby="avaliacaoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <form action="{{url("/avaliar")}}" method="POST">
                @csrf
                @method("POST")

                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="avaliacaoModalLabel">Avalie este produto / serviço</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <img class="img-cooperativa" src="{{asset("storage/".$produto[0]->imagem)}}">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5>{{$produto[0]->pnome}} ({{$produto[0]->cnome}})</h5>
                        </div>
                    </div>
                    <div>
                        <input type="text" name="id_produto" value="{{$id_produto}}" hidden>
                        <div class="mt-2 form-check">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="avaliacao" id="inlineRadio1" value="like">
                                <label class="form-check-label" for="inlineRadio1">Like</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="avaliacao" id="inlineRadio2" value="deslike">
                                <label class="form-check-label" for="inlineRadio2">Deslike</label>
                            </div>
                        </div>
                        <div class="mt-2">
                            <label for="titulo">Escreva um título</label>
                            <input class="form-control" id="titulo" name="titulo" placeholder="Escreva um título sobre o seu comentário" required>
                        </div>
                        <div class="form-floating mt-2">
                            <textarea class="form-control" name="comentario" id="comentarioTextarea" style="height: 100px" required></textarea>
                            <label for="comentarioTextarea">Escreva um comentário</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn" id="btn-comprar">Enviar</button>
                </div>

            </form>

        </div>
    </div>
</div>




<style>


    .item-img{
        object-fit: contain;
        height: 250px;
    }

    .img-cooperativa{
        object-fit: contain;
        height: 75px;
    }

    #btn-comprar{
        background-color: #00FF33;
    }

</style>


@endsection

