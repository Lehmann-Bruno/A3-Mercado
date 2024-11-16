<?php
session_start();
if (!isset($_SESSION['cpf'])) {
    header('Location: login.php');
    exit();
}

include('conexao.php');

$query = "SELECT nome, salario_220h, horas_trabalhadas, (salario_220h * horas_trabalhadas / 220) AS salario_final 
          FROM FUNCIONARIOS";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salários dos Funcionários</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Salários dos Funcionários</h2>
    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Salário Base (220h)</th>
                <th>Horas Trabalhadas</th>
                <th>Salário Final</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['nome']; ?></td>
                    <td><?php echo $row['salario_220h']; ?></td>
                    <td><?php echo $row['horas_trabalhadas']; ?></td>
                    <td><?php echo $row['salario_final']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>
