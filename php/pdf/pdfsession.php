<?php 
session_start();
$_SESSION['users'] = $_POST['users'];
$_SESSION['list'] = $_POST['list'];
$_SESSION['summary'] = $_POST['summary'];
$_SESSION['platforms'] = $_POST['platforms'];
$_SESSION['orderby'] = $_POST['orderby'];
?>