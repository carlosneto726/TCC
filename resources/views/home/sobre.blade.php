@extends('templates.template')
@section('content')


<div class="container">
    <div class="d-flex align-items-center p-3 my-3 rounded shadow-lg">
        <img class="me-3" src="{{asset("icons/file-earmark-person.svg")}}" width="48" height="38">
        <div class="lh-1">
            <h1 class="h4 mb-0 lh-1">Sobre o site</h1>
        </div>
    </div>

    <main>
        <h1 class="text-body-emphasis">O que é cooperativasunidas.online?</h1>
        <p class="fs-5 col-md-8">
            A cooperativasunidas.online é fruto de um trabalho de TCC feito por <a href="https://portfolio-carlosneto726.vercel.app/" target="_blank">mim</a> cursando 
            Tecnologia e Análise em Desenvolvimento de Sistemas do <a href="https://www.ifg.edu.br/formosa/" target="_blank">IFG - Campus Formosa</a>
            com o objetivo de desenvolver uma plataforma digital para viabilizar o fornecimento dos serviços e produtos provenientes de 
            empreendimentos cooperativos da cidade de Formosa-GO para a população em geral. <br>
            <strong>O projeto ainda está em desenvolvimento, e nenhum produto, cooperativa ou usuário são reais.</strong>
            você pode ver mais informações sobre o projeto no <a href="https://github.com/carlosneto726/TCC/tree/main" target="_blank">repositório</a> do Github, 
            caso tenha visto algum erro ou queira entrar em contato, sinta-se livre para me enviar um <a href="mailto:carlosneto726@gmail.com">E-mail</a>.    
        </p>
    </main>
</div>

@endsection