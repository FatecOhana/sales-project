<?php
// ITEM F: Listar vendas por cliente. Solicitar um Codigo de Cliente e Listar todas as suas vendas.


try {
    if (isset($_POST['submit'])) {
        include_once("database/operations/CustomerOperations.php");

        $customer = new Customer($_POST['name'], $_POST['address'], $_POST['phone'], $_POST['birthday'], $_POST['status'],
            $_POST['email'], $_POST['gender'], $_POST['city'], $_POST['skill']);

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
                    <a href="CreateSales.php">Registrar Vendas</a>
                </li>
                <li class="nav-item">
                    <a href="#">Listar Vendas por Usuario</a>
                </li>
                <li class="nav-item">
                    <a href="SearchSale.php">Buscar Vendas</a>
                </li>
            </ul>
        </div>
    </nav>
</header>
<main>
    <div>
        <form action="ListSaleByUser.php" method="post">
            <div class="container">

                <div class="form-items">
                    <label for="nome">Nome do Cliente:</label>
                    <input type="text" name="nome" id="nome" aria-describedby="nome">
                </div>
                <div class="form-items">
                    <label for="endereco">Endereço:</label>
                    <input type="text" name="endereco" id="Endereco">
                </div>
                <div class="form-items">
                    <label for="telefone">Telefone:</label>
                    <input type="text" name="telefone" id="telefone">
                </div>
                <div class="form-items">
                    <label for="data_nasc">Data de Nascimento:</label>
                    <input type="text" name="data_nasc" id="data_nasc">
                </div>
                <div class="form-items">
                    <label for="sstatus">Status:</label>
                    <input type="text" name="sstatus" id="sstatus">
                </div>
                <div class="form-items">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email">
                </div>
                <div class="form-items">
                    <label for="sexo">Sexo:</label>
                    <input type="text" name="sexo" id="sexo">
                </div>
                <input type="submit" name="submit" id="submit">

            </div>
        </form>
    </div>
</main>
</body>

</html>