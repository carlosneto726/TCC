<!-- Modal para adicionar produtos -->
<div class="modal fade" id="addAssociadoModal" tabindex="-1" aria-labelledby="addAssociadoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{url('/adicionar/associado')}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method("POST")

                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addAssociadoModalLabel">Adicionar um Associado</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    
                    <div class="mb-3">
                        <label for="inputEmail" class="form-label">Email do associado</label>
                        <input type="email" class="form-control" name="email" id="inputEmail" placeholder="Ex: email@exemplo.com" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Adicionar</button>
                </div>

            </form>
        </div>
    </div>
</div>