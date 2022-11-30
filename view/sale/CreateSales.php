<?php
require_once __DIR__ . "/../../database/operations/CustomerOperations.php";
require_once __DIR__ . "/../../database/operations/ProductOperations.php";
require_once __DIR__ . "/../../database/operations/SaleOperations.php";
require_once __DIR__ . "/../../database/model/Sale.php";
require_once __DIR__ . "/../../database/model/SaleItem.php";
require_once __DIR__ . "/../../database/model/Customer.php";
// ITEM A: Cadastrar produtos

try {
    if (isset($_POST['submit'])) {

        $salesItems = array();
        if (checkValidValues("product01")) {
            $productOne = SaleItem::create()->setName(returnValidValues("product01"));
            $productOne->setDiscount(returnValidValues("discount01"));
            $productOne->setAmount(returnValidValues("quantity01"));
            $salesItems[] = $productOne;
        }
        if (checkValidValues("product02")) {
            $productTwo = SaleItem::create()->setName(returnValidValues("product02"));
            $productTwo->setDiscount(returnValidValues("discount02"));
            $productTwo->setAmount(returnValidValues("quantity02"));
            $salesItems[] = $productTwo;
        }
        if (checkValidValues("product03")) {
            $productThree = SaleItem::create()->setName(returnValidValues("product03"));
            $productThree->setDiscount(returnValidValues("discount03"));
            $productThree->setAmount(returnValidValues("quantity03"));
            $salesItems[] = $productThree;
        }

        $customer = null;
        if (checkValidValues("customer")) {
            $customer = Customer::create()->setName(returnValidValues("customer"));
        } else {
            echo "Selecione um Cliente Valido";
            return;
        }

        $sale = Sale::create()->setSaleItems($salesItems)->setCustomer($customer)->setObs(returnValidValues("observation"));
        $saleDatabase = SaleOperations::registerSale($sale);
    }
} catch (Exception $e) {
    error_log("exception in create product. " . $e->getMessage());
}

function returnValidValues($key)
{
    return checkValidValues($key) ? $_POST[$key] : null;
}

function checkValidValues($key): bool
{
    return isset($_POST[$key]) && !empty($_POST[$key]);
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Produto</title>
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
                    <a href="#">Registrar Vendas</a>
                </li>
                <li class="nav-item">
                    <a href="ListSaleByUser.php">Listar Vendas por Usuario</a>
                </li>
                <li class="nav-item">
                    <a href="SearchSale.php">Buscar Vendas</a>
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
        <form action="CreateSales.php" method="post">

            <label for='customer'>Cliente</label>
            <select name='customer' id='customer'>
                <?php
                echo "<option disabled selected></option>";

                $result = CustomerOperations::fetchCustomer();
                if (is_array($result)) {
                    foreach ($result as &$item) {
                        echo "<option>" . $item['name'] . "</option>";
                    }
                } else {
                    echo "<option disabled>Sem Informações de Cliente</option>";
                }
                ?>
            </select>

            <br>
            <br>

            <label for='product01'>Produto 01</label>
            <select name='product01' id='product01'>
                <?php
                echo "<option disabled selected></option>";

                $result = ProductOperations::fetchProduct();
                if (is_array($result)) {
                    foreach ($result as &$item) {
                        echo "<option>" . $item['name'] . "</option>";
                    }
                } else {
                    echo "<option disabled>Sem Informações de Produto</option>";
                }
                ?>
            </select>
            <div class="form-items">
                <label for="quantity01">Quantidade:</label>
                <input type="number" name="quantity01" id="quantity01">
            </div>
            <div class="form-items">
                <label for="discount01">Desconto:</label>
                <input type="number" name="discount01" id="discount01">
            </div>

            <br>
            <br>

            <label for='product02'>Produto 02</label>
            <select name='product02' id='product02'>
                <?php
                echo "<option disabled selected></option>";

                $result = ProductOperations::fetchProduct();
                if (is_array($result)) {
                    foreach ($result as &$item) {
                        echo "<option>" . $item['name'] . "</option>";
                    }
                } else {
                    echo "<option disabled>Sem Informações de Produto</option>";
                }
                ?>
            </select>
            <div class="form-items">
                <label for="quantity02">Quantidade:</label>
                <input type="number" name="quantity02" id="quantity02">
            </div>
            <div class="form-items">
                <label for="discount02">Desconto:</label>
                <input type="number" name="discount02" id="discount02">
            </div>

            <br>
            <br>

            <label for='product03'>Produto 03</label>
            <select name='product03' id='product03'>
                <?php
                echo "<option disabled selected></option>";

                $result = ProductOperations::fetchProduct();
                if (is_array($result)) {
                    foreach ($result as &$item) {
                        echo "<option>" . $item['name'] . "</option>";
                    }
                } else {
                    echo "<option disabled>Sem Informações de Produto</option>";
                }
                ?>
            </select>
            <div class="form-items">
                <label for="discount03">Desconto:</label>
                <input type="number" name="discount03" id="discount03">
            </div>
            <div class="form-items">
                <label for="quantity03">Quantidade:</label>
                <input type="number" name="quantity03" id="quantity03">
            </div>

            <br>
            <br>

            <div class="form-items">
                <label for="observation">Observação:</label>
                <input type="text" name="observation" id="observation">
            </div>

            <br>

            <input type="submit" name="submit" id="submit">

        </form>
    </div>
</main>
</body>

</html>