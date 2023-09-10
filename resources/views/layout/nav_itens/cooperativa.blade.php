<div class="dropdown text-start ms-2">
    <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
        <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
    </a>
    <ul class="dropdown-menu text-small" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 34px);" data-popper-placement="bottom-start">
        <li><a class="dropdown-item" href="{{url("/caixa")}}">Caixa</a></li>
        <li><a class="dropdown-item" href="{{url("/relatorios")}}">Relatorios</a></li>
        <li><a class="dropdown-item" href="{{url("/foruns")}}">Fórum</a></li>
        <li><a class="dropdown-item" href="{{url("/chats")}}">Chats</a></li>
        <li><a class="dropdown-item" href="{{url("/cooperativa/".$_COOKIE['nome_cooperativa'])}}">Informações do perfil</a></li>
        <li><a class="dropdown-item" href="{{url("/pedidos")}}">Pedidos</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item text-danger" href="{{url("/sair")}}">Sair</a></li>
    </ul>
</div>