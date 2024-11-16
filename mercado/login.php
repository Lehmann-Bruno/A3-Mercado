<?php
session_start();
if (isset($_SESSION['cpf'])) {
    header('Location: dashboard.php');  // Redireciona se já estiver logado
    exit();
}

include('conexao.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cpf = $_POST['cpf'];
    $senha = $_POST['senha'];

    // Verifique se as variáveis CPF e senha foram fornecidas
    if (empty($cpf) || empty($senha)) {
        echo "Por favor, preencha todos os campos.";
    } else {
        $query = "SELECT * FROM FUNCIONARIOS WHERE cpf = '$cpf' AND senha = '$senha'";
        $result = mysqli_query($conn, $query);
        
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['cpf'] = $row['cpf'];
            $_SESSION['nome'] = $row['nome'];  // Se desejar armazenar o nome do usuário
            header('Location: dashboard.php'); // Redireciona para a página inicial
            exit();
        } else {
            echo "Usuário ou senha inválidos!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">  
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form method="POST" action="login.php">
        <label for="cpf">CPF:</label>
        <input type="text" name="cpf" id="cpf" required>
        <br>
        <label for="senha">Senha:</label>
        <input type="password" name="senha" id="senha" required>
        <br>
        <button type="submit">Entrar</button>
    </form>
</body>
</html>

