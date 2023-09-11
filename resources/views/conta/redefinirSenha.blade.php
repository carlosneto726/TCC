<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <link href="{{asset("css/bootstrap/bootstrap.min.css")}}" rel="stylesheet">
    <link href="{{asset("css/entrar.css")}}" rel="stylesheet">
    <title>Cooperativas Unidas | Redefinir senha</title>
</head>
<body class="d-flex align-items-center py-4 bg-body-tertiary">
    <main class="form-custom w-100 m-auto">
        <form method="POST" action="{{url("/redefinir-senha")}}">
            @csrf
            @method("POST")
            <img class="mb-4" src="{{asset("icons/shield-lock.svg")}}" alt="" width="72" height="57">
            <h1 class="h3 mb-3 fw-normal">Redefina a sua senha</h1>

            <div class="form-floating">
                <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="digite o seu e-mail" required>
                <label for="inputEmail" class="form-label">Digite o e-mail vinculado a sua conta</label>
            </div>

            <div class="form-text">Nós iremos enviar um email para você redefinir a sua senha. Não esqueça de checar o seu inbox ou a caixa de span.</div>

            <button class="btn btn-success mt-2 w-100" type="submit">Enviar E-mail</button>
        </form>
        <hr>        
        <h6 class="fw-bold text-center">Ainda não tem uma conta?</h6>
        <a class="mt-2 btn btn-secondary w-100" href="{{url("/cadastrar")}}">Cadastre-se</a>
    </main>
</body>
</html>
