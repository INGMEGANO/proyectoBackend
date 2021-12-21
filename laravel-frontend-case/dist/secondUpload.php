<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Subir documentos en segunda instancia</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="crossorigin="anonymous"></script>
</head>
<body style="background-color: #e0e0e0;">
  <div class="container">

    <div class="mt-5 row justify-content-center">

      <div class="col-6 shadow p-0 mb-0 bg-body rounded animate__animated animate__backInDown">
        <div class="card">
          <!--<div class="card-header">Panel Heading</div>-->
          <img src="../images/logoVotacion.png" class="card-img-top" alt="..." style="width: 18rem; margin: auto;">
    
          <div class="card-body">
            <form method="POST" name="uploadFile" id="uploadFile" enctype="multipart/form-data">
              <input type="hidden" id="reqId" name="reqId" value="<?php echo $_GET['idReq'] ?>">
              <input type="hidden" id="userId" name="userId" value="<?php echo $_GET['idUser'] ?>">
              <br><br>
                <div class="mb-3">
                  <label for="req<?php echo $_GET['idReq'] ?>" class="form-label">Subir <?php echo $_GET['nomReq'] ?></label>
                  <input class="form-control" type="file" id="req<?php echo $_GET['idReq'] ?>" name="req<?php echo $_GET['idReq'] ?>" accept="application/pdf">
                </div>
              <button type="button" style="background-color: #8e24aa;" class="btn btn-primary mb-3" id="upload" name="upload">Subir Documento</button>
            </form>
          </div>
          
        </div>
      </div>

    </div>

  </div>

  <script type="text/javascript">

   function uploadFile(){
     
      var idReq = $("#reqId").val();
      var userId = $("#userId").val();
      if( document.getElementById("req"+idReq).files.length == 0 )
      {
       alert("Verifique que haya seleccionado el documento a anexar.");
      }
      else{
        var inputFileImage = document.getElementById("req"+idReq);
        var file = inputFileImage.files[0]; 
          if(inputFileImage.files[0].type == "application/pdf"){
           //
              var data = new FormData();
              data.append("req"+idReq,file); 
              $.ajax({
                  url: '../include/upload.php?idReq='+idReq+'&postulante='+userId+'&instancia=2',
                  type: 'post',
                  data: data,
                  contentType: false,
                  processData: false,
                  success: function(response) {
                      if (response != 0) {
                          alert(response);
                          
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
      $("#upload").click(function() {
        uploadFile();
      });

  });
  </script>
</body>
</html>