<?php

class HandlerDatabase
{
    public $connection;

    /**
     * Open connection in database
     * @throws Exception any error while open database connection
     */
    public function OpenConnection()
    {
        try {
            // Configura a Conexão e Habilita a Obtenção de Erros
            $connection = new PDO("mysql: host=localhost;dbname=sales_project", "admin", "admin");
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Atribui à Variavel da Classe a Conexão
            $this->connection = $connection;

        } catch (PDOException $ex) {
            $connection = null;
            throw new Exception("Erro na Conexão com o Banco de Dados." .
                "Exceção: " . $ex->getMessage());
        }
    }

}
