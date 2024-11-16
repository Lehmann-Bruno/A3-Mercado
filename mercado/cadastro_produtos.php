<?php
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['cpf'])) {
    header('Location: login.php');  // Redireciona se não estiver logado
    exit();
}

include('conexao.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $codigo = $_POST['codigo'];
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $validade = $_POST['validade'];
    $unid_medida = $_POST['unid_medida'];
    $desconto = $_POST['desconto'] ?? null;  // O campo desconto não é obrigatório, pode ser nulo
    $quantidade = $_POST['quantidade'];

    // Verificação dos campos obrigatórios
    if (empty($codigo) || empty($nome) || empty($preco) || empty($validade) || empty($unid_medida) || empty($quantidade)) {
        echo "Por favor, preencha todos os campos obrigatórios.";
    } else {
        // Inserir o produto no banco de dados
        $query = "INSERT INTO PRODUTOS (codigo, nome, preco, validade, unid_medida, desconto, quantidade) 
                  VALUES ('$codigo', '$nome', '$preco', '$validade', '$unid_medida', '$desconto', '$quantidade')";
        if (mysqli_query($conn, $query)) {
            $msg = "Produto cadastrado com sucesso!";
        } else {
            $msg = "Erro ao cadastrar produto: " . mysqli_error($conn);
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
    <title>Cadastro de Produtos</title>
</head>
<body>
    <header>
        <h1>Cadastro de Produto</h1>
        <a href="dashboard.php">Voltar ao Painel</a>
    </header>

    <main>
        <form method="POST" action="cadastro_produtos.php">
            <label for="codigo">Código:</label>
            <input type="number" name="codigo" id="codigo" required>
            <br>

            <label for="nome">Nome do Produto:</label>
            <input type="text" name="nome" id="nome" required>
            <br>

            <label for="preco">Preço:</label>
            <input type="number" name="preco" id="preco" step="0.01" required>
            <br>

            <label for="validade">Validade:</label>
            <input type="date" name="validade" id="validade" required>
            <br>

            <label for="unid_medida">Unidade de Medida:</label>
            <input type="text" name="unid_medida" id="unid_medida" required>
            <br>

            <label for="desconto">Desconto (%):</label>
            <input type="number" name="desconto" id="desconto" min="0" max="100">
            <br>

            <label for="quantidade">Quantidade em Estoque:</label>
            <input type="number" name="quantidade" id="quantidade" required>
            <br>

            <button type="submit">Cadastrar Produto</button>
            <?php if (isset($msg)) { echo "<p>$msg</p>"; } ?>
        </form>
    </main>
</body>
</html>
