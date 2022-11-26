<?php

class DatabaseConfiguration
{

    /**
     * Open connection in database
     * @throws Exception any error while open database connection
     */
    public static function openConnection(): PDO
    {
        try {
            $connection = new PDO("mysql: host=localhost;dbname=sales_project", "admin", "admin");
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $connection;
        } catch (PDOException $ex) {
            throw new Exception("Erro na Conexão com o Banco de Dados." .
                "Exceção: " . $ex->getMessage());
        }
    }

}
