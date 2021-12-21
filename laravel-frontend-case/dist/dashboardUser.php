<?php
session_start();
include('../params/params.php');

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
    <title>Dashboard User</title>
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
                <?php include('../include/sideMenuUsers.php') ?>
            </div>
            <div class="sb-sidenav-footer justify-content-center">
                <div class="small text-center" >Corporación Universitraria<br/>Minuto de DIOS</div>
              
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
                        Información del candidato
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
                              <input type="hidden" id="rol" name="rol" value="<?php echo $_SESSION['rol'] ?>">
                              <input type="hidden" id="host" name="host" value="<?php echo $host ?>">
                              <input type="hidden" name="id" id="id" value="<?php echo $_SESSION['identificacion']  ?>">
                               <ul class="list-group">
                                  <li class="list-group-item"><strong>Nombre: </strong><?php echo $_SESSION['usuario'] ?></li>
                                  <li class="list-group-item"><strong>Correo: </strong><?php echo $_SESSION['email'] ?></li>
                                  <li class="list-group-item"><strong>Rol: </strong><?php echo $_SESSION['rol'] ?></li>
                                  <li class="list-group-item"><strong>Identificación: </strong><?php echo $_SESSION['identificacion'] ?></li>
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
                    Escoger Consejo,Programa y Facultad
                </div>
                <div class="card-body">
                    <form id="loginForm2" name="loginForm2" method="POST">
                      <div class="row">
                        
                        <div class="col-lg-6 col-xl-6 col-md-6">
                              <div class="form-group">
                                        <label class="small mb-1" for="inputPassword">Sede - Programa</label>
                                        <select class="form-control py-4" id="sede" name="sede" style="height: 12%;padding: 13px 5px 13px 8px !important;">
                                          <option value="0" selected="selected">Escoja Opción</option>
                                          
                                        </select>

                              </div>
                        </div>
                        <div class="col-lg-6 col-xl-6 col-md-6">
                          <div class="form-group">
                                        <label class="small mb-1" for="inputEmailAddress">Facultad</label>
                                        <select class="form-control py-4" id="facultad" name="facultad" style="height: 12%;padding: 13px 5px 13px 8px !important;">
                                          <option value="0" selected="selected">Escoja Opción</option>
                                        </select>
                          </div>
                        </div> 
                      </div>
                       <div class="row">
                        
                        <div class="col-lg-6 col-xl-6 col-md-6">
                              <div class="form-group">
                                        <label class="small mb-1" for="inputPassword">Cuerpo Colegiado</label>
                                        <select class="form-control py-4" id="instanciaParticipacion" name="instanciaParticipacion" style="height: 12%;padding: 13px 5px 13px 8px !important;">
                                          <option value="0" selected="selected">Escoja Opción</option>
                                         
                                        </select>
                              </div>
                        </div>
                   
                      </div>
                                    
                                    

                                    
                     </form>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-upload"></i>
                    Subir Documentos
                </div>
                <div class="card-body">
                    <form id="uploadFiles" name="uploadFiles" method="POST" enctype="multipart/form-data">
                      <div class="row" id="containerUploads">
                        
                      </div>
                      <button type="button" class="btn btn-success" id="postularCandidatos" name="postularCandidatos">Postular Candidatura</button>
                     </form>
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

 /* function getComiteConsejo(rol,host){
     $.ajax({
        type: "get",
        url: host+'eleccionesBackEnd/API/getInfoComiteConsejoRoll.php?rol='+rol,

        beforeSend: function()
        {
                                // setting a timeout
                                $("#register_client").prop('disabled', true);
                               $("#register_client").text('Enviando Datos...');
        },
        success: function (msg) 
        {
           r=JSON.parse(msg);
            
           $.each(r, function(item){
              $("#consejo").append('<option value="'+r[item].id+'">'+r[item].descripcion+'</option>');
           });
          
        }
    });
  }*/

  function getInfoFacultad(host){
     $.ajax({
        type: "get",
        url: host+'eleccionesBackEnd/consume/getInfoFacultad.php',

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
              $("#facultad").append('<option value="'+r[item].id+'">'+r[item].descripcion+'</option>');
           });
          
        }
    });
  }

 function getInfoInstancia(host){
     $.ajax({
        type: "get",
        url: host+'eleccionesBackEnd/consume/getInstanciaParticipacion.php',

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
              $("#instanciaParticipacion").append('<option value="'+r[item].id+'">'+r[item].descripcion+'</option>');
           });
          
        }
    });
  }

  function getSedePrograma(rol,id){
     $.ajax({
        type: "get",
        url: '../functions/getSede.php?rol='+rol+'&id='+id,

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
              $("#sede").append('<option value="'+r[item].sedePrograma+'">'+r[item].sedePrograma+'</option>');
           });
          
        }
    });
  }

  function showUploadInputs(rol,host){
     $.ajax({
        type: "get",
        url: host+'eleccionesBackEnd/consume/getInfoRequisitosByRol.php?rol='+rol,

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
              $("#containerUploads").append('<div class="col-lg-10 col-xl-10 col-md-10"><div class="form-group"><label class="small mb-1" for="inputPassword">'+r[item].descripcion+'</label><input enviado="0" class="form-control py-4" type="file" accept="application/pdf" requisito="'+r[item].id+'" id="req'+r[item].id+'" name="req'+r[item].id+'" style="height: 12%;padding: 10px 5px 10px 8px !important;"></div></div><div class="col-lg-2 col-xl-2 col-md-2"><div class="form-group"><button type="button" class="btn btn-primary" id="upDocument_'+r[item].id+'" name="upDocument_'+r[item].id+'" style="margin-top:15% !important;height: 12%;padding: 12px 5px 12px 8px !important;" onClick="uploadFile(this.id)">Subir Documento</button></div></div>');
           });
          
        }
    });
  }

  function uploadFile(id){
     
      var pieces = id.split("_");
      if( document.getElementById("req"+pieces[1]).files.length == 0 )
      {
       alert("Verifique que haya seleccionado el documento a anexar.");
      }
      else{
        var inputFileImage = document.getElementById("req"+pieces[1]);
        var file = inputFileImage.files[0]; 
          if(inputFileImage.files[0].type == "application/pdf"){
           //
              var data = new FormData();
              data.append("req"+pieces[1],file); 
              $.ajax({
                  url: '../include/upload.php?idReq='+pieces[1]+'&postulante='+$("#id").val()+'&instancia=1',
                  type: 'post',
                  data: data,
                  contentType: false,
                  processData: false,
                  success: function(response) {
                      if (response != 0) {
                          alert(response);
                          $("#"+'req'+pieces[1]).attr("enviado","1");
                      } else {
                          alert('Formato de imagen incorrecto.');
                      }
                  }
              });
              return false;
           //     
         }
         else{
           alert('Solo se permite subir documentos en formato PDF.');
         }
        

      }

  }
  


  $(document).ready(function()
  {
     //getComiteConsejo($("#rol").val(),$("#host").val()); 
     getSedePrograma($("#rol").val(),$("#id").val());
     getInfoFacultad($("#host").val());
     showUploadInputs($("#rol").val(),$("#host").val());
     getInfoInstancia($("#host").val());

     //postular candidatos
     $( "#postularCandidatos" ).click(function() {
          if(confirm('¿Desea guardar la postulación de este aspirante?')){
              var sedeProg= $("#sede").val(); pieces = sedeProg.split('-'); sede = pieces[0];programa=pieces[1]; 
        var sw=0; host=$("#host").val(); data = new Array(); nombre ='<?php echo  $_SESSION['usuario'] ?>';
        var identificacion='<?php echo $_SESSION['identificacion'] ?>';email='<?php echo $_SESSION['email'] ?>';
        var pictureUrl='<?php echo $_SESSION['foto'] ?>';rol = '<?php echo $_SESSION['rol']?>';
        var sw2=0; instancia=$("#instanciaParticipacion").val();
        var facultad = $("#facultad").val();
        
        $("#containerUploads input:file").each(function(){
              var id = $(this).attr('id');
              if($('#'+id).attr('enviado')==0)
              {
                sw=1;
              }

          });
        
        if( $("#sede").val()==0 || $("#facultad").val()==0){
           sw2=1;
        }

          if(sw==0 && sw2==0){
            //end point postular
                $.ajax({
                url: host+'eleccionesBackEnd/consume/postular.php',
                type: 'post',
                data: {nombre:nombre,identificacion:identificacion,email:email,rol:rol,pictureUrl:pictureUrl,sede:sede,programa:programa,instancia:instancia,facultad:facultad},
                dataType:'json',
                beforeSend: function()
                {
                    // setting a timeout
                   $("#postularCandidatos").prop('disabled', true);
                   $("#postularCandidatos").text('Enviando Datos...');
                },
                success: function(response) {
                    if (response != 0) {
                        alert(response.message);
                         $("#postularCandidatos").prop('disabled', false);
                         $("#postularCandidatos").text('Postular Candidatura');
                        //$("#"+'req'+pieces[1]).attr("enviado","1");
                    } else {
                        alert('Formato de imagen incorrecto.');
                    }
                }
            }); 
          }
          else{
            if(sw==1){
              alert('Verifique que haya anexado todos los documentos.');
            }
            else{
              alert('Verifique que haya escogido consejo, sede y facultad.');
            }
          } 
          }
         
      });

  });
</script>
</body>
</html>
