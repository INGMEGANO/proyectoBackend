<?php
session_start();
include('../params/params.php');
if(!isset($_SESSION['user_authorized'])) header("Location: loginAdmin.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Comité Consejo</title>
    <link href="css/styles.css" rel="stylesheet" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" />
    <!-- Custom fonts for this template -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.2/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css" />


    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

</head>
<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand" href="dashboardComiteConsejo.php">Votaciones Uniminuto</a>
        <!-- <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button> -->
        <!-- Navbar Search-->
        <!-- <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
                <div class="input-group-append">
                    <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </form> -->
        <!-- Navbar-->
        <input type="hidden" id="host" name="host" value="<?php echo $host ?>">
        <ul class="navbar-nav d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                 &nbsp;&nbsp;&nbsp;Bienvenido(a) <br/>&nbsp;&nbsp;&nbsp;<?php echo $_SESSION['usuario'] ?>
                 <div class="dropdown-divider"></div>
                 <a class="dropdown-item" href="closeAdmin.php">Salir</a>
             </div>
         </li>
     </ul>
 </nav>
 <div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <?php include('../include/sideMenu.php'); ?>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Usuario Logeado:</div>
                <?php echo $_SESSION['usuario'] ?>
            </div>
        </nav>
    </div>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Comite/Consejo </h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Comite/Consejo </li>
                </ol>

                <!-- Filtro por fechas inicio -->
               <!-- <div class="card mb-4">
                    <div class="card-header">
                        <i class="far fa-calendar-alt"></i>
                        Búsqueda por fechas
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 col-xl-12 col-md-8">
                                <form class="form-inline">
                                 <div class="form-group mx-sm-3 col-lg-5">
                                     <label for="datefrom" class="sr-only">User</label>
                                     <input type="date" class="form-control col-lg-12" id="dateFrom" name="dateFrom" placeholder="Fecha Inicio">
                                 </div>
                                 <div class="form-group mx-sm-3 col-lg-5">
                                     <label for="dateTo" class="sr-only">Password</label>
                                     <input type="date" class="form-control col-lg-12" id="dateTo" name="dateTo" placeholder="Fecha Fin">
                                 </div>
                                 <button type="button" class="btn btn-primary" id="searchData" name="searchData">Buscar Registros</button>
                             </form>
                         </div>
                     </div>
                 </div>
             </div> !-->
             <!-- Fltro por fechas fin -->
             <!-- Reporte de dispositivos -->
             <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-clipboard-list"></i>
                    Listado de requisitos en el sistema
                </div>
                <div class="card-body">
                    <div class="table-responsive" id="datosPOS">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Descripción</th>
                                    <th>Tipo</th>
                                    <th>Rol</th>
                                    <th>Status</th>
                                  </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Descripción</th>
                                    <th>Tipo</th>
                                    <th>Rol</th>
                                    <th>Status</th>
                                  </tr>
                            </tfoot>
                            <tbody id="contentTable">


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card mb-4">
                <input  class="form-control py-4"type="hidden" name="switch" id="swtich">
                <input  class="form-control py-4"type="hidden" name="idUser" id="idUser">
                
                <div class="card-header">
                    <i class="fas fa-clipboard-list"></i>
                    Agregar/Editar Requisitos de postulantes
                </div>
                <div class="card-body">
                    
                      
                       
                      <div class="row">
                        <div class="col-lg-3 col-xl-3 col-md-3">
                              <div class="form-group">
                                        <label class="small mb-1" for="descripcion">*Descripción</label>
                                        <input class="form-control py-4" type="text" name="descripcion" id="descripcion">

                              </div>
                        </div>
                        
                        <div class="col-lg-3 col-xl-3 col-md-3">
                              <div class="form-group">
                                        <label class="small mb-1" for="rol">*Rol</label>
                                        <select class="form-control py-4" id="rol" name="rol" style="height: 12%;padding: 13px 5px 13px 8px !important;">
                                          <option value="0">Escoja Opción</option>
                                          <option value="ADMINISTRATIVO" >ADMINISTRATIVO</option>
                                          <option value="DOCENTE">DOCENTE</option>
                                          <option value="ESTUDIANTE" >ESTUDIANTE</option>
                                          <option value="GRADUADO">GRADUADO</option>
                                        </select>

                              </div>
                        </div>
                        <div class="col-lg-3 col-xl-3 col-md-3">
                              <div class="form-group">
                                        <label class="small mb-1" for="tipo">*Tipo</label>
                                        <select class="form-control py-4" id="tipo" name="tipo" style="height: 12%;padding: 13px 5px 13px 8px !important;">
                                          <option value="0">Escoja Opción</option>
                                          <option value="PROGRAMA" >PROGRAMA</option>
                                          <option value="NACIONALES">NACIONALES</option>
                                          <option value="SEDE" >SEDE</option>
                                        </select>

                              </div>
                        </div>
                        
                        
                        <div class="col-lg-3 col-xl-3 col-md-3">
                              <div class="form-group">
                                        <label class="small mb-1" for="status">Status</label>
                                        <select class="form-control py-4" id="status" name="status" style="height: 12%;padding: 13px 5px 13px 8px !important;">
                                          <option value="0">Escoja Opción</option>
                                          <option value="ACTIVO" selected="selected">ACTIVO</option>
                                          <option value="INACTIVO">INACTIVO</option>
                                        </select>

                              </div>
                        </div>
                        
                      </div>
                      
                      <button type="button" class="btn btn-success" id="agregar" name="agregar">Guardar Datos</button>
                      <button type="button" class="btn btn-primary" id="newItem" name="newItem">Agregar Nuevo Registro</button>                 
                </div>
            </div>



        </div>
    </main>

    <footer class="py-4 bg-light mt-auto">
        <div class="container-fluid">
            <div class="d-flex align-items-center justify-content-between small">
                <div class="text-muted">Copyright &copy; Your Website 2020</div>
                <div>
                    <a href="#">Privacy Policy</a>
                    &middot;
                    <a href="#">Terms &amp; Conditions</a>
                </div>
            </div>
        </div>
    </footer>
</div>
</div>

<!--     <script src="js/scripts.js"></script> -->




<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>



<script type="text/javascript">

    function validarEmail(valor){
      var regex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
      if (!regex.test(valor)) {
          return 0;
      } else {
        return 1;
      }

    }
    function getInfoComiteConsejo(){
      
      $.ajax({
        type: "get",
        url: '../../eleccionesBackEnd/consume/getInfoComiteConsejo.php',

        beforeSend: function()
        {
                                // setting a timeout
                               /* $("#register_client").prop('disabled', true);
                               $("#register_client").text('Enviando Datos...');*/
        },
        success: function (msg) 
        {
           r=JSON.parse(msg); 
           $.each(r, function(item){
            
            // $(id_container).append('<option value="'+data[i].id+'">'+data[i].name+'</option>');
            $("#contentTable").append('<tr><td><a class="ancla" data-ancla="agregar" style="cursor:pointer;color:blue;text-decoration:underline" onclick="updateAdmin('+r[item].id+')">'+r[item].descripcion+'</a></td><td>'+r[item].tipo+'</td><td>'+r[item].rolpermitido+'</td><td>'+r[item].STATUS+'</td></tr>');
           });
           jQuery('#dataTable').DataTable({

            rowReorder: {
                selector: 'td:nth-child(2)'
            },
        

            responsive: true,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
            },
            "paging": true,
            "processing": true,
            'serverMethod': 'post',
            //"ajax": "data.php",
            dom: 'lBfrtip',
            buttons: [
            'excel', 'csv', 'pdf', 'print', 'copy',
            ],
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "aaSorting":[[0,"desc"]]
            });
        }
    });
  }

  function validarFechas(fechaIni,fechaFin){
    var start= new Date(fechaIni);
    var end= new Date(fechaFin);
    if (start > end)
    {
     return false;
    }
 else{
    return true;
    }
}

function recargarTabla(){
    $("#datosPOS").empty();
                $("#datosPOS").append('<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"><thead><tr><th>Descripción</th><th>Tipo</th><th>Rol</th><th>Status</th></tr></thead><tfoot><tr><th>Descripción</th><th>Tipo</th><th>Rol</th><th>Status</th></tr></tfoot><tbody id="contentTable"></tbody> </table>');
                getInfoComiteConsejo();
}
function updateAdmin(id){
    $("#agregar").text('Actualizar');
    $("#status").prop('disabled', false); 
    $("#idUser").val(id);
    //se hace el llamado ajax
        $.ajax({
                url: '../../eleccionesBackEnd/consume/getInfoComiteConsejoById.php?id='+id,
                type: 'get',
                
                beforeSend: function()
                {
                    // setting a timeout
                    
                },
                success: function(response) {
                  r=JSON.parse(response);

                  $.each(r, function(item){
                    $("#descripcion").val(r[item].descripcion);
                    $("#rol").val(r[item].rolpermitido);
                    $("#tipo").val(r[item].tipo);
                    $("#status").val(r[item].STATUS);
                   });
                    //
                }
            });


    //Se llama al ancla
    $('html, body').animate({
            scrollTop: $('#agregar').offset().top
        }, 500);

}


$(document).ready(function()
{
     getInfoComiteConsejo();
     $("#status").prop('disabled', true);
     $("#newItem").click(function() 
        {
          $("#swtich").val('1');
          $("#status").prop('disabled', true);  
      });

     $("#agregar").click(function(){
        var url='';var confirma=''; var labelAgregar='';var id=''; var status='';
        if($("#agregar").text()=='Actualizar'){
             url='../../eleccionesBackEnd/consume/actualizaComiteConsejo.php';
             confirma='¿Desea actualizar los datos de este Comite/Consejo Académico?';
             labelAgregar='Actualizar';
             id=$("#idUser").val();
             status=$("#status").val();
             
        }
        else{
            url='../../eleccionesBackEnd/consume/addComiteConsejo.php';
            confirma='¿Desea agregar este Comite/Consejo Académico?';
            labelAgregar='Guardar Datos';
            id='';
           
        }
        if(confirm(confirma)){
           if($("#descripcion").val()=='' || $("#rol").val()=='0' || $("#tipo").val()=='0' || $("#status").val()=='0'){
              alert('los campos marcados con * son obligatorios.');
            }
            else{
               
               
                      var tipo = $("#tipo").val();
                      var rol = $("#rol").val();
                      var descripcion = $("#descripcion").val();
                      status=$("#status").val();
                      
                      $.ajax({
                    url: url,
                    type: 'post',
                    data: {descripcion:descripcion,rol:rol,tipo:tipo,status:status,id:id},
                    dataType:'json',
                    beforeSend: function()
                    {
                        // setting a timeout
                        $("#agregar").prop('disabled', true);
                       $("#agregar").text('Enviando Datos...');
                    },
                    success: function(response){
                                alert(response.message);
                                recargarTabla();
                               // $("#codigo").val('');
                                $("#rol").val('0');
                                $("#tipo").val('0');
                                $("#descripcion").val('');
                                $("#agregar").prop('disabled', false);
                                $("#agregar").text(labelAgregar);
                                $("#status").val('ACTIVO');
                    }
                });
               
                
            }
        }
            
     });
     $("#newItem").click(function(){
            //$("#codigo").val('');
            $("#rol").val('0');
            $("#tipo").val('0');
            $("#descripcion").val('');
            $("#status").prop('disabled', true);
            $("#status").val('ACTIVO');
            $("#agregar").text('Guardar Datos');
     });

     //Ancla
       

});
</script>
</body>
</html>
