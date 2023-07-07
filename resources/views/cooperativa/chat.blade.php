@extends('templates.template')
@section('content')

<div class="container mb-3 p-3" style="background-color: var(--light-gray);">

    <div class="forum-info container p-3">

    </div>

    <div class="mensagens p-3" id="mensagens-container">

    </div>

    <iframe name="enviar_mensagem" style="display:none;"></iframe>
    <form class="container p-3 d-flex" action="{{url("/api/coments")}}" method="POST" target="enviar_mensagem">
        @csrf
        @method("POST")
        <input type="text" name="id_cooperativa" value="{{$_COOKIE['cooperativa']}}" hidden>
        <input type="text" name="id_forum" value="{{$id_forum}}" hidden>
        <input type="text" name="id_parent" value="" hidden>
        <input class="form-control me-2" type="text" name="comentario" placeholder="Envie um comentário">

        <button class="btn btn-outline-success" type="submit">Enviar</button>
    </form>

</div>


<script src="https://js.pusher.com/7.2/pusher.min.js"></script>
<script>

    // Enable pusher logging - don't include this in production
    // Pusher.logToConsole = true;

    var pusher = new Pusher('ae8c34f8cd931ba7cf6e', {
        cluster: 'sa1'
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
        document.getElementById('mensagens-container').innerHTML += 

        "<div class='rounded p-3' style='background-color: var(--light-green); width: fit-content;'> " + 
            data.message + 
        " </div><br/>";
    });
    

</script>

@endsection