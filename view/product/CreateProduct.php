<?php
// ITEM A: Cadastrar produtos

try {

    if (isset($_POST['submit'])) {
        include_once("database/operations/ProductOperations.php");

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
                <label for="descricao">Descriçao:</label>
                <input type="text" name="descricao" id="descricao">
            </div>
            <div class="form-items">
                <label for="estoque">Estoque:</label>
                <input type="text" name="estoque" id="estoque">
            </div>
            <div class="form-items">
                <label for="valor">Valor:</label>
                <input type="text" name="valor" id="valor">
            </div>
            <div class="form-items">
                <label for="unidade">Unidade:</label>
                <input type="text" name="unidade" id="unidade">
            </div>

            <input type="submit" name="submit" id="submit">

        </form>
    </div>
</main>
</body>

</html>