@extends('templates.template')
@section('content')

    <h2 class="titulo-pagina mx-auto">Exibindo resultados para "<span class="fw-bold">{{$pesquisa}}"</span></h2>

    <div class="carrinho-container mx-auto">
        <div class="hstack mx-auto">

            <div class="resumo me-5 mb-auto p-3">
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
            
            <div class="grid-categoria container me-3 p-3 mb-auto">
                @for ($i = 0; $i < 7; $i++)
                    @include('templates.produto_card')
                @endfor
            </div>
        </div>
    </div>


<style>

    .titulo-pagina{
        width: 85%;
    }

    .carrinho-container{
        width: 85%;
    }

    .grid-categoria {
        width: 95%;
        background-color: var(--gray);
        display: grid;
        grid-template-columns: auto auto auto auto;
    }

    .carrinho-item{
        width: 100%;
        margin-top: 10px;
        margin-bottom: 10px;
        background-color: #009241;
        color: black;
    }

    .item-img{
        object-fit: contain;
        height: 100%;
    }

    .img-container{
        height: 100%;
        width: 500px;
    }
    
    .item-info{
        height: 100%;
        width: 100%;
    }

    .resumo{
        width: 400px;
        background-color: #B6B1B2;
    }

    #btn-comprar{
        background-color: #00FF33;
    }

</style>


@endsection