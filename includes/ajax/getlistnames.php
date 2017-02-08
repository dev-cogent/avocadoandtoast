<?php 
session_start();
if(!isset($_SESSION['userid'])){
    echo 2; 
}
include '../class/list.php';
$obj = new listOptions;
$listnames = $obj->getListNames($_SESSION['column_id']);
foreach ($listnames as $listid => $list){
  echo '<option class="selectlist" value="'.$listid.'">'.$list.'</option>';
}