<?php
include('conexao.php');

$cliente_nome = $_POST['cliente_nome'];
$cliente_email = $_POST['cliente_email'];
$imovel_id = $_POST['imovel_id'];
$data_visita = $_POST['data_visita'];
$observacoes = $_POST['observacoes'];

$sql_imovel = "SELECT descricao FROM imoveis WHERE id = ?";
$stmt = $conn->prepare($sql_imovel);
$stmt->bind_param("i", $imovel_id);
$stmt->execute();
$stmt->bind_result($nome_imovel);
$stmt->fetch();
$stmt->close();

$sql = "INSERT INTO agendamentos (cliente_nome, cliente_email, imovel_id, nome_imovel, data_visita, observacoes) 
        VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssisss", $cliente_nome, $cliente_email, $imovel_id, $nome_imovel, $data_visita, $observacoes);

if ($stmt->execute()) {
    $mensagem = "Obrigado pela confiança! Entraremos em contato para confirmação.";
} else {
    $mensagem = "Erro: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendamento Realizado</title>

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

        .back-button {
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

        .back-button:hover {
            background: #ff8800;
            transform: scale(1.05);
        }
    </style>
</head>

<body>
    <header class="header">
        <h1>Agendamento Realizado</h1>
    </header>

    <div class="message-container">
        <p><?php echo $mensagem; ?></p>
        <a href="/Projetos/" class="back-button">Voltar para a Página Inicial</a>
    </div>
</body>
</html>

