@extends('templates.template')
@section('content')


<h2 class="text-center">Cadastro de usuário comum</h2>

<div class="login-container container p-5">
    <form>

        <div class="mb-3">
            <label class="form-check-label" for="inputNome">Nome</label>
            <input type="text" class="form-control" id="inputNome" placeholder="Digite o seu nome">
        </div>

        <div class="mb-3">
            <label for="inputEmail" class="form-label">E-mail</label>
            <input type="email" class="form-control" id="inputEmail" aria-describedby="emailHelp" placeholder="digite o seu e-mail">
        </div>

        <div class="mb-3">
            <label class="form-check-label" for="inputCPF">CPF</label>
            <input type="text" class="form-control" id="inputCPF" placeholder="Digite o seu CPF">
        </div>

        <div class="mb-3">
            <label class="form-check-label" for="inputEndereco">Endereço</label>
            <input type="text" class="form-control" id="inputEndereco" placeholder="Digite o seu endereço">
        </div>

        <div class="mb-3">
            <label class="form-check-label" for="inputCEP">CEP</label>
            <input type="text" class="form-control" id="inputCEP" placeholder="Digite o seu CEP">
        </div>

        <div class="mb-3">
            <label for="inputSenha" class="form-label">Senha</label>
            <input type="password" class="form-control" id="inputSenha" placeholder="Digite a seu senha">
        </div>
        
        <button type="submit" class="btn btn-entrar mt-2">Cadastrar</button>
    </form>

</div>


<style>
.login-container{
    background-color: var(--gray);
}

.btn-entrar{
        background-color: #00FF33;
    }
</style>

@endsection