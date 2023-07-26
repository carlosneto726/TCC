<!-- Modal para adicionar produtos -->
<div class="modal fade" id="produtoModal" tabindex="-1" aria-labelledby="produtoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/cadastrar/produto" method="POST" enctype="multipart/form-data">
                @csrf
                @method("POST")

                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="adicionarProdutoModalLabel">Adicionar um produto</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    
                    <div class="mb-3">
                        <label for="inputNome" class="form-label">Nome do produto</label>
                        <input type="text" class="form-control" name="nome" id="inputNome" placeholder="Digite o nome do seu produto / serviço" required>
                    </div>
                    <div class="form-floating">
                        <textarea class="form-control" name="descricao" placeholder="Digite uma breve descrição do seu produto / serviço" id="descricaoTextarea" style="height: 100px"></textarea>
                        <label for="descricaoTextarea">Descrição</label>
                      </div>
                    <div class="mb-3">
                        <label for="inputPreco" class="form-label">Preço</label>
                        <input type="text" class="form-control" name="preco" id="inputPreco" placeholder="Digite o nome do seu produto / serviço" required>
                    </div>
                    <div class="mb-3">
                        <label for="inputQuantidade" class="form-label">Quantidade</label>
                        <input type="text" class="form-control" name="quantidade" id="inputQuantidade" placeholder="Insira a quantidade do seu produto" aria-describedby="quantidadeHelp" required>
                        <div id="quantidadeHelp" class="form-text">Caso seja um serviço, pode deixar em branco.</div>
                    </div>
                    <div class="mb-4">
                        <label for="formFile" class="form-label">Insira uma imagem do produto</label>
                        <input class="form-control" type="file" name="imagem" id="formFile">
                        <div class="form-text">Recomendamos uma imagem quadrada com fundo branco</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-check-label fw-bold" for="entrega">Você está disponivél para entregar este produto?</label>
                        <br/>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="entrega" id="entrega" value="1">
                            <label class="form-check-label" for="inlineRadio1">Sim</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="entrega" id="entrega" value="0">
                            <label class="form-check-label" for="inlineRadio2">Não</label>
                        </div>                        
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Adicionar</button>
                </div>

            </form>
        </div>
    </div>
</div>