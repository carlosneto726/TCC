@extends('templates.template')
@section('content')

    <h2 class="container">Exibindo resultados para "<span class="fw-bold">{{$pesquisa}}"</span></h2>

    <div class="container mt-5">
        <div class="hstack mx-auto">

            <div class="me-3 mb-auto p-3 rounded" style="width: 350px; background-color: var(--light-gray);">
                <h2>Ordernar por</h2>
                <div class="mt-4">
                    <span>preço</span> <br>
                    <span>avaliação do produto</span> <br> 
                    <span>avaliação da cooperativa</span> <br>
                    <span>cooperativa</span> <br>
                    <span>categoria</span> <br>
                    <span>localização</span> <br>
                </div>
            </div>
            
            <div class="grid-container container p-3 mb-auto rounded" style="background-color: var(--light-gray);">
                @foreach ($produtos as $produto)
                    <!-- Card dos produtos -->
                    <div class="card m-1 rounded">
                        <!-- Imagem do produto com o botão de editar -->
                        <img src="{{asset("storage/".$produto->imagem)}}" class="rounded card-img-top" style="height: 200px; object-fit: contain;">
            
                        <div class="card-img-overlay" style="height: 200px;">
            
                            <div class="d-flex" style="height: 170px;">
                                <div>
                                    @if (!isset($_COOKIE["cooperativa"]))
                                        <img class="me-1" src="{{asset("icons/heart-fill.svg")}}">        
                                    @endif
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
        </div>
    </div>


<style>

    .grid-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    }

    #btn-comprar{
        background-color: #00FF33;
    }

</style>


@endsection