<?php
require_once 'models/InvoiceModel.php';
require_once 'views/InvoiceView.php';
    class invoiceController
    {
        function showInvoice()
        {
            $InvoiceView = new InvoiceView();
            $InvoiceView->showInvoice();
        }

        function getFormInvoice()
        {
            $Connection = new Connection();
            $InvoiceModel = new InvoiceModel($Connection);
            $id_cliente = $InvoiceModel->idClient();
            $id_vendedor = $InvoiceModel->idVendedor();
            $metodo = $InvoiceModel->metodoPago();
            $InvoiceView = new InvoiceView();
            $InvoiceView->addInvoice($id_cliente, $id_vendedor, $metodo);
        }
        
        function getFormDetail()
        {
            $Connection = new Connection();
            $InvoiceModel = new InvoiceModel($Connection);
            $id_producto = $InvoiceModel->idProduct();
            $InvoiceView = new InvoiceView();
            $InvoiceView->addDetail($id_producto, $_POST['id']);
        }

        function addInvoice()
        {
            $Connection = new Connection();

            $InvoiceModel = new InvoiceModel($Connection);

            $InvoiceView = new InvoiceView();

            $cod_fact = $_POST['cod_fact'];
            $doc_client = $_POST['doc_client'];
            $cod_mepa = $_POST['cod_mepa'];
            $fact_total = $_POST['fact_total'];
            $cod_vendedor = $_POST['cod_vendedor'];

            #Valida que los campos no estén vacíos
            if($cod_fact==''){exit($this->errorTask('empty:cod_fact'));}
            if($doc_client==''){exit($this->errorTask('empty:codigo'));}
            if($cod_mepa==''){exit($this->errorTask('empty:pago'));}
            if($cod_vendedor==''){exit($this->errorTask('empty:vendedor'));}

            $factura = $InvoiceModel->getClient(['position'=>'cod_fact', 'value'=>$cod_fact]);

            if($factura){exit($this->errorTask('duplicity:'));}

            $InvoiceModel->addInvoice($cod_fact, $fact_total, $doc_client, $cod_mepa, $cod_vendedor);

            echo "<script>toastr.success('¡Factura creada con exito!')</script>";

            $InvoiceView->showInvoice();
        }

        function addDetail()
        {
            $Connection = new Connection();

            $InvoiceModel = new InvoiceModel($Connection);

            $InvoiceView = new InvoiceView();

            $cod_fact = $_POST['cod_fact'];
            $cod_prod = $_POST['cod_prod'];
            $det_cant_prod = $_POST['det_cant_prod'];

            
            $array_product = $InvoiceModel->getProduct(['position'=>'cod_prod', 'value'=>$cod_prod]);

            $prod_precio = $array_product[0]->prod_precio;

            $det_subtotal = $det_cant_prod * $prod_precio;

            #Valida que los campos no estén vacíos
            if($cod_fact==''){exit($this->errorTask('empty:factura'));}
            if($cod_prod==''){exit($this->errorTask('empty:producto'));}
            if($det_cant_prod==''){exit($this->errorTask('empty:cantidad'));}

            
            echo "<script>toastr.success('¡Producto facturado con exito!')</script>";

            $InvoiceModel->addDetail($cod_fact, $cod_prod, $det_cant_prod, $prod_precio, $det_subtotal);

            $InvoiceView->showInvoice();

        }

        function showInvoiceDetail()
        {
            $Connection = new Connection();
            $InvoiceModel = new InvoiceModel($Connection);
            $array_venta = $InvoiceModel->fetchInvoiceDetail($_POST['id']);
            $InvoiceView = new InvoiceView();
            $InvoiceView->showInvoiceDetail($array_venta);
        }

        function errorTask($type)
        {
            $cadena = '';
            list($clave, $valor) = explode(':', $type);
            if ($clave == 'empty')
            {
                switch ($valor) {
                    case 'cod_fact':
                        $cadena = 'El campo del codigo factura no puede estar vacío';
                        break;
                    case 'factura':
                        $cadena = 'El campo de la factura no puede estar vacío';
                        break;
                    case 'producto':
                        $cadena = 'Debe seleccionar un producto';
                        break;
                    case 'codigo':
                        $cadena = 'Debe seleccionar un cliente';
                        break;
                    case 'pago':
                        $cadena = 'Debe seleccionar un método de pago';
                        break;
                    case 'vendedor':
                        $cadena = 'Debe seleccionar un vendedor';
                        break;
                    case 'cantidad':
                        $cadena = 'El campo de la cantidad no puede estar vacío';
                        break; 
                    case 'descuento':
                        $cadena = 'El campo del descuento no puede estar vacío';
                        break; 
                    default:
                        $cadena = '';
                        break;
                }
            }
            elseif($type == 'duplicity')
            {
                $cadena = 'La factura ya existe en la base de datos';
            } elseif($type == 'cod_fact')
            {
                $cadena = 'El codigo de la factura es obligatorio';
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
                $InvoiceView = new InvoiceView();
                $InvoiceView->showInvoice();

        }
    }
?>