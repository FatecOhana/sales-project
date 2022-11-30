<?php
date_default_timezone_set('America/Sao_Paulo');
require_once __DIR__ . "/../configuration/DatabaseConfiguration.php";
require_once __DIR__ . "/../operations/SaleItemsOperations.php";

class SaleOperations
{

    public static function registerSale(Sale $sale): ?Sale
    {
        try {
            if (is_array(self::fetchSale($sale))) {
                return null;
            }

            $sale->setSaleItems(SaleItemsOperations::registerSaleItems($sale->getSaleItems()));
            $sale->setCustomer(CustomerOperations::registerCustomer($sale->getCustomer()));
            $sale->setDate(date('d/m/Y h:i:s', time()));

            $connection = DatabaseConfiguration::openConnection();
            $sql_command = $connection->prepare("INSERT INTO sale(date, total, obs, id_customer) VALUE (?,?,?,?)");

            $isInserted = $sql_command->execute(array($sale->getDate(), $sale->getTotal(),
                $sale->getObs(), $sale->getCustomer()->getId()));

            if (is_bool($isInserted) && $isInserted) {
                $lastInsertedID = $connection->lastInsertId();
                $sale->setId($lastInsertedID);
                self::setSaleAndSaleItemRelation($sale, $sale->getSaleItems());

                return $sale;
            } else {
                // Item not inserted
                return null;
            }
        } catch (Exception $ex) {
            return null;
        }
    }

    private static function setSaleAndSaleItemRelation(Sale $sale, array $saleItems = null): void
    {
        try {
            if (!is_array($saleItems)) {
                return;
            }

            $resultSaleItems = SaleItemsOperations::registerSaleItems($saleItems);
            $connection = DatabaseConfiguration::openConnection();

            foreach ($resultSaleItems as &$item) {
                $sql_command = $connection->prepare("INSERT INTO saleitemsale(id_sale, id_sale_item) VALUE (?,?)");

                $itemDecoded = json_decode($item);
                $sql_command->execute(array($sale->getId(), $itemDecoded["id"]));
            }

        } catch (Exception $ex) {
            return;
        }
    }

    public static function fetchSale(Sale $sale = null): ?array
    {
        try {
            $connection = DatabaseConfiguration::openConnection();

            $sql_command = "";
            if (is_null($sale)) {
                $sql_command = $connection->prepare("SELECT * FROM sale");
                $sql_command->execute();
            } else {
                if (!is_null($sale->getId())) {
                    $sql_command = $connection->prepare("SELECT * FROM sale WHERE id=?");
                    $sql_command->execute([$sale->getId()]);
                }else if (!is_null($sale->getCustomer())) {
                    $sql_command = $connection->prepare("SELECT * FROM sale WHERE id_customer=?");
                    $sql_command->execute([$sale->getCustomer()->getId()]);
                }
            }

            if ($sql_command == "") {
                return null;
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

    public static function fetchSaleItemOfSale(Sale $sale): ?array
    {
        try {
            if (!is_null($sale->getId())) {
                return null;
            }

            $saleDatabase = json_decode(self::fetchSale($sale)[0]);

            $connection = DatabaseConfiguration::openConnection();

            $sql_command = "";
            if (!is_null($sale->getId())) {
                $sql_command = $connection->prepare("SELECT * FROM saleitemsale WHERE id_sale=?");
                $sql_command->execute([$saleDatabase["id"]]);
            }

            $result = array();
            while ($row = $sql_command->fetch(PDO::FETCH_ASSOC)) {
                $result[] = $row;
            }

            if (!$result) {
                return null;
            }

            $results = array();
            foreach ($result as &$item) {
                $saleWithId = SaleItem::create()->setId($result["id"]);
                $results[] = SaleItemsOperations::fetchSaleItem($saleWithId);
            }

            return $results;
        } catch (Exception $ex) {
            return null;
        }
    }

}
