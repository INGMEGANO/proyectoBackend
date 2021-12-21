<?php
session_start();
include('../params/params.php');

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $host.'associate',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'PUT',
  CURLOPT_POSTFIELDS => 'employee_id='.$_POST['employee_id'].'&manager_id='.$_POST['manager_id'],
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer '.$_SESSION['token'],
    'Content-Type: application/x-www-form-urlencoded'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
?>
