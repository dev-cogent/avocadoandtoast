<?php
session_start();
if(!class_exists(userOptions)){
    include $_SERVER['DOCUMENT_ROOT'].'/includes/class/useroptions.php';
    $useroptionsobj = new userOptions;
}
else{
    unset($useroptionsobj);
    $useroptionsobj = new userOptions;
}

//global variables 
$accesstoken = $_SESSION['access_token']; 
$mediaid = $_POST['mediaid'];


if($_POST['dataliked'] === "false"){
    $likephoto = $useroptionsobj->likePhoto($mediaid,$accesstoken);
    echo $likephoto;
}
if($_POST['dataliked'] === "true"){
    $unlikephoto = $useroptionsobj->unlikePhoto($mediaid,$accesstoken);
    echo $unlikephoto;

}
