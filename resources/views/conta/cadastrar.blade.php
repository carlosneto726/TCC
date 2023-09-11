<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <link href="{{asset("css/bootstrap/bootstrap.min.css")}}" rel="stylesheet">
    <link href="{{asset("css/entrar.css")}}" rel="stylesheet">
    <title>Cooperativas Unidas | Tipo de Cadastro</title>
</head>
<body class="d-flex align-items-center py-4 bg-body-tertiary">
    <main class="form-custom w-100 m-auto">
        <img class="mb-4" src="{{asset("icons/hash.svg")}}" alt="" width="72" height="57">
        <h1 class="h3 mb-3 fw-normal">Como você quer se cadastrar?</h1>
        <a href="{{url("/cadastrar/usuario")}}" class="btn btn-success mt-2 w-100">Cadastrar como usuário comum</a>
        <a href="{{url("/cadastrar/cooperativa")}}" class="btn btn-success mt-2 w-100">Cadastrar como cooperativa</a>
        <hr>
        <h6 class="fw-bold text-center">Já tem uma conta?</h6>
        <a class="mt-2 btn btn-secondary w-100" href="{{url("/entrar")}}">Entre com sua conta</a>
    </main>
</body>
</html>
