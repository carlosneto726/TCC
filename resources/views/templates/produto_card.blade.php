<div class="card card-produto m-1" style="">
    <img src="{{asset("images/square-placeholder.png")}}" class="card-img-top" alt="placeholder">

    <div class="card-body p-2 card-produto-body">
        <div class="hstack">

            <div>
                <div class="w-100">
                    <span class="fw-bold text-wrap">R$00.000,00</span>
                </div>
                <div class="w-100">
                    <span class="text-decoration-line-through text-wrap">R$00.000,00</span>
                </div>
            </div>

            <div class="ms-auto mb-auto">
                <img class="me-1" src="{{asset("icons/heart-fill.svg")}}"> Favoritar <br>
                <div class="ms-auto">
                    <img src="{{asset("icons/star-fill.svg")}}">
                    <img src="{{asset("icons/star-fill.svg")}}">
                    <img src="{{asset("icons/star-fill.svg")}}">
                    <img src="{{asset("icons/star.svg")}}">
                    <img src="{{asset("icons/star.svg")}}">
                </div>
            </div>
        </div>

        <hr>
        
        <div>
            <img class="cooperativa-img" src="{{asset("images/square-placeholder.png")}}">
        </div>
        
    
        
    </div>
</div>
    


<style>

    .card-produto-body{
        background-color: var(--green) !important;
        color: black !important;
    }

    .card-produto{
        border: none;
    }

    .cooperativa-img {
        object-fit: contain;
        width: 75px;

    }
</style>