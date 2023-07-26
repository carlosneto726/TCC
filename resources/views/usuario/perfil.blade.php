@extends('templates.template')
@section('content')

<h2 class="text-center">Informações do usuário</h2>

<div class="container p-5 rounded" style="background-color: var(--light-gray);">
    <form method="POST" action="{{url("/usuario/atualizar")}}">
        @csrf
        @method("POST")
        <div class="mb-3">
            <label class="form-check-label" for="inputNome">Nome</label>
            <input type="text" name="nome" class="form-control" id="inputNome" value="{{$usuario->nome}}" placeholder="Digite o seu nome" required>
        </div>

        <div class="mb-3">
            <label for="inputEmail" class="form-label">E-mail</label>
            <input type="email" name="email" class="form-control" id="inputEmail" value="{{$usuario->email}}" aria-describedby="emailHelp" placeholder="digite o seu e-mail" required>
        </div>

        <div class="mb-3">
            <label class="form-check-label" for="inputCPF">CPF</label>
            <input type="text" name="cpf" class="form-control" id="inputCPF" value="{{$usuario->cpf}}" placeholder="Digite o seu CPF" required>
        </div>

        <div class="mb-3">
            <label class="form-check-label" for="inputCEP">CEP</label>
            <input type="text" name="cep" class="form-control" id="inputCEP" value="{{$usuario->cep}}" placeholder="Digite o seu CEP" required>
        </div>

        <div class="mb-3">
            <label class="form-check-label" for="inputEndereco">Endereço</label>
            <input type="text" name="endereco" class="form-control" id="inputEndereco" value="{{$usuario->endereco}}" placeholder="Digite o seu endereço" required>
        </div>

        <div class="mb-3">
            <label for="inputSenha" class="form-label">Senha</label>
            <input type="password" name="senha" class="form-control" id="inputSenha" placeholder="Digite a seu senha">
        </div>
        
        <button type="submit" class="btn mt-2" style="background-color: var(--light-green);">Atualizar</button>
    </form>

</div>
@endsection
