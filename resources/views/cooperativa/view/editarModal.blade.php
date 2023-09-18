<div class="modal fade" id="perfilModal" tabindex="-1" aria-labelledby="perfilModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/atualizar/cooperativa" method="POST" enctype="multipart/form-data">
                @csrf
                @method("POST")

                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="perfilModalLabel">Editar perfil</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    
                    <div class="mb-3">
                        <label for="inputNome" class="form-label">Nome da cooperativa</label>
                        <input type="text" class="form-control" value="{{@$cooperativa[0]->nome}}" name="nome" id="inputNome" placeholder="Digite o nome da sua cooperativa">
                    </div>
                    <div class="mb-3 form-floating">
                        <textarea class="form-control" name="descricao" placeholder="descricao" id="descricaoTextarea" style="height: 100px">{{@$cooperativa[0]->descricao}}</textarea>
                        <label for="descricaoTextarea">Descrição</label>
                    </div>
                    <div class="mb-3 form-floating">
                        <textarea class="form-control" name="historico" placeholder="historico" id="descricaoTextarea" style="height: 100px">{{@$cooperativa[0]->historico}}</textarea>
                        <label for="descricaoTextarea">Histórico</label>
                    </div>
                    <div class="mb-3 form-floating">
                        <textarea class="form-control" name="missao" placeholder="missao" id="descricaoTextarea" style="height: 100px">{{@$cooperativa[0]->missao}}</textarea>
                        <label for="descricaoTextarea">Missão</label>
                    </div>
                    <div class="mb-3 form-floating">
                        <textarea class="form-control" name="visao" placeholder="visao" id="descricaoTextarea" style="height: 100px">{{@$cooperativa[0]->visao}}</textarea>
                        <label for="descricaoTextarea">Visão</label>
                    </div>
                    <div class="mb-3 form-floating">
                        <textarea class="form-control" name="valores" placeholder="valores" id="descricaoTextarea" style="height: 100px">{{@$cooperativa[0]->valores}}</textarea>
                        <label for="descricaoTextarea">Valores</label>
                    </div>
                    <div class="mb-3 form-floating">
                        <textarea class="form-control" name="endereco" placeholder="localizacao" id="descricaoTextarea" style="height: 100px">{{@$cooperativa[0]->endereco}}</textarea>
                        <label for="descricaoTextarea">Localização</label>
                    </div>
                    <div class="mb-3">
                        <label for="inputCEP" class="form-label">CEP</label>
                        <input type="text" class="form-control" value="{{@$cooperativa[0]->cep}}" name="cep" id="inputCEP" placeholder="Digite o CEP da sua cooperativa">
                    </div>
                    <div class="mb-3">
                        <label for="inputTel1" class="form-label">Telefone 1</label>
                        <input type="text" class="form-control" value="{{@$cooperativa[0]->tel1}}" name="tel1" id="inputTel1" placeholder="Digite o telefone da sua cooperativa">
                    </div>
                    <div class="mb-3">
                        <label for="inputTel2" class="form-label">Telefone 2</label>
                        <input type="text" class="form-control" value="{{@$cooperativa[0]->tel2}}" name="tel2" id="inputTel2" placeholder="Digite um telefone secundário da sua cooperativa">
                    </div>
                    <div class="mb-3">
                        <label for="inputWhatsApp" class="form-label">WhatsApp</label>
                        <input type="text" class="form-control" value="{{@$cooperativa[0]->whatsapp}}" name="whatsapp" id="inputWhatsApp" placeholder="Digite a URL">
                    </div>
                    <div class="mb-3">
                        <label for="inputInstagram" class="form-label">Instagram</label>
                        <input type="text" class="form-control" value="{{@$cooperativa[0]->instagram}}" name="instagram" id="inputInstagram" placeholder="Digite a URL">
                    </div>
                    <div class="mb-3">
                        <label for="inputFacebook" class="form-label">Facebook</label>
                        <input type="text" class="form-control" value="{{@$cooperativa[0]->facebook}}" name="facebook" id="inputFacebook" placeholder="Digite a URL">
                    </div>
                    <div class="mb-3">
                        <label for="formFileMultiple" class="form-label">Alterar imagem de perfil</label>
                        <input class="form-control" type="file" name="perfil" id="formFileMultiple" accept=".png, .jpg, .jpeg, .webp, .avif, .jfif">
                    </div>
                    <div class="mb-3">
                        <label for="formFileMultiple" class="form-label">Alterar do Outdoor</label>
                        <input class="form-control" type="file" name="outdoor" id="formFileMultiple" accept=".png, .jpg, .jpeg, .webp, .avif, .jfif">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Atualizar</button>
                </div>

            </form>
        </div>
    </div>
</div>