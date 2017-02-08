<?php 
session_start();
if(!isset($_SESSION['userid'])){
    echo 2; 
    return 0;
}
include '../class/list.php';
$obj = new listOptions;
$add = $obj->addToList($_POST['users'],$_SESSION['column_id'],$_POST['list']);
if(strpos($add,'Duplicate') !== FALSE ){
  echo 'Duplicate';
}
else
    echo $add;

