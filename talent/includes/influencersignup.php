<?php 
include 'dbinfo.php';
$email = $_POST['influenceremail'];
$name = $_POST['influencername'];
if($email == '' || $name == ''){
    $message = ' <br/><div style="text-align:center; display:inline; word-spacing:3px; font-size:15px; color:red">It looks like an error has occured, please make sure you filled out all the information</div>';
}
else{
    $stmt = $conn->prepare('INSERT INTO `influencer_signup` (`influencer_email`,`influencer_name`) VALUES (?,?)');
    $stmt->bind_param('ss',$email,$name);
    if($stmt->execute()){
    $message = ' <br/><div style="text-align:center; display:inline; word-spacing:3px; font-size:15px; color:green">Congragulations, You will be notified when our Influencer program is setup!</div>';
    }
    else{
        $message = ' <br/><div style="text-align:center; display:inline; word-spacing:3px; font-size:15px; color:red">It looks like an error has occured, please make sure you filled out all the information</div>';
    }
}
