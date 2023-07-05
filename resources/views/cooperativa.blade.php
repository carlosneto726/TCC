@extends('templates.template')
@section('content')

<div id="carouselAutoplaying" class="carousel carousel-dark slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="{{asset("images/square-placeholder.png")}}" class="carrosel-img d-block w-50 mx-auto" alt="...">
        </div>

        <div class="carousel-item">
            <img src="{{asset("images/horizontal-placeholder.png")}}" class="carrosel-img d-block w-50 mx-auto" alt="...">
        </div>

        <div class="carousel-item">
            <img src="{{asset("images/vertical-placeholder.png")}}" class="carrosel-img d-block w-50 mx-auto" alt="...">
        </div>

    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#carouselAutoplaying" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>

    <button class="carousel-control-next" type="button" data-bs-target="#carouselAutoplaying" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>


<h2 class="container text-center mt-5">Sobre a cooperativa</h2>
<div class="container sobre-container p-3">

    <div style="background-color: #f3f3f3;">
    
        <div class="p-5 mx-auto " style="width: 85%;">

            <div class="d-flex flex-row align-items-end mb-3">
                <img src="{{asset("icons/business.svg")}}" style="width: 64px;">
                <h3 class="ms-3">Cooperativa ({{$cooperativa_id}})</h3>
            </div>
            
            <h5>
                blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá 
                blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá 
                blá blá blá blá blá blá blá blá blá blá blá blá

            </h5>
        </div>

    </div>


    <div class="dark-container">

        <div class="p-5 mx-auto " style="width: 85%;">

            <div class="d-flex flex-row align-items-end mb-3">
                <img src="{{asset("icons/history.svg")}}" style="width: 64px;">
                <h3 class="ms-3">Histórico</h3>
            </div>
            
            <h5>
                blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá 
                blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá 
                blá blá blá blá blá blá blá blá blá blá blá blá
            </h5>
        </div>
        
    </div>


    <div style="background-color: white;">

        <div class="p-5 mx-auto " style="width: 85%;">

            <div class="d-flex flex-row align-items-end mb-3">
                <img src="{{asset("icons/missao.svg")}}" style="width: 64px;">
                <h3 class="ms-3">Missão</h3>
            </div>
            
            <h5>
                blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá 
                blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá 
                blá blá blá blá blá blá blá blá blá blá blá blá
            </h5>
        </div>
        
    </div>


    <div class="dark-container">

        <div class="p-5 mx-auto " style="width: 85%;">

            <div class="d-flex flex-row align-items-end mb-3">
                <img src="{{asset("icons/visao.svg")}}" style="width: 64px;">
                <h3 class="ms-3">Visão</h3>
            </div>
            
            <h5>
                blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá 
                blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá 
                blá blá blá blá blá blá blá blá blá blá blá blá
            </h5>
        </div>
        
    </div>

    <div style="background-color: white;">

        <div class="p-5 mx-auto " style="width: 85%;">

            <div class="d-flex flex-row align-items-end mb-3">
                <img src="{{asset("icons/valores.svg")}}" style="width: 64px;">
                <h3 class="ms-3">Valores</h3>
            </div>
            
            <h5>
                blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá 
                blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá 
                blá blá blá blá blá blá blá blá blá blá blá blá
            </h5>
        </div>
        
    </div>


    <div class="dark-container">

        <div class="p-5 mx-auto " style="width: 85%;">

            <div class="d-flex flex-row align-items-end mb-3">
                <img src="{{asset("icons/localization.svg")}}" style="width: 64px;">
                <h3 class="ms-3">Localização</h3>
            </div>
            
            <h5>
                blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá 
                blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá 
                blá blá blá blá blá blá blá blá blá blá blá blá
            </h5>
        </div>
        
    </div>


    <div style="background-color: white;">

        <div class="p-5 mx-auto " style="width: 85%;">

            <div class="d-flex flex-row align-items-end mb-3">
                <img src="{{asset("icons/contact.svg")}}" style="width: 64px;">
                <h3 class="ms-3">Contato</h3>
            </div>
            
            <h5>
                blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá 
                blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá 
                blá blá blá blá blá blá blá blá blá blá blá blá
            </h5>
        </div>
        
    </div>

</div>


<h3 class="mt-5 text-center">Produtos / serviços da Cooperativa {{$cooperativa_id}}</h3>

<div class="grid-container container mt-4 p-3">
    @for ($i = 0; $i < 7; $i++)
        @include('templates.produto_card')
    @endfor
</div>


<style>
    .carrosel-img {
        object-fit: contain;
        width: 100%;
        height: 275px;
    }

    .carousel {
        margin-top: 70px;
    }

    .grid-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(420px, 1fr));
        background-color: var(--light-gray);
    }

    .sobre-container{
        background-color: var(--light-gray);
    }

    .dark-container{
        background-color: var(--dark-green);
        color: white;
    }


</style>

@endsection