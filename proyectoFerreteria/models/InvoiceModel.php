<?php

    class InvoiceModel
    {
        private $Connection;

        function __construct($Connection)
        {
            $this->Connection = $Connection;
        }

        function fetchInvoice()
        {
            $sql = "SELECT f.cod_fact, to_char(f.fact_fecha, 'DD/MM/YYYY') AS fecha, c.doc_client, c.nom_client, m.mepa_descripcion, f.fact_total, v.nom_vendedor
            FROM ferreteria.factura f INNER JOIN ferreteria.cliente c
            ON f.doc_client = c.doc_client
            INNER JOIN ferreteria.metodo_pago m
            ON f.cod_mepa = m.cod_mepa
            INNER JOIN ferreteria.vendedor v
            ON f.cod_vendedor = v.cod_vendedor;";

            $this->Connection->query($sql);

            return $this->Connection->fetchAll();
        }

        function idClient()
        {
            $sql = "SELECT nom_client, doc_client FROM ferreteria.cliente;";
            $this->Connection->query($sql);
            return $this->Connection->fetchAll();
        }

        function metodoPago()
        {
            $sql = "SELECT * FROM ferreteria.metodo_pago;";
            $this->Connection->query($sql);
            return $this->Connection->fetchAll();
        }

        function idVendedor()
        {
            $sql = "SELECT cod_vendedor, nom_vendedor FROM ferreteria.vendedor;";
            $this->Connection->query($sql);
            return $this->Connection->fetchAll();
        }

        function idProduct()
        {
            $sql = "SELECT cod_prod, prod_nom FROM ferreteria.producto;";
            $this->Connection->query($sql);
            return $this->Connection->fetchAll();
        }
        
        function getClient($array_cliente)
        {
            $position = $array_cliente['position'];
            $value = $array_cliente['value'];
    
            $sql = "SELECT * FROM ferreteria.factura WHERE $position='$value';";

            $this->Connection->query($sql);
            
            return $this->Connection->fetchAll();
        }

        function getProduct($array_product)
        {
            $position = $array_product['position'];
            $value = $array_product['value'];

            $sql = "SELECT * FROM ferreteria.producto WHERE $position='$value';";

            $this->Connection->query($sql);
            return $this->Connection->fetchAll();
        }

        function addInvoice($cod_fact, $fact_total, $doc_client, $cod_mepa, $cod_vendedor)
        {
            $sql = "INSERT INTO ferreteria.factura (cod_fact, fact_fecha, fact_total, doc_client, cod_mepa, cod_vendedor)
                    VALUES ('$cod_fact', now(), '$fact_total', '$doc_client', '$cod_mepa', '$cod_vendedor');";
            
            $this->Connection->query($sql);
        }

        function addDetail($cod_fact, $cod_prod, $det_cant_prod, $prod_precio, $det_subtotal)
        {
            $sql = "INSERT INTO ferreteria.detalle (cod_fact, cod_prod, det_cant_prod, det_precio_prod, det_subtotal)
                    VALUES ($cod_fact, '$cod_prod', $det_cant_prod, $prod_precio, $det_subtotal);";

            $this->Connection->query($sql);
        }

        function fetchInvoiceDetail($cod_fact)
        {
            $sql = "SELECT f.cod_fact, f.doc_client, to_char(f.fact_fecha, 'DD/MM/YYYY') AS fecha, f.fact_total, c.doc_client, c.nom_client, d.cod_prod, d.det_cant_prod, d.det_precio_prod, d.det_subtotal, p.prod_nom, p.prod_descripcion
                    FROM ferreteria.cliente c INNER JOIN ferreteria.factura f
                    ON c.doc_client = f.doc_client
                    LEFT JOIN ferreteria.detalle d
                    ON f.cod_fact = d.cod_fact
                    LEFT JOIN ferreteria.producto p
                    ON d.cod_prod = p.cod_prod
                    WHERE f.cod_fact = '$cod_fact';";
            
            $this->Connection->query($sql);
            
            return $this->Connection->fetchAll();
        }

        

    }

?>