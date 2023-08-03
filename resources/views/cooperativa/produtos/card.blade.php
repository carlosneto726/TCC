<div class="card m-1 rounded">
    <!-- Imagem do produto com o botão de editar -->
    <img class="rounded card-img-top @if($produto->quantidade <= 0) opacity-50 @endif" src="{{asset("storage/".$produto->imagem)}}"  style="height: 200px; object-fit: cover;">
    <div class="card-img-overlay" style="height: 200px;">
        <div class="d-flex" style="height: 170px;">
            @if (isset($_COOKIE["cooperativa"]))
                <div>
                    <button type="button" class="btn btn-editar" data-bs-toggle="modal" data-bs-target="#produtoModal{{$produto->id}}">Editar</button>
                    <small class="p-1 rounded @if($produto->quantidade <= 10) bg-danger text-light @else bg-light text-dark @endif">QTD: {{$produto->quantidade}}</small>
                </div>
            @endif

            <div class="d-inline-flex p-1 rounded ms-auto mt-auto" style="background-color: white;">
                <img src="{{asset("icons/thumbs-up.svg")}}">
                <span class="me-1">{{$produto->likes}}</span>
                <img class="ms-1" src="{{asset("icons/thumbs-down.svg")}}">
                <span>{{$produto->deslikes}}</span>
            </div>
        </div>    
    </div>

    <a class="text-decoration-none text-dark @if($produto->quantidade <= 0) opacity-50 @endif" href="{{url("/produto?id_produto=".$produto->id)}}">
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
            <div class="w-100 text-truncate">
                <span class="p-1 rounded" style="background-color: white; font-size: 9px;">
                    @if($produto->entrega) <span class="text-success fw-bold">ENTREGA DISPONIVEL</span> @else <span class="text-danger fw-bold">ENTREGA INDISPONIVÉL</span> @endif
                </span>
            </div>
        </div>
    </a>
</div>