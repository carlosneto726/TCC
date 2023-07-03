<div class="offcanvas offcanvas-end shadow-lg" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasCarrinho" aria-labelledby="offcanvasCarrinhoLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasCarrinhoLabel">Seu carrinho</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        
        @for ($i = 0; $i < 3; $i++)
            
            <div class="carrinho-item-offcanvas hstack">
                <div class="img-container-offcanvas m-1">
                    <img class="item-img-offcanvas img-fluid" src="{{asset("images/square-placeholder.png")}}">
                </div>

                <div class="d-flex flex-column item-info-offcanvas">

                    <span class="ms-2 mb-3 text-break">nome do produto</span>

                    <div class="d-flex flex-row mt-5">
                        <span class="ms-2">quantidade</span>
                        <span class="me-2 ms-auto">preço</span>
                    </div>

                </div>

            </div>

        @endfor

        <hr>
        <div class="d-flex flex-row">
            <span>Total</span>
            <div class="d-flex flex-column ms-auto"> 
                <span class="text-end">valor total</span>
                <a class="btn mt-1" href="{{url("/carrinho")}}" id="btn-ver-carrinho">Ver carrinho</a>
            </div>

        </div>
    
    </div>
</div>

<style>
    .offcanvas{
        background-color: #0A4400;
        color: white;
    }

    .carrinho-item-offcanvas{
        width: 100%;
        margin-top: 10px;
        margin-bottom: 10px;
        background-color: #B6B1B2;
        color: black;
    }

    .item-img-offcanvas{
        object-fit: contain;
        height: 100%;
    }

    .img-container-offcanvas{
        height: 100%;
        width: 150px;
    }

    #btn-ver-carrinho{
        background-color: #00FF33;
    }
    
    .item-info-offcanvas{
        height: 100%;
        width: 100%;
    }

</style>