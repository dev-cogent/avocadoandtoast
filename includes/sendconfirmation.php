<?php 
include 'class/signup.php';
$obj = new signUp;
error_reporting(-1);
$conn = $obj->dbinfo();
$email = $_POST['email'];
$stmt = $conn->prepare('SELECT `confirmed`, `userid` FROM `login_information` WHERE `email` = ?');
$stmt->bind_param('s',$email);
$stmt->execute();
$stmt->bind_result($confirmed,$id);
$stmt->fetch();
unset($stmt);
if($id == NULL) $message = '<p class="error">No account has been found with that email. <a style="color:#c61000;text-decoration:underline;" href="/register.php">Click here to Register</a></p>';
if(!isset($message)){
    if($confirmed == 'true') $message = '<p class="error">Account has already been confirmed. <a style="color:#c61000;text-decoration:underline;" href="/login.php">Click here to Login</a></p>';
}
if(!isset($message)){
    $confirmationkey = $obj->createConfirmationKey();
    $stmt = $conn->prepare('UPDATE `login_information` SET `confirmation_key` = ? WHERE `userid` = ?');
    $stmt->bind_param('ss',$confirmationkey,$id);
    if($stmt->execute()){
        $sendemail = $obj->sendConfirmationEmail($email,$confirmationkey);
        $message = '<p class="success">A new email has been sent to you! If you still have no recieved an email, contact support@project.social</a>';
    }
}


