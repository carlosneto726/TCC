@extends('templates.template')
@section('content')


<h2 class="text-center">Cadastro de usuário comum</h2>

<div class="login-container p-5 mx-auto">
    <form class="hstack mx-auto" method="POST" action="/cadastro/cooperativa">
        @csrf
        @method("POST")

        <div class="informacoes-basicas">

            <h4>Informações básicas</h4>

            <div class="mb-3">
                <label class="form-check-label" for="inputNome">Nome da cooperativa</label>
                <input type="text" name="nome" class="form-control" id="inputNome" placeholder="Digite o seu nome">
            </div>

            <div class="mb-3">
                <label for="inputEmail" class="form-label">E-mail</label>
                <input type="email" name="email" class="form-control" id="inputEmail" aria-describedby="emailHelp" placeholder="digite o seu e-mail">
            </div>

            <div class="row mb-3">
                <div class="col">
                    <label class="form-check-label" for="inputCEP">CEP</label>
                    <input type="text" name="cep" class="form-control" id="inputCEP" placeholder="Digite o seu CEP">
                </div>
                <div class="col">
                    <label class="form-check-label" for="inputEndereco">Endereço</label>
                    <input type="text" name="endereco" class="form-control" id="inputEndereco" placeholder="Digite o seu endereço">
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
                <input type="text" name="cnpj" class="form-control" id="inputCNPJ" placeholder="Digite o seu CNPJ">
            </div>

            <div class="mb-3">
                <label for="inputSenha" class="form-label">Senha</label>
                <input type="password" name="senha" class="form-control" id="inputSenha" placeholder="Digite a seu senha">
            </div>

        </div>


        <div class="contato ms-3 mb-auto">
            <h4>Contato</h4>

            <div class="row mb-3">
                <div class="col">
                    <label class="form-check-label" for="inputTel1">Telefone 1</label>
                    <input type="text" name="tel1" class="form-control" id="inputTel1" placeholder="Digite o seu telefone principal">
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


            <button type="submit" class="btn btn-entrar mt-2">Cadastrar</button>
        </div>
    </form>    

</div>


<style>
.login-container{
    background-color: var(--gray);
    width: fit-content;
}

.btn-entrar{
        background-color: #00FF33;
    }
</style>

@endsection
