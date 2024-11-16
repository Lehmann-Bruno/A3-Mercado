<?php
session_start();
if (!isset($_SESSION['cpf'])) {
    header('Location: login.php');
    exit();
}

include('conexao.php');

$query = "SELECT VENDAS.cod_venda, PRODUTOS.nome, VENDAS.qtde_venda, VENDAS.data_venda, VENDAS.valor
          FROM VENDAS
          JOIN PRODUTOS ON VENDAS.codigo = PRODUTOS.codigo";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos Vendidos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Produtos Vendidos</h2>
    <table>
        <thead>
            <tr>
                <th>Código da Venda</th>
                <th>Produto</th>
                <th>Quantidade</th>
                <th>Data</th>
                <th>Valor</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['cod_venda']; ?></td>
                    <td><?php echo $row['nome']; ?></td>
                    <td><?php echo $row['qtde_venda']; ?></td>
                    <td><?php echo $row['data_venda']; ?></td>
                    <td><?php echo $row['valor']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>
