<?php
// ITEM F: Listar vendas por cliente. Solicitar um Codigo de Cliente e Listar todas as suas vendas.

require_once __DIR__ . "/../../database/operations/CustomerOperations.php";
require_once __DIR__ . "/../../database/operations/ProductOperations.php";
require_once __DIR__ . "/../../database/operations/SaleOperations.php";
require_once __DIR__ . "/../../database/model/Sale.php";
require_once __DIR__ . "/../../database/model/SaleItem.php";
require_once __DIR__ . "/../../database/model/Customer.php";

try {
    if (isset($_POST['submit'])) {
        $customer = CustomerOperations::fetchCustomer(Customer::create()->setName(returnValidValues("customer")));

        if (is_null($customer) || is_null($customer[0])) {
            echo "Cliente Invalido. Tente Selecionar uma outra Opção.";
        } else{
            $resultSales = SaleOperations::fetchSale(Sale::create()->setCustomer(Customer::createWithKeys($customer[0])));
        }
    } else {
        echo "Selecione um Cliente";
    }
} catch (Exception $e) {
    error_log("exception in create customer. " . $e->getMessage());
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

                <label for='customer'>Cliente</label>
                <select name='customer' id='customer'>
                    <?php
                    echo "<option disabled selected value=''></option>";

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

                <input type="submit" name="submit" id="submit">
            </div>
        </form>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th>Codigo Venda</th>
            <th>Codigo Cliente</th>
            <th>Cliente</th>
            <th>Data</th>
            <th>Valor Total</th>
            <th>Observações</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if (isset($resultSales) && is_array($resultSales)) {
            var_dump($resultSales);
            foreach ($resultSales as &$item) {
                echo '<tr>';
                echo "<td>" . $item['id'] . "</td>";
                echo "<td>" . $item['id_customer'] . "</td>";
                echo "<td>" . $item['customer'] . "</td>";
                echo "<td>" . $item['date'] . "</td>";
                echo "<td>" . $item['total'] . "</td>";
                echo "<td>" . $item['obs'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo '<tr>';
            echo "<td>Sem Valor</td>";
            echo "<td>Sem Valor</td>";
            echo "<td>Sem Valor</td>";
            echo "<td>Sem Valor</td>";
            echo "<td>Sem Valor</td>";
            echo "<td>Sem Valor</td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
</main>
</body>

</html>