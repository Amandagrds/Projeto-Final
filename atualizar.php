<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nome'], $_POST['email'])) {
    $nome = $_POST['nome'];
    $email_atual = $_POST['email'];
    $senha_nova = $_POST['senha'];

    $host = "localhost";
    $banco = "formulario";
    $user = "root";
    $senha_user = "";

    $con = mysqli_connect($host, $user, $senha_user, $banco);

    if (!$con) {
        die("Conexão falhou: " . mysqli_connect_error());
    }

    $sql = "UPDATE usuarios SET Nome = ?, Email = ?";
    if (!empty($senha_nova)) {
        $sql .= ", Senha = ?";
    }
    $sql .= " WHERE Email = ?";
    $stmt = $con->prepare($sql);
    if (!empty($senha_nova)) {
        $stmt->bind_param("ssss", $nome, $email_atual, $senha_nova, $email_atual);
    } else {
        $stmt->bind_param("sss", $nome, $email_atual, $email_atual);
    }
    if ($stmt->execute()) {
        $mensagem = "Informações atualizadas com sucesso.";
    } else {
        $mensagem = "Erro ao atualizar informações: " . $stmt->error;
    }
    $stmt->close();
    mysqli_close($con);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informações Atualizadas</title>
    <style>

        body {
            margin: 0;
            padding: 0;
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(90deg, #001244, #001244);
            color: white;
        }

        .header {
            text-align: center;
            padding: 20px;
            background: #001244;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 2.5rem;
            margin-bottom: 10px;
        }

        .message-container {
            max-width: 600px;
            margin: 50px auto;
            text-align: center;
            padding: 20px;
            background: #11114A;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        .message-container p {
            font-size: 1.2rem;
            margin-bottom: 20px;
        }

        .voltar-button {
            padding: 12px 20px;
            font-size: 1.1rem;
            background: #ff8800;
            color: #001244;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
            transition: background 0.3s;
        }

        .voltar-button:hover {
            background: #ff8800;
            transform: scale(1.05);
        }
    </style>
</head>

<body>
    <header class="header">
        <h1>Informações Atualizadas!</h1>
    </header>
    <div class="message-container">
        <p><?php echo $mensagem; ?></p>
        <a href="/Projetos/" class="voltar-button">Voltar para a Página Inicial</a>
    </div>
</body>
</html>


