<?php

    class CountryModel
    {

        private $connection;

        function __construct($connection)
        {
            $this->connection = $connection;    
        }

        function selectPais()
        {
            $sql = "SELECT * FROM ferreteria.pais";

            $this->connection->query($sql);

            return $this->connection->fetchAll();
        }

        function selectDepartamento()
        {
            $sql = "SELECT * FROM ferreteria.departamento";

            $this->connection->query($sql);

            return $this->connection->fetchAll();
        }

        function selectCiudad()
        {
            $sql = "SELECT * FROM ferreteria.ciudad";

            $this->connection->query($sql);

            return $this->connection->fetchAll();
        }
    }

?>