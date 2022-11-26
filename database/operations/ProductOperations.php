<?php

include_once "database/configuration/DatabaseConfiguration.php";

class ProductOperations
{

    public function registerProduct(Product $product): ?Product
    {
        try {
            if (is_array($this->fetchProduct($product))) {
                return null;
            }

            $connection = DatabaseConfiguration::openConnection();
            $sql_command = $connection->prepare("INSERT INTO product(name, description, stock, salePrice, unit) VALUE (?,?,?,?,?)");

            if ($sql_command->execute(array($product->getName(), $product->getDescription(),
                $product->getStock(), $product->getSalePrice(), $product->getUnit()))) {
                return $product;
            } else {
                // Item not inserted
                return null;
            }
        } catch (Exception $ex) {
            return null;
        }
    }

    public function fetchProduct(Product $product): ?array
    {
        try {
            $connection = DatabaseConfiguration::openConnection();

            // Prepara a Query SQL
            $sql_command = "";
            if (!is_null($product->getName())) {
                $sql_command = $connection->prepare("SELECT * FROM product WHERE name=?");
                $sql_command->execute($product->getName());
            } else if (!is_null($product->getDescription())) {
                $sql_command = $connection->prepare("SELECT * FROM product WHERE description=?");
                $sql_command->execute($product->getDescription());
            }

            $result = array();
            while ($row = $sql_command->fetch(PDO::FETCH_ASSOC)) {
                $result[] = $row;
            }

            if (!$result) {
                return null;
            }
            return $result;
        } catch (Exception $ex) {
            return null;
        }
    }

}
