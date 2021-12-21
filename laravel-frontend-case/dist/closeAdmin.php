<?php
session_start();
include('../params/params.php');


$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $host.'logout',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => array('token' => $_SESSION['token']),
));

$response = curl_exec($curl);

curl_close($curl);

if(isset($_SESSION['user_authorized'])){
  	session_destroy();
  	header("Location: index.php");
 }
?>