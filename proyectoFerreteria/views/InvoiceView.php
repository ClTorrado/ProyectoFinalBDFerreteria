<?php
require_once "models/InvoiceModel.php";

    class InvoiceView
    {
        function showInvoice()
        {
            $Connection = new Connection();
            $InvoiceModel = new InvoiceModel($Connection);
            $array_invoice = $InvoiceModel->fetchInvoice();
            ?>
                <!DOCTYPE html>
                <html lang="es">
                <head>
                    <meta charset="UTF-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <!-- Google Font: Source Sans Pro -->
                    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
                    <!-- Font Awesome -->
                    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
                    <!-- DataTables -->
                    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
                    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
                    <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
                    <!-- Theme style -->
                    <link rel="stylesheet" href="dist/css/adminlte.min.css">
                    <!-- Libreria sweetalert -->
                    <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
                    <!-- Stilos del menu -->
                    <link rel="stylesheet" href="css/menu.css">

                    <title>Ferreteria San Cayetano</title>
                </head>
                <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
                        <!-- Main content -->
                    <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                        <div class="col-12">
                            <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Informaci&oacute;n de facturas</h3>
                                <button class="btn btn-primary float-sm-right" id="add_client" name="add_client" onclick="getFormInvoice()">
                                <i class="nav-item fas fa-plus-circle"></i>
                                    &nbsp;Crear factura
                                </button>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>C&oacute;digo de factura</th>
                                    <th>Cliente</th>
                                    <th>Documento</th>
                                    <th>Pago</th>
                                    <th>Vendedor</th>
                                    <th>Fecha</th>
                                    <th>total</th>
                                    <th>Acci&oacute;n</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        foreach ($array_invoice as $object_invoice) {
                                            $cod_fact = $object_invoice->cod_fact;
                                            $nom_client = $object_invoice->nom_client;
                                            $doc_client = $object_invoice->doc_client;
                                            $mepa_descripcion = $object_invoice->mepa_descripcion;
                                            $nom_vendedor = $object_invoice->nom_vendedor;
                                            $fecha = $object_invoice->fecha;
                                            $fact_total = $object_invoice->fact_total;
                                            if ($fact_total == "") {
                                                $total = 0;
                                            }
                                            ?>
                                            <tr>
                                                <td><?php echo $cod_fact;?></td>
                                                <td><?php echo $nom_client;?></td>
                                                <td><?php echo $doc_client;?></td>
                                                <td><?php echo $mepa_descripcion;?></td>
                                                <td><?php echo $nom_vendedor;?></td>
                                                <td><?php echo $fecha;?></td>
                                                <td><?php echo $fact_total;?></td>
                                                <td style="text-align: center;">
                                                <i class="fas fa-receipt" style="cursor:pointer;" title="Agregar ventas a la factura" onclick="getFormDetail(<?php echo $cod_fact?>)"></i> &nbsp;
                                                <i class="fas fa-eye" style="cursor:pointer;" title="Consultar factura a detalle" onclick="showInvoiceDetail(<?php echo $cod_fact?>)"></i>
                                                </td>
                                            </tr>
                                            <?php
                                        }                                
                                    ?>                  
                                </tbody>
                                <tfoot>
                                <tr>
                                <th>C&oacute;digo de factura</th>
                                    <th>Cliente</th>
                                    <th>Documento</th>
                                    <th>Pago</th>
                                    <th>Vendedor</th>
                                    <th>Fecha</th>
                                    <th>total</th>
                                    <th>Acci&oacute;n</th>
                                </tr>
                                </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.container-fluid -->
                    </section>

                    <div id="my_modal" class="modal" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-info">
                                    <h5 class="modal-title" id="modal_tittle"></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div id="my_modal_content" class="modal-body">


                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="invoice_detail" class="modal" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div id="my_invoice_detail" class="modal-body">


                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- jQuery -->
                    <script src="plugins/jquery/jquery.min.js"></script>
                    <!-- Bootstrap 4 -->
                    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
                    <!-- DataTables  & Plugins -->
                    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
                    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
                    <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
                    <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
                    <script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
                    <script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
                    <script src="plugins/jszip/jszip.min.js"></script>
                    <script src="plugins/pdfmake/pdfmake.min.js"></script>
                    <script src="plugins/pdfmake/vfs_fonts.js"></script>
                    <script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
                    <script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
                    <script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
                    <!-- AdminLTE App -->
                    <script src="dist/js/adminlte.min.js"></script>
                    <!-- AdminLTE for demo purposes -->
                    <script src="dist/js/demo.js"></script>
                    <!-- bs-custom-file-input -->
                    <script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
                    <!-- Page specific script -->
                    <script src="js/invoice.js"></script>
                    <!-- javascript propio -->
                    <script src="plugins/sweetalert2/sweetalert2.min.js"></script>
                    <!-- javascript sweetalert -->
                </body>
                </html>
            <?php
        }
        function addInvoice($id_cliente, $id_vendedor, $metodo)
        {
            ?>
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-tittle">Formulario de registro</h3>
                </div>
                <!-- form start -->
                <form action="" class="form-horizontal" id="addInvoice">
                <div class="card-body">
                        <div class="form-group">
                            <label for="cod_fact">Codigo de factura</label>
                            <input type="number" autocomplete="off" id="cod_fact" name="cod_fact" class="form-control" maxlength="7" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="doc_client">Documento del cliente</label>
                            <input type="search" autocomplete="off" class="form-control" name="doc_client" id="doc_client" list="clientes" maxlength="10" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                            <datalist id="clientes">
                            <?php
                            foreach($id_cliente AS $clientes)
                            {
                                $nom_client = $clientes->nom_client;
                                $doc_client = $clientes->doc_client;
                                ?>
                                <option value=<?php echo $doc_client?>><?php echo $nom_client;?></option>
                                <?php
                            }
                            ?>
                            </datalist>
                        </div>
                        <div class="form-group">
                            <label for="cod_mepa" class="col-sm-4 col-form-label">Método de pago</label>
                            <div class="col-md-12">
                                <select class="custom-select" name="cod_mepa" id="cod_mepa">
                                <option selected value="">Seleccione el metodo</option>
                                <?php
                                    foreach($metodo as $p)
                                    {
                                    $cod_mepa = $p->cod_mepa;
                                    $mepa_descripcion = $p->mepa_descripcion;
                                    ?>
                                    <option value=<?php echo $cod_mepa;?>><?php echo $mepa_descripcion;?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="fact_total">Total</label>
                            <input type="number" autocomplete="off" id="fact_total" name="fact_total" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="cod_vendedor" class="col-sm-4 col-form-label">Vendedor</label>
                            <div class="col-md-12">
                                <select class="custom-select" name="cod_vendedor" id="cod_vendedor">
                                <option selected value="">Seleccione el vendedor</option>
                                <?php
                                  foreach($id_vendedor AS $vendedor)
                                  {
                                      $cod_vendedor = $vendedor->cod_vendedor;
                                      $nom_vendedor = $vendedor->nom_vendedor;
                                      ?>
                                      <option value=<?php echo $cod_vendedor?>><?php echo $nom_vendedor;?></option>
                                      <?php
                                  }
                                  ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                    <button type="button" class="btn btn-info float-md-right" id="register" name="register" onclick="addInvoice()">Registrar</button>                  
                    </div>
                    <!-- /.card-footer -->
                </form>
                </div>
            <?php
        }

        function addDetail($id_producto, $cod_factura)
        {
            
            ?>
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-tittle">Formulario de compra</h3>
                </div>
                <!-- form start -->
                <form action="" class="form-horizontal" id="addDetail">
                    <div class="card-body">
                        <div class="form-group col-md-12" hidden>
                            <label for="cod_fact">C&oacute;digo de factura</label>
                            <input type="number" autocomplete="off" id="cod_fact" name="cod_fact" class="form-control" value="<?php echo $cod_factura?>">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="cod_prod">Nombre del producto</label>
                            <input type="search" autocomplete="off" class="form-control" name="cod_prod" id="cod_prod" list="productos">
                            <datalist id="productos">
                            <?php
                            foreach($id_producto AS $productos)
                            {
                                $cod_prod = $productos->cod_prod;
                                $prod_nom = ucwords(strtolower($productos->prod_nom));
                                ?>
                                <option value="<?php echo $cod_prod;?>"><?php echo $prod_nom?></option>
                                <?php
                            }
                            ?>
                            </datalist>
                        </div>
                        <div class="form-group">
                            <label for="det_cant_prod">Cantidad de productos</label>
                            <input type="number" autocomplete="off" id="det_cant_prod" name="det_cant_prod" class="form-control" maxlength="3" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                        </div>
                    </div>
                <!-- /.card-body -->
                <div class="card-footer">
                <button type="button" class="btn btn-info float-md-right" id="register" name="register" onclick="addDetail()">Registrar</button>                  
                </div>
                <!-- /.card-footer -->
                </form>
            </div>
            <?php
        }

        function showInvoiceDetail($array_venta)
        {
            $cod_fact = $array_venta[0]->cod_fact;
            $fecha = $array_venta[0]->fecha;
            $nom_client = ucwords(strtolower($array_venta[0]->nom_client));
            ?>
            <!-- Main content -->
            <div class="invoice p-3 mb-3" id="imp1"> 
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <i class="fas fa-globe"></i><b> Ferreteria </b>San Cayetano, Inc.
                    <small class="float-right">Date: <?php echo $fecha?></small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  From
                  <address>
                    <strong>San Cayetano, Inc.</strong><br>
                    Am&eacute;rica l&aacute;tina, Colombia<br>
                    Oca&ntilde;a, Norte de Santander<br>
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  To
                  <address>
                    <strong><?php echo $nom_client?></strong><br>
                    Am&eacute;rica l&aacute;tina, Colombia<br>
                    Oca&ntilde;a, Norte de Santander<br>
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  <b>Invoice #<?php echo $cod_fact?></b><br>
                  <br>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Cantidad</th>
                        <th>Producto</th>
                        <th>Descripci&oacute;n</th>
                        <th>Precio unitario</th>
                        <th>Subtotal</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        $cont = 0;
                        foreach ($array_venta as $detalle) 
                        {
                            $cont++;
                            $det_cant_prod = $detalle->det_cant_prod;
                            $producto = $detalle->prod_nom;
                            $prod_descripcion = $detalle->prod_descripcion;
                            $det_precio_prod = $detalle->det_precio_prod;
                            $det_subtotal = $detalle->det_subtotal;
                            $fact_total = $detalle->fact_total;

                            ?>
                            <tr>
                                <td><?php echo $cont?></td>
                                <td><?php echo $det_cant_prod?></td>
                                <td><?php echo $producto?></td>
                                <td><?php echo $prod_descripcion?></td>
                                <td>$ <?php echo $det_precio_prod?></td>
                                <td>$ <?php echo $det_subtotal?></td>
                            </tr>
                            <?php
                            
                        }
                    ?>
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                  <p class="lead">Payment Methods:</p>
                  <img src="dist/img/credit/visa.png" alt="Visa">
                  <img src="dist/img/credit/mastercard.png" alt="Mastercard">
                  <img src="dist/img/credit/american-express.png" alt="American Express">
                  <img src="dist/img/credit/paypal2.png" alt="Paypal">
                </div>
                <!-- /.col -->
                <div class="col-6">
                  <p class="lead">Importe adecuado: <?php echo $fecha?></p>

                  <div class="table-responsive">
                    <table class="table">
                      <tr>
                        <th>Total:</th>
                        <td>$ <?php echo $fact_total?></td>
                      </tr>
                    </table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                  <a href="#" onclick="javascript:imprim1(imp1)" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                  <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
                    Payment
                  </button>
                  <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                    <i class="fas fa-download"></i> Generate PDF
                  </button>
                </div>
              </div>
            </div>
            <!-- /.invoice -->
            <?php
        }
    }
?>