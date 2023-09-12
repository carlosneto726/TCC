<!DOCTYPE html>
<html>
<head>
    <title>Seu pedido foi {{$dados['status']}}</title>
</head>
<body>
    <h1>Olá {{ $dados['nome'] }}.</h1>
    <p>O seu pedido foi {{$dados['status']}}</p>

    <p>
        Contate o vendedor por este <a href="{{$dados['chat']}}">link</a>
        <br>
        ou
        <br>
        Contate por <a href="{{$dados['whatsapp']}}">whatsapp</a>
    </p>

    <h3>Seu pedido</h3>

    @foreach ($dados['produtos_pedido'] as $produto)
        <div style="margin-bottom: 50px;">
            <h4>{{$produto->pnome}}</h4>
            <img src="cid:{{asset("storage/".$produto->pimg)}}">
            R$ {{number_format($produto->ppreco,2,",",".")}}
            <br/>
            QTD: {{$produto->pqtd}}
        </div>
    @endforeach
    
    <p>Obrigado por usar a Cooperativas Unidas Online!</p>

    <small>Este email foi gerado e enviado automáticamente</small>
</body>
</html>
