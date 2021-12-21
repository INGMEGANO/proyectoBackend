<?php
session_start();
include('../params/params.php');

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $host.'employees',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer '.$_SESSION['token']
  ),
));

$response = curl_exec($curl);
$data= json_decode($response, true);

curl_close($curl);
echo json_encode($data);

?>










