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
                                        <label class="small mb-1" for="inputEmailAddress">*Email</label>
                                        <input class="form-control py-4"  id="email" name="email" type="email"  placeholder="Input E-mail" />
                                    </div>
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputPassword">*Password</label>
                                        <input class="form-control py-4"  id="password" name="password" type="password" placeholder="Input Password" />
                                    </div>
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputPassword">*First Name</label>
                                        <input class="form-control py-4"  id="first_name" name="first_name" type="text" placeholder="Input First Name" />
                                    </div>
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputPassword">*Last Name</label>
                                        <input class="form-control py-4"  id="last_name" name="last_name" type="text" placeholder="Input Last Name" />
                                    </div>
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputPassword">*Rol</label>
                                        <select class="form-control py-4" id="rol" name="rol" style="height: 12%;padding: 13px 5px 13px 8px !important;">
                                          <option value="0" selected="selected">Choose Option</option>
                                          <option value="admin" >Admin</option>
                                          <option value="manager" >Manager</option>
                                         
                                        </select>
                                    </div>

                                    <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">

                                        <button type="button" class="btn btn-warning" id="register" name="register">Register</button>
                                       
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
       $("#register").click(function(){
        if($("#email").val()==''||$("#password").val()=='' || $("#first_name").val()==''|| $("#last_name").val()==''|| $("#rol").val()=='0' ){
          alert('Fields Marked with * are mandatory');
        }
        else{
               if(confirm('Are you sure you want to register in the platfomr?')){
                       var email = $("#email").val();
                      var password = $("#password").val();
                      var first_name = $("#first_name").val();
                      var last_name = $("#last_name").val();
                      var rol = $("#rol").val();
                   $.ajax({
                    url: '../functions/fRegister.php',
                    type: 'post',
                    data: {email:email,password:password,first_name:first_name,last_name:last_name,rol:rol},
                    dataType:'json',
                    beforeSend: function()
                    {
                        // setting a timeout
                        $("#register").prop('disabled', true);
                       $("#register").text('Sending Data...');
                    },
                    success: function(response) {
                        alert(response.message);
                        $("#register").prop('disabled', false);
                        $("#register").text('Register');
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
