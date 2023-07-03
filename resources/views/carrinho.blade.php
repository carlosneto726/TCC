@extends('templates.template')
@section('content')

<h2 class="titulo-pagina mx-auto">Meu carrinho</h2>

<div class="carrinho-container mx-auto">
    <div class="horizontal-stack hstack mx-auto">
        <div class="lista-itens me-3 p-3 mb-auto">

            <div class="d-flex">
                <div class="flex-grow-1 ms-3 fs-5">produto</div> 
                <div class="me-3">quantidade</div> 
                <div class="me-3">preço</div> 
            </div>
            
            @for ($i = 0; $i < 3; $i++)
                        
                <div class="carrinho-item hstack">
                    <div class="img-container m-1 p-2">
                        <img class="item-img img-fluid" src="{{asset("images/square-placeholder.png")}}">
                    </div>
    
                    <div class="d-flex w-100">
                        <div class="flex-grow-1">produto</div> 
                        <div class="me-3">quantidade</div> 
                        <div class="me-3">preço</div> 
                    </div>
                </div>
    
            @endfor
        </div>
    
        <div class="resumo ms-auto mb-auto p-3">
            <h2>Resumo do pedido</h2>
            <div class="d-flex mt-4">
                <div class="flex-grow-1">2 Produtos</div> 
                <div class="">preço total produtos</div> 
            </div>
            <div class="d-flex">
                <div class="flex-grow-1">Frete</div> 
                <div class="">preço frete</div> 
            </div>
            <hr>
            <div class="d-flex mt-4">
                <div class="flex-grow-1">Total</div> 
                <div class="">preço total</div> 
            </div>

            <a class="btn mt-4 w-100" id="btn-comprar" href="#">Comprar</a>
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

    .lista-itens{
        width: 80%;
        background-color: #B6B1B2;
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