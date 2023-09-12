<div class="container py-4">
    <!-- Descrição da cooperativa -->
    <div class="p-5 mb-4 rounded-3 shadow">
        <div class="container-fluid py-5">
            <div class="d-flex gap-3 py-3">
                <img src="{{asset("storage/".$cooperativa[0]->perfil)}}" width="128" height="128" class="rounded-circle flex-shrink-0 object-fit-cover">
                <div class="d-flex gap-2 w-100 justify-content-between">
                    <div>
                        <h1 class="display-5 fw-bold">{{@$cooperativa[0]->nome}}</h1>
                        <p class="col-md-8 fs-4">{{@$cooperativa[0]->descricao}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row align-items-md-stretch">
        <!-- Histórico da cooperativa -->
        @if (@$cooperativa[0]->historico)
        <div class="col-md-6">
            <div class="h-100 p-5 shadow rounded-3">
                <div class="d-flex gap-3 py-3">
                    <img src="{{asset('icons/history.svg')}}" width="64" height="64">
                    <div class="d-flex gap-2 w-100 justify-content-between">
                        <div>
                            <h2>Histórico</h2>
                            <p class="col-md-8">{{$cooperativa[0]->historico}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <!-- Missão da cooperativa -->
        @if (@$cooperativa[0]->missao)
        <div class="col-md-6">
            <div class="h-100 p-5 shadow rounded-3">
                <div class="d-flex gap-3 py-3">
                    <img src="{{asset('icons/missao.svg')}}" width="64" height="64">
                    <div class="d-flex gap-2 w-100 justify-content-between">
                        <div>
                            <h2>Missão</h2>
                            <p class="col-md-8">{{@$cooperativa[0]->missao}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <!-- Visão da cooperativa -->
        @if (@$cooperativa[0]->visao)
        <div class="col-md-6">
            <div class="h-100 p-5 shadow rounded-3">
                <div class="d-flex gap-3 py-3">
                    <img src="{{asset('icons/visao.svg')}}" width="64" height="64">
                    <div class="d-flex gap-2 w-100 justify-content-between">
                        <div>
                            <h2>Visão</h2>
                            <p class="col-md-8">{{$cooperativa[0]->visao}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <!-- Valores da cooperativa -->
        @if (@$cooperativa[0]->valores)
        <div class="col-md-6">
            <div class="h-100 p-5 shadow rounded-3">
                <div class="d-flex gap-3 py-3">
                    <img src="{{asset('icons/valores.svg')}}" width="64" height="64">
                    <div class="d-flex gap-2 w-100 justify-content-between">
                        <div>
                            <h2>Valores</h2>
                            <p class="col-md-8">{{$cooperativa[0]->valores}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <!-- Endereço da cooperativa -->
        @if (@$cooperativa[0]->endereco)
        <div class="col-md-6">
            <div class="h-100 p-5 shadow rounded-3">
                <div class="d-flex gap-3 py-3">
                    <img src="{{asset("icons/localization.svg")}}" width="64" height="64">
                    <div class="d-flex gap-2 w-100 justify-content-between">
                        <div>
                            <h2>Localização</h2>
                            <p class="col-md-8">{{@$cooperativa[0]->endereco}}</p>
                            <p class="col-md-8">CEP: {{@$cooperativa[0]->cep}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <!-- Contato da cooperativa -->
        @if (@$cooperativa[0]->tel1)
        <div class="@if($impar) col-md-12 @else col-md-6 @endif">
            <div class="h-100 p-5 shadow rounded-3">
                <div class="d-flex gap-3 py-3">
                    <img src="{{asset("icons/contact.svg")}}" width="64" height="64">
                    <div class="d-flex gap-2 w-100 justify-content-between">
                        <div>
                            <h2>Contato</h2>
                            <p class="col-md-12">Telefone 1: {{@$cooperativa[0]->tel1}}</p>
                            @if (@$cooperativa[0]->tel2)
                                <p class="col-md-12">Telefone 2: {{@$cooperativa[0]->tel2}}</p>
                            @endif
                            <p class="col-md-12"><a href="https://wa.me/55{{@$cooperativa[0]->tel1}}"><img src="{{asset("icons/whatsapp.svg")}}"></a>                        
                                @if (@$cooperativa[0]->instagram)
                                    <a href="{{@$cooperativa[0]->instagram}}"><img src="{{asset("icons/instagram.svg")}}"></a>
                                @endif
                                @if (@$cooperativa[0]->facebook)
                                    <a href="{{@$cooperativa[0]->facebook}}"><img src="{{asset("icons/facebook.svg")}}"></a>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
