@extends('templates.template')
@section('content')


<h2 class="text-center">Cadastro de usuário comum</h2>

<div class="container p-5 rounded" style="background-color: var(--light-gray);">
    <form method="POST" action="{{url("/cadastrar/usuario")}}">
        @csrf
        @method("POST")
        <div class="mb-3">
            <label class="form-check-label" for="inputNome">Nome</label>
            <input type="text" name="nome" class="form-control" id="inputNome" placeholder="Digite o seu nome" required>
        </div>

        <div class="mb-3">
            <label for="inputEmail" class="form-label">E-mail</label>
            <input type="email" name="email" class="form-control" id="inputEmail" aria-describedby="emailHelp" placeholder="digite o seu e-mail" required>
        </div>

        <div class="mb-3">
            <label class="form-check-label" for="inputCPF">CPF</label>
            <input type="text" name="cpf" class="form-control" id="inputCPF" placeholder="Digite o seu CPF" required>
        </div>

        <div class="mb-3">
            <label class="form-check-label" for="inputCEP">CEP</label>
            <input type="text" name="cep" id="cep" class="form-control" maxlength="9" placeholder="Digite o seu CEP" required>
            <div class="form-text">Não sabe o seu CEP? descubra <a href="http://cep.la/" target="_blank">aqui</a>.</div>
        </div>

        <div class="mb-3">
            <label class="form-check-label" for="inputEndereco">Endereço</label>
            <input type="text" name="endereco" id="endereco" class="form-control" placeholder="Digite o seu endereço completo" required>
        </div>

        <div class="mb-3">
            <label for="inputSenha" class="form-label">Senha</label>
            <input type="password" name="senha" class="form-control" id="inputSenha" placeholder="Digite a seu senha" required>
        </div>
        
        <button type="submit" id="submit" class="btn mt-2" style="background-color: var(--light-green);">Cadastrar</button>
    </form>

</div>

<script src="{{asset("js/app.js")}}"></script>
@endsection
