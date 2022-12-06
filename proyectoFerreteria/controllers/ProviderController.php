<?php
require_once 'models/ProviderModel.php';
require_once 'views/ProviderView.php';
class ProviderController
{
    function showProvider()
    {
        $ProviderView = new ProviderView();
        $ProviderView->showProvider();
    }

    function formProvider()
    {
        $ProviderView = new ProviderView();
        $ProviderView->addProvider();
    }

    function addProvider()
    {
        $Connection = new Connection();

        $ProviderModel = new ProviderModel($Connection);

        $ProviderView = new ProviderView();

        $nit_prov = strtoupper($_POST['nit_prov']);
        $nom_prov = strtoupper($_POST['nom_prov']);
        $num_tel_prov= $_POST['num_tel_prov'];

        #Valida que los campos no estén vacíos
        if($nit_prov==''){exit($this->errorTask('empty:nif'));}
        if($nom_prov==''){exit($this->errorTask('empty:nombre'));}
        if($num_tel_prov==''){exit($this->errorTask('empty:celular'));}
        if(!is_numeric($num_tel_prov)){exit($this->errorTask('cellphone:'));}

        $array_provider = $ProviderModel->getProvider(['position'=>'nit_prov', 'value'=>$nit_prov]);

        if($array_provider){exit($this->errorTask('duplicity:'));}

        $ProviderModel->addProvider($nit_prov,$nom_prov,$num_tel_prov);

        echo "<script>toastr.success('¡Proveedor guardado con exito!')</script>";

        $ProviderView->showProvider();

    }

    function getProvider()
    {
        $Connection = new Connection();

        $ProviderModel = new ProviderModel($Connection);

        $ProviderView = new ProviderView();

        $nit_prov = $_POST['id'];

        $array_provider = $ProviderModel->getProvider(['position'=>'nit_prov', 'value'=>$nit_prov]);

        $ProviderView->getProvider($array_provider);

    }

    function updateProvider()
    {
        $Connection = new Connection();

        $ProviderModel = new ProviderModel($Connection);

        $ProviderView = new ProviderView();
        
        $nit_prov = strtoupper($_POST['nit_prov']);
        $nom_prov = strtoupper($_POST['nom_prov']);
        $num_tel_prov= $_POST['num_tel_prov'];

        #Valida que los campos no estén vacíos
        if($nit_prov==''){exit($this->errorTask('empty:nif'));}
        if($nom_prov==''){exit($this->errorTask('empty:nombre'));}
        if($num_tel_prov==''){exit($this->errorTask('empty:celular'));}
        if(!is_numeric($num_tel_prov)){exit($this->errorTask('cellphone:'));}

        $ProviderModel->updateProvider($nit_prov, $nom_prov, $num_tel_prov);

        echo "<script>toastr.success('¡Proveedor actualizado con exito!')</script>";

        $ProviderView->showProvider();

    }

    function errorTask($type)
    {
        $cadena = '';
        list($clave, $valor) = explode(':', $type);
        if ($clave == 'empty')
        {
            switch ($valor) {
                case 'nif':
                    $cadena = 'El campo del nif no puede estar vacío';
                    break;
                case 'nombre':
                    $cadena = 'El campo del nombre no puede estar vacío';
                    break;
                case 'direccion':
                    $cadena = 'El campo de la dirección no puede estar vacío';
                    break;
                case 'email':
                    $cadena = 'El campo del email no puede estar vacío';
                    break;
                case 'celular':
                    $cadena = 'El campo del celular no puede estar vacío';
                    break; 
                default:
                    $cadena = '';
                    break;
            }
        }
        elseif($clave == 'duplicity')
        {
            $cadena = 'El proveedor ya existe en la base de datos';
        } elseif($clave == 'nif')
        {
            $cadena = 'El NIF es obligatorio';
        } elseif($clave == 'email')
        {
            $cadena = 'Email mal estructurado';
        } elseif($clave == 'cellphone')
        {
            $cadena = 'El celular debe ser numérico';
        }
        echo "<script>
        Swal.fire({
            title: 'Error!',
            text: '$cadena',
            icon: 'error',
            confirmButtonText: 'Confirmar'
          })
            </script>";
        $ProviderView = new ProviderView();
        $ProviderView->showProvider();

    }
}

?>