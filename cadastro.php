<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="assets/css/cadastro.css">
</head>
<body>
    <header class="header">
        <h1>Cadastro de Cliente</h1>
        <p>Preencha os dados abaixo para receber novidades sobre o seu imóvel!</p>
    </header>
    
    <div class="form-container">
        <form action="config.php" method="post" class="form-container" onsubmit="return validarFormulario()">
            <div class="form-group">
                <label for="nome"><strong>Nome</strong></label>
                <input type="text" name="nome" id="nome" required>
            </div>

            <div class="form-group">
                <label for="email"><strong>Email</strong></label>
                <input type="email" name="email" id="email" required>
            </div>

            <div class="form-group">
                <label for="senha"><strong>Senha</strong></label>
                <input type="password" name="senha" id="senha" required>
            </div>

            <div class="form-actions">
                <button type="submit" class="botao" name="Cadastrar">Cadastrar</button>
            </div>
        </form>

        <div class="login-link">
            <p>Já tem uma conta? <a href="login.php">Faça login</a></p>
        </div>
    </div>

    <script>
        function validarFormulario() {
            var nome = document.getElementById('nome').value;
            var email = document.getElementById('email').value;
            var senha = document.getElementById('senha').value;

            if (nome === "") {
                alert("Por favor, preencha o campo Nome.");
                return false;
            }

            var regexEmail = /\S+@\S+\.\S+/;
            if (!regexEmail.test(email)) {
                alert("Por favor, insira um email válido.");
                return false;
            }

            if (senha.length < 6) {
                alert("A senha deve ter pelo menos 6 caracteres.");
                return false;
            }

            return true;
        }
    </script>
</body>
</html>
