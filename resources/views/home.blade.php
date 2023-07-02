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


<div class="ofertas mt-5">
    <h4 class="titulo-container mx-auto">Ofertas do dia</h4>
    <div class="grid-container mx-auto p-3">

        @for ($i = 0; $i < 4; $i++)
            @include('templates.home_produto')
        @endfor
    
    </div>
</div>


<div class="categorias-populares mt-5">
    <h4 class="titulo-container mx-auto">Categorias populares</h4>

    <div class="mx-auto flex-container d-flex justify-content-center p-3">

        @for ($i = 0; $i < 10; $i++)
        
        <div class="flex-categoria p-3 ms-1 me-1">
            <img class="categoria-img img-fluid" src="{{asset("images/square-placeholder.png")}}">
        </div>
        

        @endfor

    </div>

</div>




<div class="produtos-mais-vendidos mt-5">
    <h4 class="titulo-container mx-auto">Produtos mais vendidos</h4>
    <div class="grid-container mx-auto p-3">

        @for ($i = 0; $i < 16; $i++)
            @include('templates.home_produto')
        @endfor
    
    </div>
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
        grid-template-columns: repeat(auto-fit, minmax(380px, 1fr));
        width: 85%;
        background-color: #B6B1B2;
    }

    .titulo-container {
        width: fit-content;
    }

    .flex-container {
        width: 85%;
        background-color: #B6B1B2;
    }

    .flex-categoria {
        background-color: #0A4400;        
    }

    .categoria-img{
        object-fit: contain;
    }

</style>

@endsection