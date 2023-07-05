@extends('templates.template')
@section('content')

<div class="container">
    <div class="hstack mx-auto">
        <div class="produto-container me-3 p-3 mb-auto">

            <div class="m-2">
                <img src="{{asset("icons/heart-fill.svg")}}"> Favoritar
            </div>

            <div class="d-flex align-items-center">
                <div class="flex-shrink-0">
                      <img class="item-img" src="{{asset("images/square-placeholder.png")}}">
                </div>
                <div class="flex-grow-1 ms-3 mb-auto">
                    <h3>Titulo do produto ({{$produto_id}})</h3>
                    <div class="ms-auto">
                        <img src="{{asset("icons/star-fill.svg")}}">
                        <img src="{{asset("icons/star-fill.svg")}}">
                        <img src="{{asset("icons/star-fill.svg")}}">
                        <img src="{{asset("icons/star.svg")}}">
                        <img src="{{asset("icons/star.svg")}}">
                        (0.000.000.000) Avaliações
                    </div>

                    <div>
                        Descrição do produto / serviço
                    </div>

                    <hr>

                    <div class="hstack">
                        <a href="{{url("/cooperativa?cooperativa_id=$produto_id")}}" class="text-decoration-none text-dark">
                            <img class="img-cooperativa" src="{{asset("images/square-placeholder.png")}}" alt="">
                            <span class="m-2">
                                Nome da cooperativa
                                <br>
                                Localização
                            </span>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    
        <div class="preco ms-auto mb-auto p-3">
            <h2>R$ 0.000.000,00</h2>
            <hr>
            <a class="btn mt-4 w-100" id="btn-comprar" href="#">Comprar</a>
        </div>
    </div>
</div>


<div class="container avaliacoes-container p-2 mt-5">

    <h3 class="container">Avaliações</h3>
    <div class="hstack mx-auto p-3">

        <div class="avaliacao mb-auto p-3">

            <button class="btn mt-2 mb-2 w-100" type="button" id="btn-comprar" data-bs-toggle="modal" data-bs-target="#avaliacaoModal">Avaliar</button>

            <div class="container nota p-2">
                <div class="mb-1">
                    Nota
                </div>
                <div class="ms-auto">
                    <span class="me-5">3</span>
                    <img src="{{asset("icons/star-fill.svg")}}">
                    <img src="{{asset("icons/star-fill.svg")}}">
                    <img src="{{asset("icons/star-fill.svg")}}">
                    <img src="{{asset("icons/star.svg")}}">
                    <img src="{{asset("icons/star.svg")}}">
                </div>

            </div>
        </div>


        <div class="comentarios-container me-3 p-3 mb-auto ms-auto">

            <div class="mt-2">
                <span class="fw-bold fs-5">Comentários</span>
            </div>

            <div class="m-2 comentario p-2">
                <h5>Titulo</h5>
                <p>
                    blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá 
                    blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá 
                    blá blá blá blá blá blá blá blá blá blá blá blá
                </p>
                <div class="d-flex">
                    <img src="{{asset("icons/thumbs-up.svg")}}">
                    <span>0.000.000</span>
                    <img src="{{asset("icons/thumbs-down.svg")}}">
                    <span>0.000.000</span>

                    <span class="fw-bold ms-auto">usuário 31/12/2023</span>
                </div>
            </div>
        </div>
    
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="avaliacaoModal" tabindex="-1" aria-labelledby="avaliacaoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <form action="">

                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="avaliacaoModalLabel">Avalie este produto / serviço</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <img class="img-cooperativa" src="{{asset("images/square-placeholder.png")}}">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5>Nome do produto ({{$produto_id}})</h5>
                        </div>
                    </div>
                    <div class="ms-auto">
                        <img src="{{asset("icons/star.svg")}}">
                        <img src="{{asset("icons/star.svg")}}">
                        <img src="{{asset("icons/star.svg")}}">
                        <img src="{{asset("icons/star.svg")}}">
                        <img src="{{asset("icons/star.svg")}}">
                    </div>
                    <div>
                        <div class="form-floating mt-2">
                            <textarea class="form-control" placeholder="blá blá blá" id="comentarioTextarea" style="height: 100px"></textarea>
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

    .produto-container{
        width: 80%;
        background-color: #B6B1B2;
    }

    .item-img{
        object-fit: contain;
        height: 250px;
    }

    .img-cooperativa{
        object-fit: contain;
        height: 75px;
    }
    
    .preco{
        width: 400px;
        background-color: #B6B1B2;
    }

    #btn-comprar{
        background-color: #00FF33;
    }

    .avaliacoes-container{
        background-color: var(--gray);
    }
    .avaliacao{
        background-color: var(--dark-green);
    }
    .nota{
        background-color: var(--light-gray);
    }

    .comentarios-container{
        background-color: var(--dark-green);
        color: white;
        width: 80%;

    }

    .comentario{
        background-color: var(--light-gray);
        color: black !important;
    }

    #avaliacaoModal .modal-dialog .modal-content{
        background-color: var(--dark-gray);
        color: white;
    }
</style>


@endsection