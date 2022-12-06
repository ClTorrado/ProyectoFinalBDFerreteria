<?php

    class AccessModel
    {

        private $connection;

        function __construct($connection)
        {
            $this->connection = $connection;    
        }

        function validateFormSession($usuario, $password)
        {
            $sql = "SELECT cod_login
                    FROM ferreteria.login
                    WHERE usuario = '$usuario'
                    AND password = '$password'";

            $this->connection->query($sql);

            return $this->connection->fetchAll();
        }
    }

?>