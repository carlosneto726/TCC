<!-- Modal para editar produtos -->
<div class="modal fade" id="produtoModal{{$produto->id}}" tabindex="-1" aria-labelledby="produtoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <form action="{{url("/atualizar/produto")}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method("POST")

                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="adicionarProdutoModalLabel">Adicionar um produto</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" name="id" value="{{$produto->id}}" hidden>
                    <div class="mb-3">
                        <label for="inputNome" class="form-label">Nome do produto</label>
                        <input type="text" class="form-control" name="nome" id="inputNome" value="{{$produto->nome}}">
                    </div>
                    <div class="form-floating">
                        <textarea class="form-control" name="descricao" value="{{$produto->descricao}}" id="descricaoTextarea" style="height: 100px">
                            {{$produto->descricao}}
                        </textarea>
                        <label for="descricaoTextarea">Descrição</label>
                    </div>
                    <div class="mb-3">
                        <label for="inputPreco" class="form-label">Preço (R$)</label>
                        <input type="text" class="form-control" name="preco" id="inputPreco" value="{{$produto->preco}}">
                    </div>
                    <div class="mb-3">
                        <label for="inputQuantidade" class="form-label">Quantidade (Unidade)</label>
                        <input type="text" class="form-control" name="quantidade" id="inputQuantidade" value="{{$produto->quantidade}}" aria-describedby="quantidadeHelp">
                        <div id="quantidadeHelp" class="form-text">Caso seja um serviço, pode deixar em branco.</div>
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Insira uma imagem do produto</label>
                        <input class="form-control" type="file" name="imagem" id="formFile">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary" name="acao" value="atualizar">Atualizar</button>
                    <button type="submit" class="btn btn-danger" name="acao" value="deletar">Deletar</button>
                </div>

            </form>

        </div>
    </div>
</div>