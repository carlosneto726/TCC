<div class="grid-categoria container p-1 mt-1 mb-1">
    @for ($j = 0; $j < 4; $j++)
        <div class="grid-item container p-1">
            <a href="#" class="text-decoration-none text-dark">
                <img class="item-img" src="{{asset("images/square-placeholder.png")}}">
                <span class="preco-desconto fw-bold">preço com desconto</span><br>
                <span class="preco text-decoration-line-through">preço sem desconto</span><br>
            </a>
        
            <div class="estrelas">
                <img class="icons" src="{{asset("icons/star-fill.svg")}}">
                <img class="icons" src="{{asset("icons/star-fill.svg")}}">
                <img class="icons" src="{{asset("icons/star-fill.svg")}}">
                <img class="icons" src="{{asset("icons/star.svg")}}">
                <img class="icons" src="{{asset("icons/star.svg")}}">
            </div>

            <a href="#">
                <img class="cooperativa-img" src="{{asset("images/square-placeholder.png")}}">
            </a>
            
        </div>

    @endfor

</div>


<style>

    .grid-categoria {
        width: 95%;
        height: 450px;
        background-color: #0A4400;
        display: grid;
        grid-template-columns: auto auto;
    }

    .grid-item {
        width: 95%;
        height: 95%;
        background-color: #00FF33;
    }

    .item-img {
        object-fit: contain;
        width: 100%;
        height: 120px;
    }
    .preco-desconto {
        font-size: 16px;
    }

    .preco {
        font-size:14px;
    }

    .estrelas {
        width: fit-content;
    }

    .cooperativa-img {
        object-fit: cover;
        width: 38px;
        height: 38px;
        border-radius: 19px;
        margin-left: 75%;
        margin-top: -45px;
    }
</style>