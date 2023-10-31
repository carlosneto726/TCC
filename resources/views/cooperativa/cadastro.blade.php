<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <link href="{{asset("css/bootstrap/bootstrap.min.css")}}" rel="stylesheet">
    <link href="{{asset("css/cooperativaCadastro.css")}}" rel="stylesheet">
    <title>Cooperativas Unidas | Cadastrar Cooperativa</title>
</head>
<body class="d-flex align-items-center py-4 bg-body-tertiary">

    @if(@$_SESSION['mensagem'] != "")
        <div class="z-3 position-fixed top-0 end-0" id="alerta">            
            <div class="alert alert-{{@$_SESSION['tipo']}} alert-dismissible" role="alert">
                <div>{{$_SESSION['mensagem']}}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
        @php
            @$_SESSION['mensagem'] = "";
            @$_SESSION['tipo'] = "";
        @endphp
    @endif

    <main class="form-custom w-100 m-auto">

        <form method="POST" action="{{url("/cadastrar/cooperativa")}}" enctype="multipart/form-data">
            @csrf
            @method("POST")
            <img class="mb-4" src="{{asset("icons/people.svg")}}" alt="" width="72" height="57">
            <h1 class="h3 mb-3 fw-normal">Criar uma conta de cooperativa</h1>
            <div class="input-group mb-2">
                <input type="text" class="form-control shadow" placeholder="Nome da cooperativa" name="nome" id="inputNome" required>
            </div>
            
            <div class="input-group">
                <input type="email" class="form-control shadow" placeholder="E-Mail" name="email" id="inputEmail" required>
            </div>
            <div class="input-group">
                <input type="password" class="form-control shadow" placeholder="Senha" id="inputSenha" name="senha" maxlength="255" required>
                <input type="checkbox" class="btn-check" id="btn-check" autocomplete="off" onclick="verSenha()">
                <label class="btn btn-outline-secondary shadow h-50" for="btn-check"><img src="{{asset("icons/eye.svg")}}" width="16" height="16"></label>
            </div>
            
            <div class="input-group mb-2">
                <input type="text" class="form-control shadow" name="cep" id="cep" placeholder="CEP" maxlength="8" onkeypress="return /[0-9]/i.test(event.key)" required>
                <input type="text" class="form-control shadow" name="endereco" id="endereco" placeholder="Endereço" required>
            </div>
            <div class="input-group mb-2">
                <input type="text" class="form-control shadow" name="cnpj" id="inputCNPJ" placeholder="CNPJ" maxlength="14" onkeypress="return /[0-9]/i.test(event.key)" required>
            </div>

            <div class="input-group mb-2">
                <label class="input-group-text shadow" for="inputTipo">Tipo</label>
                <select class="form-select shadow" name="tipo" id="inputTipo" aria-label="Tipo de cooperativa">
                    <option value="1">Frutas e Verduras</option>
                    <option value="2">Consumo</option>
                    <option value="3">Crédito</option>
                    <option value="4">Educacionais</option>
                    <option value="5">Especiais</option>
                    <option value="6">Habitacionais</option>
                    <option value="7">Minerais</option>
                    <option value="8">Produção</option>
                    <option value="9">Infraestrutura</option>
                    <option value="10">Trabalho</option>
                    <option value="11">Saúde</option>
                    <option value="12">Transporte</option>
                    <option value="13">Turismo e lazer</option>
                </select>
            </div>

            <div class="input-group mb-2">
                <input type="text" class="form-control shadow" name="tel1" id="inputTel1" placeholder="Tel1" maxlength="20" onkeypress="return /[0-9]/i.test(event.key)" required>
                <input type="text" class="form-control shadow" name="tel2" id="inputTel2" placeholder="Tel2">
            </div>

            <div class="input-group mb-2">
                <input type="text" class="form-control shadow" name="instagram" id="inputInstagram" placeholder="Instagram URL">
                <input type="text" class="form-control shadow" name="facebook" id="inputFacebook" placeholder="Facebook URL">
            </div>

            <div class="input-group mb-2">
                <textarea class="form-control shadow" name="descricao" placeholder="Digite um descrição sobre a sua cooperativa" id="inputTextarea"></textarea>
            </div>

            <div class="mb-2">
                <label for="basic-url" class="form-label">Imagem de perfil</label>
                <div class="input-group">
                    <input class="form-control shadow" type="file" name="perfil" id="formFile" accept=".png, .jpg, .jpeg, .webp, .avif, .jfif">
                </div>
                <div class="form-text" id="basic-addon4">.png, .jpg, .jpeg, .webp, .avif, .jfif</div>
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
