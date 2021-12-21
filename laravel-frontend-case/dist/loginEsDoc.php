<?php
session_start();

if(isset($_SESSION['user_authorized'])) {session_destroy();}
?>
<?php 
if(isset($_POST['loginEstProf']) )
{ 
 
 
 include('../../eleccionesBackEnd/clases/auth.php');
  $auth = new auth();

  //getSedeEstudiante($id);
  //Logueo de docente o estudiante
  $usuario=$_POST['email'];
  $password=$_POST['password'];
  $userType=1;
  $respuesta =  $auth->usuario($usuario,base64_encode($password),$userType);
  $info= (array) json_decode(stripslashes($respuesta));
  if($info['codigo']=='00'){
     $_SESSION['user_active']=true;
     $_SESSION['usuario']=$info['nombre'];
     $_SESSION['userType']=$userType;
     $_SESSION['identificacion']=$info['identificacion'];
     $_SESSION['email']=$info['email'];
     $_SESSION['rol']=$info['rol'];
     $_SESSION['foto']=$info['pictureUrl'];
     $cadena=' * ';
     if($_SESSION['rol']=='DOCENTE'){
        //se saca la sede para saber la rectoría
         $sede=$auth->getSedeDocente($_SESSION['identificacion']);
         //var_dump($sede);exit();
         include('../../eleccionesBackEnd/consume/getRectoria.php');
         include('../params/params.php');
        
         $sedes= getRectoria($sede['nombreSede'],$host);
         //var_dump($sedes);exit();
        
        foreach ($sedes as $value) {
          $cadena=$cadena.$value->UNHOSED_DES_SEDE.' * ';
        }
     }
     else{
       $sedes = $auth->getSedeEstudiante($_SESSION['identificacion']);
       foreach ($sedes as $value) {
         $pieces = explode('-',$value);
         $cadena= $cadena.$pieces[0].' * ';
       }
   
     }
         
    $_SESSION['rectoria']=$cadena; 



     header("Location: dashboardUser.php");
  }
  else{
    echo $info['mensaje']; 
  }
  
 

}
?>   

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Votaciones Uniminuto</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
</head>
<body>
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <br/>
                            <br/>
                             <?php include('../include/logoVote.php') ?>
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                               

                               <div class="card-body" id="estProf">
                                <form id="loginForm2" name="loginForm2" method="POST">
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputEmailAddress">Email</label>
                                        <input class="form-control py-4"  id="email" name="email" type="email"  placeholder="Digite Correo" />
                                    </div>
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputPassword">Password</label>
                                        <input class="form-control py-4"  id="password" name="password" type="password" placeholder="Digite password" />
                                    </div>

                                    <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">

                                        <button type="submit" class="btn btn-warning" id="loginEstProf" name="loginEstProf">Iniciar sesión</button>
                                    </div>
                                </form>
                            </div>

                           

                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>


    <div id="layoutAuthentication_footer">
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
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>

<script type="text/javascript">
    $(document).ready(function()
    {
       

    });
</script>
</body>
</html>
