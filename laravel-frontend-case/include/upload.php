<?php
   
   include('../params/params.php');
       $id='req'.$_GET['idReq'];
       
       $curl = curl_init();
          curl_setopt_array($curl, array(
		  CURLOPT_URL => $host.'eleccionesBackEnd/API/addEvidenciaPostulante.php',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS => array('requisito' => $_GET['idReq'],'imagen' => $_FILES[$id]['name'],'postulante' => $_GET['postulante'],'instancia'=>$_GET['instancia']),
		));

		$response = curl_exec($curl);

		curl_close($curl);
		
       $info= (array) json_decode(stripslashes($response));
        if($info['response_code']=='200'){
           if (move_uploaded_file($_FILES[$id]["tmp_name"], "../evidencias/".$_FILES[$id]['name'])) {
        //more code here...
               echo 'Documento subido con éxito';

		    } else {
		        echo 0;
		    }    	
        }
        else{
        	echo $info['message'];
        }
        


    
?>    
