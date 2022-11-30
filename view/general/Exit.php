<?php
// ITEM F: Listar vendas por cliente. Solicitar um Codigo de Cliente e Listar todas as suas vendas.

session_abort();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Vendas Por Usuario</title>
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">

    <!-- CSS -->
    <link rel="stylesheet" href="../general/global.css">

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
                    <a class="nav-link" href="../customer/CreateCustomer.php">Cadastrar Clientes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../customer/ListCustomer.php">Listar Clientes</a>
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
                    <a href="#">Sair</a>
                </li>
            </ul>
        </div>
    </nav>
</header>

<br>

<h4>Sessão Encerrada</h4>

</body>

</html>