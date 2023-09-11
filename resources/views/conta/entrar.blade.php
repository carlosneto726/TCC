<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <link href="{{asset("css/bootstrap/bootstrap.min.css")}}" rel="stylesheet">
    <link href="{{asset("css/entrar.css")}}" rel="stylesheet">
    <title>Cooperativas Unidas | Entrar</title>
</head>
<body class="d-flex align-items-center py-4 bg-body-tertiary">
    <main class="form-custom w-100 m-auto">
        <form method="POST" action="{{url("/entrar")}}">
            @csrf
            @method("POST")
            <img class="mb-4" src="{{asset("icons/box-arrow-in-right.svg")}}" alt="" width="72" height="57">
            <h1 class="h3 mb-3 fw-normal">Entre com a sua conta</h1>

            <div class="form-floating">
                <input class="form-control shadow" type="email" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="digite o seu e-mail" required>
                <label for="inputEmail">E-Mail</label>
            </div>
            <div class="form-floating">
                <input class="form-control shadow" type="password" name="senha" id="inputSenha" placeholder="digite a sua senha" required>
                <label for="inputSenha" class="form-label">Senha</label>
                <div class="form-text"><a href="{{url("/redefinir-senha")}}">Esqueceu a senha?</a></div>
            </div>
            <button class="btn btn-success w-100 m-1 shadow" type="submit" name="tipo_login" value="usuario">Entrar como usuário</button>
            <button class="btn btn-success w-100 m-1 shadow" type="submit" name="tipo_login" value="cooperativa">Entrar como cooperativa</button>
        </form>
        <hr>        
        <h6 class="fw-bold text-center">Ainda não tem uma conta?</h6>
        <a class="mt-2 btn btn-secondary w-100" href="{{url("/cadastrar")}}">Cadastre-se</a>
    </main>
</body>
</html>
