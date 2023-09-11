<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <link href="{{asset("css/bootstrap/bootstrap.min.css")}}" rel="stylesheet">
    <link href="{{asset("css/cooperativaCadastro.css")}}" rel="stylesheet">
    <title>Cooperativas Unidas | Cadastrar usuário comum</title>
</head>
<body class="d-flex align-items-center py-4 bg-body-tertiary">
    <main class="form-custom w-100 m-auto">

        <form method="POST" action="{{url("/cadastrar/usuario")}}" enctype="multipart/form-data">
            @csrf
            @method("POST")
            <img class="mb-4" src="{{asset("icons/person.svg")}}" alt="" width="72" height="57">
            <h1 class="h3 mb-3 fw-normal">Criar uma conta de usuário comum</h1>

            <div class="input-group mb-3">
                <input type="text" class="form-control shadow" placeholder="Seu nome" name="nome" id="inputNome" required>
            </div>
            <div class="input-group mb-3">
                <input type="email" class="form-control shadow" placeholder="Seu E-Mail" name="email" id="inputEmail" required>
            </div>
            <div class="input-group">
                <input type="text" class="form-control shadow" name="cpf" id="inputCPF" placeholder="Seu CPF" maxlength="11" onkeypress="return /[0-9]/i.test(event.key)" required>
            </div>
            <div class="form-text mb-3 ms-2">Digite o CPF sem simbolos e pontuações.</div>

            <div class="input-group">
                <input type="text" class="form-control shadow" name="cep" id="cep" placeholder="Seu CEP" maxlength="8" onkeypress="return /[0-9]/i.test(event.key)" required>
                <input type="text" class="form-control shadow" name="endereco" id="endereco" placeholder="Endereço" required>
            </div>
            <div class="form-text mb-3 ms-1">Não sabe o seu CEP? descubra <a href="https://buscacepinter.correios.com.br/app/endereco/index.php" target="_blank">aqui</a>.</div>

            <div class="input-group mb-3">
                <input type="password" class="form-control shadow" name="senha" id="inputSenha" placeholder="Sua Senha" required>
                <input type="checkbox" class="btn-check" id="btn-check" autocomplete="off" onclick="verSenha()">
                <label class="btn btn-outline-secondary shadow h-50" for="btn-check"><img src="{{asset("icons/eye.svg")}}" width="16" height="16"></label>
            </div>
    
            <hr>
            <button class="btn btn-success mt-2 w-100 shadow" type="submit" id="submit">Criar conta</button>
            <small>
                Ao clicar em <strong>Criar conta</strong>, você concorda com nossos <a href="{{("/termos")}}" target="_blank">Termos, Política de Privacidade e Política de Cookies</a>. Você poderá receber E-mails.
            </small>
        </form>
    </main>
    
    <script src="{{asset("js/cadastro.js")}}"></script>
</body>
</html>
