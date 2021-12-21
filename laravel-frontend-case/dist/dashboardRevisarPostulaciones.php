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
    <title>Revisar Postulaciones</title>
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
<style type="text/css">
  #InfoToCheck tr td a:hover{
    text-decoration: underline;
  }
</style>
<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand" href="dashboardRevisarPostulaciones.php">Votaciones Uniminuto</a>
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
                 <input type="hidden" id="usuario" name="usuario" value="<?php echo $_SESSION['usuario'] ?>">
                 <input type="hidden" id="identificacion" name="identificacion">
                 <input type="hidden" id="emailPostulante" name="emailPostulante">
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
                <h1 class="mt-4">Revisar Postulaciones</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Revisar Postulaciones</li>
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
                    Listado de postulantes en el sistema
                </div>
                <div class="card-body">
                    <div class="table-responsive" id="datosPOS">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Identificación</th>
                                    <th>Nombre</th>
                                    <th>Rol</th>
                                    <th>Sede</th>
                                    <th>Programa</th>
                                    <th>Estado</th>
                                  </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Identificación</th>
                                    <th>Nombre</th>
                                    <th>Rol</th>
                                    <th>Sede</th>
                                    <th>Programa</th>
                                    <th>Estado</th>
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
                    <i class="fas fa-check"></i>
                    Revisar Documentos de Postulantes
                </div>
                <div class="card-body">
                    <div class="table-responsive" id="checkInfo">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                  <tr>
                                    <th>Tipo de Documento</th>
                                    <th>Descargar Para Revisión</th>
                                    <th>Descargar Para Segunda Revisión</th>
                                  </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Tipo de Documento</th>
                                    <th>Descargar Para Revisión</th>
                                    <th>Descargar Para Segunda Revisión</th>
                                  </tr>
                            </tfoot>
                            <tbody id="InfoToCheck">
                                  
                           </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-header">
                    <i class="fas fa-check"></i>
                    Aceptar/Rechazar Postulación
                </div>
                <div class="card-body">
                    <div class="row">
                      <div class="col-lg-6 col-xl-6 col-md-6">
                        <label class="small mb-1" for="observaciones">Observaciones</label>
                        <textarea id="observaciones" name="observaciones" class="form-control py-4" rows="1" style="height: 54.5%;padding: 13px 5px 13px 8px !important;"></textarea>
                      </div>
                      <div class="col-lg-6 col-xl-6 col-md-6">
                              <div class="form-group">
                                        <label class="small mb-1" for="apellido2">Descición</label>
                                        <select class="form-control py-4" id="status" name="status" style="height: 12%;padding: 13px 5px 13px 8px !important;">
                                          <option value="0" selected="selected">Escoja Opción</option>
                                          <option value="APROBADA">APROBADA</option>
                                          <option value="RECHAZADA">RECHAZADA</option>
                                          <option value="PRE-APROBADA">PRE-APROBADA</option>
                                          
                                        </select>


                              </div>
                              
                        </div>
                        
                    </div>
                    <button type="button" class="btn btn-success" id="send" name="send">Guardar Revisión</button>
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

  function getPostuladosList(){
      
      $.ajax({
        type: "get",
        url: '../../eleccionesBackEnd/consume/getPostuladosList.php',

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
             /*var id='';
             if(r[item].estado=='EN ESPERA'){
               id = r[item].identificacion;
             }*/
             var ident= "'"+r[item].identificacion+"'";
            // $(id_container).append('<option value="'+data[i].id+'">'+data[i].name+'</option>');
            $("#contentTable").append('<tr><td><a class="ancla" data-ancla="agregar" style="cursor:pointer;color:blue;text-decoration:underline" onclick="getInfoToCheck('+ident+')">'+r[item].identificacion+'</a></td><td>'+r[item].nombre+'</td><td>'+r[item].rol+'</td><td>'+r[item].sede_id+'</td><td>'+r[item].programa_id+'</td><td>'+r[item].estado+'</td></tr>');
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

   function getInfoToCheck(id){
      recargarTablaRequisitos();

      $("#identificacion").val(id);
      $.ajax({
        type: "get",
        url: '../../eleccionesBackEnd/consume/getInfoRequisitosToCheck.php?id='+id,

        beforeSend: function()
        {
                                // setting a timeout
                               /* $("#register_client").prop('disabled', true);
                               $("#register_client").text('Enviando Datos...');*/
        },
        success: function (msg) 
        {
           id2="'"+id+"'";
           r=JSON.parse(msg); 
           $.each(r, function(item){
              if(r[item].email!=''){
                $("#emailPostulante").val(r[item].email);
                // $(id_container).append('<option value="'+data[i].id+'">'+data[i].name+'</option>');
                
                  if(r[item].rutaimagen.indexOf('*')>0)
                  {
                     var separa = r[item].rutaimagen.split("*");
                     $("#InfoToCheck").append('<tr><td>'+r[item].requisito+'</td><td><a target="_blank" style="cursor:pointer" href="../evidencias/'+separa[0]+'">Descargar Documento </a>||<a style="cursor:pointer;color:#007bff;text-decoration:none" onclick="requestChargeAgain('+id2+','+r[item].idreq+')"> Requerir Nuevo Cargue</a></td><td><a target="_blank" style="cursor:pointer" href="../evidencias/'+separa[1]+'">Descargar Documento</a></td></tr>');
                  }
                  else
                  {
                    $("#InfoToCheck").append('<tr><td>'+r[item].requisito+'</td><td><a target="_blank" style="cursor:pointer" href="../evidencias/'+r[item].rutaimagen+'">Descargar Documento </a>||<a style="cursor:pointer;color:#007bff;text-decoration:none" onclick="requestChargeAgain('+id2+','+r[item].idreq+')"> Requerir Nuevo Cargue</a></td><td></td></tr>');
                  
                  }




              }else{
                $("#observaciones").val(r[item].observaciones);
                $("#status").val(r[item].estado);
              }
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
                $("#datosPOS").append('<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"><thead><tr><th>Identificación</th><th>Nombre</th><th>Rol</th><th>Sede</th><th>Programa</th><th>Estado</th></tr></thead><tfoot><tr><th>Identificación</th><th>Nombre</th><th>Rol</th><th>Sede</th><th>Programa</th><th>Estado</th></tr></tfoot><tbody id="contentTable"></tbody></table>');
                getPostuladosList();
}
function recargarTablaRequisitos(){
    $("#checkInfo").empty();
                $("#checkInfo").append('<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"><thead><tr><th>Tipo de Documento</th><th>Descargar Para Revisión</th><th>Descargar Para Segunda Revisión</th></tr></thead><tfoot><tr><th>Tipo de Documento</th><th>Descargar Para Revisión</th><th>Descargar Para Segunda Revisión</th></tr></tfoot><tbody id="InfoToCheck"></tbody></table>');
                
}


 function requestChargeAgain(idUser,idRequirement){
    if(confirm('¿Desea solicitar el nuevo cargue de este documento?')){
        var user= idUser;
        $.ajax({
          url: '../../eleccionesBackEnd/consume/notifyToCharge.php',
          type: 'post',
                  data: {user:user,requerimiento:idRequirement},
                  dataType:'json',

          beforeSend: function()
          {
                                  // setting a timeout
                                 /* $("#register_client").prop('disabled', true);
                                 $("#register_client").text('Enviando Datos...');*/
          },
          success: function (msg) 
          {
            alert(msg.message);
      
          }
      });
    }    
  }



$(document).ready(function()
{
     
     getPostuladosList();
    
     $("#newItem").click(function() 
        {
          $("#swtich").val('1');
          $("#status").prop('disabled', true);  
      });

     $("#send").click(function(){
        
        if(confirm('¿Desea guradar la revisión de esta postulación?')){
           if($("#status").val()=='0'){
              alert('Verifique que no haya campos si llenar, o que haya elegido una postulación para revisión.');
            }
            else{
                      var observaciones = $("#observaciones").val();
                      var estado = $("#status").val();
                      var revisado_por = $("#usuario").val();
                      var identificacion= $("#identificacion").val();
                      var emailPostulante=$("#emailPostulante").val();
                      
                      $.ajax({
                    url: '../../eleccionesBackEnd/consume/revisaPostulacion.php',
                    type: 'post',
                    data: {observaciones:observaciones,estado:estado,revisado_por:revisado_por,identificacion:identificacion,emailPostulante},
                    dataType:'json',
                    beforeSend: function()
                    {
                        // setting a timeout
                       $("#send").prop('disabled', true);
                       $("#send").text('Enviando Datos...');
                    },
                    success: function(response){
                                alert(response.message);
                                recargarTabla();
                                $("#send").prop('disabled', false);
                                $("#send").text('Guardar Revisión');
                    }
                });
               
                
            }
        }
            
     });
     $("#newItem").click(function(){
            $("#codigo").val('');
            $("#rol").val('0');
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
