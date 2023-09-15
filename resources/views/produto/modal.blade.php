<!-- Modal -->
<div class="modal fade" id="avaliacaoModal" tabindex="-1" aria-labelledby="avaliacaoModalLabel" aria-hidden="true">
    <div class="modal-dialog">

        <div class="modal-content rounded-4 shadow">
            <div class="modal-header p-5 pb-4 border-bottom-0">
                <h1 class="fw-bold mb-0 fs-2">{{$produto[0]->pnome}} ({{$produto[0]->cnome}})</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
        
            <div class="modal-body p-5 pt-0">
                <div class="flex-shrink-0">
                    <img class="img-fluid rounded" src="{{asset("storage/".$produto[0]->imagem)}}" id="img-modal">
                </div>
                <form action="{{url("/avaliar")}}" method="POST">
                    @csrf
                    @method("POST")
                    <input type="text" name="id_produto" value="{{$id_produto}}" hidden>
                                        
                    <div class="form-check-inline mb-3">
                        <input 
                        class="rounded btn-check" 
                        id="btn-check-like" 
                        type="radio" 
                        name="avaliacao" 
                        value="like" 
                        autocomplete="off">
                        <label class="btn btn-outline-success shadow h-50" for="btn-check-like">
                            <img src="{{asset("icons/thumbs-up.svg")}}" width="16" height="16">
                        </label>
                        
                        <input 
                        class="btn-check" 
                        id="btn-check-deslike" 
                        type="radio" 
                        name="avaliacao" 
                        value="deslike" 
                        autocomplete="off">
                        <label class="btn btn-outline-danger shadow h-50" for="btn-check-deslike">
                            <img src="{{asset("icons/thumbs-down.svg")}}" width="16" height="16">
                        </label>
                    </div>
                    
                    <div class="mt-2">
                        <label for="titulo">Escreva um título</label>
                        <input class="form-control" id="titulo" name="titulo" placeholder="Escreva um título sobre o seu comentário" required>
                    </div>
                    <div class="form-floating mt-2">
                        <textarea class="form-control" name="comentario" id="comentarioTextarea" style="height: 100px" required></textarea>
                        <label for="comentarioTextarea">Escreva um comentário</label>
                    </div>
                    @if(!isset($_COOKIE['usuario']))
                        <a href="{{url("/entrar")}}" class="btn btn-success w-100 mt-3">Enviar avaliação</a>
                    @else
                        <button type="submit" class="btn btn-success w-100 mt-3">Enviar avaliação</button>
                    @endif
                </form>
            </div>
        </div>

    </div>
</div>

<style>
    #img-modal{
        height: 200px;
        object-fit: contain;
    }
</style>




