<?php
session_start();

if(!isset($_SESSION['user_active'])) header("Location: loginEsDoc.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Reportes</title>
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
        <a class="navbar-brand" href="dashboard.php">Disglobal</a>
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
        <ul class="navbar-nav d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                 &nbsp;&nbsp;&nbsp;Bienvenido(a) <br/>&nbsp;&nbsp;&nbsp;<?php echo $_SESSION['usuario'] ?>
                 <div class="dropdown-divider"></div>
                 <a class="dropdown-item" href="close.php">Salir</a>
             </div>
         </li>
     </ul>
 </nav>
 <div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Core</div>
                    <a class="nav-link" href="dashboard.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                    <a class="nav-link" href="setPercentaje.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-percentage"></i></div>
                        Fijar Porcentaje
                    </a>
             
                </div>
            </div>
            <div class="sb-sidenav-footer justify-content-center">
                <div class="small text-center" >Corporaci??n Universitraria<br/>Minuto de DIOS</div>
              
            </div>
        </nav>
    </div>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Dashboard</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>

                <!-- Filtro por fechas inicio -->
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fa fa-id-card"></i>
                        Informaci??n del candidato
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-2 col-xl-2 col-md-2">
                               &nbsp; 
                            </div>
                            <div class="col-lg-4 col-xl-4 col-md-4">
                             <form class="form-inline">
                               <img src="<?php echo $_SESSION['foto'] ?>" class="img-fluid" alt="Responsive image" width="300" height="150">   
                             </form>
                         </div>
                         <div class="col-lg-6 col-xl-6 col-md-6">
                             <form class="form-inline">
                               <ul class="list-group">
                                  <li class="list-group-item"><strong>Nombre: </strong><?php echo $_SESSION['usuario'] ?></li>
                                  <li class="list-group-item"><strong>Correo: </strong><?php echo $_SESSION['email'] ?></li>
                                  <li class="list-group-item"><strong>Rol: </strong><?php echo $_SESSION['rol'] ?></li>
                                  <li class="list-group-item"><strong>Identificaci??n: </strong><?php echo $_SESSION['identificacion'] ?></li>
                                  <li class="list-group-item"><strong>Sede: </strong><?php echo $_SESSION['rectoria'] ?></li>
                                </ul>  
                             </form>
                         </div>
                        
                     </div>
                 </div>
             </div>
             <!-- Fltro por fechas fin -->
             <!-- Reporte de dispositivos -->
             <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-address-book"></i>
                    Postulaci??n del candidato
                </div>
                <div class="card-body">
                    <div class="table-responsive" id="datosPOS">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Fecha Transacci??n</th>
                                    <th>Id Transacci??n</th>
                                    <th>Identificaci??n</th>
                                    <th>Comercio</th>
                                    <th>Banco</th>
                                    <th>Serial</th>
                                    <th>Lote Cr??dito</th>
                                    <th>Monto Cr??dito</th>
                                    <th>Lote D??bito</th>
                                    <th>Monto D??bito</th>
                                    <th>Comisi??n</th>
                                    <th>Nro Tel??fono</th>
                                    <th>Medio de Pago</th>
                                    <th>Tipo de entrada</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Fecha Transacci??n</th>
                                    <th>Id Transacci??n</th>
                                    <th>Identificaci??n</th>
                                    <th>Comercio</th>
                                    <th>Banco</th>
                                    <th>Serial</th>
                                    <th>Lote Cr??dito</th>
                                    <th>Monto Cr??dito</th>
                                    <th>Lote D??bito</th>
                                    <th>Monto D??bito</th>
                                    <th>Comisi??n</th>

                                    <th>Nro Tel??fono</th>
                                    <th>Medio de Pago</th>
                                    <th>Tipo de entrada</th>
                                </tr>
                            </tfoot>
                            <tbody id="contentTable">


                            </tbody>
                        </table>
                    </div>
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
    function getData(fini,ffin){
      
      $.ajax({
        type: "get",
        url: "ajax/getReprotData.php?fini="+fini+"&ffin="+ffin,

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
           // alert(r[item].idTransaccion+' '+r[item].fechaCreacion);
            // $(id_container).append('<option value="'+data[i].id+'">'+data[i].name+'</option>');
            $("#contentTable").append('<tr><td>'+r[item].fechaCreacion+'</td><td>'+r[item].idTransaccion+'</td><td>'+r[item].identificacion+'</td><td>'+r[item].comercio+'</td><td>'+r[item].banco+'</td><td>'+r[item].serial+'</td><td>'+r[item].loteCredito+'</td><td>'+r[item].montoCredito+'</td><td>'+r[item].loteDebito+'</td><td>'+r[item].montoDebito+'</td><td>'+r[item].comision+'</td><td>'+r[item].nroTelefono+'</td><td>'+r[item].medioPago+'</td><td>'+r[item].typeEntry+'</td></tr>');
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
                $("#datosPOS").append('<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"><thead><tr><th>Fecha Transacci??n</th><th>Id Transacci??n</th><th>Identificaci??n</th><th>Comercio</th><th>Banco</th><th>Serial</th><th>Lote Cr??dito</th><th>Monto Cr??dito</th><th>Lote D??bito</th><th>Monto D??bito</th><th>Comisi??n</th><th>Nro Tel??fono</th><th>Medio de Pago</th><th>Tipo de entrada</th></tr></thead><tfoot><tr><th>Fecha Transacci??n</th><th>Id Transacci??n</th><th>Identificaci??n</th><th>Comercio</th><th>Banco</th><th>Serial</th><th>Lote Cr??dito</th><th>Monto Cr??dito</th><th>Lote D??bito</th><th>Monto D??bito</th><th>Comisi??n</th><th>Nro Tel??fono</th><th>Medio de Pago</th><th>Tipo de entrada</th></tr></tfoot><tbody id="contentTable"></tbody></table>');
                getData($("#dateFrom").val(),$("#dateTo").val());
}


$(document).ready(function()
{
     getData('','');
     
     $("#searchData").click(function() 
          {
            if($("#dateFrom").val()!='' && $("#dateTo").val()!=''){
               if(validarFechas($("#dateFrom").val(),$("#dateTo").val())){
                  recargarTabla();
               }
               else{
                 alert('Verifique el rango de fechas.');
               }
            }
            else{

                recargarTabla();
            }
      });


});
</script>
</body>
</html>
