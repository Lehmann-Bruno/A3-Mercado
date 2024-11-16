<?php
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['cpf'])) {
    header('Location: login.php');  // Redireciona se não estiver logado
    exit();
}

include('conexao.php');

// Definir a consulta para exibir todos os produtos cadastrados
$query = "SELECT * FROM PRODUTOS";
$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Produtos</title>
    <link rel="stylesheet" href="style.css">  <!-- Link para o seu CSS -->
</head>
<body>
    <header>
        <h1>Consulta de Produtos</h1>
        <a href="dashboard.php">Voltar ao Painel</a>
    </header>

    <main>
        <h2>Lista de Produtos Cadastrados</h2>

        <?php if (mysqli_num_rows($result) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nome</th>
                        <th>Preço</th>
                        <th>Validade</th>
                        <th>Unidade de Medida</th>
                        <th>Desconto (%)</th>
                        <th>Quantidade</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($produto = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?php echo $produto['codigo']; ?></td>
                            <td><?php echo $produto['nome']; ?></td>
                            <td><?php echo number_format($produto['preco'], 2, ',', '.'); ?></td>
                            <td><?php echo date('d/m/Y', strtotime($produto['validade'])); ?></td>
                            <td><?php echo $produto['unid_medida']; ?></td>
                            <td><?php echo $produto['desconto'] ?? 'Sem Desconto'; ?></td>
                            <td><?php echo $produto['quantidade']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Nenhum produto encontrado.</p>
        <?php endif; ?>
    </main>

    <footer>
        <p>&copy; 2024 Mercado</p>
    </footer>

</body>
</html>
