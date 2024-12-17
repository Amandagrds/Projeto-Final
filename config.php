<?php
if (isset($_POST['Cadastrar'])) 
    $nome = $_POST['nome'];
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
        if ($usuario['status'] === 'inativo') {
            $sql_update = "UPDATE usuarios SET Nome = '$nome', Senha = '$senha', status = 'ativo' WHERE Email = '$email'";
            if (mysqli_query($con, $sql_update)) {
                session_start();
                $_SESSION['email'] = $usuario['Email'];
                $_SESSION['nome'] = $usuario['Nome']; 
                header("Location: editar_excluir.php"); 
                exit();
            } else {
                echo "Erro ao reativar a conta.";
            }
        } else {
            echo "Este email já está ativo.";
        }
    } else 

        $sql_insert = "INSERT INTO usuarios (Nome, Email, Senha, status) VALUES ('$nome', '$email', '$senha', 'ativo')";

if (mysqli_query($con, $sql_insert)) {
    session_start();
    $_SESSION['email'] = $email;
    $_SESSION['nome'] = $nome; 

    header("Location: editar_excluir.php");
    exit(); 
} else {
    echo "Erro ao cadastrar.";
}

?>