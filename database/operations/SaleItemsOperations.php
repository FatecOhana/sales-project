<?php

require_once __DIR__ . "/../configuration/DatabaseConfiguration.php";

class SaleItemsOperations
{
    public static function registerSaleItems(array $saleItems = null): array
    {
        try {
            if (!isset($saleItem) || !is_array($saleItems)) {
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
            if (is_array(self::fetchSaleItem($saleItem))) {
                return $saleItem;
            }

            $connection = DatabaseConfiguration::openConnection();
            $sql_command = $connection->prepare("INSERT INTO saleitem(amount, discount, totalValue) VALUE (?,?,?)");

            $isInserted = $sql_command->execute(array($saleItem->getAmount(), $saleItem->getDiscount(), $saleItem->getTotalValue()));

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

   /* private static function setSaleItemAndProductRelation(Sale $sale)
    {
        try {
            if (is_array(self::fetchSaleItem($saleItem))) {
                return $saleItem;
            }

            $connection = DatabaseConfiguration::openConnection();
            $sql_command = $connection->prepare("INSERT INTO sale(amount, discount, totalValue) VALUE (?,?,?)");

            $isInserted = $sql_command->execute(array($saleItem->getAmount(), $saleItem->getDiscount(), $saleItem->getTotalValue()));

            if (is_bool($isInserted) && $isInserted) {
                return $saleItem;
            } else {
                // Item not inserted
                return null;
            }
        } catch (Exception $ex) {
            return null;
        }
    }*/

    public static function fetchSaleItem(SaleItem $saleItem = null): ?array
    {
        try {
            $connection = DatabaseConfiguration::openConnection();

            $sql_command = "";
            if (is_null($saleItem)) {
                $sql_command = $connection->prepare("SELECT * FROM saleitem");
            } else {
                if (!is_null($saleItem->getId())) {
                    $sql_command = $connection->prepare("SELECT * FROM saleitem WHERE id=?");
                    $sql_command->execute($saleItem->getId());
                }
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
