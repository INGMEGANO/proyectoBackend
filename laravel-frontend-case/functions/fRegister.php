<?php
session_start();
include('../params/params.php');

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $host.'register',
    CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => array('email' => $_POST['email'],'password' => $_POST['password'],'first_name' => $_POST['first_name'],'last_name'=>$_POST['last_name'],'rol' => $_POST['rol']),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
?>