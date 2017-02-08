<?php
session_start();
include '../class/list.php';
$obj = new listOptions;
$listconn = $obj->listDB();
$conn = $obj->dbinfo();
$columnid = $_SESSION['column_id'];
$listid = $_POST['list'];
$influencerid = $_POST['influencerid'];
$stmt = $conn->prepare('SELECT `list_id` FROM `list_link` WHERE `column_id` = ? AND `list_id` = ?');
$stmt->bind_param('ss',$columnid,$listid);
$stmt->execute();
$stmt->bind_result($check);
$stmt->fetch();
if($check === NULL) return 0;
$delete = $obj->deleteFromList($influencerid,$listid,$listconn);
var_dump($delete);








