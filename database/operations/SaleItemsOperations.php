<?php

require_once __DIR__ . "/../configuration/DatabaseConfiguration.php";

class SaleItemsOperations
{
    public static function registerSaleItems(array $saleItems = null): array
    {
        try {
            if (!isset($saleItems) || !is_array($saleItems)) {
                return array();
            }

            $results = array();
            foreach ($saleItems as &$item) {
                $results[] = self::registerSaleItem($item);
            }

            return $results;
        } catch (Exception $ex) {
            return array();
        }
    }

    public static function registerSaleItem(SaleItem $saleItem): ?SaleItem
    {
        try {
            $fetchSaleItem = self::fetchSaleItem($saleItem);
            if (is_array($fetchSaleItem)) {
                $saleItem = $fetchSaleItem[0];
                return SaleItem::create()->setName($saleItem["name"])->setId($saleItem["id"])->setAmount($saleItem["amount"])
                    ->setDiscount($saleItem["discount"])->setTotalValue($saleItem["totalValue"])->setUnit($saleItem["unit"])
                    ->setSalePrice($saleItem["salePrice"])->setStock($saleItem["stock"])->setDescription($saleItem["description"]);
            }

            $productValues = ProductOperations::fetchProduct(Product::create()->setName($saleItem->getName()));

            if (!isset($productValues) || !is_array($productValues)) {
                return null;
            }

            $product = $productValues[0];

            $saleItem->setSalePrice($product["salePrice"])->setName($product["name"])->setDescription($product["description"]);
            $saleItem->setTotalValue($saleItem->calculateTotalValue());

            $connection = DatabaseConfiguration::openConnection();
            $sql_command = $connection->prepare("INSERT INTO saleitem(amount, discount, totalValue, id_product) VALUE (?,?,?,?)");

            $isInserted = $sql_command->execute(array($saleItem->getAmount(), $saleItem->getDiscount(),
                $saleItem->getTotalValue(), $product["id"]));

            if (is_bool($isInserted) && $isInserted) {
                $lastInsertedID = $connection->lastInsertId();
                $saleItem->setId($lastInsertedID);
                return $saleItem;
            } else {
                // Item not inserted
                return null;
            }
        } catch (Exception $ex) {
            return null;
        }
    }

    public static function fetchSaleItem(SaleItem $saleItem = null): ?array
    {
        try {
            $connection = DatabaseConfiguration::openConnection();

            $sql_command = "";
            if (is_null($saleItem)) {
                $sql_command = $connection->prepare("SELECT * FROM saleitem");
                $sql_command->execute();
            } else {
                if (!is_null($saleItem->getId())) {
                    $sql_command = $connection->prepare("SELECT * FROM saleitem WHERE id=?");
                    $sql_command->execute([$saleItem->getId()]);
                }
            }

            if ($sql_command == "") {
                return null;
            }

            $result = array();
            while ($row = $sql_command->fetch(PDO::FETCH_ASSOC)) {
                $productValues = ProductOperations::fetchProduct(Product::create()->setId($row["id_product"]));

                if (!isset($productValues) || !is_array($productValues)) {
                    $result[] = $row;
                }

                $product = $productValues[0];
                $finalRow = $row;
                $finalRow["salePrice"] = $product["salePrice"];
                $finalRow["name"] = $product["name"];
                $finalRow["unit"] = $product["unit"];
                $finalRow["description"] = $product["description"];

                foreach ($result as &$item) {
                    if (is_null($item)) continue;

                    $productValues = ProductOperations::fetchProduct(Product::create()->setId($item["id_product"]));
                    if (!isset($productValues) || !is_array($productValues)) {
                        return null;
                    }

                    $product = $productValues[0];
                    $finalRow->setSalePrice($product["salePrice"])->setName($product["name"])->setDescription($product["description"]);
                    $finalRow->setTotalValue($finalRow->calculateTotalValue());
                }

                $result[] = $finalRow;
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
