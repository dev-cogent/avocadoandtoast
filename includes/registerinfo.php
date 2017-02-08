<?php 
include 'class/signup.php';
$signup = new signUp;
$reg = $signup->register($_POST);
if($reg === true){
    header('location:/emailconfirmation.php');

}
?>