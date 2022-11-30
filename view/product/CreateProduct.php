<?php
require __DIR__ . "/../../database/operations/ProductOperations.php";
require __DIR__ . "/../../database/model/Product.php";
// ITEM A: Cadastrar produtos

try {

    if (isset($_POST['submit'])) {

        $product = new Product($_POST['name'], $_POST['description'], $_POST['stock'], $_POST['salePrice'], $_POST['unit']);

        $productDatabase = ProductOperations::registerProduct($product);
    }
} catch (Exception $e) {
    error_log("exception in create product. " . $e->getMessage());
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crie um produto</title>
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
                    <a class="active" href="#">Cadastrar Produto</a>
                </li>
                <li class="nav-item">
                    <a href="ListProduct.php">Listar produtos</a>
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
            </ul>
        </div>
    </nav>
</header>
<main>
    <div>
        <form action="CreateProduct.php" method="post">

            <div class="form-items">
                <label for="name">Nome:</label>
                <input type="text" name="name" id="name">
            </div>
            <div class="form-items">
                <label for="description">Descriçao:</label>
                <input type="text" name="description" id="description">
            </div>
            <div class="form-items">
                <label for="stock">Estoque:</label>
                <input type="text" name="stock" id="stock">
            </div>
            <div class="form-items">
                <label for="salePrice">Valor:</label>
                <input type="text" name="salePrice" id="salePrice">
            </div>
            <div class="form-items">
                <label for="unit">Unidade:</label>
                <input type="text" name="unit" id="unit">
            </div>

            <input type="submit" name="submit" id="submit">

        </form>
    </div>
</main>
</body>

</html>