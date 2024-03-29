@extends('templates.template')
@section('content')
<div class="container">

    <div class="d-flex align-items-center p-3 my-3 rounded shadow-lg">
        <img class="me-3" src="{{asset("icons/person-circle.svg")}}" width="48" height="38">
        <div class="lh-1">
            <h1 class="h4 mb-0 lh-1">Suas Informações</h1>
        </div>
    </div>

    <div class="rounded mt-5">
        <form class="row g-3 needs-validation" method="POST" action="{{url("/usuario/atualizar")}}">
            @csrf
            @method("POST")
            <div class="mb-3">
                <label class="form-check-label" for="inputNome">Nome</label>
                <input type="text" name="nome" class="form-control shadow" id="inputNome" value="{{$usuario->nome}}" placeholder="Digite o seu nome" required>
            </div>

            <div class="mb-3">
                <label for="inputEmail" class="form-label">E-mail</label>
                <input type="email" name="email" class="form-control shadow" id="inputEmail" value="{{$usuario->email}}" aria-describedby="emailHelp" placeholder="digite o seu e-mail" required>
            </div>

            <div class="mb-3">
                <label class="form-check-label" for="inputCPF">CPF</label>
                <input type="text" name="cpf" class="form-control shadow" id="inputCPF" value="{{$usuario->cpf}}" placeholder="Digite o seu CPF" required>
            </div>

            <div class="mb-3 col-md-6">
                <label class="form-check-label" for="CEP">CEP</label>
                <input type="text" name="cep" class="form-control shadow" id="CEP" value="{{$usuario->cep}}" placeholder="Digite o seu CEP" required>
            </div>

            <div class="mb-3 col-md-6">
                <label class="form-check-label" for="endereco">Endereço</label>
                <input type="text" name="endereco" class="form-control shadow" id="endereco" value="{{$usuario->endereco}}" placeholder="Digite o seu endereço" required>
            </div>

            <div class="mb-3">
                <label for="inputSenha" class="form-label">Senha</label>
                <div class="input-group">
                    <input type="password" class="form-control shadow" placeholder="Senha" id="inputSenha" name="senha" required>
                    <input type="checkbox" class="btn-check" id="btn-check" autocomplete="off" onclick="verSenha()">
                    <label class="btn btn-outline-secondary shadow h-50" for="btn-check"><img src="{{asset("icons/eye.svg")}}" width="16" height="16"></label>
                </div>
            </div>
            
            <div class="col-md-4">
                <button type="submit" class="btn btn-success mt-2 shadow">Atualizar</button>
            </div>
        </form>
    </div>

</div>

<script src="{{asset("js/cadastro.js")}}"></script>
@endsection
