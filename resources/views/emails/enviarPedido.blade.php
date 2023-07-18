<!DOCTYPE html>
<html>
<head>
    <title>Novo Pedido!</title>
</head>
<body>
    <h1>Olá! {{$dados['nome']}}</h1>
    <p><strong>Você tem um solicitação de um novo pedido.</strong></p>
    <p>
        Contate o cliente por este <a href="{{$dados['chat']}}">link</a>
    </p>

    <h5>O pedido do cliete possui o(s) seguinte(s) iten(s):</h5>

    @foreach ($dados['produtos_pedido'] as $produtos)
        <div style="margin-bottom: 120px;">
            @foreach ($produtos as $produto)
                <div style="margin-bottom: 50px;">
                    <h4>{{$produto->pnome}}</h4>
                    <img src="{{asset("storage/".$produto->pimg)}}">
                    R$ {{number_format($produto->ppreco,2,",",".")}}
                    <br/>
                    QTD: {{$produto->pqtd}}
                </div>
            @endforeach
        </div>
    @endforeach

    <p>Obrigado por usar a Cooperativas Unidas Online!</p>

    <small>Este email foi gerado e enviado automáticamente</small>
</body>
</html>
