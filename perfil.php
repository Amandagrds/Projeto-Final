<?php
session_start(); 

$host = "localhost";
$banco = "formulario";
$user = "root";
$senha_user = "";
$con = mysqli_connect($host, $user, $senha_user, $banco);

if (!$con) {
    die("Conexão falhou: " . mysqli_connect_error()); 
}

$email_usuario = $_SESSION['email']; 
if (!$email_usuario) {
    die("Erro: Nenhum email de usuário encontrado na sessão.");
}

$sql = "SELECT Nome, Email, status FROM usuarios WHERE Email = ?";
$stmt = $con->prepare($sql);

if (!$stmt) {
    die("Erro na preparação da consulta: " . $con->error); 
}

$stmt->bind_param("s", $email_usuario);

if (!$stmt->execute()) {
    die("Erro na execução da consulta: " . $stmt->error);
}

$result = $stmt->get_result();
if (!$result) {
    die("Erro ao obter o resultado: " . $stmt->error);
}

$user_data = $result->fetch_assoc();
if (!$user_data) {
    die("Nenhum usuário encontrado com este email."); 
}

$stmt->close();
mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Meu Perfil</title>
    <link rel="stylesheet" type="text/css" href="assets/css/perfil.css">
</head>

<body>
    <h2>Meu Perfil</h2>
    <p><strong>Nome:</strong> <?php echo htmlspecialchars($user_data['Nome']); ?></p>
    <p><strong>Email:</strong> <?php echo htmlspecialchars($user_data['Email']); ?></p>
    <p><strong>Status:</strong> <?php echo htmlspecialchars($user_data['status']); ?></p>
    <a href="editar_perfil.php">Editar Perfil</a>
</body>
</html>


