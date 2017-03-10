<?php 
error_reporting(0);
class userSettings extends userOptions{

/**
*@param {int} $instagram_id - the instagram user id 
*@param {string} $userid - the users id 
*@return {bool}
*/
public function removeInstagram($instagram_id,$user_id,$conn = NULL){
if($conn === NULL)
$conn = $this->dbinfo();
$instagram_accounts = $this->getInstagramAccounts($user_id,$conn);
foreach($instagram_accounts as $key=>$account){
    if($account === $instagram_id){
        unset($instagram_accounts[$key]);
        $instagram_accounts = array_values($instagram_accounts);
        break;
    }
} 
$_SESSION['instagram_accounts'] = $instagram_accounts;
$instagram_accounts = serialize($instagram_accounts);
$stmt = $conn->prepare("UPDATE `login_information` SET `instagram_accounts` = ? WHERE `userid` = ?");
$stmt->bind_param("ss",$instagram_accounts,$user_id);
if($stmt->execute())
    return true;
else
    return false; 
}


/**
*@param {string} $userid - user id from login 
*@return {array} $arr - information about the user 
*/
public function getUserInformation($userid,$conn = NULL){
if($conn === NULL)
    $conn = $this->dbinfo();
    $arr = array();
    $stmt = $conn->prepare("SELECT `email`,`company`,`account_type`,`name` FROM `login_information` WHERE `userid` = ? ");
    $stmt->bind_param("s",$userid);
    $stmt->execute();
    $stmt->bind_result($arr['email'],$arr['company'],$arr['account_type'],$arr['name']);
    $stmt->fetch();
    return $arr;
} 


/**
*@param {array} $info - user information 
*@return {bool}
*/
public function updateGeneralInfo($info,$files,$userid){
$conn = $this->dbinfo();
$email = $info['email'];
$check = $this->checkEmail($email);
if($check == false) return false;
$firstname = $info['firstname'];
$lastname = $info['lastname'];
$company = $info['company'];
$upload = $this->uploadPhoto($files['image']['tmp_name'],$userid);
$stmt = $conn->prepare("UPDATE `login_information` SET `email` = ? ,`firstname` = ?, `lastname` = ?, `company` = ?  WHERE `userid` = ?");
$stmt->bind_param('sssss',$email,$firstname,$lastname,$company,$userid);
if($stmt->execute())
    return true;
else
    return false; 
    
}



/**
*@param {string} - checkemail 
*@return {bool}
*/
public function checkEmail($email){
$check = strpos($email,'@');
if($check !== FALSE)
    return true;
else
    return false;
}




/**
*@param {string} password 
*@return {bool}
*/
public function verifyPassword($inputpassword,$conn = NULL){
if($conn === NULL)
    $conn = $this->dbinfo();
if(!isset($_SESSION))
    session_start();
$stmt = $conn->prepare("SELECT `salt`,`password` FROM `login_information` WHERE `userid` = ? ");
$stmt->bind_param('s',$_SESSION['userid']);
$stmt->execute();
$stmt->bind_result($salt,$realpassword);
$stmt->fetch();
$password = hash_pbkdf2("sha256", $inputpassword, $salt, 1000, 20);
if($password === $realpassword){
    return true;
}
else
    return false;

}

/**
*@param {string} - new password 
*@param {array} - conn -optional 
*@return {bool}
*/
public function changePassword($oldpassword, $newpassword,$userid){
$conn = $this->dbinfo();
$salt = $this->randomString(10);
$check = $this->verifyPassword($oldpassword);
if($check === false) return false;
$password = $this->createPassword($newpassword,$salt);
$stmt = $conn->prepare("UPDATE `login_information` SET `password` = ?, `salt` = ? WHERE `userid` = ?");
$stmt->bind_param("sss",$password,$salt,$userid);

if($stmt->execute())
    return true;
else
    return false;
}



/**
*@param {string} - $password
*@param {string} - salt 
*@return {string} - returns string if salt is given. {array} -returns array if salt is not given in arr is salt and password. 
*/
public function createPassword($password,$salt = NULL){
if($salt === NULL){
    $salt = $this->randomString(10);
    $arr = array();
}
$password = hash_pbkdf2("sha256", $password, $salt, 1000, 20);

    if(isset($arr)){
        $arr['salt'] = $salt;
        $arr['password'] = $password;
        return $arr;
    }

    else
        return $password;

}

/**
*@param {string} - password 
*@return {bool}
*/
function checkPassword($password){
if(strlen($password) < 6)
    return false;
if(1 !== preg_match('~[0-9]~', $password))
    return false;
if(!preg_match('/[^a-zA-Z\d]/', $password))
    return false;
else
    return true;
}



/**
*
*@param {String} email 
*
*/
public function checkNewEmail($email,$userid){
$conn = $this->dbinfo();
$stmt = $conn->prepare("SELECT `email` FROM `login_information` WHERE `userid` = ?");
$stmt->bind_param('s',$userid);
$stmt->execute();
$stmt->bind_result($realemail);
$stmt->fetch();

if($realemail == NULL) return false; 
if($email !== $realemail){
    newEmail($email,$userid);
}
  return true;  
}

/**
*@about putting in the database your new email address and sending a confirmation email to that email address. 
*@param {String} email 
*@param {string} userid
*
*
*/
public function newEmail($email,$userid){
/*The way this works is that it sends the user an email to their new email address. Unless they confirm their new email, their email stays to the one previous given */
$conn = $this->dbinfo();
$confirmation = false; 
$confirmationkey = $this->createConfirmationKey();
$stmt = $conn->prepare("UPDATE `login_information` SET `new_email` = ?, `confirmation_key` = ? WHERE `userid` = ?");
$stmt->bind_param('sss',$email,$confirmationkey,$userid);
if($stmt->execute()){
    $message = 'CLICK HERE TO CONFIRM YOUR NEW EMAIL ADDRESS http://avocadoandtoast.com/emailchange.php?id='.$confirmationkey;
    mail($email, 'New email address', $message );
    return true;
}

}


/**
*@about if the confirmation key exist then we are going to change the email.
*@param {string} confirmation key
*@return {bool} 
*/
public function changeEmail($confirmationkey){
    $conn = $this->dbinfo();
    $stmt = $conn->prepare("SELECT `new_email`,`userid` FROM  `login_information` WHERE `confirmation_key` = ? AND `new_email` IS NOT NULL");
    $stmt->bind_param('s',$confirmationkey);
    $stmt->execute();
    $stmt->bind_result($newemail,$userid);
    $stmt->fetch();
    if(!isset($newemail) || !isset($userid)) return false;
    unset($stmt);
    $stmt = $conn->prepare("UPDATE `login_information` SET `email` = ? WHERE `userid` = ? ");
    $stmt->bind_param('ss',$email,$userid);
    if($stmt->execute()){
        return true;
    }
    else{
        return false;
    }
}



function uploadPhoto($image, $userid){
if($image == NULL){
   $image = 'assets/default-photo.png';
   return $image;
}
$conn_id = ftp_connect("ftp.avocadoandtoast.com");
$login_result = ftp_login($conn_id, "bashir@avocadoandtoast.com", "Platinum1!");
if($login_result !== true)
echo "Can't connect to the FTP server";
$remote_file = "images/user/".$userid.".jpg";
if (@ftp_put($conn_id, $remote_file, $image, FTP_BINARY)) {
ftp_close($conn_id);
return true;
} else {
ftp_close($conn_id);
return false;
}
}

/**
*@param none
*@return {array} $conn - database connection  
*/
public function dbinfo(){
date_default_timezone_set('EST'); # setting timezone
$dbusername ='l5o0c8t4_blaze'; 
$password = 'Platinum1!'; 
$db = 'l5o0c8t4_General_Information'; 
$servername = '162.144.181.131'; 
$conn = new mysqli($servername, $dbusername, $password, $db);
$date = new DateTime();
$last_updated = $date->getTimestamp();
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
return $conn;
}


private function createConfirmationKey(){
return md5($this->randomString(20));
}




}


?>