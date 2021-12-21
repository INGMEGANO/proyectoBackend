<?php
session_start();
if(isset($_SESSION['user_authorized'])) {session_destroy();}
?>
<?php 
if(isset($_POST['login']) )
{ 
    include('../params/params.php');
    $curl = curl_init();
    curl_setopt_array($curl, array(
    CURLOPT_URL => $host.'login',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => array('email' => $_POST['email'],'password' => $_POST['password']),
  ));
  $response = curl_exec($curl);
  curl_close($curl);


  $data= json_decode($response, true);
  //print_r($data['user'][0]['roles'][0]['name']);exit();

      if (is_array($data) && array_key_exists('token', $data)){
        $_SESSION['user_authorized']=true;
        $_SESSION['token']=$data['token'];
        $_SESSION['first_name']=$data['user'][0]['first_name'];
        $_SESSION['last_name']=$data['user'][0]['last_name'];
        $_SESSION['id']=$data['user'][0]['id'];

        $_SESSION['role']=$data['user'][0]['roles'][0]['name'];

          switch ($_SESSION['role']) {
              case 'employee':
                  header("Location: submitHours.php");
              break;
              case 'admin':
                  header("Location: listEmployees.php");
              break;
              case 'manager':
                 header("Location: listEmployees.php");
              break;
          }

    

  }
  else{
    echo 'Incorrect credentials.';
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
                                        <input class="form-control py-4"  id="email" name="email" type="email"  placeholder="Type E-mail" />
                                    </div>
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputPassword">Password</label>
                                        <input class="form-control py-4"  id="password" name="password" type="password" placeholder="Type Password" />
                                    </div>

                                    <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">

                                        <button type="submit" class="btn btn-warning" id="login" name="login">Login</button>
                                        <a href="register.php">Register</a>
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
