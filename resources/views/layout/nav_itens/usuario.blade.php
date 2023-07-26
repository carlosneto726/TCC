<li class="nav-item">
    <a class="nav-link text-light" href="{{url("/carrinho")}}">Carrinho</a>
</li>
<li class="nav-item">
    <a class="nav-link text-light" href="{{url("/favoritos")}}">Favoritos</a>
</li>
<li class="nav-item">
    <a class="nav-link text-light" href="{{url("/chats")}}">Chats</a>
</li>

<li class="nav-item dropdown">
    <a class="nav-link text-light dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        Olá {{$_COOKIE["nome_usuario"]}}
    </a>
    <ul class="dropdown-menu">
      <li><a class="dropdown-item" href="{{url("/perfil")}}">Informações do usuário</a></li>
      <li><a class="dropdown-item" href="{{url("/pedidos")}}">Pedidos</a></li>
      <li><a class="dropdown-item text-danger" href="{{url("/sair")}}">Sair</a></li>
    </ul>
</li>