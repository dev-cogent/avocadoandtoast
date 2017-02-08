<?php 
session_start();
if(!isset($_SESSION['userid'])){
    echo 2; 
    return 0;
}
include '../class/favorite.php';
$fav = new favorite;
$influencerid = $_POST['id'];
$check = $_POST['check'];
if($check == 'false'){
$favorite = $fav->addToFavorite($influencerid,$_SESSION['userid']);
    if($favorite){
        echo 'true';
        array_push($_SESSION['favoriteinfluencers'],$influencerid);
    }
    else echo 0;
}
else{
$favorite = $fav->unFavorite($influencerid,$_SESSION['userid']);
    if($favorite){
        echo 'false';
        $_SESSION['favoriteinfluencers'] = array_diff($_SESSION['favoriteinfluencers'], array($influencerid));
    } 
    else echo 0;
}