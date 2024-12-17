<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edição e Exclusão</title>
    <link rel="stylesheet" type="text/css" href="assets/css/editar_excluir.css">
</head>

<body>
    <div class="frases-container">
        <h2>Seu cadastro foi reconhecido!</h2>
        <p>Agora você pode editar ou excluir suas informações.</p>
    </div>

    <div class="forms-container">
        <form action="excluir.php" method="post" class="form-container" onsubmit="return confirmarExclusao()">
            <div class="chat">
                <label for="email_excluir"><strong>Email para Excluir</strong></label>
                <input type="email" name="email_excluir" id="email_excluir" required>
            </div>

            <div class="container">
                <button class="botao" type="submit" name="Excluir">Excluir</button>
            </div>
        </form>

        <form action="atualizar.php" method="post" class="form-container" onsubmit="return validarFormulario()">
            <div class="chat">
                <label for="nome_editar"><strong>Nome</strong></label>
                <input type="text" name="nome" id="nome_editar" required>
            </div>

            <div class="chat">
                <label for="email_editar"><strong>Email</strong></label>
                <input type="email" name="email" id="email_editar" required>
            </div>

            <div class="chat">
                <label for="senha_editar"><strong>Nova Senha</strong> (opcional)</label>
                <input type="password" name="senha" id="senha_editar">
            </div>
            
            <div class="container">
                <button class="botao" type="submit" name="Atualizar">Atualizar</button>
            </div>
        </form>
    </div>

    <div class="vt-container">
        <a href="/Projetos/" class="vt-button">Voltar para a Página Inicial</a>
    </div>

    <script>
        function validarFormulario() {
            var nome = document.getElementById('nome_editar').value;
            var email = document.getElementById('email_editar').value;
            var senha = document.getElementById('senha_editar').value;

            if (nome === "") {
                alert("Por favor, preencha o campo Nome.");
                return false;
            }

            var regexEmail = /\S+@\S+\.\S+/;
            if (!regexEmail.test(email)) {
                alert("Por favor, insira um email válido.");
                return false;
            }

            if (senha.length > 0 && senha.length < 6) {
                alert("A senha deve ter pelo menos 6 caracteres.");
                return false;
            }

            return true;
        }

        function confirmarExclusao() {
            return confirm("Você tem certeza que deseja excluir sua conta?");
        }
    </script>
</body>
</html>


