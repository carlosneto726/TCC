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







<!-- Titulo -->
<h3 class="mt-5 text-center">Produtos em destaque</h3>
<!-- Container com todos os produtos da cooperativa -->
<div class="grid-container rounded container mt-4 p-3" style="background-color: var(--light-gray);">
    <!-- Listando os produtos do banco de dados -->
    @foreach ($produtos as $produto)
        <!-- Card dos produtos -->
        <div class="card m-1 rounded">
            <!-- Imagem do produto com o botão de editar -->
            <img src="{{asset("storage/".$produto->imagem)}}" class="rounded card-img-top" style="height: 200px; object-fit: contain;">

            <div class="card-img-overlay" style="height: 200px;">

                <div class="d-flex" style="height: 170px;">
                    <div class="">
                        @if (!isset($_COOKIE["cooperativa"]))
                            <img class="me-1" src="{{asset("icons/heart-fill.svg")}}">        
                        @endif
                        <small class="text-dark bg-white p-1 rounded">QTD: {{$produto->quantidade}}</small>
                    </div>
    

                    <div class="d-inline-flex p-1 rounded ms-auto mt-auto" style="background-color: white;">
                        <img src="{{asset("icons/thumbs-up.svg")}}">
                        <span class="me-1">{{$produto->likes}}</span>
                        <img class="ms-1" src="{{asset("icons/thumbs-down.svg")}}">
                        <span>{{$produto->deslikes}}</span>
                    </div>
                </div>    
            </div>

            <a class="text-decoration-none text-dark" href="{{url("/produto?id_produto=".$produto->id)}}">
                <div class="card-body p-2 rounded">
                    <!-- Iformações do produto -->
                    <div class="w-100 text-truncate">
                        <span class="fs-3">{{$produto->nome}}</span>
                    </div>
                    <div class="w-100">
                        <span class="fw-bold text-wrap">R$ {{number_format($produto->preco,2,",",".")}}</span>
                    </div>
                    <div class="w-100 text-truncate">
                        <span class="">{{$produto->descricao}}</span>
                    </div>
                </div>
            </a>
        </div>
    @endforeach
</div>


<div class="mt-5">
    <h3 class="mt-5 text-center">Categorias</h3>
    <div class="container mx-auto d-flex justify-content-center p-3 mt-4 rounded" style="background-color: var(--light-gray);">
        @for ($i = 0; $i < 10; $i++)
        
            <div class="flex-categoria p-3 ms-1 me-1">
                <img class="categoria-img img-fluid" src="{{asset("images/square-placeholder.png")}}">
            </div>
        
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
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    }

</style>

@endsection