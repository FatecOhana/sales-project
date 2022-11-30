<?php
// ITEM C: Cadastrar clientes

require __DIR__ . "/../../database/operations/CustomerOperations.php";
require __DIR__ . "/../../database/model/Customer.php";

try {
    if (isset($_POST['submit'])) {

        // TODO ADD SKILL AND CITY ($_POST['city'], $_POST['skill'])
        $customer = Customer::createWithParam($_POST['name'], $_POST['address'], $_POST['phone'], $_POST['birthday'], "ATIVO",
            $_POST['email'], $_POST['gender']);

        $result = CustomerOperations::registerCustomer($customer);
    }
} catch (Exception $e) {
    error_log("exception in create customer. " . $e->getMessage());
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendas</title>
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
                    <a class="active" href="#">Cadastrar Clientes</a>
                </li>
                <li class="nav-item">
                    <a href="ListCustomer.php">Listar Clientes</a>
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
        <form action="CreateCustomer.php" method="post">
            <div class="container">

                <div class="form-items">
                    <label for="name">Nome do Cliente:</label>
                    <input type="text" name="name" id="name">
                </div>
                <div class="form-items">
                    <label for="city">Cidade:</label>
                    <input type="text" name="city" id="city">
                </div>
                <div class="form-items">
                    <label for="address">Endereço:</label>
                    <input type="text" name="address" id="address">
                </div>
                <div class="form-items">
                    <label for="phone">Telefone:</label>
                    <input type="text" name="phone" id="phone">
                </div>
                <div class="form-items">
                    <label for="birthday">Data de Nascimento:</label>
                    <input type="text" name="birthday" id="birthday">
                </div>
                <div class="form-items">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email">
                </div>
                <div class="form-items">
                    <label for="gender">Sexo:</label>
                    <input type="text" name="gender" id="gender">
                </div>
                <input type="submit" name="submit" id="submit">

            </div>
        </form>
    </div>
</main>
</body>

</html>