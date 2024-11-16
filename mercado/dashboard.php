<?php
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['cpf'])) {
    header('Location: login.php');  // Redireciona se não estiver logado
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">  <!-- Link para o seu CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet"> <!-- Font Awesome CDN -->
</head>
<body>
    <header>
        <h1>Bem-vindo ao Dashboard</h1>
        <a href="logout.php">Sair</a>
    </header>

    <main>
        <section>
            <h2>Escolha uma opção</h2>
            
            <div class="opcoes">
                <div class="opcao">
                    <a href="cadastro_produtos.php">
                        <i class="fas fa-box"></i> Cadastro de Produtos
                    </a>
                </div>
                
                <div class="opcao">
                    <a href="cadastro_funcionario.php">
                        <i class="fas fa-user-tie"></i> Cadastro de Funcionário
                    </a>
                </div>

                <div class="opcao">
                    <a href="venda.php">
                        <i class="fas fa-cash-register"></i> Tela de Venda
                    </a>
                </div>

                <div class="opcao">
                    <a href="consulta_produtos.php">
                        <i class="fas fa-search"></i> Consulta de Produtos
                    </a>
                </div>

                <div class="opcao">
                    <a href="produtos_vendidos.php">
                        <i class="fas fa-list"></i> Produtos Vendidos
                    </a>
                </div>

                <div class="opcao">
                    <a href="salarios_funcionarios.php">
                        <i class="fas fa-dollar-sign"></i> Salários dos Funcionários
                    </a>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Mercado</p>
    </footer>
</body>
</html>
