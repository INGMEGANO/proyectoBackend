<?php
session_start();
include('../params/params.php');

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $host.'employees/'.$_GET['id'],
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

$array = array();
$emoployee=array();
$employee['id']=$data['id'];
$employee['first_name']=$data['first_name'];
$employee['last_name']=$data['last_name'];
$employee['email']=$data['email'];
$employee['emp_id']=$data['employee']['emp_id'];
$employee['name_prefix']=$data['employee']['name_prefix'];
$employee['middle_initial']=$data['employee']['middle_initial'];
$employee['gender']=$data['employee']['gender'];
$employee['father_name']=$data['employee']['father_name'];
$employee['mother_name']=$data['employee']['mother_name'];
$employee['mother_maiden_name']=$data['employee']['mother_maiden_name'];
$employee['date_of_birth']=$data['employee']['date_of_birth'];
$employee['date_of_joining']=$data['employee']['date_of_joining'];
$employee['salary']=$data['employee']['salary'];
$employee['ssn']=$data['employee']['ssn'];
$employee['phone']=$data['employee']['phone'];
$employee['city']=$data['employee']['city'];
$employee['state']=$data['employee']['state'];
$employee['zip']=$data['employee']['zip'];
$array[]=$employee;
print_r(json_encode($array));

?>










