<?php
session_start();
include('../params/params.php');

$curl = curl_init();

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $host.'getEmployees/'.$_GET['id'],
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

curl_close($curl);
$array= json_decode($response, true);

echo(json_encode($array['data']));

?>












