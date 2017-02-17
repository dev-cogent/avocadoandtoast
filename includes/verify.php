<?php
//We will start by checking if the request is ajax or not. If it's not an ajax request, then we will return to the login page. 
if(isset($_SESSION)){
session_destroy();
unset($_SESSION);
}
session_start();

include 'class/useroptions.php';
include 'class/favorite.php';
$favoriteobj = new favorite; 
$useroptionsobj = new userOptions;

$conn = $useroptionsobj->dbinfo();
$inputemail = $_POST['email'];
$inputpassword = $_POST['password'];
//Preparing sql statement 
$stmt = $conn->prepare("SELECT `userid`,`email`,`firstname`,`lastname`,`salt`,`password`,`column_id`,`pdf_logo`,`login_attempts`,`temporary_lockout`,`lockout`,`confirmed` FROM `login_information` WHERE `email` = ?");
$stmt->bind_param('s',$inputemail);
$stmt->execute();
$stmt->bind_result($userid,$email,$firstname,$lastname,$salt,$realpassword,$columnid,$pdf_logo,$login_attempts,$temporary_lockout,$lockout,$confirmed);
$stmt->fetch();
//We will now check if there is anything wrong with the user user i.e lockedout temporary locked out. 
$password = hash_pbkdf2("sha256", $inputpassword, $salt, 1000, 20);

if($confirmed === 'false'){
    $error = 'Please Confirm your email address to continue.';
    $login = false;
}

if($email === NULL ||  $password !== $realpassword){
    $error = 'Email address or password is incorrect<br/>';
    $login = false;
}
if($lockout === "true"){
    $error = 'Your account has been lockedout. Please contact support for further assistance</br>';
    $login = false;
}
if($temporary_lockout != NULL){
    $lockouttime = floor(($temporary_lockout - time())/60);
    $error = 'Your account has been temporary locked out for '.$lockouttime. ' minutes';
    $login = false;
}
if($login !== false){
    $_SESSION['project_id'] = md5(session_id());
    $_SESSION['column_id'] = $columnid;
    $_SESSION['firstname'] = $firstname;
    $_SESSION['lastname'] = $lastname;
    $_SESSION['email'] = $email;
    $_SESSION['pdf_logo'] = $pdf_logo;
    $_SESSION['userid'] = $userid;
    $_SESSION['campaigns'] = $useroptionsobj->getCampaigns($userid,$columnid);
    $_SESSION['campaignids'] = $useroptionsobj->getCampaignsWithID($userid,$columnid);
    $_SESSION['favoriteinfluencers'] = $favoriteobj->getFavorites($userid);
    $login_attempts = 0;
    $stmt->prepare('UPDATE `login_information` SET `login_attempts` = ? WHERE `email` = ?');
    $stmt->bind_param('is',$login_attempts,$email);
    $stmt->execute();
    header('Location:/dashboard.php');
}
else{
    //If the email is right but
    $login_attempts += 1 ;
    if($login_attempts >= 4){
        $temporary_lockout = date(strtotime("+15 minutes", strtotime(date('H:i:s'))));
        $stmt->prepare("UPDATE `login_information` SET `login_attempts` = ?, `temporary_lockout` = ? WHERE `email` = ?");
        $stmt->bind_param('iss',$login_attempts,$temporary_lockout,$email);
        $stmt->execute();
        $error = "Your account has been locked out for 15 minutes";
        $login = false;
    }
    if($login_attempts >=6){
        $lockout = "true";
        $stmt->prepare("UPDATE `login_information` SET `lockout` = ? WHERE `email` = ?");
        $stmt->bind_param('ss',$lockout,$email);
        $stmt->execute();
        $login = false;
    }
    $stmt->prepare("UPDATE `login_information` SET `login_attempts` = ? WHERE `email` = ? ");
    $stmt->bind_param('is',$login_attempts,$email);
    $stmt->execute();
    $login = false;
}


?>
