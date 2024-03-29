<div class="dropdown text-start ms-2 mt-2">
    <a href="#" class="d-block link-body-emphasis text-decoration-none text-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
        Olá {{$_COOKIE["nome_usuario"]}}
    </a>
    <ul class="dropdown-menu text-small" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 34px);" data-popper-placement="bottom-start">
        <li><a class="dropdown-item" href="{{url("/meusprodutos")}}">Meus produtos</a></li>
        <li><a class="dropdown-item" href="{{url("/foruns")}}">Fórum</a></li>
        <li><a class="dropdown-item" href="{{url("/cooperativa/".$_COOKIE['nome_cooperativa'])}}">Minha Cooperativa</a></li>
        <li><a class="dropdown-item" href="{{url("/pedidos/usuario")}}">Pedidos</a></li>
        <li><a class="dropdown-item" href="{{url("/carrinho")}}">Carrinho</a></li>
        <li><a class="dropdown-item" href="{{url("/favoritos")}}">Favoritos</a></li>
        <li><a class="dropdown-item" href="{{url("/perfil")}}">Perfil</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item text-danger" href="{{url("/sair")}}">Sair</a></li>
    </ul>
</div>
