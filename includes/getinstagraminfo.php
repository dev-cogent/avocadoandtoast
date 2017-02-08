<?php 
session_start();
if(isset($_SESSION['name'])){
 if(!isset($_SESSION['sent'])){
  #If this is the first time the user has gotten to this page, we send them a verification email.
  #We send the email here because for some reason, if it's a POST request, it won't send an email. 
  #So we send it here, since you can't get to this page unless all your mail gets sent out.  
  #Since you can reload this page multiple times we made a session for it. 
  $email = $_SESSION['email'];
  $headers = "From: support@project.social \r\n";
  $headers .= "MIME-Version: 1.0\r\n";
  $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
  $message = '<div style="width:100%;text-align:center;background:#000;height:75px;">
              <img src="https://project.social/assets/logos/pjs.png" style="padding: 10px;width: 50%;">
              </div><br/>Welcome to project.social <a href="https://project.social/confirmation?q='.$_SESSION['confirmationkey'].'"> Click here to continue</a></h4>';
  $mail = mail($email, 'Please Confirm Project Social Account', $message, $headers);
  $_SESSION['sent'] = true;
  unset($_SESSION['confirmationkey']); // we don't need this anymore, so we unset it. 
  }


  if($_GET['code']){
  include 'includes/class/useroptions.php';
  $useroptionobj = new userOptions;
  $client_id = '72ecc575c986492282e238e6429798e7';
  $client_secret ='705ea6ddf42347bb800baa0129b6f31a';
  $redirect_uri = 'https://project.social/addinstagram.php';
  $code = $_GET['code'];
  $url = "https://api.instagram.com/oauth/access_token";
  $access_token_parameters = array(
      'client_id'                =>     $client_id,
      'client_secret'            =>     $client_secret,
      'grant_type'               =>     'authorization_code',
      'redirect_uri'             =>     $redirect_uri,
      'code'                     =>     $code
  );

  //cant use the curl function because of the access token parameters. 
  $curl = curl_init($url);    // we init curl by passing the url
  curl_setopt($curl,CURLOPT_POST,true);   // to send a POST request
  curl_setopt($curl,CURLOPT_POSTFIELDS,$access_token_parameters);   // indicate the data to send
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);   // to return the transfer as a string of the return value of curl_exec() instead of outputting it out directly.
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);   // to stop cURL from verifying the peer's certificate.
  $json = json_decode(curl_exec($curl), true);   // to perform the curl session
  curl_close($curl);   // to close the curl session_cache_expire
   
  //Using the next function to check if the user has instagram accounts stored in the database. If they do, we unserialize it and add the new instagram account to the array and store it. 
  $userInstagramAccounts = $useroptionobj->getInstagramAccounts($_SESSION['userid']);
  if($userInstagramAccounts === NULL)
  $userInstagramAccounts = array();
  
  $access_token = $json['access_token'];
  $json = $useroptionobj->getBasicInstagramInfo($access_token);  
  //end all json request now. 
  if($json['username'] !== NULL || $json['username'] != ""){
    $conn = $useroptionobj->dbinfo();
    $stmt = $conn->prepare("INSERT INTO `user_instagram_information` (username, full_name, instagram_id, access_token, profile_picture, bio, website, media_count, follows, followed_by) VALUES (?,?,?,?,?,?,?,?,?,?)");
    $stmt->bind_param('sssssssiii',$json['username'],$json['full_name'],$json['id'],$access_token,$json['profile_picture'],$json['bio'],$json['website'],$json['media_count'],$json['follows'],$json['followed_by']);
    $stmt->execute();
    array_push($userInstagramAccounts,$json['id']);
    $userInstagramAccounts = serialize($userInstagramAccounts);
    $stmt->prepare("UPDATE `login_information` SET `instagram_accounts` = ? WHERE `userid` = ? ");
    //Here we will also update the influencer_information. 
    //When added to the influencer information we will then also put an influencer id  inside user_instagram_information and an id will be put inside login_information set insdie of an array. 
    
    $stmt->bind_param('ss',$userInstagramAccounts,$_SESSION['userid']);
    if($stmt->execute())
    $instagramconnected = true;
   }// end if username 
  } //end if get code 
}//end if isset




?>