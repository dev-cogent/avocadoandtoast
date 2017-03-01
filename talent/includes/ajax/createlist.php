<?php
session_start();
if(!isset($_SESSION['userid'])){
    echo 2; 
}
include '../class/list.php';
$obj = new listoptions;
$create = $obj->createList($_POST['users'],$_POST['listname'],$_POST['description'],$_SESSION['userid'],$_SESSION['column_id']);
echo $create;