<?php
    require_once "views/ProductView.php";
    require_once "models/ProviderModel.php";

    class ProductController
    {
        function showProduct()
        {
            $ProductView = new ProductView();
            $ProductView->showProduct();
        }

        function getformProduct()
        {
            $ProductView = new ProductView();
            $Connection = new Connection();
            $ProviderModel = new ProviderModel($Connection);
            $array_provider = $ProviderModel->fetchProvider();
            $ProductView->addProduct($array_provider);
        }

        function addProduct()
        {
            $Connection = new Connection();

            $ProductModel = new ProductModel($Connection);

            $ProductView = new ProductView();

            $cod_prod = $_POST['cod_prod'];
            $prod_nom = strtoupper($_POST['prod_nom']);
            $prod_precio = $_POST['prod_precio'];
            $prod_stock = $_POST['prod_stock'];
            $nit_prov = $_POST['nit_prov'];
            $prod_descripcion = $_POST['prod_descripcion'];

            #Valida que los campos no estén vacíos
            if($cod_prod==''){exit($this->errorTask('empty:codigo'));}
            if($prod_nom==''){exit($this->errorTask('empty:nombre'));}
            if($prod_precio==''){exit($this->errorTask('empty:precio'));}
            if($prod_stock==''){exit($this->errorTask('empty:cantidad'));}
            if($nit_prov==''){exit($this->errorTask('empty:proveedor'));}

            if($cod_prod==''){exit($this->errorTask('product:'));}
            if(!is_numeric($prod_precio)){exit($this->errorTask('value:'));}
            if(!is_numeric($prod_stock)){exit($this->errorTask('value:'));}

            $array_product = $ProductModel->getProduct(['position'=>'cod_prod', 'value'=>$cod_prod]);

            if($array_product){exit($this->errorTask('duplicity:'));}

            $ProductModel->addProduct($cod_prod, $prod_nom, $prod_precio, $prod_stock, $nit_prov, $prod_descripcion);

            echo "<script>toastr.success('¡Producto guardado con exito!')</script>";

            $ProductView->showProduct();
        }

        function getProduct()
    {
        $Connection = new Connection();

        $ProductModel = new ProductModel($Connection);

        $ProductView = new ProductView();

        $cod_prod = $_POST['id'];

        $array_product = $ProductModel->getProduct(['position'=>'cod_prod', 'value'=>$cod_prod]);

        $ProductView->updateProduct($array_product);

    }

    function updateProduct()
    {
        $Connection = new Connection();

        $ProductModel = new ProductModel($Connection);

        $ProductView = new ProductView();
    
        $cod_prod = $_POST['cod_prod'];
        $prod_nom = strtoupper($_POST['prod_nom']);
        $prod_precio = $_POST['prod_precio'];
        $prod_stock = $_POST['prod_stock'];
        $prod_descripcion = $_POST['prod_descripcion'];

        #Valida que los campos no estén vacíos
        if($cod_prod==''){exit($this->errorTask('empty:codigo'));}
        if($prod_nom==''){exit($this->errorTask('empty:nombre'));}
        if($prod_precio==''){exit($this->errorTask('empty:precio'));}
        if($prod_stock==''){exit($this->errorTask('empty:cantidad'));}

        if($prod_nom==''){exit($this->errorTask('product:'));}
        if(!is_numeric($prod_precio)){exit($this->errorTask('value:'));}
        if(!is_numeric($prod_stock)){exit($this->errorTask('value:'));}

        $ProductModel->updateProduct($cod_prod, $prod_nom, $prod_precio, $prod_stock, $prod_descripcion);

        echo "<script>toastr.success('¡Producto actualizado con exito!')</script>";

        $ProductView->showProduct();
    }

        function errorTask($type)
        {
            $cadena = '';
            list($clave, $valor) = explode(':', $type);
            if ($clave == 'empty')
            {
                switch ($valor) {
                    case 'nombre':
                        $cadena = 'El campo del nombre no puede estar vacío';
                        break;
                    case 'precio':
                        $cadena = 'El campo del precio no puede estar vacío';
                        break;                
                    case 'cantidad':
                        $cadena = 'El campo de la cantidad no puede estar vacio';
                        break;
                    case 'codigo':
                        $cadena = 'El campo del codigo no puede estar vacío';
                        break;
                    case 'proveedor':
                        $cadena = 'El campo del proveedor no puede estar vacío';
                        break; 
                    default:
                        $cadena = '';
                        break;
                }
            }
            elseif($type == 'duplicity')
            {
                $cadena = '¡El producto ya existe en la base de datos!';
            } elseif($type == 'product')
            {
                $cadena = '¡El nombre del producto es obligatorio!';
            } elseif($type == 'value')
            {
                $cadena = '¡El valor debe ser numérico!';
            }
            echo "<script>
            Swal.fire({
                title: 'Error!',
                text: '$cadena',
                icon: 'error',
                confirmButtonText: 'Confirmar'
            })
                </script>";
            $ProductView = new ProductView();
            $ProductView->showProduct();

        }
    }
?>