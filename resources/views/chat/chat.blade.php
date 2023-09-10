@extends('templates.template')
@section('content')

<div class="container mb-3 p-3 rounded position-relative" style="background-color: var(--light-gray);">

    <div class="chat-info p-3 rounded position-fixed bg-light">
        <h1>@if(isset($_COOKIE['cooperativa'])) {{$chat[0]->unome}} @elseif(isset($_COOKIE['usuario'])) {{$chat[0]->cnome}} @endif</h1>
    </div>


    <div class="mensagens p-3" id="mensagens-container" style="margin-top: 100px;">
        @foreach ($mensagens as $mensagem)
        <div class='rounded p-3 @if($mensagem->id_cooperativa == @$_COOKIE['cooperativa']) ms-auto @elseif($mensagem->id_usuario == @$_COOKIE['usuario']) ms-auto @endif' style='background-color: var(--light-green); width: fit-content;'>
            {{$mensagem->mensagem}}
        </div>
        <br/>
        @endforeach

    </div>

    <iframe name="enviar_mensagem" style="display:none;"></iframe>
    <form class="container p-3 d-flex" action="{{url("/api/messages")}}" method="POST">
        @csrf
        @method("POST")
        
        <input type="text" name="id_cooperativa" value="@if(isset($_COOKIE['cooperativa'])) {{$_COOKIE['cooperativa']}} @endif" hidden>
        <input type="text" name="id_usuario" value="@if(isset($_COOKIE['usuario'])) {{$_COOKIE['usuario']}} @endif" hidden>
        <input type="text" name="id_chat" value="{{$id_chat}}" hidden>
        <input class="form-control me-2" type="text" name="mensagem" id="inputField" placeholder="Envie uma mensagem">
        
        <button class="btn btn-outline-success" type="submit" onclick="clearInput()">Enviar</button>
    </form>

</div>


<script src="https://js.pusher.com/7.2/pusher.min.js"></script>
<script>

    // Enable pusher logging - don't include this in production
    // Pusher.logToConsole = true;

    var pusher = new Pusher('{{env('PUSHER_APP_KEY')}}', {
        cluster: 'sa1'
    });

    var channel = pusher.subscribe("chat-_{{$id_chat}}");
    channel.bind('mensagem', function(data) {
        document.getElementById('mensagens-container').innerHTML += 

        "<div class='rounded p-3' style='background-color: var(--light-green); width: fit-content;'>" +
            data.message +
        "</div><br/>";

    });
    
    function sleep(ms) {
        return new Promise(resolve => setTimeout(resolve, ms));
    }

    async function clearInput(){
        await sleep(500);
        document.getElementById("inputField").value = " ";
    }

</script>

@endsection