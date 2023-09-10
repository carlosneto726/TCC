
<div class="d-flex align-items-center p-3 my-3 rounded shadow">
    <img class="me-3" src="{{asset("icons/arrow-down-up.svg")}}" alt="" width="48" height="38">
    <div class="lh-1">
        <h1 class="h4 mb-0 lh-1">Avaliações</h1>
        <small>
            <a type="button" data-bs-toggle="modal" href="#avaliacaoModal">Clique aqui para avaliar</a>
        </small>
    </div>
</div>

<div class="my-3 p-3 bg-body rounded shadow">
    <h6 class="border-bottom pb-2 mb-0">Comentários</h6>

    @if (count($comentarios) == 0)
        <div class="text-body-secondary pt-3 border-bottom">
            Parece que este produto ainda não tem avaliações. Seja o primerio a 
            <a href="#avaliacaoModal" data-bs-toggle="modal">avaliar.</a>
        </div>
    @else
        @foreach ($comentarios as $comentario)
            <div class="d-flex text-body-secondary pt-3 border-bottom">
                @if($comentario->avaliacao == "like")
                    <img src="{{asset("icons/thumbs-up.svg")}}" class="bd-placeholder-img flex-shrink-0 me-2 rounded bg-success p-1" width="32" height="32">
                @else
                    <img src="{{asset("icons/thumbs-down.svg")}}" class="bd-placeholder-img flex-shrink-0 me-2 rounded bg-danger p-1" width="32" height="32">
                @endif
                <p class="pb-3 mb-0 small lh-sm">
                    <strong class="d-block text-gray-dark">{{$comentario->titulo}}</strong>
                    {{$comentario->comentario}}
                </p>
                <small class="ms-auto mt-auto mb-2">{{$comentario->nome}} | {{$comentario->data}}</small>
            </div>
        @endforeach
    @endif
</div>


@include('produto.modal')