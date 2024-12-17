<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Imóveis Disponíveis</title>
    <link rel="stylesheet" href="assets/css/imoveis.css"> 
</head>

<body>
    <div class="frase-container">
        <h1>IMÓVEIS PARA VENDA OU ALUGUEL</h1>
        <p>Encontre as melhores opções disponíveis para você!</p>
    </div>

    <?php
    include('conexao.php');
    $sql = "SELECT * FROM imoveis";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<div class="imoveis-container">';
        while($row = $result->fetch_assoc()) {
            echo '<div class="imovel">'; 
            echo '<h2>' . htmlspecialchars($row["descricao"]) . '</h2>';
            $imagem = $row["imagem"];
            echo '<img src="assets/css/img/' . htmlspecialchars($imagem) . '" alt="Imagem do Imóvel" class="imovel-img">';
            echo '<p><strong>Preço:</strong> ' . htmlspecialchars($row["preco"]) . '</p>';
            echo '<p><strong>Endereço:</strong> ' . htmlspecialchars($row["endereco"]) . '</p>';
            echo '<p><strong>Contato:</strong> ' . htmlspecialchars($row["contato"]) . '</p>';
            $latitude = htmlspecialchars($row["latitude"]);
            $longitude = htmlspecialchars($row["longitude"]);
            echo '<p><strong>Localização:</strong> <a href="https://www.google.com/maps?q=' . $latitude . ',' . $longitude . '" target="_blank">Ver no Mapa</a></p>';
            echo '</div>';  
        }
        
        echo '</div>';  
    } else {
        echo '<p>Nenhum imóvel encontrado.</p>';
    }
    $conn->close();
    ?>
</body>
</html>

