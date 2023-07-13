<!-- Descrição da cooperativa -->
<div class="bg-light mb-2 rounded">
    <div class="p-5 container">
        <div class="d-flex flex-row align-items-end mb-3">
            <img src="{{asset("storage/".$cooperativa[0]->perfil)}}" style="width: 64px;">
            <h3 class="ms-3">{{@$cooperativa[0]->nome}}</h3>
        </div>
        <h5>
            {{@$cooperativa[0]->descricao}}
        </h5>
    </div>
</div>
<!-- Endereço da cooperativa -->
@if (@$cooperativa[0]->endereco)
<div class="bg-light mb-2 rounded">
    <div class="p-5 container">
        <div class="d-flex flex-row align-items-end mb-3">
            <img src="{{asset("icons/localization.svg")}}" style="width: 64px;">
            <h3 class="ms-3">Localização</h3>
        </div>
        <h5>
            {{@$cooperativa[0]->endereco}}
            <br>
            CEP: {{@$cooperativa[0]->cep}}
        </h5>
    </div>
</div>
@endif
<!-- Contato da cooperativa -->
@if (@$cooperativa[0]->tel1)
<div class="bg-light mb-2 rounded">
    <div class="p-5 container">
        <div class="d-flex flex-row align-items-end mb-3">
            <img src="{{asset("icons/contact.svg")}}" style="width: 64px;">
            <h3 class="ms-3">Contato</h3>
        </div>
        <h5>
            Telefone 1: {{@$cooperativa[0]->tel1}} <br>
            @if (@$cooperativa[0]->tel2)
                Telefone 2: {{@$cooperativa[0]->tel2}} <br>
            @endif

            @if (@$cooperativa[0]->whatsapp)
                <a href="{{@$cooperativa[0]->whatsapp}}">WhatsApp</a> <br>    
            @endif

            @if (@$cooperativa[0]->instagram)
                <a href="{{@$cooperativa[0]->instagram}}">Instagram</a> <br>    
            @endif

            @if (@$cooperativa[0]->facebook)
                <a href="{{@$cooperativa[0]->facebook}}">Facebook</a> <br>                    
            @endif

        </h5>
    </div>
</div>
@endif
<!-- Histórico da cooperativa -->
@if (@$cooperativa[0]->historico)
    <div class="bg-light mb-2 rounded">
        <div class="p-5 container">
            <div class="d-flex flex-row align-items-end mb-3">
                <img src="{{asset('icons/history.svg')}}" style="width: 64px;">
                <h3 class="ms-3">Histórico</h3>
            </div>
            <h5>
                {{$cooperativa[0]->historico}}
            </h5>
        </div>
    </div>
@endif
<!-- Missão da cooperativa -->
@if ($cooperativa[0]->missao)
<div class="bg-light mb-2 rounded">
    <div class="p-5 container">
        <div class="d-flex flex-row align-items-end mb-3">
            <img src="{{asset('icons/missao.svg')}}" style="width: 64px;">
            <h3 class="ms-3">Missão</h3>
        </div>
        <h5>
            {{@$cooperativa[0]->missao}}
        </h5>
    </div>
</div>
@endif
<!-- Visão da cooperativa -->
@if (@$cooperativa[0]->visao)
    <div class="bg-light mb-2 rounded">
        <div class="p-5 container">
            <div class="d-flex flex-row align-items-end mb-3">
                <img src="{{asset('icons/visao.svg')}}" style="width: 64px;">
                <h3 class="ms-3">Visão</h3>
            </div>
            <h5>
                {{$cooperativa[0]->visao}}
            </h5>
        </div>
    </div>
@endif
<!-- Valores da cooperativa -->
@if (@$cooperativa[0]->valores)
    <div class="bg-light mb-2 rounded">
        <div class="p-5 container">
            <div class="d-flex flex-row align-items-end mb-3">
                <img src="{{asset("icons/valores.svg")}}" style="width: 64px;">
                <h3 class="ms-3">Valores</h3>
            </div>
            <h5>
                {{$cooperativa[0]->valores}}
            </h5>
        </div>
    </div>
@endif