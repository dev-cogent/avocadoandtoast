<?php 
include 'class/signup.php';
$signup = new signUp;
$reg = $signup->register($_POST);
var_dump($_POST);
var_dump($reg);
if($reg === true){
    header('location:/emailconfirmation.php');

}
?>