<?php
require_once "models/ClientModel.php";
require_once 'models/ProviderModel.php';
class ClientView
{
    function showClient()
    {
        $Connection = new Connection();
        $ClientModel = new ClientModel($Connection);
        $array_client = $ClientModel->fetchClient();
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
                            <h3 class="card-title">Informaci&oacute;n de clientes</h3>
                            <button class="btn btn-primary float-md-right" id="add_client" name="add_cliente" onclick="getFormClient()">
                              <i class="nav-item fas fa-plus-circle"></i>
                                &nbsp;Agregar cliente
                            </button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Documento</th>
                                <th>Nombre(s)</th>
                                <th>Tel&eacute;fono</th>
                                <th>Dirección</th>
                                <th>Ciudad</th>
                                <th>Departamento</th>
                                <th>Pais</th>
                                <th>Acci&oacute;n</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach ($array_client as $object_client) {
                                        $doc_client = $object_client->doc_client;
                                        $nom_client = $object_client->nom_client;
                                        $num_tel_client = $object_client->num_tel_client;
                                        $dir_client = $object_client->dir_client;
                                        $nom_ciudad = $object_client->nom_ciudad;
                                        $nom_dpto = $object_client->nom_dpto;
                                        $nom_pais = $object_client->nom_pais;
                                        ?>
                                        <tr>
                                            <td><?php echo $doc_client;?></td>
                                            <td><?php echo $nom_client;?></td>
                                            <td><?php echo $num_tel_client;?></td>
                                            <td><?php echo $dir_client;?></td>
                                            <td><?php echo $nom_ciudad;?></td>
                                            <td><?php echo $nom_dpto;?></td>
                                            <td><?php echo $nom_pais;?></td>
                                            <td style="text-align: center;"><i class="fas fa-edit" style="cursor:pointer;" onclick="getClient('<?php echo $doc_client?>');"></i>
                                            </td>
                                        </tr>
                                        <?php
                                    }                                
                                ?>                  
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Documento</th>
                                <th>Nombre(s)</th>
                                <th>Tel&eacute;fono</th>
                                <th>Dirección</th>
                                <th>Ciudad</th>
                                <th>Departamento</th>
                                <th>Pais</th>
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
                <script src="js/client.js"></script>
                <!-- javascript propio -->
                <script src="plugins/sweetalert2/sweetalert2.min.js"></script>
                <!-- javascript sweetalert -->
            </body>
            </html>
        <?php
    }

    function addClient($pais, $dpto, $ciudad)
    {
        ?>
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-tittle">Formulario de registro</h3>
          </div>
              <!-- form start -->
              <form action="" class="form-horizontal" id="addClient">
                <div class="card-body">
                <div class="form-group row">
                    <label for="document" class="col-sm-2 col-form-label">Documento</label>
                    <div class="col-sm-10">
                      <input type="number" autocomplete="off" class="form-control" id="document" name="doc_client" maxlength="10" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="first_name" class="col-sm-2 col-form-label">Nombres</label>
                    <div class="col-sm-10">
                      <input type="text" autocomplete="off" class="form-control" id="first_name" name="nom_client" maxlength="100">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="last_name" class="col-sm-2 col-form-label">Direcci&oacute;n</label>
                    <div class="col-sm-10">
                      <input type="text" autocomplete="off" class="form-control" id="last_name" name="dir_client" maxlength="100">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="cellphone" class="col-sm-2 col-form-label">Tel&eacute;fono</label>
                    <div class="col-sm-10">
                      <input type="number" autocomplete="off" class="form-control" id="cellphone" name="num_tel_client" maxlength="10" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                    </div>
                  </div>
                  <div class="form-group row">
                      <label for="cod_pais" class="col-sm-2 col-form-label">Pa&iacute;s</label>
                      <div class="col-md-10">
                        <select class="custom-select" name="cod_pais" id="cod_pais">
                          <option selected value="">Seleccione el pais</option>
                          <?php
                            foreach($pais as $p)
                            {
                              $cod_pais = $p->cod_pais;
                              $nom_pais = ucwords(strtolower($p->nom_pais));
                              ?>
                              <option value=<?php echo $cod_pais;?>><?php echo $nom_pais;?></option>
                              <?php
                            }
                            ?>
                        </select>
                      </div>
                  </div>
                  <div class="form-group row">
                      <label for="cod_dpto" class="col-sm-2 col-form-label">Departamento</label>
                      <div class="col-md-10">
                        <select class="custom-select" name="cod_dpto" id="cod_dpto">
                          <option selected value="">Seleccione el departamento</option>
                          <?php
                            foreach($dpto as $d)
                            {
                              $cod_dpto = $d->cod_dpto;
                              $nom_dpto = ucwords(strtolower($d->nom_dpto));
                              ?>
                              <option value=<?php echo $cod_dpto;?>><?php echo $nom_dpto;?></option>
                              <?php
                            }
                            ?>
                        </select>
                      </div>
                  </div>
                  <div class="form-group row">
                      <label for="cod_ciudad" class="col-sm-2 col-form-label">Ciudad</label>
                      <div class="col-md-10">
                        <select class="custom-select" name="cod_ciudad" id="cod_ciudad">
                          <option selected value="">Seleccione la ciudad</option>
                          <?php
                            foreach($ciudad as $c)
                            {
                              $cod_ciudad = $c->cod_ciudad;
                              $nom_ciudad = ucwords(strtolower($c->nom_ciudad));
                              ?>
                              <option value=<?php echo $cod_ciudad;?>><?php echo $nom_ciudad;?></option>
                              <?php
                            }
                            ?>
                        </select>
                      </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="button" class="btn btn-info float-md-right" id="register" name="register" onclick="addClient()">Registrar</button>                  
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
        </div>
        <?php        
    }

    function getClient($array_client)
    {   
        $doc_client = $array_client[0]->doc_client;
        $nom_client = $array_client[0]->nom_client;
        $num_tel_client = $array_client[0]->num_tel_client;
        $dir_client = $array_client[0]->dir_client;
        ?>
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-tittle">Formulario de actualizaci&oacute;n</h3>
          </div>
              <!-- form start -->
              <form action="" class="form-horizontal" id="updateClient">
                <div class="card-body">
                <div class="form-group row" hidden>
                    <label for="document" class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                      <input type="number" autocomplete="off" class="form-control" id="doc_client" name="doc_client" maxlength="10" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"value="<?php echo $doc_client;?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="nom_client" class="col-sm-2 col-form-label">Nombres</label>
                    <div class="col-sm-10">
                      <input type="text" autocomplete="off" class="form-control" id="nom_client" name="nom_client" maxlength="100" value="<?php echo $nom_client;?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="num_tel_client" class="col-sm-2 col-form-label">Tel&eacute;fono</label>
                    <div class="col-sm-10">
                      <input type="text" autocomplete="off" class="form-control" id="num_tel_client" name="num_tel_client" maxlength="10" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" value="<?php echo $num_tel_client;?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="dir_client" class="col-sm-2 col-form-label">Direcci&oacute;n</label>
                    <div class="col-sm-10">
                      <input type="text" autocomplete="off" class="form-control" id="dir_client" name="dir_client" maxlength="250" value="<?php echo $dir_client;?>">
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="button" class="btn btn-info float-md-right" id="register" name="register" onclick="updateClient()">Actualizar</button>                  
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
        </div>
        <?php
    }
}
?>