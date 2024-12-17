<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email_excluir'])) {
    $email_excluir = $_POST['email_excluir'];

    $host = "localhost";
    $banco = "formulario";
    $user = "root";
    $senha_user = "";

    $con = mysqli_connect($host, $user, $senha_user, $banco);

    if (!$con) {
        die("Conexão falhou: " . mysqli_connect_error());
    }

    $sql = "UPDATE usuarios SET status = 'inativo' WHERE Email = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $email_excluir);

    if ($stmt->execute()) {
        $mensagem = "Você não receberá notificações da GDE.";
    } else {
        $mensagem = "Erro ao atualizar o status: " . $stmt->error;
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
    <title>Email Excluído</title>

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
        <h1>Email Excluído!</h1>
    </header>

    <div class="message-container">
        <p><?php echo $mensagem; ?></p>
        <a href="/Projetos/" class="voltar-button">Voltar para a Página Inicial</a>
    </div>
</body>
</html>


