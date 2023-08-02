@extends('templates.template')
@section('content')


<h2 class="text-center">Tipo de cadastro</h2>

<div class="p-5 mt-5 container rounded" style="background-color: var(--light-gray); width: fit-content;">
    <h4>Qual o seu tipo de cadastro?</h4> 

    <h6 class="mt-5 text-center">Quero me cadastrar como usuário comum</h6>
    <div class="d-flex justify-content-center">
        <a href="{{url("/cadastrar/usuario")}}" class="btn btn-cadastrar mt-2">Cadastrar como usuário comum</a>
    </div>
    
    <hr>

    <h6 class="text-center">Quero me cadastrar como cooperativa</h6>
    <div class="d-flex justify-content-center">
        <a href="{{url("/cadastrar/cooperativa")}}" class="btn btn-cadastrar mt-2">Cadastrar como cooperativa</a>
    </div>
</div>


<style>
.btn-cadastrar{
        background-color: #00FF33;
}
</style>

@endsection