<?php
session_start();
include('../params/params.php');

$curl = curl_init();



curl_setopt_array($curl, array(
  CURLOPT_URL => $host.'employeesUpdate/'.$_POST['idUser'],
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'PUT',
  CURLOPT_POSTFIELDS => 'first_name='.$_POST['first_name'].'&last_name='.$_POST['last_name'].'&email='.$_POST['email'].'&emp_id='.$_POST['emp_id'].'&name_prefix='.$_POST['name_prefix'].'&middle_initial='.$_POST['middle_initial'].'&gender='.$_POST['gender'].'&father_name='.$_POST['father_name'].'&mother_name='.$_POST['mother_name'].'&date_of_birth='.$_POST['date_of_birth'].'&date_of_joining='.$_POST['date_of_joining'].'&mother_maiden_name='.$_POST['mother_maiden_name'].'&salary='.$_POST['salary'].'&ssn='.$_POST['ssn'].'&phone='.$_POST['phone'].'&city='.$_POST['city'].'&state='.$_POST['state'].'&zip='.$_POST['zip'],
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer '.$_SESSION['token'],
    'Content-Type: application/x-www-form-urlencoded'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;