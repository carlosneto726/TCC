<!DOCTYPE html>
<html>
<head>
    <title>Novo Pedido!</title>
</head>
<body>
    <h1>Olá! {{$dados['nome']}}</h1>
    <p>Você tem um solicitação de um novo pedido.</p>

    <p>
        Contate o cliente por este <a href="{{$dados['chat']}}">link</a>
    </p>

    <h3>O pedido do cliete possui o(s) seguinte(s) iten(s):</h3>

    @foreach ($dados['produtos_pedido'] as $produtos)
        <div style="margin-bottom: 120px;">
            @foreach ($produtos as $produto)
                <div style="margin-bottom: 50px;">
                    <h4>{{$produto->pnome}}</h4>
                    <img src="{{asset("http://127.0.0.1:8000/storage/".$produto->pimg)}}">
                    R$ {{number_format($produto->ppreco,2,",",".")}}
                    <br/>
                    QTD: {{$produto->pqtd}}
                </div>
            @endforeach
        </div>
    @endforeach

    <ul>
        <li>Email: {{ $dados['email'] }}</li>
    </ul>
    
    <p>Obrigado por usar a Cooperativas Unidas Online!</p>

    <small>Este email foi gerado e enviado automáticamente</small>
</body>
</html>
