<?php 
session_start();

if(!class_exists(userOptions)){
    include $_SERVER['DOCUMENT_ROOT'].'/includes/class/useroptions.php';
    $useroptionsobj = new userOptions;
}
else{
    unset($useroptionsobj);
    $useroptionsobj = new userOptions;
}

//these two variables will be needed regardeless so we definie them before we initalize the others.
$accesstoken = $_SESSION['access_token'];
$id = $_POST['mediaid'];


if(!isset($_POST['delete'])){
    $comment = $_POST['comment'];
    $addcomment = $useroptionsobj->addComment($id,$comment,$accesstoken);
    echo $addcomment;
}
if($_POST['delete'] == 'true'){
    $commentid = $_POST['commentid'];
    $deletecomment = $useroptionsobj->deleteComment($id,$commentid,$accesstoken);
    echo $deletecomment;

}


