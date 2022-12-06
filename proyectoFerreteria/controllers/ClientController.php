<?php
require_once 'models/ClientModel.php';
require_once 'views/ClienteView.php';
class ClientController
{
    function showClient()
    {
        $ClientView = new ClientView();
        $ClientView->showClient();
    }

    function getFormClient()
    {
        $Connection = new Connection();
        $ClientView = new ClientView();

        $Country = new CountryModel($Connection);
        $ciudad = $Country->selectCiudad();
        $dpto = $Country->selectDepartamento();
        $pais = $Country->selectPais();
        $ClientView->addClient($pais, $dpto, $ciudad);
    }

    function addClient()
    {
        $Connection = new Connection();

        $ClientModel = new ClientModel($Connection);

        $ClientView = new ClientView();

        $doc_client = $_POST['doc_client'];
        $nom_client = strtoupper($_POST['nom_client']);
        $dir_client = strtoupper($_POST['dir_client']);
        $num_tel_client = $_POST['num_tel_client'];
        $cod_ciudad= $_POST['cod_ciudad'];
        $cod_dpto= $_POST['cod_dpto'];
        $cod_pais= $_POST['cod_pais'];

        #Valida que los campos no estén vacíos
        if($doc_client==''){exit($this->errorTask('empty:documento'));}
        if($nom_client==''){exit($this->errorTask('empty:nombres'));}
        if($dir_client==''){exit($this->errorTask('empty:direccion'));}
        if($num_tel_client==''){exit($this->errorTask('empty:celular'));}
        
        if(!is_numeric($doc_client)){exit($this->errorTask('document'));}
        if(!is_numeric($num_tel_client)){exit($this->errorTask('cellphone'));}

        $array_client = $ClientModel->getClient(['position'=>'doc_client', 'value'=>$doc_client]);

        if($array_client){exit($this->errorTask('duplicity'));}

        $ClientModel->addClient($doc_client,$nom_client,$dir_client,$num_tel_client, $cod_ciudad, $cod_dpto, $cod_pais);

        echo "<script>toastr.success('¡Cliente guardado con exito!')</script>";

        $ClientView->showClient();

    }

    function getClient()
    {
        $Connection = new Connection();

        $ClientModel = new ClientModel($Connection);

        $ClientView = new ClientView();

        $doc_client = $_POST['id'];

        $array_client = $ClientModel->getClient(['position'=>'doc_client', 'value'=>$doc_client]);

        $ClientView->getClient($array_client);

    }

    function updateClient()
    {
        $Connection = new Connection();

        $ClientModel = new ClientModel($Connection);

        $ClientView = new ClientView();
        
        $doc_client = $_POST['doc_client'];
        $nom_client = strtoupper($_POST['nom_client']);
        $dir_client = strtoupper($_POST['dir_client']);
        $num_tel_client= $_POST['num_tel_client'];

        #Valida que los campos no estén vacíos
        if($doc_client==''){exit($this->errorTask('empty:documento'));}
        if($nom_client==''){exit($this->errorTask('empty:nombres'));}
        if($dir_client==''){exit($this->errorTask('empty:apellidos'));}
        if($num_tel_client==''){exit($this->errorTask('empty:celular'));}

        if(!is_numeric($doc_client)){exit($this->errorTask('document'));}
        if(!is_numeric($num_tel_client)){exit($this->errorTask('num_tel_client'));}

        $ClientModel->updateClient($doc_client, $nom_client, $dir_client, $num_tel_client);

        echo "<script>toastr.success('¡Cliente actualizado con exito!')</script>";

        $ClientView->showClient();

    }

    function errorTask($type)
    {
        $cadena = '';
        list($clave, $valor) = explode(':', $type);
        if ($clave == 'empty')
        {
            switch ($valor) {
                case 'documento':
                    $cadena = 'El campo del documento no puede estar vacío';
                    break;
                case 'nombres':
                    $cadena = 'El campo de los nombres no puede estar vacío';
                    break;
                case 'direccion':
                    $cadena = 'El campo de los direccion no puede estar vacío';
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
        elseif($type == 'duplicity')
        {
            $cadena = 'El documento ya existe en la base de datos';
        } elseif($type == 'document')
        {
            $cadena = 'El documento debe ser un número';
        } elseif($type == 'email')
        {
            $cadena = 'Email mal estructurado';
        } elseif($type == 'cellphone')
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
        $ClientView = new ClientView();
        $ClientView->showClient();

    }
}

?>