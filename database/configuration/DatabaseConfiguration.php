<?php

class DatabaseConfiguration
{
    public PDO $connection;

    /**
     * Open connection in database
     * @throws Exception any error while open database connection
     */
    public function OpenConnection()
    {
        try {
            $connection = new PDO("mysql: host=localhost;dbname=sales_project", "admin", "admin");
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $this->connection = $connection;
        } catch (PDOException $ex) {
            $connection = null;
            throw new Exception("Erro na Conexão com o Banco de Dados." .
                "Exceção: " . $ex->getMessage());
        }
    }

}
