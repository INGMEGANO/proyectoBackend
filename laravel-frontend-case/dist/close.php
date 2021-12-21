<?php
session_start();
//if(isset($_SESSION['user_active'])) session_destroy();
//header("Location: loginEsDoc.php");
if(isset($_SESSION['user_active'])){

  if($_SESSION['userType']==1){
  	session_destroy();
  	header("Location: loginEsDoc.php");
  }
  else{
  	session_destroy();
  	header("Location: loginGrad.php");
  }
}
?>