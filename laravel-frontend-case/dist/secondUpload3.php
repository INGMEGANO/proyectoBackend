<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Subir documentos en segunda instancia</title>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="crossorigin="anonymous"></script>
</head>
<body>
<form method="POST" name="uploadFile" id="uploadFile" enctype="multipart/form-data">
  <input type="hidden" id="reqId" name="reqId" value="<?php echo $_GET['idReq'] ?>">
  <input type="hidden" id="userId" name="userId" value="<?php echo $_GET['idUser'] ?>">
   <label for="inputFile">Subir <?php echo $_GET['nomReq'] ?></label>
   <p>
     
     <input type="file" id="req<?php echo $_GET['idReq'] ?>" name="req<?php echo $_GET['idReq'] ?>" accept="application/pdf">
     
   </p>
   <button type="button" id="upload" name="upload">Subir Documento</button>
</form>

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