<?php
session_start();
include('../params/params.php');
if(!isset($_SESSION['user_authorized']) || $_SESSION['role']=='admin' || $_SESSION['role']=='manager' ){
  header("Location: index.php");
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
    <title>Dashboard Admin</title>
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
        <a class="navbar-brand" href="dashboardAdmin.php">Votaciones Uniminuto</a>
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
                 &nbsp;&nbsp;&nbsp;Welcome <br/>&nbsp;&nbsp;&nbsp;<?php echo $_SESSION['first_name'].' '.$_SESSION['last_name'].', Role: '.$_SESSION['role']  ?>
                 <div class="dropdown-divider"></div>
                 <a class="dropdown-item" href="closeAdmin.php">Logout</a>
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
                <div class="small">Logged User:</div>
                <?php  echo $_SESSION['first_name'].' '.$_SESSION['last_name'].', Role: '.$_SESSION['role'] ?>
            </div>
        </nav>
    </div>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Submit Hours</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Submit Hours</li>
                </ol>

            <div class="card mb-4">
                <input  class="form-control py-4"type="hidden" name="switch" id="swtich">
                <input  class="form-control py-4"type="hidden" name="idUser" id="idUser">
                
                <div class="card-header">
                    <i class="fas fa-user-edit"></i>
                    Submit Hours
                </div>
                <div class="card-body">
                    
                      <div class="row">
                        <div class="col-lg-6 col-xl-6 col-md-6">
                          <div class="form-group">
                                        <label class="small mb-1" for="workedHours">*Wroked Hours</label>
                                        <input  class="form-control py-4"type="number" name="workedHours" id="workedHours">
                          </div>
                        </div>
                        <div class="col-lg-6 col-xl-6 col-md-6">
                              <div class="form-group">
                                        <label class="small mb-1" for="detail">*Details</label>
                                        <input class="form-control py-4" type="text" name="detail" id="detail">

                              </div>
                        </div>
                   
                      </div>
                      <button type="button" class="btn btn-success" id="submit" name="submit">Submit Hours</button>
                                 
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
$(document).ready(function()
{
     $("#submit").click(function(){
        if($("#workedHours").val()==''||$("#detail").val()==''){
          alert('Fields Marked with * are mandatory');
        }
        else{
          if(confirm('Are you sure you want to submit the hours.')){
                      var workedHours = $("#workedHours").val();
                      var detail = $("#detail").val();
                   $.ajax({
                    url: '../functions/fSubmitHours.php',
                    type: 'post',
                    data: {worked_hours:workedHours,detail:detail},
                    dataType:'json',
                    beforeSend: function()
                    {
                        // setting a timeout
                        $("#submit").prop('disabled', true);
                       $("#submit").text('Sending Data...');
                    },
                    success: function(response) {
                        alert(response.message);
                        $("#submit").prop('disabled', false);
                        $("#submit").text('Submit Hours');
                        location.reload();
                    }
                });
          }
        }
            
     });
});
</script>
</body>
</html>
