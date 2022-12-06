<?php

    class ProductModel
    {

        private $Connection;

        function __construct($Connection)
        {
            $this->Connection = $Connection;
        }

        function fetchPorduct()
        {
            $sql = "SELECT prod.cod_prod, prod.prod_precio, prod.prod_descripcion, prod.prod_nom, prov.nom_prov, prod.prod_stock
                    FROM ferreteria.producto prod 
                    INNER JOIN ferreteria.provedor prov
                    ON prod.nit_prov = prov.nit_prov;";
            $this->Connection->query($sql);
            return $this->Connection->fetchAll();
        }

        function addProduct($cod_prod, $prod_nom, $prod_precio, $prod_stock, $nit_prov, $prod_descripcion)
        {
            $sql = "INSERT INTO ferreteria.producto (cod_prod, prod_precio, prod_descripcion, prod_nom, nit_prov, prod_stock)
                    VALUES ($cod_prod, '$prod_precio', '$prod_descripcion', '$prod_nom', '$nit_prov', '$prod_stock');";

            $this->Connection->query($sql);
        }

        function getProduct($array_product)
        {
            $position = $array_product['position'];
            $value = $array_product['value'];

            $sql = "SELECT * FROM ferreteria.producto WHERE $position='$value';";

            $this->Connection->query($sql);
            return $this->Connection->fetchAll();
        }

        function updateProduct($cod_prod, $prod_nom, $prod_precio, $prod_stock, $prod_descripcion)
        {
            $sql = "UPDATE ferreteria.producto
                    SET prod_nom='$prod_nom', prod_precio='$prod_precio', prod_stock='$prod_stock', prod_descripcion='$prod_descripcion'
                    WHERE cod_prod = '$cod_prod';";

            $this->Connection->query($sql);
        }
    }


?>