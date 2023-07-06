@extends('templates.template')
@section('content')

@if (isset($_COOKIE["cooperativa"]))

    <div class="container">
        <button class="btn btn-editar" data-bs-toggle="modal" data-bs-target="#perfilModal">Configurar perfil</button>
    </div>

    <!-- Modal para editar perfil -->
    <div class="modal fade" id="perfilModal" tabindex="-1" aria-labelledby="perfilModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="/atualizar/cooperativa" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method("POST")
    
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="perfilModalLabel">Editar perfil</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        
                        <div class="mb-3">
                            <label for="inputNome" class="form-label">Nome da cooperativa</label>
                            <input type="text" class="form-control" value="{{@$cooperativa[0]->nome}}" name="nome" id="inputNome" placeholder="Digite o nome da sua cooperativa">
                        </div>
                        <div class="mb-3 form-floating">
                            <textarea class="form-control" value="{{@$cooperativa[0]->descricao}}" name="descricao" placeholder="descricao" id="descricaoTextarea" style="height: 100px"></textarea>
                            <label for="descricaoTextarea">Descrição</label>
                        </div>
                        <div class="mb-3 form-floating">
                            <textarea class="form-control" name="historico" placeholder="historico" id="descricaoTextarea" style="height: 100px">{{@$cooperativa[0]->historico}}</textarea>
                            <label for="descricaoTextarea">Histórico</label>
                        </div>
                        <div class="mb-3 form-floating">
                            <textarea class="form-control" name="missao" placeholder="missao" id="descricaoTextarea" style="height: 100px">{{@$cooperativa[0]->missao}}</textarea>
                            <label for="descricaoTextarea">Missão</label>
                        </div>
                        <div class="mb-3 form-floating">
                            <textarea class="form-control" name="visao" placeholder="visao" id="descricaoTextarea" style="height: 100px">{{@$cooperativa[0]->visao}}</textarea>
                            <label for="descricaoTextarea">Visão</label>
                        </div>
                        <div class="mb-3 form-floating">
                            <textarea class="form-control" name="valores" placeholder="valores" id="descricaoTextarea" style="height: 100px">{{@$cooperativa[0]->valores}}</textarea>
                            <label for="descricaoTextarea">Valores</label>
                        </div>
                        <div class="mb-3 form-floating">
                            <textarea class="form-control" name="endereco" placeholder="localizacao" id="descricaoTextarea" style="height: 100px">{{@$cooperativa[0]->endereco}}</textarea>
                            <label for="descricaoTextarea">Localização</label>
                        </div>
                        <div class="mb-3">
                            <label for="inputCEP" class="form-label">CEP</label>
                            <input type="text" class="form-control" value="{{@$cooperativa[0]->cep}}" name="cep" id="inputCEP" placeholder="Digite o CEP da sua cooperativa">
                        </div>
                        <div class="mb-3">
                            <label for="inputTel1" class="form-label">Telefone 1</label>
                            <input type="text" class="form-control" value="{{@$cooperativa[0]->tel1}}" name="tel1" id="inputTel1" placeholder="Digite o telefone da sua cooperativa">
                        </div>
                        <div class="mb-3">
                            <label for="inputTel2" class="form-label">Telefone 2</label>
                            <input type="text" class="form-control" value="{{@$cooperativa[0]->tel2}}" name="tel2" id="inputTel2" placeholder="Digite um telefone secundário da sua cooperativa">
                        </div>
                        <div class="mb-3">
                            <label for="inputWhatsApp" class="form-label">WhatsApp</label>
                            <input type="text" class="form-control" value="{{@$cooperativa[0]->whatsapp}}" name="whatsapp" id="inputWhatsApp" placeholder="Digite a URL">
                        </div>
                        <div class="mb-3">
                            <label for="inputInstagram" class="form-label">Instagram</label>
                            <input type="text" class="form-control" value="{{@$cooperativa[0]->instagram}}" name="instagram" id="inputInstagram" placeholder="Digite a URL">
                        </div>
                        <div class="mb-3">
                            <label for="inputFacebook" class="form-label">Facebook</label>
                            <input type="text" class="form-control" value="{{@$cooperativa[0]->facebook}}" name="facebook" id="inputFacebook" placeholder="Digite a URL">
                        </div>
                        <div class="mb-3">
                            <label for="formFileMultiple" class="form-label">Alterar imagem de perfil</label>
                            <input class="form-control" type="file" name="perfil" id="formFileMultiple">
                        </div>
                        <div class="mb-3">
                            <label for="formFileMultiple" class="form-label">Alterar do Outdoor</label>
                            <input class="form-control" type="file" name="outdoor" id="formFileMultiple">
                        </div>
    
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Adicionar</button>
                    </div>
    
                </form>
            </div>
        </div>
    </div>
@endif


<!-- Imagem do outdoor -->
<img src="{{asset("storage/".$cooperativa[0]->outdoor)}}" class="d-block container mx-auto m-5 img-fluid">

<!-- 
    =========================== Disponibilização de informações sobre cooperativas ===========================
-->
<!-- Titulo -->
<h2 class="container text-center mt-5">Sobre a cooperativa</h2>
<!-- Container que engloba as informações sobre a cooperativa -->
<div class="container sobre-container p-3">
    <!-- Descrição da cooperativa -->
    <div class="bg-light mb-2">
        <div class="p-5 mx-auto " style="width: 85%;">
            <div class="d-flex flex-row align-items-end mb-3">
                <img src="{{asset("storage/".$cooperativa[0]->perfil)}}" style="width: 64px;">
                <h3 class="ms-3">{{@$cooperativa[0]->nome}}</h3>
            </div>
            <h5>
                {{@$cooperativa[0]->descricao}}
            </h5>
        </div>
    </div>
    <!-- Endereço da cooperativa -->
    @if (@$cooperativa[0]->endereco)
    <div class="bg-light mb-2">
        <div class="p-5 mx-auto " style="width: 85%;">
            <div class="d-flex flex-row align-items-end mb-3">
                <img src="{{asset("icons/localization.svg")}}" style="width: 64px;">
                <h3 class="ms-3">Localização</h3>
            </div>
            <h5>
                {{@$cooperativa[0]->endereco}}
                <br>
                CEP: {{@$cooperativa[0]->cep}}
            </h5>
        </div>
    </div>
    @endif

    <!-- Contato da cooperativa -->
    @if (@$cooperativa[0]->tel1)
    <div class="bg-light mb-2">
        <div class="p-5 mx-auto " style="width: 85%;">
            <div class="d-flex flex-row align-items-end mb-3">
                <img src="{{asset("icons/contact.svg")}}" style="width: 64px;">
                <h3 class="ms-3">Contato</h3>
            </div>
            <h5>
                Telefone 1: {{@$cooperativa[0]->tel1}} <br>
                @if (@$cooperativa[0]->tel2)
                    Telefone 2: {{@$cooperativa[0]->tel2}} <br>
                @endif

                @if (@$cooperativa[0]->whatsapp)
                    <a href="{{@$cooperativa[0]->whatsapp}}">WhatsApp</a> <br>    
                @endif

                @if (@$cooperativa[0]->instagram)
                    <a href="{{@$cooperativa[0]->instagram}}">Instagram</a> <br>    
                @endif

                @if (@$cooperativa[0]->facebook)
                    <a href="{{@$cooperativa[0]->facebook}}">Facebook</a> <br>                    
                @endif

            </h5>
        </div>
    </div>
    @endif

    <!-- Listando as outras informções caso tenha no bando de dados -->
    @php
        $infos = array(@$cooperativa[0]->historico, @$cooperativa[0]->missao, @$cooperativa[0]->visao, @$cooperativa[0]->valores);
        $icons = array("icons/history.svg", "icons/missao.svg", "icons/visao.svg", "icons/valores.svg");
        $titulo = array("Histórico", "Missão", "Visão", "Valores");
    @endphp

    @for ($i = 0; $i < 4; $i++)

        @if ($infos[$i])
            <div class="bg-light mb-2">
                <div class="p-5 mx-auto " style="width: 85%;">
                    <div class="d-flex flex-row align-items-end mb-3">
                        <img src="{{asset($icons[$i])}}" style="width: 64px;">
                        <h3 class="ms-3">{{$titulo[$i]}}</h3>
                    </div>
                    <h5>
                        {{$infos[$i]}}
                    </h5>
                </div>
            </div>
        @endif
        
    @endfor
</div>


<!-- 
    =========================== Disponibilização de informações sobre cooperativas ===========================
-->

<!-- Titulo -->
<h3 class="mt-5 text-center">Produtos / serviços da Cooperativa </h3>

<!-- Container com todos os produtos da cooperativa -->
<div class="grid-container container mt-4 p-3">

    <!-- Caso o usuário logado seja um cooperando -->
    @if (isset($_COOKIE["cooperativa"]))
        <!-- Primeiro card da lista de produtos é um Modal para adicionar mais produtos -->
        <a class="p-1 w-100 h-100" data-bs-toggle="modal" href="#produtoModal">
            <div class="rounded-0 card mb-3 w-100 h-100" style="background-color: var(--green);">
                <div class="mx-auto my-auto">
                    <img src="{{asset("icons/plus.svg")}}" style="width: 5rem;">
                </div>
            </div>
        </a>
    @endif

    <!-- Listando os produtos do banco de dados -->
    @foreach ($produtos as $produto)
        <!-- Card dos produtos -->
        <div class="card m-1 rounded">
            <div class="card-body p-2 card-produto-body">
                <!-- Imagem do produto com o botão de editar -->
                <img src="{{asset("storage/".$produto->imagem)}}" class="rounded-0 card-img-top" alt="placeholder">

                <div class="card-img-overlay">
                    @if (isset($_COOKIE["cooperativa"]))
                        <button type="button" class="btn btn-editar" data-bs-toggle="modal" data-bs-target="#produtoModal{{$produto->id}}">Editar</button>
                    @endif
                </div>

                <!-- Iformações do produto -->
                <div class="hstack">
                    <div>
                        <div class="w-100">
                            <span class="fs-4 text-wrap">{{$produto->nome}}</span>
                        </div>
                        <div class="w-100">
                            <span class="fw-bold text-wrap">R$ {{number_format($produto->preco,2,",",".")}}</span>
                        </div>
                        <div class="w-100">
                            <span class="text-wrap">{{$produto->descricao}}</span>
                        </div>
                    </div>
        
                    <div class="ms-auto mb-auto">
                        @if (!isset($_COOKIE["cooperativa"]))
                            <img class="me-1" src="{{asset("icons/heart-fill.svg")}}"> Favoritar <br>
                        @endif
                        <div class="ms-auto">
                            @for ($i = 0; $i < 5; $i++)
                                @if ($i >= $produto->estrelas)
                                    <img src="{{asset("icons/star.svg")}}">
                                @else
                                    <img src="{{asset("icons/star-fill.svg")}}">
                                @endif
                            @endfor
                        </div>

                        @if (isset($_COOKIE["cooperativa"]))
                            <small class="">QTD: {{$produto->quantidade}}</small>
                        @endif

                    </div>
                </div>
            </div>
        </div>

        <!-- Modal para editar produtos -->
        <div class="modal fade" id="produtoModal{{$produto->id}}" tabindex="-1" aria-labelledby="produtoModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <form action="/atualizar/produto" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method("POST")

                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="adicionarProdutoModalLabel">Adicionar um produto</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="text" name="id" value="{{$produto->id}}" hidden>
                            <div class="mb-3">
                                <label for="inputNome" class="form-label">Nome do produto</label>
                                <input type="text" class="form-control" name="nome" id="inputNome" value="{{$produto->nome}}">
                            </div>
                            <div class="form-floating">
                                <textarea class="form-control" name="descricao" value="{{$produto->descricao}}" id="descricaoTextarea" style="height: 100px"></textarea>
                                <label for="descricaoTextarea">Descrição</label>
                            </div>
                            <div class="mb-3">
                                <label for="inputPreco" class="form-label">Preço</label>
                                <input type="text" class="form-control" name="preco" id="inputPreco" value="{{$produto->preco}}">
                            </div>
                            <div class="mb-3">
                                <label for="inputQuantidade" class="form-label">Quantidade</label>
                                <input type="text" class="form-control" name="quantidade" id="inputQuantidade" value="{{$produto->quantidade}}" aria-describedby="quantidadeHelp">
                                <div id="quantidadeHelp" class="form-text">Caso seja um serviço, pode deixar em branco.</div>
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Insira uma imagem do produto</label>
                                <input class="form-control" type="file" name="imagem" id="formFile">
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary" name="acao" value="atualizar">Atualizar</button>
                            <button type="submit" class="btn btn-danger" name="acao" value="deletar">Deletar</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    @endforeach
</div>


<!-- Modal para adicionar produtos -->
<div class="modal fade" id="produtoModal" tabindex="-1" aria-labelledby="produtoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/cadastrar/produto" method="POST" enctype="multipart/form-data">
                @csrf
                @method("POST")

                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="adicionarProdutoModalLabel">Editar um produto</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    
                    <div class="mb-3">
                        <label for="inputNome" class="form-label">Nome do produto</label>
                        <input type="text" class="form-control" name="nome" id="inputNome" placeholder="Digite o nome do seu produto / serviço">
                    </div>
                    <div class="form-floating">
                        <textarea class="form-control" name="descricao" placeholder="Digite uma breve descrição do seu produto / serviço" id="descricaoTextarea" style="height: 100px"></textarea>
                        <label for="descricaoTextarea">Descrição</label>
                      </div>
                    <div class="mb-3">
                        <label for="inputPreco" class="form-label">Preço</label>
                        <input type="text" class="form-control" name="preco" id="inputPreco" placeholder="Digite o nome do seu produto / serviço">
                    </div>
                    <div class="mb-3">
                        <label for="inputQuantidade" class="form-label">Quantidade</label>
                        <input type="text" class="form-control" name="quantidade" id="inputQuantidade" placeholder="Insira a quantidade do seu produto" aria-describedby="quantidadeHelp">
                        <div id="quantidadeHelp" class="form-text">Caso seja um serviço, pode deixar em branco.</div>
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Insira uma imagem do produto</label>
                        <input class="form-control" type="file" name="imagem" id="formFile">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Adicionar</button>
                </div>

            </form>
        </div>
    </div>
</div>


<style>
    .carrosel-img {
        object-fit: contain;
        width: 100%;
        height: 275px;
    }

    .carousel {
        margin-top: 70px;
    }

    .grid-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(420px, 1fr));
        background-color: var(--light-gray);
    }

    .sobre-container{
        background-color: var(--light-gray);
    }

    .btn-editar{
        background-color: #00FF33;
    }
            
    .card-produto-body{
        background-color: var(--green) !important;
        color: black !important;
    }

    .cooperativa-img {
        object-fit: contain;
        width: 75px;

    }
        
</style>

@endsection