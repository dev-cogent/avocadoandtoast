<?php 
session_start();
include '../class/favorite.php';
$fav = new favorite;
$influencerid = $_POST['id'];
$unfavorite = $fav->unFavorite($influencerid,$_SESSION['userid']);
var_dump($unfavorite);
