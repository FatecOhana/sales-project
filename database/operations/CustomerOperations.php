<?php

include_once(__DIR__ . "/../configuration/DatabaseConfiguration.php");
include_once(__DIR__ . "/../operations/SkillOperations.php");

class CustomerOperations
{

    public static function registerCustomer(Customer $customer): ?Customer
    {
        try {
            if (is_array(self::fetchCustomer($customer))) {
                return $customer;
            }

            $customer->setSkill(SkillOperations::registerSkills($customer->getSkill()));

            $connection = DatabaseConfiguration::openConnection();
            $sql_command = $connection->prepare("INSERT INTO " .
                "customer(name, address, phone, birthday, status, email, gender) VALUE (?,?,?,?,?,?,?)");

            // TODO ADD CITY DEPENDENCIES

            $isInserted = $sql_command->execute(array($customer->getName(), $customer->getAddress(),
                $customer->getPhone(), $customer->getBirthday(), $customer->getStatus(), $customer->getEmail(),
                $customer->getGender()));

            if (is_bool($isInserted) && $isInserted) {
                $lastInsertedID = $connection->lastInsertId();
                $customer->setId($lastInsertedID);

                self::setCustomerAndSkillRelation($customer, $customer->getSkill());

                return $customer;
            } else {
                // Item not inserted
                return null;
            }
        } catch (Exception $ex) {
            return null;
        }
    }

    public static function fetchCustomer(Customer $customer = null): ?array
    {
        try {
            $connection = DatabaseConfiguration::openConnection();

            $sql_command = "";
            if (is_null($customer)) {
                $sql_command = $connection->prepare("SELECT * FROM customer");
                $sql_command->execute();
            } else {
                if (!is_null($customer->getName())) {
                    $sql_command = $connection->prepare("SELECT * FROM customer WHERE name=?");
                    $sql_command->execute([$customer->getName()]);
                } else if (!is_null($customer->getEmail())) {
                    $sql_command = $connection->prepare("SELECT * FROM customer WHERE email=?");
                    $sql_command->execute([$customer->getEmail()]);
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

    private static function setCustomerAndSkillRelation(Customer $customer, array $skills = null): void
    {
        try {
            if (!is_array($skills)) {
                return;
            }

            $resultSkills = SkillOperations::registerSkills($skills);

            $connection = DatabaseConfiguration::openConnection();
            foreach ($resultSkills as &$item) {
                $sql_command = $connection->prepare("INSERT INTO customer_skill(id_customer, id_skill) VALUE (?,?)");
                $sql_command->execute(array($customer->getId(), $item->getId()));
            }
        } catch (Exception $ex) {
        }
    }

}
