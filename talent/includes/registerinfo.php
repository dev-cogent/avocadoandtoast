<?php 
include 'class/signuptalent.php';
$signup = new signUpTalent;
$reg = $signup->register($_POST);
if($reg === true){
   echo 'SIGNED UP ;';

}
?> 