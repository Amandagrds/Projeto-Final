<?php
session_start();
$erro = ''; 

if (isset($_POST['Login'])) {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $host = "localhost";
    $banco = "formulario";
    $user = "root";
    $senha_user = "";

    $con = mysqli_connect($host, $user, $senha_user, $banco);
    if (!$con) {
        die("Conexão falhou: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM usuarios WHERE Email = '$email'";
    $result = mysqli_query($con, $sql);
    $usuario = mysqli_fetch_assoc($result);

    if ($usuario) {
        if ($senha == $usuario['Senha']) {
            if ($usuario['status'] == 'ativo') {
                $_SESSION['email'] = $usuario['Email'];
                $_SESSION['nome'] = $usuario['Nome'];
                header("Location: editar_excluir.php"); 
                exit();
            } else {
                $erro = "Conta inativa. Por favor, cadastre-se novamente.";
            }
        } else {
            $erro = "Email ou senha incorretos.";
        }
    } else {
        $erro = "Email não encontrado.";
    }
    mysqli_close($con);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="assets/css/login.css"> 
</head>
<body>
    <div class="login-container">
        <h2 id="titulo">Acesse sua conta!</h2>
        <p id="subtitulo">Preencha as informações</p>

      
        <form action="login.php" method="post" class="form-container">
            <div class="input-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>
            </div>

            <div class="input-group">
                <label for="senha">Senha:</label>
                <input type="password" name="senha" id="senha" required>
            </div>

            <div class="button-container">
                <button class="botao" type="submit" name="Login">Login</button>
            </div>

            <?php
            if (!empty($erro)): ?>
                <div class="erro-container">
                    <p class="erro-msg"><?= $erro; ?></p>
                </div>
            <?php endif;
            ?>

            <p class="signup-link">Não tem uma conta? <a href="cadastro.php">Cadastre-se</a></p>
        </form>
    </div>
</body>
</html>
