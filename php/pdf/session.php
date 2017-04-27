<?php 
session_start();
$users = $_POST['users'];
$list = $_POST['list'];
$summary = $_POST['summary'];
$users = str_replace('<td class="sorting_1"><input type="checkbox" class="testcheck" id="check"></td>','',$users);
$_SESSION['list'] = $list;
$_SESSION['users'] = $users;
$_SESSION['summary'] = $summary;
var_dump($users);

?>