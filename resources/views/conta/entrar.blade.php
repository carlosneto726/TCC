@extends('templates.template')
@section('content')

<h2 class="text-center">Login</h2>

<div class="p-5 mx-auto container rounded" style="width: fit-content; background-color: var(--light-gray);">
    <h4>Faça o seu login</h4> 

    <form method="POST" action="{{url("/entrar")}}">
        @csrf
        @method("POST")
        <div class="mb-3">
            <label for="inputEmail" class="form-label">E-Mail</label>
            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="digite o seu e-mail" required>
        </div>

        <div class="mb-3">
            <label for="inputSenha" class="form-label">Senha</label>
            <input type="password" name="senha" class="form-control" id="inputSenha" placeholder="digite a sua senha" required>
        </div>
        
        <button type="submit" class="btn btn-entrar" name="tipo_login" value="usuario">Entrar como usuário</button>
        <button type="submit" class="btn btn-entrar" name="tipo_login" value="cooperativa">Entrar como cooperativa</button>
    </form>

    <hr>
    <div>
        <h6 class="fw-bold text-center">Ainda não tem uma conta?</h6>
        <a class="btn btn-entrar mt-2 w-100" href="{{url("/cadastrar")}}" style="background-color: light-green;">Cadastre-se</a>
    </div>

</div>

<style>
.btn-entrar{
        background-color: var(--light-green);
    }
</style>

@endsection