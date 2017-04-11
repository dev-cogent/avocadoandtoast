<?php 
session_start();
$html = $_SESSION['html'];
$name = $_SESSION['name'];
if($name == null){
    $name = "BRP";
}
$name = $name.".xls";
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$name");

echo $html;
 
 


?>