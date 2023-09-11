    // Enable pusher logging - don't include this in production
    // Pusher.logToConsole = true;

    var pusher = new Pusher('app', {
        cluster: 'sa1'
    });

    var channel = pusher.subscribe("chat-_{{$id_chat}}");
    channel.bind('mensagem', function(data) {
        document.getElementById('mensagens-container').innerHTML += 

        "<div class='bg-success text-light p-3 rounded shadow' style='width: fit-content;'>" +
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
