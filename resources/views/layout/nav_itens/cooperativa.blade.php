<li class="nav-item">
    <a class="nav-link text-light" href="{{url("/pedidos")}}">Pedidos</a>
</li>
<li class="nav-item">
    <a class="nav-link text-light" href="{{url("/caixa")}}">Caixa</a>
</li>
<li class="nav-item">
    <a class="nav-link text-light" href="{{url("/relatorios")}}">Relatorios</a>
</li>
<li class="nav-item">
    <a class="nav-link text-light" href="{{url("/foruns")}}">Fórum</a>
</li>
<li class="nav-item position-relative">
    <a class="nav-link text-light" href="{{url("/chats")}}">Chats</a>
</li>

<li class="nav-item dropdown">
    <a class="nav-link text-light dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        Olá {{$_COOKIE["nome_cooperativa"]}}
    </a>
    <ul class="dropdown-menu">
      <li><a class="dropdown-item" href="{{url("/cooperativa/".$_COOKIE['nome_cooperativa'])}}">Informações do perfil</a></li>
      <li><a class="dropdown-item" href="{{url("/pedidos")}}">Pedidos</a></li>
      <li><a class="dropdown-item text-danger" href="{{url("/sair")}}">Sair</a></li>
    </ul>
</li>