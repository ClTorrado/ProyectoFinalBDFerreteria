<?php

class ClientModel
{
    private $Connection;

    function __construct($Connection)
    {
        $this->Connection = $Connection;
    }

    function fetchClient()
    {
        $sql = "SELECT c.doc_client, c.dir_client, c.num_tel_client, c.nom_client, p.nom_pais, d.nom_dpto, ci.nom_ciudad FROM ferreteria.cliente c INNER JOIN ferreteria.pais p
        ON c.cod_pais = p.cod_pais
        INNER JOIN ferreteria.departamento d
        ON c.cod_dpto = d.cod_dpto
        INNER JOIN ferreteria.ciudad ci
        ON c.cod_ciudad = ci.cod_ciudad;";

        $this->Connection->query($sql);

        return $this->Connection->fetchAll();
    }

    function addClient($doc_client,$nom_client,$dir_client,$num_tel_client, $cod_ciudad, $cod_dpto, $cod_pais)
    {
        $sql = "INSERT INTO ferreteria.cliente (doc_client, dir_client, num_tel_client, nom_client, cod_ciudad, cod_dpto, cod_pais)
                VALUES ('$doc_client','$dir_client','$num_tel_client','$nom_client','$cod_ciudad', '$cod_dpto', '$cod_pais');";
        
        $this->Connection->query($sql);
    }

    function getClient($array_client)
    {
        $position = $array_client['position'];
        $value = $array_client['value'];

        $sql = "SELECT * FROM ferreteria.cliente WHERE $position='$value';";

        $this->Connection->query($sql);
        return $this->Connection->fetchAll();
    }

    function updateClient($doc_client, $nom_client, $dir_client, $num_tel_client)
    {
        $sql = "UPDATE ferreteria.cliente 
                SET  nom_client='$nom_client', dir_client='$dir_client', num_tel_client='$num_tel_client'
                WHERE doc_client = '$doc_client';";

        $this->Connection->query($sql);
    }
}

?>