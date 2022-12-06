<?php
require_once "models/ProviderModel.php";
class ProviderView
{
    function showProvider()
    {
        $Connection = new Connection();
        $ProviderModel = new ProviderModel($Connection);
        $array_provider = $ProviderModel->fetchProvider();
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
                            <h3 class="card-title">Informaci&oacute;n de proveedores</h3>
                            <button class="btn btn-primary float-md-right" id="form_provider" name="form_provider" onclick="getFormProvider()">
                              <i class="nav-item fas fa-plus-circle"></i>
                                &nbsp;Registrar proveedor
                            </button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>NIT</th>
                                <th>Nombre</th>                
                                <th>Tel&eacute;fono</th>
                                <th>Acci&oacute;n</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach ($array_provider as $object_provider) {
                                        $nit_prov = $object_provider->nit_prov;
                                        $nom_prov = ucwords(strtolower($object_provider->nom_prov));
                                        $num_tel_prov = $object_provider->num_tel_prov;
                                        ?>
                                        <tr>
                                            <td><?php echo $nit_prov;?></td>
                                            <td><?php echo $nom_prov;?></td>
                                            <td><?php echo $num_tel_prov;?></td>
                                            <td style="text-align: center;"><i class="fas fa-edit" style="cursor:pointer;" onclick="getProvider('<?php echo $nit_prov?>');"></i>
                                            </td>
                                        </tr>
                                        <?php
                                    }                                
                                ?>                  
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>NIT</th>
                                <th>Nombre</th>               
                                <th>Tel&eacute;fono</th>
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
                <!-- Page specific script -->
                <script src="js/provider.js"></script>
                <!-- javascript propio -->
                <script src="plugins/sweetalert2/sweetalert2.min.js"></script>
                <!-- javascript sweetalert -->           
            </body>
            </html>
        <?php
    }

    function addProvider()
    {
        ?>
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-tittle">Formulario de registro</h3>
          </div>
              <!-- form start -->
              <form action="" class="form-horizontal" id="addProvider">
                <div class="card-body">
                <div class="form-group row">
                    <label for="nit_prov" class="col-sm-2 col-form-label">NIT</label>
                    <div class="col-sm-10">
                      <input type="text" autocomplete="off" class="form-control" id="nit_prov" name="nit_prov" maxlength="9">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="nom_prov" class="col-sm-2 col-form-label">Nombre</label>
                    <div class="col-sm-10">
                      <input type="text" autocomplete="off" class="form-control" id="nom_prov" name="nom_prov" maxlength="100">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="num_tel_prov" class="col-sm-2 col-form-label">Tel&eacute;fono</label>
                    <div class="col-sm-10">
                      <input type="number" autocomplete="off" class="form-control" id="num_tel_prov" name="num_tel_prov" maxlength="10" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="button" class="btn btn-info float-md-right" id="register" name="register" onclick="addProvider()">Registrar</button>                  
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
        </div>
        <?php        
    }

    function getProvider($array_provider)
    {   
        $nit_prov = $array_provider[0]->nit_prov;
        $nom_prov = $array_provider[0]->nom_prov;
        $num_tel_prov = $array_provider[0]->num_tel_prov;
        ?>
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-tittle">Formulario de actualizaci&oacute;n</h3>
          </div>
              <!-- form start -->
              <form action="" class="form-horizontal" id="updateProvider">
                <div class="card-body">
                <div class="form-group row" hidden>
                    <label for="nit_prov" class="col-sm-2 col-form-label">NIT</label>
                    <div class="col-sm-10">
                      <input type="text" autocomplete="off" class="form-control" id="nit_prov" name="nit_prov" maxlength="9" value="<?php echo $nit_prov;?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="nom_prov" class="col-sm-2 col-form-label">Nombre</label>
                    <div class="col-sm-10">
                      <input type="text" autocomplete="off" class="form-control" id="nom_prov" name="nom_prov" maxlength="100" value="<?php echo $nom_prov;?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="num_tel_prov" class="col-sm-2 col-form-label">Contacto</label>
                    <div class="col-sm-10">
                      <input type="number" autocomplete="off" class="form-control" id="num_tel_prov" name="num_tel_prov" maxlength="10" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" value="<?php echo $num_tel_prov;?>">
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="button" class="btn btn-info float-md-right" id="register" name="register" onclick="updateProvider()">Actualizar</button>                  
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
        </div>
        <?php
    }
}
?>