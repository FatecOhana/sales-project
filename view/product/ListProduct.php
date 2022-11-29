<?php
// ITEM B: Listar produtos. Exibir na tela todos os produtos cadastrados
try {

    if (isset($_POST['submit'])) {
        include_once("database/operations/ProductOperations.php");
        $result = ProductOperations::fetchProduct();
    }
} catch (Exception $e) {
    error_log("exception in list product. " . $e->getMessage());
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Produtos</title>
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">

    <!-- CSS -->
    <link rel="stylesheet" href="../general/global.css">

</head>
<body>
<header>
    <nav class="navbar" id="nav">
        <div class="container-fluid">
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="CreateProduct.php">Cadastrar Produto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Listar produtos</a>
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
        </div>
    </nav>
</header>
<main>
    <div>
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>Descriçao</th>
                <th>Estoque</th>
                <th>Valor</th>
                <th>Unidade</th>
            </tr>
            </thead>
            <tbody>
            <?php
            while ($user_data = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo "<td>" . $user_data['id'] . "</td>";
                echo "<td>" . $user_data['descricao'] . "</td>";
                echo "<td>" . $user_data['estoque'] . "</td>";
                echo "<td>" . $user_data['valor'] . "</td>";
                echo "<td>" . $user_data['unidade'] . "</td>";
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
</main>
</body>
</html>