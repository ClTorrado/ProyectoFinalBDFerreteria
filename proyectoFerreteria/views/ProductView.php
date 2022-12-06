<?php
    require_once "models/ProductModel.php";
    class ProductView
    {

        function showProduct()
        {
            $Connection = new Connection();
            $ProductModel = new ProductModel($Connection);
            $array_products = $ProductModel->fetchPorduct();
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
                  <!-- BS Stepper -->
                <link rel="stylesheet" href="plugins/bs-stepper/css/bs-stepper.min.css">
                <!-- Theme style -->
                <link rel="stylesheet" href="dist/css/adminlte.min.css">
                <!-- Libreria sweetalert -->
                <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
                <!-- Stilos del menu -->
                <link rel="stylesheet" href="css/menu.css">

                <title>Proyecto | Gestor empresarial</title>
            </head>
            <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
                    <!-- Main content -->
                <section class="content">
                <div class="container-fluid">
                    <div class="row">
                    <div class="col-12">
                        <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Informaci&oacute;n de inventario</h3>
                            <button class="btn btn-primary float-md-right" id="form_product" name="form_product" onclick="getFormProduct()">
                                	<i class="nav-item fas fa-plus-circle"></i>
                                &nbsp;Registrar producto
                            </button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>C&oacute;digo</th>
                                <th>Producto</th>
                                <th>Descripci&oacute;n</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Provisto</th>
                                <th>Acci&oacute;n</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach ($array_products as $object_product) {
                                        $cod_prod = $object_product->cod_prod;
                                        $prod_nom = $object_product->prod_nom;
                                        $prod_description = $object_product->prod_descripcion;                                        
                                        $prod_precio = $object_product->prod_precio;
                                        $prod_stock = $object_product->prod_stock;
                                        $nom_prov = $object_product->nom_prov;
                                        ?>
                                        <tr>
                                            <td><?php echo $cod_prod;?></td>
                                            <td><?php echo $prod_nom;?></td>
                                            <td><?php echo $prod_description;?></td>
                                            <td><?php echo $prod_precio;?></td>
                                            <td><?php echo $prod_stock;?></td>
                                            <td><?php echo $nom_prov;?></td>
                                            <td style="text-align: center;"><i class="fas fa-edit" style="cursor:pointer;" onclick="getProduct('<?php echo $cod_prod?>');"></i>
                                            </td>
                                        </tr>
                                        <?php
                                    }                                
                                ?>                  
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>C&oacute;digo</th>
                                <th>Producto</th>
                                <th>Descripci&oacute;n</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Provisto</th>
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
                <!-- Toastr -->
                <script src="plugins/toastr/toastr.min.js"></script>
                <!-- Page specific script -->
                <script src="js/product.js"></script>
                <!-- javascript propio -->
                <script src="plugins/sweetalert2/sweetalert2.min.js"></script>
                <!-- javascript sweetalert -->           
            </body>
            </html>
            <?php
        }

        function addProduct($provider)
        {
            ?>
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-tittle">Formulario de registro</h3>
                </div>
                <!-- form start -->
                <form action="" class="form-horizontal" id="addProduct">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="cod_prod">Codigo del producto</label>
                            <input type="number" autocomplete="off" id="cod_prod" name="cod_prod" class="form-control" maxlength="4" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                        </div>
                        <div class="form-group">
                            <label for="prod_nom">Nombre del producto</label>
                            <input type="text" autocomplete="off" id="prod_nom" name="prod_nom" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="prod_precio">Precio</label>
                            <input type="number" autocomplete="off" id="prod_precio" name="prod_precio" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="prod_stock">Cantidad</label>
                            <input type="number" autocomplete="off" id="prod_stock" name="prod_stock" class="form-control">
                        </div>
                        <div class="form-group row">
                            <label for="nit_prov" class="col-sm-2 col-form-label">Proveedor</label>
                            <div class="col-md-12">
                                <select class="custom-select" name="nit_prov" id="nit_prov">
                                <option selected value="">Seleccione el proveedor</option>
                                <?php
                                    foreach($provider as $p)
                                    {
                                    $nit_prov = $p->nit_prov;
                                    $nom_prov = ucwords(strtolower($p->nom_prov));
                                    ?>
                                    <option value=<?php echo $nit_prov;?>><?php echo $nom_prov;?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>                      
                        <div class="form-group">
                            <label for="prod_descripcion">Descripci&oacute;n</label>
                            <textarea id="prod_descripcion" name="prod_descripcion" class="form-control" rows="4"></textarea>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                    <button type="button" class="btn btn-info float-md-right" id="register" name="register" onclick="addProduct()">Registrar</button>                  
                    </div>
                    <!-- /.card-footer -->
                </form>
                </div>
            </div>
            <?php
        }
        function updateProduct($array_product)
        {   
            $cod_prod = $array_product[0]->cod_prod;
            $prod_nom = $array_product[0]->prod_nom;
            $prod_precio = $array_product[0]->prod_precio;
            $prod_stock = $array_product[0]->prod_stock;
            $prod_descripcion = $array_product[0]->prod_descripcion;

            ?>
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-tittle">Formulario de actualizaci&oacute;n</h3>
                </div>
                <!-- form start -->
                <form action="" class="form-horizontal" id="updateProduct">
                <div class="card-body">
                    <div class="form-group row" hidden>
                        <label for="cod_prod" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10">
                            <input type="text" autocomplete="off" class="form-control" id="cod_prod" name="cod_prod" maxlength="100" value="<?php echo $cod_prod;?>">
                        </div>
                    </div>
                    <div class="form-group">
                            <label for="prod_nom">Nombre del producto</label>
                            <input type="text" autocomplete="off" id="prod_nom" name="prod_nom" class="form-control" value="<?php echo $prod_nom;?>">
                        </div>
                        <div class="form-group">
                            <label for="prod_precio">Precio</label>
                            <input type="text" autocomplete="off" id="prod_precio" name="prod_precio" class="form-control" value="<?php echo $prod_precio;?>">
                        </div>
                        <div class="form-group">
                            <label for="prod_stock">Cantidad</label>
                            <input type="text" autocomplete="off" id="prod_stock" name="prod_stock" class="form-control" value="<?php echo $prod_stock;?>">
                        </div>
                        <div class="form-group">
                            <label for="prod_descripcion">Descripci&oacute;n</label>
                            <textarea id="prod_descripcion" name="prod_descripcion" class="form-control" rows="4" ><?php echo $prod_descripcion;?></textarea>
                        </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="button" class="btn btn-info float-md-right" id="register" name="register" onclick="updateProduct()">Actualizar</button>                  
                </div>
                <!-- /.card-footer -->
                </form>
            </div>
            <?php
        }
    }


?>
