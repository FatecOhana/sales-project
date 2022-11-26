<?php

include_once "database/configuration/DatabaseConfiguration.php";

class CustomerOperations
{

    public function registerCustomer(Customer $customer): ?Customer
    {
        try {
            if (is_array($this->fetchCustomer($customer))) {
                return null;
            }

            $connection = DatabaseConfiguration::openConnection();
            $sql_command = $connection->prepare("INSERT INTO " +
                "customer(name, address, phone, birthday, status, email, gender, city, skill) VALUE (?,?,?,?,?,?,?,?,?)");

            $isInserted = $sql_command->execute(array($customer->getName(), $customer->getAddress(),
                $customer->getPhone(), $customer->getBirthday(), $customer->getStatus(), $customer->getEmail(),
                $customer->getGender(), $customer->getCity(), $customer->getSkill()));

            if (is_bool($isInserted) && $isInserted) {
                return $customer;
            } else {
                // Item not inserted
                return null;
            }
        } catch (Exception $ex) {
            return null;
        }
    }

    public function fetchCustomer(Customer $customer): ?array
    {
        try {
            $connection = DatabaseConfiguration::openConnection();

            // Prepara a Query SQL
            $sql_command = "";
            if (!is_null($customer->getName())) {
                $sql_command = $connection->prepare("SELECT * FROM customer WHERE name=?");
                $sql_command->execute($customer->getName());
            } else if (!is_null($customer->getEmail())) {
                $sql_command = $connection->prepare("SELECT * FROM customer WHERE email=?");
                $sql_command->execute($customer->getEmail());
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
