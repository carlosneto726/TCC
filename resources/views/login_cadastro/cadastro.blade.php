@extends('templates.template')
@section('content')


<h2 class="text-center">Tipo de cadastro</h2>

<div class="login-container p-5 mx-auto">
    <h4>Qual o seu tipo de cadastro?</h4> 

    <h6 class="mt-5">Quero me cadastrar como usuário comum</h6>
    
    <a href="{{url("/cadastro/usuario")}}" class="btn btn-entrar mt-2 mx-auto">Cadastrar como usuário comum</a>

    <hr style="width: 350px;">

    <h6>Quero me cadastrar como cooperativa</h6>
    <a href="{{url("/cadastro/cooperativa")}}" class="btn btn-entrar mt-2">Cadastrar como cooperativa</a>

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