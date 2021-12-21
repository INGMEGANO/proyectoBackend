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
    <title>Votar</title>
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
        <a class="navbar-brand" href="dashboardVote.php">Votaciones Uniminuto</a>
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
              <input type="hidden" id="host" name="host" value="<?php echo $host ?>">
              <input type="hidden" name="id" id="id" value="<?php echo $_SESSION['identificacion']?>">
              <input type="hidden" name="votante_id" id="votante_id" value="">
                <h1 class="mt-4">Panel de votación</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Panel de votación</li>
                </ol>
               
                <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-address-book"></i>
                    Instacias de participación
                </div>
                <div class="card-body">
                    <form id="loginForm2" name="loginForm2" method="POST">
                      <div class="row">
                        <div class="col-lg-6 col-xl-6 col-md-6">
                          <div class="form-group">
                                <label class="small mb-1" for="inputEmailAddress">Cuerpo Colegiado</label>
                                <select class="form-control py-4" id="instancia" name="instancia" style="height: 12%;padding: 13px 5px 13px 8px !important;">
                                  
                                </select>
                          </div>
                        </div>

                        <div class="col-lg-6 col-xl-6 col-md-6">
                              <div class="form-group">
                                        <label class="small mb-1" for="inputPassword">Sede - Programa</label>
                                        <select class="form-control py-4" id="sede" name="sede" style="height: 12%;padding: 13px 5px 13px 8px !important;">
                                          <option value="0" selected="selected">Escoja Opción</option>
                                          
                                        </select>

                              </div>
                        </div>

                        
                      
                   
                      </div>
                      <div class="row">
                        <div class="col-lg-6 col-xl-6 col-md-6">
                          <div class="form-group">
                                        <label class="small mb-1" for="inputEmailAddress">Facultad</label>
                                        <select class="form-control py-4" id="facultad" name="facultad" style="height: 12%;padding: 13px 5px 13px 8px !important;">
                                          <option value="0" selected="selected">Escoja Opción</option>
                                        </select>
                          </div>
                        </div>
                        <div class="col-lg-6 col-xl-6 col-md-6">
                          <div class="form-group" style="margin-top:4.9%">
                            <button type="button" class="btn btn-success" id="verTarjeton" name="verTarjeton">Ver Tarjetón</button>
                          </div>
                        </div>

                      </div>
                       
                                    
                                    

                                    
                     </form>
                </div>
            </div>

                <!-- Filtro por fechas inicio -->


                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fa fa-id-card"></i>
                        Tarjetón
                    </div>
                    <div class="card-body" id="cards">
                        
                    </div>
             <!-- Fltro por fechas fin -->
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

  function vote(id){
    $("#votante_id").val(id);
    var candidato_id=id;votante_id=$("#id").val();instancia_id=$("#instancia").val();host=$("#host").val()
    var piezas = $("#sede").val(); 
    piezas = piezas.split('-');
    var sede = piezas[0].trim();
     $.ajax({
                url: host+'eleccionesBackEnd/consume/registerVote.php',
                type: 'post',
                data: {candidato_id:candidato_id,votante_id:votante_id,instancia_id:instancia_id,sede:sede},
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
                         getInfoInstancia($("#host").val(),$("#id").val());
                         $("#cards").empty();

                        //$("#"+'req'+pieces[1]).attr("enviado","1");
                    } else {
                        alert('Error en el proceso de votación.');
                    }
                }
            }); 
  }

  function getNumRows(n){
    if(n % 3 != 0)
      {
        filas =Math.floor(n/3) + 1;
      }
      else
      {
        filas = n/3;
      } 
    return filas;      
  }

  function getInfoTarjetones(host,cuerpoColegiado,sede,facultad){
     var rol = '<?php echo $_SESSION['rol']?>';
     var programa='';
     if(sede!=''){
       var pieces = sede.split('-');
       var sede = pieces[0].trim();
       programa = pieces[1].trim(); 
      }  
     
     var id = cuerpoColegiado;
   
     $.ajax({
        type: "post",
        url: host+'eleccionesBackEnd/consume/getInfoTarjetones.php',
        data: {rol:rol,sede:sede,programa:programa,id:id,facultad:facultad},
        //dataType:'json',
        beforeSend: function()
        {
                                // setting a timeout
                               /* $("#register_client").prop('disabled', true);
                               $("#register_client").text('Enviando Datos...');*/
        },
        success: function (msg) 
        {
          
          $("#cards").empty();
           r=JSON.parse(msg);
           var cantObjetos= Object.keys(r).length;//para saber cuantos objetos tiene un JSON
           var votoEnBlanco = '';
           var elementoFila='';
           var sw=0; var numRows=0;
           //se calcula el numero de filas que se necesitan para pintar las fotos,los nombres y el botón de votar de cada candidato
           numRows=getNumRows(cantObjetos);
           var i=1;j=1;
           elementoFIla='';
           $("#cards").append(elementoFIla);
           while(i<=numRows){
             elementoFIla='<div class="row" id="fila'+i+'"><div class="col-lg-1 col-xl-1 col-md-1">&nbsp;</div></div><br/>';
           $("#cards").append(elementoFIla);
             i++;
           }
           i=1;
           $.each(r, function(item){
               if(r[item].identificacion==''){
                alert(r[item].nombre);
              }
              else{
                //Se hace la respectiva inserción de elementos
                 //aca en el foreach, sacar los datos de cada persona y pegar sus datos en cada append
                 var ident= "'"+r[item].identificacion+"'";
                 var columna = ' <div class="col-lg-3 col-xl-3 col-md-3"><img src="https://pix.uniminuto.edu/pix/0.JPG" class="img-fluid" alt="Responsive image" width="300" height="150"><br><h4>'+r[item].nombre+'</h4><button onclick="vote('+ident+')" type="button" class="btn btn-primary" id="votar"name="votar">Votar</button></div>';
                 if(j<=3){
                  $("#fila"+i).append(columna);
                   /*alert('fila: '+i+' columna:'+j);*/j++;

                 }
                 else{
                   j=1; i++;
                   $("#fila"+i).append(columna);
                   /*alert('fila: '+i+' columna:'+j);*/j++;
                 }
                 sw=1;
                //fin
              }
            });
             if(sw==1){ //para controlar que se añada laopcion de voto en blanco.
                var blanco="'"+'BLANCO'+"'";
                var votoEnBlanco = '<div class="row" id="fila'+(numRows+1)+'"><div class="col-lg-1 col-xl-1 col-md-1">&nbsp;</div><div class="col-lg-3 col-xl-3 col-md-3"><img src="https://pix.uniminuto.edu/pix/0.JPG" class="img-fluid" alt="Responsive image" width="300" height="150"><br><h3>Voto en Blanco</h3><button  onclick="vote('+blanco+')" type="button" class="btn btn-primary" id="verTarjeton" name="verTarjeton">Votar</button></div></div>';
                $("#cards").append(votoEnBlanco);
              }
        }
    });
  }
  function getComiteConsejo(rol,host){
     $.ajax({
        type: "get",
        url: host+'eleccionesBackEnd/API/getInfoComiteConsejoRoll.php?rol='+rol,

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
              $("#consejo").append('<option value="'+r[item].id+'">'+r[item].descripcion+'</option>');
           });
          
        }
    });
  }

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

 function getInfoInstancia(host,id){
     $("#instancia").empty();
     $("#instancia").append('<option value="0" selected="selected">Escoja Opción</option>');
     $.ajax({
        type: "get",
        url: host+'eleccionesBackEnd/consume/getInstanciaToVote.php?id='+id,

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
              $("#instancia").append('<option value="'+r[item].id+'">'+r[item].descripcion+'</option>');
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
                  url: '../include/upload.php?idReq='+pieces[1]+'&postulante='+$("#id").val(),
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
     $("#facultad").prop('disabled', true);
     var rol = '<?php echo $_SESSION['rol']?>'; 
    
     getInfoInstancia($("#host").val(),$("#id").val());
     getSedePrograma($("#rol").val(),$("#id").val());
     getInfoFacultad($("#host").val());

     //postular candidatos
     $("#postularCandidatos").click(function(){
          if(confirm('¿Desea guardar la revisión de esta postulación?')){
              var sedeProg= $("#sede").val(); pieces = sedeProg.split('-'); sede = pieces[0];programa=pieces[1]; 
        var sw=0; host=$("#host").val(); data = new Array(); nombre ='<?php echo  $_SESSION['usuario'] ?>';
        var identificacion='<?php echo $_SESSION['identificacion'] ?>';email='<?php echo $_SESSION['email'] ?>';
        var pictureUrl='<?php echo $_SESSION['foto'] ?>';
        var sw2=0; instancia=$("#instanciaParticipacion").val();
        var facultad = $("#facultad").val();
        
        $("#containerUploads input:file").each(function(){
              var id = $(this).attr('id');
              if($('#'+id).attr('enviado')==0)
              {
                sw=1;
              }

          });
        
        if($("#consejo").val()==0 || $("#sede").val()==0 || $("#facultad").val()==0){
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

     $("#verTarjeton").click(function(){
           var sede=''; var facultad='';
           if($("#instancia").val()=='0'){
             alert('Los campos marcados con * son obligatorios');
           }
           else{
               if($("#instancia").val()=='1'){
                  facultad = $("#facultad").val();
               }
               else{
                  if($("#instancia").val()=='2'){
                    facultad= $("#facultad").val();
                    sede = $("#sede").val();
                  }
                  else{
                    sede = $("#sede").val();
                  }
               }
               getInfoTarjetones($("#host").val(),$("#instancia").val(),sede,facultad);
           }
      });

     $("#instancia").change(function() {
        if($("#instancia").val()=='1' || $("#instancia").val()=='2'){
          $("#facultad").prop('disabled', false);
        }
        else{
          $("#facultad").prop('disabled', true);
        }
      });

  });
</script>
</body>
</html>
