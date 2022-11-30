<?php
// ITEM D: Listar clientes. Exibir na tela todos os clientes cadastrados

session_start();

require __DIR__ . "/../../database/operations/CustomerOperations.php";

try {
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
    <title>Lista de Clientes</title>
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
                <li class="nav-item">
                    <a href="../general/Exit.php">Sair</a>
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
                <th>Codigo</th>
                <th>Nome</th>
                <th>Cod. Cidade</th>
                <th>Cidade</th>
                <th>Endereço</th>
                <th>Data de Nascimento</th>
                <th>Status</th>
                <th>Telefone</th>
                <th>Email</th>
                <th>Sexo</th>
            </tr>
            </thead>
            <tbody>
            <?php
                if (is_array($result)) {
                    foreach ($result as &$item) {
                        echo '<tr>';
                        echo "<td>" . $item['id'] . "</td>";
                        echo "<td>" . $item['name'] . "</td>";
                        echo "<td>" . $item['id_city'] . "</td>";
                        echo "<td>" . $item['city'] . "</td>";
                        echo "<td>" . $item['address'] . "</td>";
                        echo "<td>" . $item['birthday'] . "</td>";
                        echo "<td>" . $item['status'] . "</td>";
                        echo "<td>" . $item['phone'] . "</td>";
                        echo "<td>" . $item['email'] . "</td>";
                        echo "<td>" . $item['gender'] . "</td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</main>
</body>
</html>