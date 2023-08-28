@extends('templates.template')
@section('content')


<h2 class="text-center">Cadastro de usuário comum</h2>

<div class="container p-5 mx-auto rounded" style="background-color: var(--light-gray); width: fit-content;">
    <form class="hstack mx-auto" method="POST" action="/cadastrar/cooperativa" enctype="multipart/form-data">
        @csrf
        @method("POST")

        <div class="informacoes-basicas">
            <h4>Informações básicas</h4>

            <div class="mb-3">
                <label class="form-check-label" for="inputNome">Nome da cooperativa</label>
                <input type="text" name="nome" class="form-control" id="inputNome" placeholder="Digite o seu nome" required>
            </div>

            <div class="mb-3">
                <label for="inputEmail" class="form-label">E-mail</label>
                <input type="email" name="email" class="form-control" id="inputEmail" aria-describedby="emailHelp" placeholder="digite o seu e-mail" required>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <label class="form-check-label" for="inputCEP">CEP</label>
                    <input type="text" name="cep" id="cep" class="form-control" maxlength="8" placeholder="Digite o seu CEP" required onkeypress="return /[0-9]/i.test(event.key)" >
                </div>

                <div class="col">
                    <label class="form-check-label" for="inputEndereco">Endereço</label>
                    <input type="text" id="endereco" name="endereco" class="form-control" placeholder="Digite o seu endereço" required>
                </div>

            </div>

            <div class="mb-3">
                <label class="form-check-label" for="inputTipo">Tipo de cooperativa</label>
                <select class="form-select" name="tipo" id="inputTipo" aria-label="Tipo de cooperativa">
                    <option value="1">Agropecuárias</option>
                    <option value="2">Consumo</option>
                    <option value="3">Crédito</option>
                    <option value="4">Educacionais</option>
                    <option value="5">Especiais</option>
                    <option value="6">Habitacionais</option>
                    <option value="7">Minerais</option>
                    <option value="8">Produção</option>
                    <option value="9">Infraestrutura</option>
                    <option value="10">Trabalho</option>
                    <option value="11">Saúde</option>
                    <option value="12">Transporte</option>
                    <option value="13">Turismo e lazer</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="inputCNPJ" class="form-label">CNPJ</label>
                <input type="text" name="cnpj" class="form-control" maxlength="14" id="inputCNPJ" placeholder="Digite o seu CNPJ" required onkeypress="return /[0-9]/i.test(event.key)" >
            </div>

            <div class="mb-3">
                <label for="inputSenha" class="form-label">Senha</label>
                <input type="password" name="senha" class="form-control" id="inputSenha" placeholder="Digite a seu senha" required>
            </div>
        </div>

        <div class="contato ms-3 mb-auto">
            <h4>Contato</h4>

            <div class="row mb-3">
                <div class="col">
                    <label class="form-check-label" for="inputTel1">Telefone 1</label>
                    <input type="text" name="tel1" class="form-control" maxlength="20" id="inputTel1" placeholder="Digite o seu telefone principal" required onkeypress="return /[0-9]/i.test(event.key)" >
                </div>
                <div class="col">
                    <label class="form-check-label" for="inputTel2">Telefone 2</label>
                    <input type="text" name="tel2" class="form-control" id="inputTel2" placeholder="Digite o seu telefone secundário">
                </div>
            </div>


            <div class="row mb-3">
                <div class="col">
                    <label class="form-check-label" for="inputWhatsapp">Whatsapp</label>
                    <input type="text" name="whatsapp" class="form-control" id="inputWhatsapp" placeholder="URL">
                </div>
                <div class="col">
                    <label class="form-check-label" for="inputInstagram">Instagram</label>
                    <input type="text" name="instagram" class="form-control" id="inputInstagram" placeholder="URL">
                </div>
                <div class="col">
                    <label class="form-check-label" for="inputFacebook">Facebook</label>
                    <input type="text" name="facebook" class="form-control" id="inputFacebook" placeholder="URL">
                </div>
            </div>

            <div class="mb-3">
                <label for="inputTextarea">Descrição</label>
                <textarea class="form-control" name="descricao" placeholder="Digite um descrição sobre a sua cooperativa" id="inputTextarea" style="height: 100px"></textarea>
            </div>

            <div class="mb-3">
                <label for="formFile" class="form-label">Imagem de perfil</label>
                <input class="form-control" type="file" name="img" id="formFile">
            </div>

            <button type="submit" id="submit" class="btn btn-entrar mt-2">Cadastrar</button>
        </div>
    </form>    

</div>

<script src="{{asset("js/app.js")}}"></script>
  
<style>
.btn-entrar{
        background-color: #00FF33;
    }
</style>

@endsection
