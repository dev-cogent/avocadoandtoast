<?php 
include 'useroptions.php';
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
public function updateGeneralInfo($info,$conn = NULL){
if($conn == NULL)
    $conn = $this->dbinfo();
if(!isset($_SESSION))
    session_start();
$email = $info['email'];
$fullname = $info['name'];
$company = $info['company'];
$accounttype = $info['accounttype'];
$stmt = $conn->prepare("UPDATE `login_information` SET `email` = ? ,`name` = ?, `company` = ?, `account_type` = ?  WHERE `userid` = ?");
$stmt->bind_param('sssss',$email,$fullname,$company,$accounttype,$_SESSION['userid']);
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
public function changePassword($newpassword,$conn = NULL){
if($conn === NULL)
    $conn = $this->dbinfo();

$salt = $this->randomString(10);
$password = $this->createPassword($newpassword,$salt);
$stmt = $conn->prepare("UPDATE `login_information` SET `password` = ?, `salt` = ? WHERE `userid` = ?");
$stmt->bind_param("sss",$password,$salt,$_SESSION['userid']);

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







}


?>