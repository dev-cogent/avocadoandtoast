<?php
 

include 'favorite.php';

class signUp extends favorite{

 function register($arr){
	 
    $first = $arr['firstname'];
    $last = $arr['lastname'];
    $email = $arr['email'];
    $password = $arr['password'];
    $confirmpassword = $arr['confirm'];
    $company = $arr['company'];
    $checkEmail = $this->checkEmail($email);
    $checkPassword = $this->checkPassword($password);
    $error = $this->errorHandling($arr);
    if($error !== FALSE){
        return $error;
    }
    $passwordarr = $this->hashPassword($password);
    $password = $passwordarr['password'];
    $salt = $passwordarr['salt'];
    $userid = $this->createUserID();
    $columnid = $this->createColumnID();
    $confirmationkey = $this->createConfirmationKey();
    $favoriteID = $this->createFavoriteID();
    $confirmed = 'false';
    $conn = $this->dbinfo();
    $favoritedb = $this->favoriteDB();
	$date = time();
    $stmt = $conn->prepare("INSERT INTO `login_information`(`userid`,`email`, `firstname`, `lastname`,`salt`, `password`, `column_id`, `confirmed`,`confirmation_key`,`company`,`date_created`)
    VALUES (?,?,?,?,?,?,?,?,?,?,?)");
    $stmt->bind_param('sssssssssss', $userid, $email, $first, $last, $salt, $password,$columnid,$confirmed,$confirmationkey,$company,$date);
    if(!$stmt->execute()){
        echo 'here';
        if(strpos($stmt->error, 'Duplicate') !== FALSE){
            $error = 'That email address is already being used.';
            return $error;
        }
        else{
        $error = 'An unknown error has occured. Make sure all fields are filled out. Contact support if issue occurs';
        return $error;
        }
    }
    unset($stmt);
    $stmt = $favoritedb->prepare("CREATE TABLE IF NOT EXISTS `$userid` (
    `influencer_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL PRIMARY KEY,
    `image_url` varchar(100) COLLATE utf8_unicode_ci  NULL
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;");
    if($stmt->execute())
        $this->sendConfirmationEmail($email,$confirmationkey);
        return true;
 }



public function sendConfirmationEmail($email,$confirmationkey){
$headers = "From: support@avocadoandtoast \r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
$message = $this->emailWelcome($confirmationkey);
$mail = mail($email, 'Please Confirm avocado and  toast Account', $message, $headers);
return true;
}


 private function errorHandling($arr){
    $firstname = $arr['firstname'];
    $lastname = $arr['lastname'];
    $email = $arr['email'];
    $password = $arr['password'];
    $confirmpassword = $arr['confirm'];
    $company = $arr['company'];
    $checkEmail = $this->checkEmail($email);
    $checkPassword = $this->checkPassword($password);

    if($checkEmail === false){
    $error .= '<li>Email is not properly formatted</li>';
    $signup = false;
    }
    if($checkPassword === false){
    $error .= '<li>Password must be more than 6 charaters long and must contain one number and one special character</li>';
    $signup = false;
    }
    if($confirmpassword !== $password){
    $error .= '<li>Passwords do not match</li>';
    $signup = false;
    }
    if($firstname == NULL || $firstname == ""){
    $error .= "<li>First Name can't be empty.</li>";
    $signup = false;
    }
    if($lastname == NULL || $lastname == ""){
    $error .= "<li>First Name can't be empty.</li>";
    $signup = false;
    }
    if($company === NULL || $company == ""){
    $error .= '<li>You have to enter a company name in</li>';
    $signup = false;
    }

    if(isset($signup)) return $error;
    else return false;
 }




protected function checkEmail($email){
$check = strpos($email,'@');
if($check !== FALSE)
return true;
else
return false;
}


protected function checkPassword($password){
if(strlen($password) < 6)
return false;
else
return true;
/*
if(1 !== preg_match('~[0-9]~', $password)){
return false;
}
if(!preg_match('/[^a-zA-Z\d]/', $password))
return false;*/

}

private function createUserID(){
$userid = hash_pbkdf2("sha256", $this->randomString(50), $this->randomString(10), 1000,20);
return $userid;
}

private function createColumnID(){
$columnid = hash_pbkdf2("sha256", $this->randomString(30), $this->randomString(12), 1000, 20);
return $columnid;
}

private function hashPassword($password){
$salt = $this->randomString(10);
$password = hash_pbkdf2("sha256", $_POST['password'], $salt, 1000, 20);
$arr['password'] = $password;
$arr['salt'] = $salt;
return $arr;
}


public function createConfirmationKey(){
return md5($this->randomString(10));
}


public function forgotPasswordKey(){
return hash_pbkdf2("sha256", $this->randomString(20), $salt, 1000, 20);
} 


public function forgotPassword($email){
	$passwordkey = $this->forgotPasswordKey();
	$conn = $this->dbinfo();
	$stmt = $conn->prepare("UPDATE `login_information` SET `forgot_password_key` = ? WHERE `email` = ?");
	$stmt->bind_param('ss',$passwordkey,$email);
	if(!$stmt->execute()){
		return false;
	}
	$headers = "From: support@avocadoandtoast \r\n";
	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
	$message = 'Youve forgot your password. <a href="passwordreset.php?id='.$passwordkey.'">Click here to reset it</a>';
	$mail = mail($email, 'Please Confirm avocado and  toast Account', $message, $headers);

}



public function emailWelcome($link){
  $html = '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>


<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<style type="text/css">
		.ReadMsgBody{
			width:100%;
			background-color:#ffffff;
		}
		.ExternalClass{
			width:100%;
			background-color:#ffffff;
		}
		body{
			width:100%;
			background-color:#ffffff;
			margin:0;
			padding:0;
			-webkit-font-smoothing:antialiased;
			font-family:Helvetica, Times, serif;
		}
		table{
			border-collapse:collapse;
		}
	@media only screen and (max-width: 640px){
		.deviceWidth{
			width:440px!important;
			padding:0;
		}

}	@media only screen and (max-width: 640px){
		.center{
			text-align:center!important;
		}

}	@media only screen and (max-width: 479px){
		.deviceWidth{
			width:280px!important;
			padding:0;
		}

}	@media only screen and (max-width: 479px){
		.smallFont{
			font-size:28px !important;
		}

}	@media only screen and (max-width: 479px){
		.spacing{
			padding:10px !important;
		}

}	@media only screen and (max-width: 479px){
		.center{
			text-align:center!important;
		}

}</style></head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" style="font-family: Helvetica, Times, serif">

<!-- Wrapper -->
<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
	<tr>
		<td width="100%" valign="top" bgcolor="#ffffff" style="padding-top:20px">

			<!-- Start Header-->
			<table width="800" border="0" cellpadding="0" cellspacing="0" align="center" class="deviceWidth" style="margin:0 auto;">
				<tr>
					<td width="100%" bgcolor="#ffffff">

<div style="display:none;font-size:1px;color:#333333;line-height:1px;max-height:0px;max-width:0px;opacity:0;overflow:hidden;">  Welcome To Avocado and Toast!  Please confirm your email so you can get started!   <br>     
</div>
<div style="display:none;font-size:1px;color:#333333;line-height:1px;max-height:0px;max-width:0px;opacity:0;overflow:hidden;">
 <br>     
 
</div>

					</td>
				</tr>
			</table><!-- End Header -->

			<!-- One Column  Header Title  --> 
			<table width="800" class="deviceWidth" border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="white" style="margin:0 auto;">
				<tr>
					<td valign="top" style="padding-bottom:10px;" bgcolor="#ffffff">
						<a href=""><img class="deviceWidth" src="https://gallery.mailchimp.com/bb1e624c1a86ff7a7fe97f3b0/images/ca4217fd-1ba0-43ae-8897-39dff00c29f9.png" alt="" border="0" style="display: block;"></a>
					</td>
				</tr>
                <tr>
                    <td style="font-size: 14px; color: #959595; font-weight: normal; text-align: center; font-family: Helvetica, Times, serif; line-height: 24px; vertical-align: top; padding:0px 0px 0px 0px" bgcolor="">
		
<table width="600" class="deviceWidth" border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="" style="margin:0 auto;">
		
                <tr>
                    <td style="font-size: 14px; color: #959595; font-weight: normal; text-align:center; font-family: Helvetica, Times, serif; line-height: 24px; vertical-align: top; padding:0px 0px 0px 0px" bgcolor="">
		
                        <table>
                            <tr>
                                <td valign="top" style="padding:0 0px 0px 0 text-align:center;">
                                    <a href="#"> <img src="https://gallery.mailchimp.com/bb1e624c1a86ff7a7fe97f3b0/images/51cbbde0-786f-499d-b369-09058ef014f0.gif" style="width:50%; padding: 0px 0px 0px 0px;" alt="" border="0" align="center"></a>
                                </td>
                                <td valign="middle" style="padding:0 0px 0px 0"><a href="#" style="text-decoration: none; color: #272727; font-size: 16px; color: black; font-weight:bold; font-family:Helvetica, sans-serif ">  </a>  
                                
                                </td>
                            </tr>      
                        </table>
                    </td>
               </tr>
			</table><!-- End One Column header  -->


 	<!-- One Column Copy text  -->
			<table width="400" class="deviceWidth" border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="white" style="margin:0 auto;">
		
                <tr>
                    <td style="font-size: 20px; color: #000000; font-weight: normal; text-align:center; font-family: Helvetica, Times, serif; line-height: 26px; vertical-align: top; padding:0px 0px 0px 0px" bgcolor="">
		
                        <table>
                           <tbody>
														<tr>
															<td class="center" style="text-align: center;" valign="top"> 
                    <div style="height:20px;margin:0 auto;">&nbsp;</div><!-- spacer -->                            
                <span style="font-size:44px; color:#73c48d;font-weight:600;letter-spacing:1px;" class="smallFont">WELCOME!  </span> 
                             <div style="height:8px;margin:0 auto;">&nbsp;</div><!-- spacer -->
                                                            We are so glad to have you on board!
														

 <div style="height:30px;margin:0 auto;">&nbsp;</div><!-- spacer -->
 <a href="http://avocadoandtoast.com/confirmation?q='.$link.'" style="padding: 15px 50px;text-transform:uppercase;borer-radius:3px;font-family:\'Helvetica\';font-size:16px;letter-spacing:1px; color:white; background-color:#73C48d;text-decoration:none; "> Verify your email </a> <br> 
 
  <div style="height:30px;margin:0 auto;">&nbsp;</div><!-- spacer -->
Can\'t click on button above? Copy and paste this link to your browser: <br> <br> 
	http://avocadoandtoast.com/confirmation?q='.$link.'

 </td>
														</tr>
                                                        
                         
													</tbody>
                        </table>
                    </td>
               </tr>
			</table><!-- End One Column -->

<div style="height:10px;margin:0 auto;">&nbsp;</div><!-- spacer -->






<div style="height:30px;margin:0 auto;">&nbsp;</div><!-- spacer -->

            
            <!-- 2 Column Images 3rd & fourth image if in a four grid stack - -->
			<table width="600" border="0" cellpadding="0" cellspacing="0" align="center" class="deviceWidth" bgcolor="white" style="margin:0 auto;">
				<tr>
					<td style="padding:0px 0">
                            <table align="right" width="49%" cellpadding="0" cellspacing="0" border="0" class="deviceWidth">
                                <tr>
                                    <td valign="top" align="right" class="center" style="padding:0px 0px 0 0">
										<p style="mso-table-lspace:0;mso-table-rspace:0; margin:0"><a href="#"><img width="300" src="https://gallery.mailchimp.com/bb1e624c1a86ff7a7fe97f3b0/images/078f9dea-0c3b-48d2-874a-5717f195ec77.png" alt="" border="0" style="width: 300px; display: block;" class="deviceWidth spacing"></a></p>
                                    </td>
                                </tr>
                            </table>
                            <table align="left" width="49%" cellpadding="0" cellspacing="0" border="0" class="deviceWidth">
                                <tr>
                                    <td style="font-size: 13px; color: #959595; font-weight: normal; text-align: left; font-family: Helvetica, Times, serif; line-height: 24px; vertical-align: top; padding:0px 0 0px 0px">

                                                                 <table align="right" width="49%" cellpadding="0" cellspacing="0" border="0" class="deviceWidth">
                                <tr>
                                    <td valign="top" align="right" class="center" style="padding:0px 0px 0 0">
										<p style="mso-table-lspace:0;mso-table-rspace:0; margin:0"><a href="http://www.wayofwade.com/announcement.html/?utm_source=Email&utm_medium=Mailchimp&utm_campaign=AllStar"><img width="300" src="https://gallery.mailchimp.com/bb1e624c1a86ff7a7fe97f3b0/images/5d4ad523-ac5f-438c-b474-48e6e3b2f527.png" alt="" border="0" style="width: 300px; display: block;" class="deviceWidth spacing"></a></p>
                                    </td>
                                </tr>
                            </table>
                                    </td>
                                </tr>
                            </table>
                    </td>
                </tr>
            </table><!-- End 2 Column Images  - text left -->



<div style="height:25px;margin:0 auto;">&nbsp;</div><!-- spacer -->

		<!-- One Column  image 1-->
			<table width="600" class="deviceWidth" border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="" style="margin:0 auto;">
		
                <tr>
                    <td style="font-size: 14px; color: #959595; font-weight: normal; text-align: left; font-family: Helvetica, Times, serif; line-height: 24px; vertical-align: top; padding:0px 0px 0px 0px" bgcolor="">
		
                        <table>
                            <tr>
                                <td valign="top" style="padding:0 0px 0px 0">
                                    <a href="#"> <img src="https://gallery.mailchimp.com/bb1e624c1a86ff7a7fe97f3b0/images/47f788a9-ce5c-489a-a34f-8c1a00ae7c9d.png" style="display:block; width:100%; padding: 0px 0px 0px 0px;" alt="" border="0" align="left"></a>
                                </td>
                                <td valign="middle" style="padding:0 0px 0px 0"><a href="#" style="text-decoration: none; color: #272727; font-size: 16px; color: black; font-weight:bold; font-family:Helvetica, sans-serif ">  </a>  
                                
                                </td>
                            </tr>      
                        </table>
                         <table width="100%" cellpadding="0" cellspacing="0" border="0" align="center" class="deviceWidth">
                                            <tr>
                                                <td valign="top" style="font-size: 12px; color: #f1f1f1; font-weight: normal; font-family: Helvetica, Times, serif; line-height: 25px; vertical-align: top; text-align:center;" class="center">

                                                   
                                                    <a href="https://www.facebook.com/AvocadoAndToast/"><img src="https://gallery.mailchimp.com/bb1e624c1a86ff7a7fe97f3b0/images/54a4092b-e403-43bd-b351-e05337e9ff85.png" width="130" height="100" alt="Facebook" title="Facebook" border="0"></a>

                             
                                                                 <a href="https://www.instagram.com/avocadoandtoast/"><img src="https://gallery.mailchimp.com/bb1e624c1a86ff7a7fe97f3b0/images/e4f4bcd9-cc3c-404c-bf04-d73ded229b8a.png" title="Instagram" alt="Instagram" border="0" width="130" height="100"></a>
                                                                               <a href="#"><img src="https://gallery.mailchimp.com/bb1e624c1a86ff7a7fe97f3b0/images/584cf4d4-4c50-4dbf-ab82-c8a20103de01.png" title="Twitter" alt="Twitter" border="0" width="130" height="100"></a>




                                       

                                </td>
                                            </tr>
                                        </table>
                    </td>
               </tr>
			</table><!-- End One Column image  -->
            
          

<div style="height:15px;margin:0 auto;">&nbsp;</div><!-- spacer -->


			<!-- 4 Columns -->
            <footer>
					<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
				<tr>
					<td bgcolor="white" style="padding:10px 0">
                        <table width="800" border="0" cellpadding="10" cellspacing="0" align="center" class="deviceWidth" style="margin:0 auto;">
                            <tr>
                                <td>
                                        <table width="80%" cellpadding="0" cellspacing="0" border="0" align="left" class="deviceWidth">
                                            <tr>
                                                <td valign="top" style="font-size: 12px;  color:000000; font-family: Arial, sans-serif; padding-bottom:5px" class="center"> <br> 
                                       

<em>Copyright &copy; *|CURRENT_YEAR|* *|LIST:COMPANY|*, All rights reserved.</em><br>
*|IFNOT:ARCHIVE_PAGE|* *|LIST:DESCRIPTION|*<br>
                                                 This email is an advertisement of Way of Wade products.<br>
                                          

                                                  
                Want to change how you receive these emails?<br>
You can <a href="*|UPDATE_PROFILE|*">update your preferences</a> or <a href="*|UNSUB|*">unsubscribe from this list</a><br>

*|IF:REWARDS|* *|HTML:REWARDS|* *|END:IF|*
                                                </td>
                                            </tr>
                                        </table>

                                        <table width="20%" cellpadding="0" cellspacing="0" border="0" align="right" class="deviceWidth">
                                            <tr>
                                                <td valign="top" style="font-size: 12px; color: #f1f1f1; font-weight: normal; font-family: Helvetica, Times, serif; line-height: 25px; vertical-align: top; text-align:center;" class="center">
<br> <br> 
        <a href="http://www.avocadoandtoast.com"><img src="https://gallery.mailchimp.com/bb1e624c1a86ff7a7fe97f3b0/images/20820bc5-6e08-48c3-a60f-668c74095b16.png" alt="" border="0" width="50" height="50" style="margin-top:-1px;"></a> 
          <div style="height:5px;margin:0 auto;">&nbsp;</div><!-- spacer -->
                                                <a href="#" style="text-decoration: none; color: #000000; font-weight: normal; margin-bottom:"> 150 5th Ave  <br> New York, NY 10011</a><br>
                                                              
                                                    
                                            

                                       

                                </td>
                                            </tr>
                                        </table>
	</td></tr></table></td></tr></table></footer> 
                        		</td>
                        	</tr>
                        </table>
                    </td>
                </tr>
            </table><!-- End 4 Columns -->



		
	
 <!-- End Wrapper -->

<div style="display:none; white-space:nowrap; font:15px courier; color:#ffffff;">
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
</div>
</body>
</html>
';
  return $html;

}


}
