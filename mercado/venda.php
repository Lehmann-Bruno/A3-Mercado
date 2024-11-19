<?php
session_start();
if (!isset($_SESSION['cpf'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include('conexao.php');

    $codigo = $_POST['codigo'];
    $qtde_venda = $_POST['qtde_venda'];
    $data_venda = date('Y-m-d');
    
    // Recuperar preço do produto
    $query_produto = "SELECT preco, quantidade FROM PRODUTOS WHERE codigo = '$codigo'";
    $result_produto = mysqli_query($conn, $query_produto);
    $produto = mysqli_fetch_assoc($result_produto);

    if ($produto) {
        $valor = $produto['preco'] * $qtde_venda;
        $nova_quantidade = $produto['quantidade'] - $qtde_venda;

        // Verificar se há estoque suficiente
        if ($nova_quantidade >= 0) {
            // Inserir venda
            $query_venda = "INSERT INTO VENDAS (codigo, qtde_venda, data_venda, valor) 
                            VALUES ('$codigo', '$qtde_venda', '$data_venda', '$valor')";
            $query_altera_quantidade = "UPDATE PRODUTOS SET quantidade = '$nova_quantidade' WHERE codigo = '$codigo'";

            // Executar as queries
            if (mysqli_query($conn, $query_venda) && mysqli_query($conn, $query_altera_quantidade)) {
                $msg = "Venda realizada com sucesso!";
            } else {
                $msg = "Erro ao registrar venda!";
            }
        } else {
            $msg = "Estoque insuficiente!";
        }
    } else {
        $msg = "Produto não encontrado!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Venda</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="form-container">
        <h2>Venda</h2>
        <form method="POST">
            <label for="codigo">Código do Produto:</label>
            <input type="number" name="codigo" required><br>
            <label for="qtde_venda">Quantidade:</label>
            <input type="number" name="qtde_venda" required><br>
            <input type="submit" value="Registrar Venda">
        </form>
        <?php if (isset($msg)) { echo "<p>$msg</p>"; } ?>
    </div>
</body>
</html>
