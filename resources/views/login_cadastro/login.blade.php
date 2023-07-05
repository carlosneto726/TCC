@extends('templates.template')
@section('content')


<h2 class="text-center">Login</h2>

<div class="login-container p-5 mx-auto">
    <h4>Faça o seu login</h4> 

    <form method="POST" action="/login">
        @csrf
        @method("POST")
        <div class="mb-3">
            <label for="inputEmail" class="form-label">E-Mail</label>
            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="digite o seu e-mail">
        </div>

        <div class="mb-3">
            <label for="inputSenha" class="form-label">Senha</label>
            <input type="password" name="senha" class="form-control" id="inputSenha" placeholder="digite a sua senha">
        </div>
        
        <button type="submit" class="btn btn-entrar" name="tipo_login" value="usuario">Entrar como usuário</button>
        <button type="submit" class="btn btn-entrar" name="tipo_login" value="cooperativa">Entrar como cooperativa</button>
    </form>

    <hr style="width: 350px;">

    <div>
        <span class="fw-bold">Ainda não tem uma conta?</span>
    </div>

    <a href="{{url("/cadastro")}}" class="btn btn-entrar mt-2">Cadastre-se</a>

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