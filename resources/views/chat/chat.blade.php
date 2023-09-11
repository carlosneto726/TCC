@extends('templates.template')
@section('content')

<script>
    var app = {{ Js::from( env('PUSHER_APP_KEY') ) }};
</script>

<script src="https://js.pusher.com/7.2/pusher.min.js"></script>
<script src="{{asset("js/chat.js")}}"></script>

<div class="container mb-3 p-3 rounded position-relative">

    <div class="chat-info p-3 rounded position-fixed shadow">
        <h2 class="fw-bold">@if(isset($_COOKIE['cooperativa'])) {{$chat[0]->unome}} @elseif(isset($_COOKIE['usuario'])) {{$chat[0]->cnome}} @endif</h2>
    </div>


    <div class="mensagens p-3" id="mensagens-container" style="margin-top: 100px;">
        @foreach ($mensagens as $mensagem)
        <div class='bg-success text-light p-3 rounded shadow @if($mensagem->id_cooperativa == @$_COOKIE['cooperativa']) ms-auto @elseif($mensagem->id_usuario == @$_COOKIE['usuario']) ms-auto @endif' style='background-color: var(--light-green); width: fit-content;'>
            {{$mensagem->mensagem}}
        </div>
        <br/>
        @endforeach

    </div>

    <iframe name="enviar_mensagem" style="display:none;"></iframe>
    <form class="container mt-3 d-flex" action="{{url("/api/messages")}}" method="POST">
        @csrf
        @method("POST")
        
        <input type="text" name="id_cooperativa" value="@if(isset($_COOKIE['cooperativa'])) {{$_COOKIE['cooperativa']}} @endif" hidden>
        <input type="text" name="id_usuario" value="@if(isset($_COOKIE['usuario'])) {{$_COOKIE['usuario']}} @endif" hidden>
        <input type="text" name="id_chat" value="{{$id_chat}}" hidden>
        <input class="form-control me-2 shadow" type="text" name="mensagem" id="inputField" placeholder="Envie uma mensagem">
        <button class="btn btn-outline-success shadow" type="submit" onclick="clearInput()">Enviar</button>
    </form>

</div>
@endsection