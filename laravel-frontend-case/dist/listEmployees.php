<?php
session_start();

include('../params/params.php');
if(!isset($_SESSION['user_authorized']) || $_SESSION['role']=='employee' ){
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
    <title>Dashboard Facultades</title>
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
        <a class="navbar-brand" href="dashboardFacultades.php">Votaciones Uniminuto</a>
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
        <input  type="hidden" name="logged_user_id" id="logged_user_id" value="<?php echo  $_SESSION['id'] ?>">
        <input  type="hidden" name="logged_user_rol" id="logged_user_rol" value="<?php echo  $_SESSION['role'] ?>">
        <ul class="navbar-nav d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                   &nbsp;&nbsp;&nbsp;Welcome <br/>&nbsp;&nbsp;&nbsp;<?php echo $_SESSION['first_name'].' '.$_SESSION['last_name'].', Role: '.$_SESSION['role'] ?>
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
                <?php echo $_SESSION['first_name'].' '.$_SESSION['last_name'].', Role: '.$_SESSION['role'] ?>
            </div>
        </nav>
    </div>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">List Employees</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">List Employees</li>
                </ol>

      
             <div class="card mb-4" id="firstGrid">
                <div class="card-header">
                    <i class="fas fa-book-reader"></i>
                   Employees Registered in the System
                </div>
                <div class="card-body">
                    <div class="table-responsive" id="datosPOS">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>E-mail</th>
                                    <th>Creation  Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>E-mail</th>
                                    <th>Creation  Date</th>
                                    <th>Actions</th>
                                </tr>
                            </tfoot>
                            <tbody id="contentTable">


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

             <div class="card mb-4" id="detailedInfo" style="display:none">
                <input  class="form-control py-4"type="hidden" name="switch" id="swtich">
                <input  class="form-control py-4"type="hidden" name="idUser" id="idUser">
                
                <div class="card-header">
                    <i class="fas fa-user-edit"></i>
                    Edit Info
                </div>
                <div class="card-body">
                    
                      <div class="row">
                        <div class="col-lg-6 col-xl-6 col-md-6">
                          <div class="form-group">
                                        <label class="small mb-1" for="first_name">*First Name</label>
                                        <input  class="form-control py-4"type="text" name="first_name" id="first_name">
                          </div>
                        </div>
                        <div class="col-lg-6 col-xl-6 col-md-6">
                              <div class="form-group">
                                        <label class="small mb-1" for="last_name">*Last Name</label>
                                        <input class="form-control py-4" type="text" name="last_name" id="last_name">

                              </div>
                        </div>
                   
                      </div>
                       <div class="row">
                        <div class="col-lg-6 col-xl-6 col-md-6">
                          <div class="form-group">
                                        <label class="small mb-1" for="email">*E-mail</label>
                                        <input  class="form-control py-4"type="text" name="email" id="email">
                          </div>
                        </div>
                        <div class="col-lg-6 col-xl-6 col-md-6">
                              <div class="form-group">
                                        <label class="small mb-1" for="emp_id">*Emp Id</label>
                                        <input class="form-control py-4" type="text" name="emp_id" id="emp_id">

                              </div>
                        </div>
                   
                      </div>
                       <div class="row">
                        <div class="col-lg-6 col-xl-6 col-md-6">
                          <div class="form-group">
                                        <label class="small mb-1" for="name_prefix">*Name Prefix</label>
                                        <input  class="form-control py-4"type="text" name="name_prefix" id="name_prefix">
                          </div>
                        </div>
                        <div class="col-lg-6 col-xl-6 col-md-6">
                              <div class="form-group">
                                        <label class="small mb-1" for="middle_initial">*Middle Initial</label>
                                        <input class="form-control py-4" type="text" name="middle_initial" id="middle_initial">

                              </div>
                        </div>
                   
                      </div>
                       <div class="row">
                        <div class="col-lg-6 col-xl-6 col-md-6">
                          <div class="form-group">
                                        <label class="small mb-1" for="gender">*Gender</label>
                                        <select class="form-control py-4" id="gender" name="gender" style="height: 12%;padding: 13px 5px 13px 8px !important;">
                                          <option value="0" selected="selected">Choose Option</option>
                                          <option value="M" >Male</option>
                                          <option value="F" >Female</option>
                                         
                                        </select>
                          </div>
                        </div>
                        <div class="col-lg-6 col-xl-6 col-md-6">
                              <div class="form-group">
                                        <label class="small mb-1" for="father_name">*Father Name</label>
                                        <input class="form-control py-4" type="text" name="father_name" id="father_name">

                              </div>
                        </div>
                   
                      </div>
                       <div class="row">
                        <div class="col-lg-6 col-xl-6 col-md-6">
                          <div class="form-group">
                                        <label class="small mb-1" for="mother_name">*Mother Name</label>
                                        <input  class="form-control py-4"type="text" name="mother_name" id="mother_name">
                          </div>
                        </div>
                        <div class="col-lg-6 col-xl-6 col-md-6">
                              <div class="form-group">
                                        
                                     <label class="small mb-1" for="mother_maiden_name">*Mother Maiden Name</label>
                                        <input  class="form-control py-4"type="text" name="mother_maiden_name" id="mother_maiden_name">
                              </div>
                        </div>
                   
                      </div>
                       <div class="row">
                        <div class="col-lg-6 col-xl-6 col-md-6">
                          <div class="form-group">
                                  
                                          <label class="small mb-1" for="date_of_birth">*Date of Birth</label>
                                <input class="form-control py-4" type="text" name="date_of_birth" id="date_of_birth">     
                          </div>
                        </div>
                        <div class="col-lg-6 col-xl-6 col-md-6">
                              <div class="form-group">
                              
                                   
                                              <label class="small mb-1" for="date_of_joining">*Date of Joining</label>
                                        <input  class="form-control py-4"type="text" name="date_of_joining" id="date_of_joining">

                              </div>
                        </div>
                   
                      </div>
                       <div class="row">
                        <div class="col-lg-6 col-xl-6 col-md-6">
                          <div class="form-group">
                            

                                        <label class="small mb-1" for="salary">*Salary</label>
                                        <input class="form-control py-4" type="number" name="salary" id="salary">
                          </div>
                        </div>
                        <div class="col-lg-6 col-xl-6 col-md-6">
                              <div class="form-group">
                                          
                                        <label class="small mb-1" for="ssn">*SSN</label>
                                        <input  class="form-control py-4"type="text" name="ssn" id="ssn">
                              </div>
                        </div>
                   
                      </div>
                       <div class="row">
                        <div class="col-lg-6 col-xl-6 col-md-6">
                          <div class="form-group">
              


                                        <label class="small mb-1" for="phone">*Phone</label>
                                        <input class="form-control py-4" type="text" name="phone" id="phone">   
                          </div>
                        </div>
                        <div class="col-lg-6 col-xl-6 col-md-6">
                              <div class="form-group">
                                                 
                                   <label class="small mb-1" for="city">*City</label>
                                        <input  class="form-control py-4"type="text" name="city" id="city">
                              </div>
                        </div>
                   
                      </div>
                       <div class="row">
                        <div class="col-lg-6 col-xl-6 col-md-6">
                          <div class="form-group">
                                         <label class="small mb-1" for="state">*State</label>
                                        <input class="form-control py-4" type="text" name="state" id="state">       
                          </div>
                        </div>
                        <div class="col-lg-6 col-xl-6 col-md-6">
                              <div class="form-group">
                                        <label class="small mb-1" for="zip">*Zip</label>
                                        <input class="form-control py-4" type="text" name="zip" id="zip">

                              </div>
                        </div>
                   
                      </div>
                      <button type="button" class="btn btn-success" id="update" name="update">Update</button>
                      <button type="button" class="btn btn-warning" id="cancel" name="cancel">Close</button>
                                 
                </div>
            </div>

            <!-- Associate To a Manager !-->
              <div class="card mb-4" id="associate" style="display: none">
                <input  class="form-control py-4"type="hidden" name="employee" id="employee">
               
                
                <div class="card-header">
                    <i class="fas fa-user-edit"></i>
                    Associate Employee to a Manager
                </div>
                <div class="card-body">
                    
                      <div class="row">
                         <div class="col-lg-6 col-xl-6 col-md-6">
                          <div class="form-group">
                              <label class="small mb-1" for="gender">*Select Manager</label>
                              <select class="form-control py-4" id="chmanager" name="chmanager" style="height: 12%;padding: 13px 5px 13px 8px !important;">
                                <option value="0" selected="selected">Choose Option</option>
                               
                              </select>
                          </div>
                        </div>
                   
                      </div>
                      <button type="button" class="btn btn-success" id="associateI" name="associateI">Associate</button>
                      <button type="button" class="btn btn-warning" id="cancel2" name="cancel2">Close</button>
                                 
                </div>
            </div>
             
            <!-- End To associate !-->
            


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
    function edit(id){
      $("#firstGrid").fadeOut('medium');
      $("#detailedInfo").fadeIn("medium");
      $("#idUser").val(id);
           $.ajax({
                    type: "get",
                    url: '../functions/fGetDetailedEmployeeInfo.php?id='+id,

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
                           $("#first_name").val(r[item].first_name);$("#last_name").val(r[item].last_name);$("#email").val(r[item].email);
                           $("#emp_id").val(r[item].emp_id);$("#name_prefix").val(r[item].name_prefix);$("#middle_initial").val(r[item].middle_initial);
                           $("#gender").val(r[item].gender);$("#father_name").val(r[item].father_name);$("#mother_name").val(r[item].mother_name);
                           $("#mother_maiden_name").val(r[item].mother_maiden_name);$("#date_of_birth").val(r[item].date_of_birth);$("#date_of_joining").val(r[item].date_of_joining);
                           $("#salary").val(r[item].salary);$("#ssn").val(r[item].ssn);$("#phone").val(r[item].phone);
                           $("#city").val(r[item].city);$("#state").val(r[item].state);$("#zip").val(r[item].zip);
                        });
                    }
             });

    }

    function associate(id){
        $("#firstGrid").fadeOut("medium");
        $("#associate").fadeIn("medium");

       $("#employee").val(id);

    }

     function delUser(id){
      
      if(confirm('Do you want to delete that user?')){
           var idUser=id;
           $.ajax({
                    url: '../functions/fDeleteEmployee.php',
                    type: 'post',
                    data: {idUser:idUser
                    },
                    dataType:'json',
                    beforeSend: function()
                    {
                        // setting a timeout
                       
                    },
                    success: function(response) {
                        alert(response.message);
                        location.reload();

                        
                    }
                });
      }

    }

    function getInfoFacultad(){
      var id= $("#logged_user_id").val();
      var associate='';
      var url='';
      if($("#logged_user_rol").val()=='admin'){
      
       url='../functions/fListEmployees.php';
      }
      else{
        url='../functions/fGetOwnEmployees.php?id='+id;
      }
      $.ajax({
        type: "get",
        url: url,

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
            var id= "'"+r[item].id+"'";
            if($("#logged_user_rol").val()=='admin'){
               associate = '|| <a style="color:blue;cursor:pointer" onclick="associate('+id+')">Asscociate to Manager</a>' ;
            }


          $("#contentTable").append('<tr><td>'+r[item].first_name+'</td><td>'+r[item].last_name+'</td><td>'+r[item].email+'</td><td>'+r[item].created_at+'</td><td><a style="color:blue;cursor:pointer" onclick="edit('+id+')">Edit</a> || <a style="color:blue;cursor:pointer" onclick="delUser('+id+')">Delete</a>'+associate+' </td></tr>');
           });
           jQuery('#dataTable').DataTable({

            rowReorder: {
                selector: 'td:nth-child(2)'
            },
           responsive: true,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/English.json"
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
            "aaSorting":[[1,"asc"]]
            });
        }
    });
  }

      function getManagers(){
      
      $.ajax({
        type: "get",
        url: '../functions/fgetManagers.php',

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
              $("#chmanager").append('<option value="'+r[item].id+'">'+r[item].first_name+' '+r[item].last_name+'</option>');
               
               
           });
          
        }
    });
  }

$(document).ready(function()
{
     getInfoFacultad();
     getManagers();

     $("#cancel").click(function(){
        $("#detailedInfo").fadeOut("medium");
        $("#firstGrid").fadeIn("medium");

     });

     $("#cancel2").click(function(){
        $("#associate").fadeOut("medium");
        $("#firstGrid").fadeIn("medium");

     });

     $("#update").click(function(){
          if(confirm('Are you sure you want to update this user?')){
             var idUser = $("#idUser").val();var first_name = $("#first_name").val();var last_name = $("#last_name").val();
              var email = $("#email").val();var emp_id = $("#emp_id").val();var name_prefix = $("#name_prefix").val();
              var middle_initial = $("#middle_initial").val();var gender = $("#gender").val();var father_name = $("#father_name").val();
              var mother_name = $("#mother_name").val();var mother_maiden_name = $("#mother_maiden_name").val();var date_of_birth = $("#date_of_birth").val();
              var date_of_joining = $("#date_of_joining").val();var salary = $("#salary").val();var ssn = $("#ssn").val();
              var phone = $("#phone").val();var city = $("#city").val();var state = $("#state").val();
              var zip = $("#zip").val();


                   $.ajax({
                    url: '../functions/fupdateEmployee.php',
                    type: 'post',
                    data: {idUser:idUser,first_name:first_name,first_name:first_name,last_name:last_name,email:email,emp_id:emp_id,name_prefix:name_prefix,middle_initial:middle_initial,gender:gender,father_name:father_name,mother_name:mother_name,mother_maiden_name:mother_maiden_name,date_of_birth:date_of_birth,date_of_joining:date_of_joining,
                        salary:salary,ssn:ssn,phone:phone,city:city,state:state,zip:zip
                    },
                    dataType:'json',
                    beforeSend: function()
                    {
                        // setting a timeout
                        $("#update").prop('disabled', true);
                        $("#update").text('Sending Data...');
                    },
                    success: function(response) {
                        alert(response.message);
                        $("#update").prop('disabled', false);
                        $("#update").text('Update');
                        $("#detailedInfo").fadeOut("medium");
                        $("#firstGrid").fadeIn("medium");
                        location.reload();
                    }
                });
          }
     });

     

     $("#associateI").click(function(){
          if($("#chmanager").val()=='0'){
                   alert('Check that you have selected a manager.');

          }
          else{
                   var manager_id = $("#chmanager").val();
                   var employee_id = $("#employee").val();
                   $.ajax({
                    url: '../functions/fAssociateEmployees.php',
                    type: 'post',
                    data: {employee_id:employee_id,manager_id:manager_id},
                    dataType:'json',
                    beforeSend: function()
                    {
                        // setting a timeout
                        $("#associateI").prop('disabled', true);
                        $("#associateI").text('Sending Data...');
                    },
                    success: function(response) {
                        alert(response.message);
                        $("#associateI").prop('disabled', false);
                        $("#associateI").text('Update');
                        $("#detailedInfo").fadeOut("medium");
                        $("#firstGrid").fadeIn("medium");
                        location.reload();
                    }
                });
          }
     });



});
</script>
</body>
</html>
