<?php

include_once (__DIR__ . "/../configuration/DatabaseConfiguration.php");

class CityOperations
{


    public static function registerCity(City $city): ?City
    {
        try {
            $existInDatabase= self::fetchCity($city);
            if (is_array($existInDatabase)) {
                return City::create()->setName($existInDatabase[0]["name"])->setId($existInDatabase[0]["id"]);
            }

            $connection = DatabaseConfiguration::openConnection();
            $sql_command = $connection->prepare("INSERT INTO city(name) VALUE (?)");

            $inserted = $sql_command->execute(array($city->getName()));
            if (is_bool($inserted) && $inserted) {
                $lastInsertedID = $connection->lastInsertId();
                $city->setId($lastInsertedID);
                return $city;
            } else {
                // Item not inserted
                return null;
            }
        } catch (Exception $ex) {
            return null;
        }
    }

    public static function fetchCity(City $city = null): ?array
    {
        try {
            $connection = DatabaseConfiguration::openConnection();

            // Prepara a Query SQL
            $sql_command = "";
            if (is_null($city)) {
                $sql_command = $connection->prepare("SELECT * FROM city");
                $sql_command->execute();
            } else {
                if (!is_null($city->getName())) {
                    $sql_command = $connection->prepare("SELECT * FROM city WHERE name=?");
                    $sql_command->execute([$city->getName()]);
                } else if (!is_null($city->getId())) {
                    $sql_command = $connection->prepare("SELECT * FROM city WHERE id=?");
                    $sql_command->execute([$city->getId()]);
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
