<?php
// ITEM D: Listar clientes. Exibir na tela todos os clientes cadastrados

session_start();

try {
    include_once("database/operations/CustomerOperations.php");
    $result = CustomerOperations::fetchCustomer();
} catch (Exception $e) {
    error_log("exception in list customer. " . $e->getMessage());
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuários</title>
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">

    <!-- CSS -->
    <link rel="stylesheet" href="../general/global.css">

    <style>
        main {
            margin: 1em;
        }
    </style>

</head>
<body>
<header>
    <nav class="navbar" id="nav">
        <div class="container">
            <ul>
                <li class="nav-item">
                    <a href="../product/CreateProduct.php">Cadastrar Produto</a>
                </li>
                <li class="nav-item">
                    <a href="../product/ListProduct.php">Listar produtos</a>
                </li>
                <li class="nav-item">
                    <a href="CreateCustomer.php">Cadastrar Clientes</a>
                </li>
                <li class="nav-item">
                    <a class="active" href="ListCustomer.php">Listar Clientes</a>
                </li>
                <li class="nav-item">
                    <a href="../sale/CreateSales.php">Registrar Vendas</a>
                </li>
                <li class="nav-item">
                    <a href="../sale/ListSaleByUser.php">Listar Vendas por Usuario</a>
                </li>
                <li class="nav-item">
                    <a href="../sale/SearchSale.php">Buscar Vendas</a>
                </li>
            </ul>
        </div>
    </nav>
</header>
<main>
    <div>
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Endereço</th>
                <th>Telefone</th>
                <th>Data de Nascimento</th>
                <th>Status</th>
                <th>Email</th>
                <th>Sexo</th>
            </tr>
            </thead>
            <tbody>
            <?php
            while ($user_data = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $user_data['id'] . "</td>";
                echo "<td>" . $user_data['nome'] . "</td>";
                echo "<td>" . $user_data['endereco'] . "</td>";
                echo "<td>" . $user_data['telefone'] . "</td>";
                echo "<td>" . $user_data['data_nasc'] . "</td>";
                echo "<td>" . $user_data['sstatus'] . "</td>";
                echo "<td>" . $user_data['email'] . "</td>";
                echo "<td>" . $user_data['sexo'] . "</td>";
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
</main>
</body>
</html>