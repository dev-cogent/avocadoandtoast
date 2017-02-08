<?php 
include 'includes/dbinfo.php';
$code = $_GET['q'];
$stmt = $conn->prepare('SELECT `userid` FROM `login_information` WHERE `confirmation_key` = ?');
$stmt->bind_param('s',$code);
$stmt->execute();
$stmt->bind_result($userid);
$stmt->fetch();
if($userid !== NULL){
$confirmed = 'true';
$stmt->prepare("UPDATE `login_information` SET `confirmed` = ? WHERE `userid` = ?");
$stmt->bind_param('ss',$confirmed,$userid);
if($stmt->execute()){
header('Location: https://project.social/login');
}
else{
echo 'no';
}

}





?>