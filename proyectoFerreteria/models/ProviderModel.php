<?php

class ProviderModel
{
    private $Connection;

    function __construct($Connection)
    {
        $this->Connection = $Connection;
    }

    function fetchProvider()
    {
        $sql = "SELECT * FROM ferreteria.provedor";

        $this->Connection->query($sql);

        return $this->Connection->fetchAll();
    }

    function addProvider($nit_prov,$nom_prov,$num_tel_prov)
    {
        $sql = "INSERT INTO ferreteria.provedor (nit_prov, nom_prov, num_tel_prov)
                VALUES ('$nit_prov', '$nom_prov', '$num_tel_prov');";
        
        $this->Connection->query($sql);
    }

    function getProvider($array_client)
    {
        $position = $array_client['position'];
        $value = $array_client['value'];

        $sql = "SELECT * FROM ferreteria.provedor WHERE $position='$value';";

        $this->Connection->query($sql);
        return $this->Connection->fetchAll();
    }

    function updateProvider($nit_prov, $nom_prov, $num_tel_prov)
    {
        $sql = "UPDATE ferreteria.provedor 
                SET nom_prov='$nom_prov', num_tel_prov='$num_tel_prov'
                WHERE nit_prov = '$nit_prov';";

        $this->Connection->query($sql);
    }
}

?>