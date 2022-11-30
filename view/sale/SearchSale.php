<?php
// ITEM F: Listar vendas por cliente. Solicitar um Codigo de Cliente e Listar todas as suas vendas.

require_once __DIR__ . "/../../database/operations/SaleOperations.php";
require_once __DIR__ . "/../../database/operations/ProductOperations.php";
require_once __DIR__ . "/../../database/operations/SaleOperations.php";
require_once __DIR__ . "/../../database/model/Sale.php";
require_once __DIR__ . "/../../database/model/SaleItem.php";
require_once __DIR__ . "/../../database/model/Customer.php";

try {
    if (isset($_POST['submit'])) {
        $resultSales = SaleOperations::fetchSale(Sale::create()->setId(returnValidValues("sale")));

        if (!isset($resultSales) || !is_array($resultSales)) {
            echo "Venda Invalida. Tente Selecionar uma outra Opção.";
        }
    } else {
        echo "Selecione uma Venda";
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
                    <a href="ListSaleByUser.php">Listar Vendas por Usuario</a>
                </li>
                <li class="nav-item">
                    <a href="#">Buscar Vendas</a>
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
        <form action="SearchSale.php" method="post">
            <div class="container">

                <label for='sale'>Codigo da Venda</label>
                <select name='sale' id='sale'>
                    <?php
                    echo "<option disabled selected value=''></option>";

                    $result = SaleOperations::fetchSale();
                    if (is_array($result)) {
                        foreach ($result as &$item) {
                            echo "<option>" . $item['id'] . "</option>";
                        }
                    } else {
                        echo "<option disabled>Sem Informações de Vendas</option>";
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
            <th>Prod 1: Nome</th>
            <th>Prod 1: Desconto</th>
            <th>Prod 1: Quantidade</th>
            <th>Prod 2: Nome</th>
            <th>Prod 2: Desconto</th>
            <th>Prod 2: Quantidade</th>
            <th>Prod 3: Nome</th>
            <th>Prod 3: Desconto</th>
            <th>Prod 3: Quantidade</th>
            <th>Observações</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if (isset($resultSales) && is_array($resultSales)) {
            foreach ($resultSales as &$item) {
                echo '<tr>';
                echo "<td>" . $item['id'] . "</td>";
                echo "<td>" . $item['id_customer'] . "</td>";
                echo "<td>" . $item['customer'] . "</td>";
                echo "<td>" . $item['date'] . "</td>";
                echo "<td>" . $item['total'] . "</td>";

                for ($i = 0; $i < 3; $i++) {
                    $salesItemArray = $item["sales_items"];
                    $sales_items = is_array($salesItemArray)
                        ? (count($salesItemArray) > $i ? $salesItemArray[$i] : null)
                        : null;

                    if (is_array($sales_items)) {
                        echo "<td>" . $sales_items['name'] . "</td>";
                        echo "<td>" . $sales_items['discount'] . "</td>";
                        echo "<td>" . $sales_items['amount'] . "</td>";
                    } else {
                        echo "<td> </td>";
                        echo "<td> </td>";
                        echo "<td> </td>";
                    }
                }

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
            echo "<td>Sem Valor</td>";
            echo "<td>Sem Valor</td>";
            echo "<td>Sem Valor</td>";
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