<?php 
include '../class/campaign.php';
include '../numberAbbreviation.php';
$calculate = new campaignCalculator;
$users = $_POST['selected'];
$type = $_POST['type'];
$posts = $_POST['posts'];

if($type == 'instagram'){
    $calculate = $calculate->instagramCalculate($users,$posts);
    echo number_format($calculate);
}

if($type == 'twitter'){
    $calculate = $calculate->twitterCalculate($users,$posts);
    echo number_format($calculate);
}

if($type == 'facebook'){
    $calculate = $calculate->facebookCalculate($users,$posts);
    echo number_format($calculate);
}