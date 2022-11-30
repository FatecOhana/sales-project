<?php
date_default_timezone_set('America/Sao_Paulo');
require_once __DIR__ . "/../configuration/DatabaseConfiguration.php";
require_once __DIR__ . "/../operations/SaleItemsOperations.php";
require_once __DIR__ . "/../operations/CustomerOperations.php";

class SaleOperations
{

    public static function registerSale(Sale $sale): ?Sale
    {
        try {
            $fetchSale = self::fetchSale($sale);
            if (is_array($fetchSale)) {
                return $fetchSale[0];
            }

            $sale->setCustomer(CustomerOperations::registerCustomer($sale->getCustomer()));
            $sale->setSaleItems(SaleItemsOperations::registerSaleItems($sale->getSaleItems()));
            $sale->setDate(date('d-m-Y H:i:s', time()));
            $sale->setTotal($sale->calculateTotalSale());

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

            $connection = DatabaseConfiguration::openConnection();

            foreach ($saleItems as &$item) {
                if (!is_null($item) && !is_null($item->getId())) {
                    $sql_command = $connection->prepare("INSERT INTO saleitemsale(id_sale, id_sale_item) VALUE (?,?)");
                    $sql_command->execute(array($sale->getId(), $item->getId()));
                }
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
                } else if (!is_null($sale->getCustomer())) {
                    $sql_command = $connection->prepare("SELECT * FROM sale WHERE id_customer=?");
                    $sql_command->execute([$sale->getCustomer()->getId()]);
                }
            }

            if ($sql_command == "") {
                return null;
            }

            $result = array();
            while ($row = $sql_command->fetch(PDO::FETCH_ASSOC)) {
                $customer = CustomerOperations::fetchCustomer(Customer::create()->setId($row['id_customer']));
                $row['customer'] = Customer::createWithKeys($customer[0])->getName();

                $saleItemResults = self::fetchSaleItemOfSale($row['id']);
                if (isset($saleItemResults) && is_array($saleItemResults)) {
                    $row['sales_items'] = $saleItemResults;
                }

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

    public static function fetchSaleItemOfSale(int $id_sale): ?array
    {
        try {
            $connection = DatabaseConfiguration::openConnection();

            $sql_command = $connection->prepare("SELECT * FROM saleitemsale WHERE id_sale=?");
            $sql_command->execute([$id_sale]);

            $result = array();
            while ($row = $sql_command->fetch(PDO::FETCH_ASSOC)) {
                $result[] = $row;
            }

            if (!isset($result) || !is_array($result)) {
                return null;
            }

            $results = array();
            foreach ($result as &$item) {
                if (is_null($item)) continue;
                $results[] = SaleItemsOperations::fetchSaleItem(SaleItem::create()->setId($item["id_sale_item"]))[0];
            }

            return $results;
        } catch (Exception $ex) {
            return null;
        }
    }

}
