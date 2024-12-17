<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendar Visita</title>
    <link rel="stylesheet" href="assets/css/agendar.css">
</head>
<body>
    <header class="header">
        <h1>Agende sua Visita</h1>
        <p>Escolha o imóvel e a data ideal para conhecê-lo!</p>
    </header>

    <div class="form-container">
        <form action="processa_agendamento.php" method="POST">
            <div class="form-group">
                <label for="cliente_nome">Seu Nome:</label>
                <input type="text" id="cliente_nome" name="cliente_nome" required>
            </div>

            <div class="form-group">
                <label for="cliente_email">Seu Email:</label>
                <input type="email" id="cliente_email" name="cliente_email" required>
            </div>

            <div class="form-group">
                <label for="imovel_id">Selecione o Imóvel:</label>
                <select id="imovel_id" name="imovel_id" required>
                    <option value="">Escolha um imóvel</option>

                    <?php
                    include('conexao.php');
                    $sql = "SELECT id, descricao FROM imoveis";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<option value="' . $row['id'] . '">' . htmlspecialchars($row['descricao']) . '</option>';
                        }
                    } else {
                        echo '<option value="">Nenhum imóvel disponível</option>';
                    }
                    $conn->close();
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="data_visita">Data da Visita:</label>
                <input type="date" id="data_visita" name="data_visita" required>
            </div>

            <div class="form-group">
                <label for="observacoes">Observações (opcional):</label>
                <textarea id="observacoes" name="observacoes" rows="4"></textarea>
            </div>

            <button type="submit" class="submit-btn">Agendar</button>
        </form>
    </div>
</body>
</html>
