<?php
 

class signUp {
 
 function register($arr){
	/* echo 'MEH';
	 return false;
    $first = $arr['firstname'];
    $last = $arr['lastname'];
    $email = $arr['email'];
    $password = $arr['password'];
    $confirmpassword = $arr['confirm'];
    $company = $arr['company'];
	$referral = $arr['referral'];
    $checkEmail = $this->checkEmail($email);
    $checkPassword = $this->checkPassword($password);
	$checkRefferal = $this->checkReferral($referral);
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
    $conn = $this->dbinfo();
    $stmt = $conn->prepare("INSERT INTO `login_information`(`userid`,`email`, `firstname`, `lastname`,`salt`, `password`, `column_id`)
    VALUES (?,?,?,?,?,?,?)");
    $stmt->bind_param('sssssss', $userid, $email, $first, $last, $salt, $password,$columnid);
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
	else{
        $this->sendConfirmationEmail($email,$confirmationkey);
        return true;
	}*/
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
	$referral = $arr['referral'];
    $checkEmail = $this->checkEmail($email);
    $checkPassword = $this->checkPassword($password);
	$checkRefferal = $this->checkRefferal($referral);

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
	if($checkRefferal === false){
		$error .= 'Referral password is incorrect';
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


protected function checkRefferal($referral){
$salt = '7Pas+2ADrAneducR';
$realpassword = hash_pbkdf2("sha256", $salt, 'T6_BruTRuFr=2rap', 1000, 20);
$userpassword =  hash_pbkdf2("sha256", $salt, $referral, 1000, 20);
if($realpassword === $userpassword)
return true;
else
return false;
}

protected function checkPassword($password){
if(strlen($password) < 6)
return false;
if(1 !== preg_match('~[0-9]~', $password)){
return false;
}
if(!preg_match('/[^a-zA-Z\d]/', $password))
return false;
else
return true;
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

public function dbinfo(){
date_default_timezone_set('EST'); # setting timezone
$dbusername ='l5o0c8t4_blaze'; 
$password = 'Platinum1!'; 
$db = 'l5o0c8t4_talent'; 
$servername = '162.144.181.131'; 
$conn = new mysqli($servername, $dbusername, $password, $db);
$date = new DateTime();
$last_updated = $date->getTimestamp();
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

}

public function emailWelcome($link){
  $html = '
<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
	<head>
	<!-- NAME: MEMBER WELCOME -->
	<!--[if gte mso 15]>
	<xml>
	<o:OfficeDocumentSettings>
	<o:AllowPNG/>
	<o:PixelsPerInch>96</o:PixelsPerInch>
	</o:OfficeDocumentSettings>
	</xml>
	<![endif]-->
	<meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>*|MC:SUBJECT|*</title>

    <style type="text/css">
	p{
	margin:10px 0;
	padding:0;
	}
	table{
	border-collapse:collapse;
	}
	h1,h2,h3,h4,h5,h6{
	display:block;
	margin:0;
	padding:0;
	}
	img,a img{
	border:0;
	height:auto;
	outline:none;
	text-decoration:none;
	}
	body,#bodyTable,#bodyCell{
	height:100%;
	margin:0;
	padding:0;
	width:100%;
	}
	#outlook a{
	padding:0;
	}
	img{
	-ms-interpolation-mode:bicubic;
	}
	table{
	mso-table-lspace:0pt;
	mso-table-rspace:0pt;
	}
	.ReadMsgBody{
	width:100%;
	}
	.ExternalClass{
	width:100%;
	}
	p,a,li,td,blockquote{
	mso-line-height-rule:exactly;
	}
	a[href^=tel],a[href^=sms]{
	color:inherit;
	cursor:default;
	text-decoration:none;
	}
	p,a,li,td,body,table,blockquote{
	-ms-text-size-adjust:100%;
	-webkit-text-size-adjust:100%;
	}
	.ExternalClass,.ExternalClass p,.ExternalClass td,.ExternalClass div,.ExternalClass span,.ExternalClass font{
	line-height:100%;
	}
	a[x-apple-data-detectors]{
	color:inherit !important;
	text-decoration:none !important;
	font-size:inherit !important;
	font-family:inherit !important;
	font-weight:inherit !important;
	line-height:inherit !important;
	}
	.templateContainer{
	max-width:600px !important;
	}
	a.mcnButton{
	display:block;
	}
	.mcnImage{
	vertical-align:bottom;
	}
	.mcnTextContent{
	word-break:break-word;
	}
	.mcnTextContent img{
	height:auto !important;
	}
	.mcnDividerBlock{
	table-layout:fixed !important;
	}
	/*
	@tab Page
	@section Background Style
	@tip Set the background color and top border for your email. You may want to choose colors that match your company"s branding.
	*/
	body,#bodyTable{
	/*@editable*/background-color:#1F2934;
	}
	/*
	@tab Page
	@section Background Style
	@tip Set the background color and top border for your email. You may want to choose colors that match your company"s branding.
	*/
	#bodyCell{
	/*@editable*/border-top:0;
	}
	/*
	@tab Page
	@section Heading 1
	@tip Set the styling for all first-level headings in your emails. These should be the largest of your headings.
	@style heading 1
	*/
	h1{
	/*@editable*/color:#202020;
	/*@editable*/font-family:Georgia;
	/*@editable*/font-size:30px;
	/*@editable*/font-style:normal;
	/*@editable*/font-weight:normal;
	/*@editable*/line-height:125%;
	/*@editable*/letter-spacing:normal;
	/*@editable*/text-align:left;
	}
	/*
	@tab Page
	@section Heading 2
	@tip Set the styling for all second-level headings in your emails.
	@style heading 2
	*/
	h2{
	/*@editable*/color:#202020;
	/*@editable*/font-family:Helvetica;
	/*@editable*/font-size:24px;
	/*@editable*/font-style:normal;
	/*@editable*/font-weight:bold;
	/*@editable*/line-height:150%;
	/*@editable*/letter-spacing:normal;
	/*@editable*/text-align:center;
	}
	/*
	@tab Page
	@section Heading 3
	@tip Set the styling for all third-level headings in your emails.
	@style heading 3
	*/
	h3{
	/*@editable*/color:#989898;
	/*@editable*/font-family:Helvetica;
	/*@editable*/font-size:24px;
	/*@editable*/font-style:normal;
	/*@editable*/font-weight:bold;
	/*@editable*/line-height:150%;
	/*@editable*/letter-spacing:normal;
	/*@editable*/text-align:center;
	}
	/*
	@tab Page
	@section Heading 4
	@tip Set the styling for all fourth-level headings in your emails. These should be the smallest of your headings.
	@style heading 4
	*/
	h4{
	/*@editable*/color:#202020;
	/*@editable*/font-family:Helvetica;
	/*@editable*/font-size:18px;
	/*@editable*/font-style:normal;
	/*@editable*/font-weight:bold;
	/*@editable*/line-height:200%;
	/*@editable*/letter-spacing:normal;
	/*@editable*/text-align:center;
	}
	/*
	@tab Preheader
	@section Preheader Style
	@tip Set the background color and borders for your email"s preheader area.
	*/
	#templatePreheader{
	/*@editable*/background-color:#ffffff;
	/*@editable*/background-image:none;
	/*@editable*/background-repeat:no-repeat;
	/*@editable*/background-position:center;
	/*@editable*/background-size:cover;
	/*@editable*/border-top:0;
	/*@editable*/border-bottom:0;
	/*@editable*/padding-top:9px;
	/*@editable*/padding-bottom:9px;
	}
	/*
	@tab Preheader
	@section Preheader Text
	@tip Set the styling for your email"s preheader text. Choose a size and color that is easy to read.
	*/
	#templatePreheader .mcnTextContent,#templatePreheader .mcnTextContent p{
	/*@editable*/color:#656565;
	/*@editable*/font-family:Helvetica;
	/*@editable*/font-size:12px;
	/*@editable*/line-height:150%;
	/*@editable*/text-align:left;
	}
	/*
	@tab Preheader
	@section Preheader Link
	@tip Set the styling for your email"s preheader links. Choose a color that helps them stand out from your text.
	*/
	#templatePreheader .mcnTextContent a,#templatePreheader .mcnTextContent p a{
	/*@editable*/color:#656565;
	/*@editable*/font-weight:normal;
	/*@editable*/text-decoration:underline;
	}
	/*
	@tab Header
	@section Header Style
	@tip Set the background color and borders for your email"s header area.
	*/
	#templateHeader{
	/*@editable*/background-color:#000000;
	/*@editable*/background-image:none;
	/*@editable*/background-repeat:no-repeat;
	/*@editable*/background-position:center;
	/*@editable*/background-size:cover;
	/*@editable*/border-top:0;
	/*@editable*/border-bottom:0;
	/*@editable*/padding-top:40px;
	/*@editable*/padding-bottom:40px;
	}
	/*
	@tab Header
	@section Header Text
	@tip Set the styling for your email"s header text. Choose a size and color that is easy to read.
	*/
	#templateHeader .mcnTextContent,#templateHeader .mcnTextContent p{
	/*@editable*/color:#ffffff;
	/*@editable*/font-family:"Helvetica Neue", Helvetica, Arial, Verdana, sans-serif;
	/*@editable*/font-size:60px;
	/*@editable*/line-height:150%;
	/*@editable*/text-align:left;
	}
	/*
	@tab Header
	@section Header Link
	@tip Set the styling for your email"s header links. Choose a color that helps them stand out from your text.
	*/
	#templateHeader .mcnTextContent a,#templateHeader .mcnTextContent p a{
	/*@editable*/color:#3a3a3a;
	/*@editable*/font-weight:normal;
	/*@editable*/text-decoration:underline;
	}
	/*
	@tab Body
	@section Body Style
	@tip Set the background color and borders for your email"s body area.
	*/
	#templateBody{
	/*@editable*/background-color:#ffffff;
	/*@editable*/background-image:none;
	/*@editable*/background-repeat:no-repeat;
	/*@editable*/background-position:center;
	/*@editable*/background-size:cover;
	/*@editable*/border-top:0;
	/*@editable*/border-bottom:0;
	/*@editable*/padding-top:20px;
	/*@editable*/padding-bottom:20px;
	}
	/*
	@tab Body
	@section Body Text
	@tip Set the styling for your email"s body text. Choose a size and color that is easy to read.
	*/
	#templateBody .mcnTextContent,#templateBody .mcnTextContent p{
	/*@editable*/color:#666666;
	/*@editable*/font-family:Georgia, Times, "Times New Roman", serif;
	/*@editable*/font-size:16px;
	/*@editable*/line-height:150%;
	/*@editable*/text-align:center;
	}
	/*
	@tab Body
	@section Body Link
	@tip Set the styling for your email"s body links. Choose a color that helps them stand out from your text.
	*/
	#templateBody .mcnTextContent a,#templateBody .mcnTextContent p a{
	/*@editable*/color:#888888;
	/*@editable*/font-weight:normal;
	/*@editable*/text-decoration:underline;
	}
	/*
	@tab Columns
	@section Column Style
	@tip Set the background color and borders for your email"s columns.
	*/
	#templateColumns{
	/*@editable*/background-color:#6d7d81;
	/*@editable*/background-image:none;
	/*@editable*/background-repeat:no-repeat;
	/*@editable*/background-position:center;
	/*@editable*/background-size:cover;
	/*@editable*/border-top:0;
	/*@editable*/border-bottom:0;
	/*@editable*/padding-top:220px;
	/*@editable*/padding-bottom:50px;
	}
	/*
	@tab Columns
	@section Column Text
	@tip Set the styling for your email"s column text. Choose a size and color that is easy to read.
	*/
	#templateColumns .columnContainer .mcnTextContent,#templateColumns .columnContainer .mcnTextContent p{
	/*@editable*/color:#202020;
	/*@editable*/font-family:Helvetica;
	/*@editable*/font-size:16px;
	/*@editable*/line-height:200%;
	/*@editable*/text-align:center;
	}
	/*
	@tab Columns
	@section Column Link
	@tip Set the styling for your email"s column links. Choose a color that helps them stand out from your text.
	*/
	#templateColumns .columnContainer .mcnTextContent a,#templateColumns .columnContainer .mcnTextContent p a{
	/*@editable*/color:#202020;
	/*@editable*/font-weight:normal;
	/*@editable*/text-decoration:underline;
	}
	/*
	@tab Footer
	@section Footer Style
	@tip Set the background color and borders for your email"s footer area.
	*/
	#templateFooter{
	/*@editable*/background-color:#1f2934;
	/*@editable*/background-image:none;
	/*@editable*/background-repeat:no-repeat;
	/*@editable*/background-position:center;
	/*@editable*/background-size:cover;
	/*@editable*/border-top:0;
	/*@editable*/border-bottom:0;
	/*@editable*/padding-top:60px;
	/*@editable*/padding-bottom:60px;
	}
	/*
	@tab Footer
	@section Footer Text
	@tip Set the styling for your email"s footer text. Choose a size and color that is easy to read.
	*/
	#templateFooter .mcnTextContent,#templateFooter .mcnTextContent p{
	/*@editable*/color:#FFFFFF;
	/*@editable*/font-family:Helvetica;
	/*@editable*/font-size:12px;
	/*@editable*/line-height:150%;
	/*@editable*/text-align:center;
	}
	/*
	@tab Footer
	@section Footer Link
	@tip Set the styling for your email"s footer links. Choose a color that helps them stand out from your text.
	*/
	#templateFooter .mcnTextContent a,#templateFooter .mcnTextContent p a{
	/*@editable*/color:#FFFFFF;
	/*@editable*/font-weight:normal;
	/*@editable*/text-decoration:underline;
	}
	@media only screen and (min-width:768px){
	.templateContainer{
	width:600px !important;
	}

}	@media only screen and (max-width: 480px){
	body,table,td,p,a,li,blockquote{
	-webkit-text-size-adjust:none !important;
	}

}	@media only screen and (max-width: 480px){
	body{
	width:100% !important;
	min-width:100% !important;
	}

}	@media only screen and (max-width: 480px){
	.columnWrapper{
	max-width:100% !important;
	width:100% !important;
	}

}	@media only screen and (max-width: 480px){
	.mcnImage{
	width:100% !important;
	}

}	@media only screen and (max-width: 480px){
	.mcnCartContainer,.mcnCaptionTopContent,.mcnRecContentContainer,.mcnCaptionBottomContent,.mcnTextContentContainer,.mcnBoxedTextContentContainer,.mcnImageGroupContentContainer,.mcnCaptionLeftTextContentContainer,.mcnCaptionRightTextContentContainer,.mcnCaptionLeftImageContentContainer,.mcnCaptionRightImageContentContainer,.mcnImageCardLeftTextContentContainer,.mcnImageCardRightTextContentContainer{
	max-width:100% !important;
	width:100% !important;
	}

}	@media only screen and (max-width: 480px){
	.mcnBoxedTextContentContainer{
	min-width:100% !important;
	}

}	@media only screen and (max-width: 480px){
	.mcnImageGroupContent{
	padding:9px !important;
	}

}	@media only screen and (max-width: 480px){
	.mcnCaptionLeftContentOuter .mcnTextContent,.mcnCaptionRightContentOuter .mcnTextContent{
	padding-top:9px !important;
	}

}	@media only screen and (max-width: 480px){
	.mcnImageCardTopImageContent,.mcnCaptionBlockInner .mcnCaptionTopContent:last-child .mcnTextContent{
	padding-top:18px !important;
	}

}	@media only screen and (max-width: 480px){
	.mcnImageCardBottomImageContent{
	padding-bottom:9px !important;
	}

}	@media only screen and (max-width: 480px){
	.mcnImageGroupBlockInner{
	padding-top:0 !important;
	padding-bottom:0 !important;
	}

}	@media only screen and (max-width: 480px){
	.mcnImageGroupBlockOuter{
	padding-top:9px !important;
	padding-bottom:9px !important;
	}

}	@media only screen and (max-width: 480px){
	.mcnTextContent,.mcnBoxedTextContentColumn{
	padding-right:18px !important;
	padding-left:18px !important;
	}

}	@media only screen and (max-width: 480px){
	.mcnImageCardLeftImageContent,.mcnImageCardRightImageContent{
	padding-right:18px !important;
	padding-bottom:0 !important;
	padding-left:18px !important;
	}

}	@media only screen and (max-width: 480px){
	.mcpreview-image-uploader{
	display:none !important;
	width:100% !important;
	}

}	@media only screen and (max-width: 480px){
	/*
	@tab Mobile Styles
	@section Heading 1
	@tip Make the first-level headings larger in size for better readability on small screens.
	*/
	h1{
	/*@editable*/font-size:36px !important;
	/*@editable*/line-height:125% !important;
	}

}	@media only screen and (max-width: 480px){
	/*
	@tab Mobile Styles
	@section Heading 2
	@tip Make the second-level headings larger in size for better readability on small screens.
	*/
	h2{
	/*@editable*/font-size:20px !important;
	/*@editable*/line-height:125% !important;
	}

}	@media only screen and (max-width: 480px){
	/*
	@tab Mobile Styles
	@section Heading 3
	@tip Make the third-level headings larger in size for better readability on small screens.
	*/
	h3{
	/*@editable*/font-size:18px !important;
	/*@editable*/line-height:125% !important;
	}

}	@media only screen and (max-width: 480px){
	/*
	@tab Mobile Styles
	@section Heading 4
	@tip Make the fourth-level headings larger in size for better readability on small screens.
	*/
	h4{
	/*@editable*/font-size:16px !important;
	/*@editable*/line-height:150% !important;
	}

}	@media only screen and (max-width: 480px){
	/*
	@tab Mobile Styles
	@section Boxed Text
	@tip Make the boxed text larger in size for better readability on small screens. We recommend a font size of at least 16px.
	*/
	.mcnBoxedTextContentContainer .mcnTextContent,.mcnBoxedTextContentContainer .mcnTextContent p{
	/*@editable*/font-size:14px !important;
	/*@editable*/line-height:150% !important;
	}

}	@media only screen and (max-width: 480px){
	/*
	@tab Mobile Styles
	@section Preheader Visibility
	@tip Set the visibility of the email`s preheader on small screens. You can hide it to save space.
	*/
	#templatePreheader{
	/*@editable*/display:block !important;
	}

}	@media only screen and (max-width: 480px){
	/*
	@tab Mobile Styles
	@section Preheader Text
	@tip Make the preheader text larger in size for better readability on small screens.
	*/
	#templatePreheader .mcnTextContent,#templatePreheader .mcnTextContent p{
	/*@editable*/font-size:14px !important;
	/*@editable*/line-height:150% !important;
	}

}	@media only screen and (max-width: 480px){
	/*
	@tab Mobile Styles
	@section Header Text
	@tip Make the header text larger in size for better readability on small screens.
	*/
	#templateHeader .mcnTextContent,#templateHeader .mcnTextContent p{
	/*@editable*/font-size:36px !important;
	/*@editable*/line-height:150% !important;
	}

}	@media only screen and (max-width: 480px){
	/*
	@tab Mobile Styles
	@section Body Text
	@tip Make the body text larger in size for better readability on small screens. We recommend a font size of at least 16px.
	*/
	#templateBody .mcnTextContent,#templateBody .mcnTextContent p{
	/*@editable*/font-size:16px !important;
	/*@editable*/line-height:150% !important;
	}

}	@media only screen and (max-width: 480px){
	/*
	@tab Mobile Styles
	@section Column Text
	@tip Make the column text larger in size for better readability on small screens. We recommend a font size of at least 16px.
	*/
	#templateColumns .columnContainer .mcnTextContent,#templateColumns .columnContainer .mcnTextContent p{
	/*@editable*/font-size:16px !important;
	/*@editable*/line-height:150% !important;
	}

}	@media only screen and (max-width: 480px){
	/*
	@tab Mobile Styles
	@section Footer Text
	@tip Make the footer content text larger in size for better readability on small screens.
	*/
	#templateFooter .mcnTextContent,#templateFooter .mcnTextContent p{
	/*@editable*/font-size:14px !important;
	/*@editable*/line-height:150% !important;
	}

}</style></head>
    <body style="height: 100%;margin: 0;padding: 0;width: 100%;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background-color: #1F2934;">
        <center>
            <table align="center" border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="bodyTable" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;height: 100%;margin: 0;padding: 0;width: 100%;background-color: #1F2934;">
                <tr>
                    <td align="center" valign="top" id="bodyCell" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;height: 100%;margin: 0;padding: 0;width: 100%;border-top: 0;">
                        <!-- BEGIN TEMPLATE // -->
                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                            <tr>
	<td align="center" valign="top" id="templatePreheader" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background-color: #ffffff;background-image: none;background-repeat: no-repeat;background-position: center;background-size: cover;border-top: 0;border-bottom: 0;padding-top: 9px;padding-bottom: 9px;">
	<!--[if gte mso 9]>
	<table align="center" border="0" cellspacing="0" cellpadding="0" width="600" style="width:600px;">
	<tr>
	<td align="center" valign="top" width="600" style="width:600px;">
	<![endif]-->
	<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" class="templateContainer" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;max-width: 600px !important;">
	<tr>
                                	<td valign="top" class="preheaderContainer" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;"><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnTextBlock" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
    <tbody class="mcnTextBlockOuter">
        <tr>
            <td valign="top" class="mcnTextBlockInner" style="padding-top: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
              	<!--[if mso]>
	<table align="left" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
	<tr>
	<![endif]-->

	<!--[if mso]>
	<td valign="top" width="390" style="width:390px;">
	<![endif]-->
                <table align="left" border="0" cellpadding="0" cellspacing="0" style="max-width: 390px;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" width="100%" class="mcnTextContentContainer">
                    <tbody><tr>

                        <td valign="top" class="mcnTextContent" style="padding-top: 0;padding-left: 18px;padding-bottom: 9px;padding-right: 18px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;word-break: break-word;color: #656565;font-family: Helvetica;font-size: 12px;line-height: 150%;text-align: left;">

                            Use this area to offer a short preview of your email`s content.
                        </td>
                    </tr>
                </tbody></table>
	<!--[if mso]>
	</td>
	<![endif]-->

	<!--[if mso]>
	<td valign="top" width="210" style="width:210px;">
	<![endif]-->
                <table align="left" border="0" cellpadding="0" cellspacing="0" style="max-width: 210px;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" width="100%" class="mcnTextContentContainer">
                    <tbody><tr>

                        <td valign="top" class="mcnTextContent" style="padding-top: 0;padding-left: 18px;padding-bottom: 9px;padding-right: 18px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;word-break: break-word;color: #656565;font-family: Helvetica;font-size: 12px;line-height: 150%;text-align: left;">

                            <a href="*|ARCHIVE|*" target="_blank" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;color: #656565;font-weight: normal;text-decoration: underline;">View this email in your browser</a>
                        </td>
                    </tr>
                </tbody></table>
	<!--[if mso]>
	</td>
	<![endif]-->

	<!--[if mso]>
	</tr>
	</table>
	<![endif]-->
            </td>
        </tr>
    </tbody>
</table></td>
	</tr>
	</table>
	<!--[if gte mso 9]>
	</td>
	</tr>
	</table>
	<![endif]-->
	</td>
                            </tr>
	<tr>
	<td align="center" valign="top" id="templateHeader" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background-color: #000000;background-image: none;background-repeat: no-repeat;background-position: center;background-size: cover;border-top: 0;border-bottom: 0;padding-top: 40px;padding-bottom: 40px;">
	<!--[if gte mso 9]>
	<table align="center" border="0" cellspacing="0" cellpadding="0" width="600" style="width:600px;">
	<tr>
	<td align="center" valign="top" width="600" style="width:600px;">
	<![endif]-->
	<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" class="templateContainer" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;max-width: 600px !important;">
	<tr>
                                	<td valign="top" class="headerContainer" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;"><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnTextBlock" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
    <tbody class="mcnTextBlockOuter">
        <tr>
            <td valign="top" class="mcnTextBlockInner" style="padding-top: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
              	<!--[if mso]>
	<table align="left" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
	<tr>
	<![endif]-->

	<!--[if mso]>
	<td valign="top" width="600" style="width:600px;">
	<![endif]-->
                <table align="left" border="0" cellpadding="0" cellspacing="0" style="max-width: 100%;min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" width="100%" class="mcnTextContentContainer">
                    <tbody><tr>

                        <td valign="top" class="mcnTextContent" style="padding-top: 0;padding-right: 18px;padding-bottom: 9px;padding-left: 18px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;word-break: break-word;color: #ffffff;font-family: `Helvetica Neue`, Helvetica, Arial, Verdana, sans-serif;font-size: 60px;line-height: 150%;text-align: left;">

                            <div style="text-align: center;">PROJECT SOCIAL&nbsp;</div>

                        </td>
                    </tr>
                </tbody></table>
	<!--[if mso]>
	</td>
	<![endif]-->

	<!--[if mso]>
	</tr>
	</table>
	<![endif]-->
            </td>
        </tr>
    </tbody>
</table></td>
	</tr>
	</table>
	<!--[if gte mso 9]>
	</td>
	</tr>
	</table>
	<![endif]-->
	</td>
                            </tr>
	<tr>
	<td align="center" valign="top" id="templateBody" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background-color: #ffffff;background-image: none;background-repeat: no-repeat;background-position: center;background-size: cover;border-top: 0;border-bottom: 0;padding-top: 20px;padding-bottom: 20px;">
	<!--[if gte mso 9]>
	<table align="center" border="0" cellspacing="0" cellpadding="0" width="600" style="width:600px;">
	<tr>
	<td align="center" valign="top" width="600" style="width:600px;">
	<![endif]-->
	<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" class="templateContainer" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;max-width: 600px !important;">
	<tr>
                                	<td valign="top" class="bodyContainer" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;"><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnTextBlock" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
    <tbody class="mcnTextBlockOuter">
        <tr>
            <td valign="top" class="mcnTextBlockInner" style="padding-top: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
              	<!--[if mso]>
	<table align="left" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
	<tr>
	<![endif]-->

	<!--[if mso]>
	<td valign="top" width="600" style="width:600px;">
	<![endif]-->
                <table align="left" border="0" cellpadding="0" cellspacing="0" style="max-width: 100%;min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" width="100%" class="mcnTextContentContainer">
                    <tbody><tr>

                        <td valign="top" class="mcnTextContent" style="padding-top: 0;padding-right: 18px;padding-bottom: 9px;padding-left: 18px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;word-break: break-word;color: #666666;font-family: Georgia, Times, `Times New Roman`, serif;font-size: 16px;line-height: 150%;text-align: center;">

                            <h2 style="display: block;margin: 0;padding: 0;color: #202020;font-family: Helvetica;font-size: 24px;font-style: normal;font-weight: bold;line-height: 150%;letter-spacing: normal;text-align: center;">WELCOME *|FNAME|*</h2>

<p style="margin: 10px 0;padding: 0;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;color: #666666;font-family: Georgia, Times, `Times New Roman`, serif;font-size: 16px;line-height: 150%;text-align: center;">Thank you for your joining Project Social. Please confirm your acccount <a href="https://dev.avocadoandtoast.com/confirmation?q='.$link.'" class="confirmation-link" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;color: #888888;font-weight: normal;text-decoration: underline;"> HERE. </a><br>
<br>
I appreciate you taking the time to sign up for&nbsp;our tool that will&nbsp;provide you with realistic pricing for the influencers you want to work with.&nbsp;Here are some additional resources that you can use to get the most out of Project Social!<br>
&nbsp;</p>
- Choose your influencers and create &nbsp;your first campaign <a href="http://here " target="_blank" title="here " style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;color: #888888;font-weight: normal;text-decoration: underline;">here </a>&nbsp;<br>
&nbsp;-Price the campaign once you have chosen your &nbsp;desired influencers <a href="http://www.google.com" target="_blank" title="here" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;color: #888888;font-weight: normal;text-decoration: underline;">here</a><br>
- Gather your favorite influencers before creating a campaign <a href="http://www.google.com" target="_blank" title="HERE " style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;color: #888888;font-weight: normal;text-decoration: underline;">here&nbsp;</a>

<p style="margin: 10px 0;padding: 0;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;color: #666666;font-family: Georgia, Times, `Times New Roman`, serif;font-size: 16px;line-height: 150%;text-align: center;"><br>
If you have any questions our support team is available to help&nbsp;<a href="mailto:support@projectsocial.com?subject=Support%20Question%20Project%20Social%20" target="_blank" title="you " style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;color: #888888;font-weight: normal;text-decoration: underline;">support@projectsocial.com</a></p>

<p style="margin: 10px 0;padding: 0;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;color: #666666;font-family: Georgia, Times, `Times New Roman`, serif;font-size: 16px;line-height: 150%;text-align: center;">Sincerely,<br>
Project Social Team&nbsp;<br>
&nbsp;</p>

                        </td>
                    </tr>
                </tbody></table>
	<!--[if mso]>
	</td>
	<![endif]-->

	<!--[if mso]>
	</tr>
	</table>
	<![endif]-->
            </td>
        </tr>
    </tbody>
</table></td>
	</tr>
	</table>
	<!--[if gte mso 9]>
	</td>
	</tr>
	</table>
	<![endif]-->
	</td>
                            </tr>
	<tr>
	<td align="center" valign="top" id="templateColumns" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background-color: #6d7d81;background-image: none;background-repeat: no-repeat;background-position: center;background-size: cover;border-top: 0;border-bottom: 0;padding-top: 220px;padding-bottom: 50px;">
	<table border="0" cellpadding="0" cellspacing="0" width="100%" class="templateContainer" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;max-width: 600px !important;">
                                        <tr>
                                            <td valign="top" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
	<!--[if gte mso 9]>
	<table align="center" border="0" cellspacing="0" cellpadding="0" width="600" style="width:600px;">
	<tr>
	<td align="center" valign="top" width="200" style="width:200px;">
	<![endif]-->
	<table align="left" border="0" cellpadding="0" cellspacing="0" width="200" class="columnWrapper" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
	<tr>
	<td valign="top" class="columnContainer" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;"><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnImageCardBlock" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
    <tbody class="mcnImageCardBlockOuter">
        <tr>
            <td class="mcnImageCardBlockInner" valign="top" style="padding-top: 9px;padding-right: 18px;padding-bottom: 9px;padding-left: 18px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">



<table align="right" border="0" cellpadding="0" cellspacing="0" class="mcnImageCardTopContent" width="100%" style="background-color: #FFFFFF;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
    <tbody><tr>
        <td class="mcnTextContent" valign="top" style="padding: 18px 18px 0px;color: #202020;font-size: 9px;text-align: center;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;word-break: break-word;font-family: Helvetica;line-height: 200%;" width="146">
            <h3 style="display: block;margin: 0;padding: 0;color: #989898;font-family: Helvetica;font-size: 24px;font-style: normal;font-weight: bold;line-height: 150%;letter-spacing: normal;text-align: center;">01</h3>

<h4 style="display: block;margin: 0;padding: 0;color: #202020;font-family: Helvetica;font-size: 18px;font-style: normal;font-weight: bold;line-height: 200%;letter-spacing: normal;text-align: center;">BLOG</h4>

        </td>
    </tr>
    <tr>
        <td class="mcnImageCardTopImageContent" align="center" valign="top" style="padding-top: 9px;padding-right: 0px;padding-bottom: 0px;padding-left: 0px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">



            <img alt="" src="https://gallery.mailchimp.com/bb1e624c1a86ff7a7fe97f3b0/images/18ed6017-162e-4bae-960d-278a03e9f2a8.jpg" width="164" style="max-width: 564px;border: 0;height: auto;outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;vertical-align: bottom;" class="mcnImage">



        </td>
    </tr>
</tbody></table>


            </td>
        </tr>
    </tbody>
</table></td>
	</tr>
	</table>
	<!--[if gte mso 9]>
	</td>
	<td align="center" valign="top" width="200" style="width:200px;">
	<![endif]-->
	<table align="left" border="0" cellpadding="0" cellspacing="0" width="200" class="columnWrapper" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
	<tr>
	<td valign="top" class="columnContainer" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;"><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnImageCardBlock" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
    <tbody class="mcnImageCardBlockOuter">
        <tr>
            <td class="mcnImageCardBlockInner" valign="top" style="padding-top: 9px;padding-right: 18px;padding-bottom: 9px;padding-left: 18px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">



<table align="right" border="0" cellpadding="0" cellspacing="0" class="mcnImageCardTopContent" width="100%" style="background-color: #FFFFFF;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
    <tbody><tr>
        <td class="mcnTextContent" valign="top" style="padding: 18px 18px 0px;color: #202020;font-size: 9px;text-align: center;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;word-break: break-word;font-family: Helvetica;line-height: 200%;" width="146">
            <h3 style="display: block;margin: 0;padding: 0;color: #989898;font-family: Helvetica;font-size: 24px;font-style: normal;font-weight: bold;line-height: 150%;letter-spacing: normal;text-align: center;">02</h3>

<h4 style="display: block;margin: 0;padding: 0;color: #202020;font-family: Helvetica;font-size: 18px;font-style: normal;font-weight: bold;line-height: 200%;letter-spacing: normal;text-align: center;">BLOG</h4>

        </td>
    </tr>
    <tr>
        <td class="mcnImageCardTopImageContent" align="center" valign="top" style="padding-top: 9px;padding-right: 0px;padding-bottom: 0px;padding-left: 0px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">



            <img alt="" src="https://gallery.mailchimp.com/bb1e624c1a86ff7a7fe97f3b0/images/cb96c6ac-b1b4-43f7-b3d5-c77b304381d5.jpg" width="164" style="max-width: 564px;border: 0;height: auto;outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;vertical-align: bottom;" class="mcnImage">



        </td>
    </tr>
</tbody></table>


            </td>
        </tr>
    </tbody>
</table></td>
	</tr>
	</table>
	<!--[if gte mso 9]>
	</td>
	<td align="center" valign="top" width="200" style="width:200px;">
	<![endif]-->
	<table align="left" border="0" cellpadding="0" cellspacing="0" width="200" class="columnWrapper" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
	<tr>
	<td valign="top" class="columnContainer" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;"><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnImageCardBlock" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
    <tbody class="mcnImageCardBlockOuter">
        <tr>
            <td class="mcnImageCardBlockInner" valign="top" style="padding-top: 9px;padding-right: 18px;padding-bottom: 9px;padding-left: 18px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">



<table align="right" border="0" cellpadding="0" cellspacing="0" class="mcnImageCardTopContent" width="100%" style="background-color: #FFFFFF;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
    <tbody><tr>
        <td class="mcnTextContent" valign="top" style="padding: 18px 18px 0px;color: #202020;font-size: 9px;text-align: center;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;word-break: break-word;font-family: Helvetica;line-height: 200%;" width="146">
            <h3 style="display: block;margin: 0;padding: 0;color: #989898;font-family: Helvetica;font-size: 24px;font-style: normal;font-weight: bold;line-height: 150%;letter-spacing: normal;text-align: center;">03</h3>

<h4 style="display: block;margin: 0;padding: 0;color: #202020;font-family: Helvetica;font-size: 18px;font-style: normal;font-weight: bold;line-height: 200%;letter-spacing: normal;text-align: center;">BLOG</h4>

        </td>
    </tr>
    <tr>
        <td class="mcnImageCardTopImageContent" align="center" valign="top" style="padding-top: 9px;padding-right: 0px;padding-bottom: 0px;padding-left: 0px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">



            <img alt="" src="https://gallery.mailchimp.com/bb1e624c1a86ff7a7fe97f3b0/images/fd6eb1aa-32b8-43a5-9abb-e1c58ce453da.jpg" width="164" style="max-width: 564px;border: 0;height: auto;outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;vertical-align: bottom;" class="mcnImage">



        </td>
    </tr>
</tbody></table>


            </td>
        </tr>
    </tbody>
</table></td>
	</tr>
	</table>
	<!--[if gte mso 9]>
	</td>
	</tr>
	</table>
	<![endif]-->
	</td>
	</tr>
	</table>
	</td>
                            </tr>
                            <tr>
	<td align="center" valign="top" id="templateFooter" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;background-color: #1f2934;background-image: none;background-repeat: no-repeat;background-position: center;background-size: cover;border-top: 0;border-bottom: 0;padding-top: 60px;padding-bottom: 60px;">
	<!--[if gte mso 9]>
	<table align="center" border="0" cellspacing="0" cellpadding="0" width="600" style="width:600px;">
	<tr>
	<td align="center" valign="top" width="600" style="width:600px;">
	<![endif]-->
	<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" class="templateContainer" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;max-width: 600px !important;">
	<tr>
                                	<td valign="top" class="footerContainer" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;"><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnFollowBlock" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
    <tbody class="mcnFollowBlockOuter">
        <tr>
            <td align="center" valign="top" style="padding: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" class="mcnFollowBlockInner">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnFollowContentContainer" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
    <tbody><tr>
        <td align="center" style="padding-left: 9px;padding-right: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" class="mcnFollowContent">
                <tbody><tr>
                    <td align="center" valign="top" style="padding-top: 9px;padding-right: 9px;padding-left: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                        <table align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                            <tbody><tr>
                                <td align="center" valign="top" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                    <!--[if mso]>
                                    <table align="center" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                    <![endif]-->

                                        <!--[if mso]>
                                        <td align="center" valign="top">
                                        <![endif]-->


                                            <table align="left" border="0" cellpadding="0" cellspacing="0" style="display: inline;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                <tbody><tr>
                                                    <td valign="top" style="padding-right: 10px;padding-bottom: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" class="mcnFollowContentItemContainer">
                                                        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnFollowContentItem" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                            <tbody><tr>
                                                                <td align="left" valign="middle" style="padding-top: 5px;padding-right: 10px;padding-bottom: 5px;padding-left: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                                    <table align="left" border="0" cellpadding="0" cellspacing="0" width="" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                                        <tbody><tr>

                                                                                <td align="center" valign="middle" width="24" class="mcnFollowIconContent" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                                                    <a href="http://www.facebook.com/" target="_blank" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;"><img src="https://cdn-images.mailchimp.com/icons/social-block-v2/light-facebook-48.png" style="display: block;border: 0;height: auto;outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;" height="24" width="24" class=""></a>
                                                                                </td>


                                                                        </tr>
                                                                    </tbody></table>
                                                                </td>
                                                            </tr>
                                                        </tbody></table>
                                                    </td>
                                                </tr>
                                            </tbody></table>

                                        <!--[if mso]>
                                        </td>
                                        <![endif]-->

                                        <!--[if mso]>
                                        <td align="center" valign="top">
                                        <![endif]-->


                                            <table align="left" border="0" cellpadding="0" cellspacing="0" style="display: inline;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                <tbody><tr>
                                                    <td valign="top" style="padding-right: 10px;padding-bottom: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" class="mcnFollowContentItemContainer">
                                                        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnFollowContentItem" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                            <tbody><tr>
                                                                <td align="left" valign="middle" style="padding-top: 5px;padding-right: 10px;padding-bottom: 5px;padding-left: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                                    <table align="left" border="0" cellpadding="0" cellspacing="0" width="" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                                        <tbody><tr>

                                                                                <td align="center" valign="middle" width="24" class="mcnFollowIconContent" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                                                    <a href="http://www.twitter.com/" target="_blank" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;"><img src="https://cdn-images.mailchimp.com/icons/social-block-v2/light-twitter-48.png" style="display: block;border: 0;height: auto;outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;" height="24" width="24" class=""></a>
                                                                                </td>


                                                                        </tr>
                                                                    </tbody></table>
                                                                </td>
                                                            </tr>
                                                        </tbody></table>
                                                    </td>
                                                </tr>
                                            </tbody></table>

                                        <!--[if mso]>
                                        </td>
                                        <![endif]-->

                                        <!--[if mso]>
                                        <td align="center" valign="top">
                                        <![endif]-->


                                            <table align="left" border="0" cellpadding="0" cellspacing="0" style="display: inline;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                <tbody><tr>
                                                    <td valign="top" style="padding-right: 10px;padding-bottom: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" class="mcnFollowContentItemContainer">
                                                        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnFollowContentItem" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                            <tbody><tr>
                                                                <td align="left" valign="middle" style="padding-top: 5px;padding-right: 10px;padding-bottom: 5px;padding-left: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                                    <table align="left" border="0" cellpadding="0" cellspacing="0" width="" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                                        <tbody><tr>

                                                                                <td align="center" valign="middle" width="24" class="mcnFollowIconContent" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                                                    <a href="http://www.instagram.com/" target="_blank" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;"><img src="https://cdn-images.mailchimp.com/icons/social-block-v2/light-instagram-48.png" style="display: block;border: 0;height: auto;outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;" height="24" width="24" class=""></a>
                                                                                </td>


                                                                        </tr>
                                                                    </tbody></table>
                                                                </td>
                                                            </tr>
                                                        </tbody></table>
                                                    </td>
                                                </tr>
                                            </tbody></table>

                                        <!--[if mso]>
                                        </td>
                                        <![endif]-->

                                        <!--[if mso]>
                                        <td align="center" valign="top">
                                        <![endif]-->


                                            <table align="left" border="0" cellpadding="0" cellspacing="0" style="display: inline;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                <tbody><tr>
                                                    <td valign="top" style="padding-right: 0;padding-bottom: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" class="mcnFollowContentItemContainer">
                                                        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnFollowContentItem" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                            <tbody><tr>
                                                                <td align="left" valign="middle" style="padding-top: 5px;padding-right: 10px;padding-bottom: 5px;padding-left: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                                    <table align="left" border="0" cellpadding="0" cellspacing="0" width="" style="border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                                        <tbody><tr>

                                                                                <td align="center" valign="middle" width="24" class="mcnFollowIconContent" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
                                                                                    <a href="http://mailchimp.com" target="_blank" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;"><img src="https://cdn-images.mailchimp.com/icons/social-block-v2/light-link-48.png" style="display: block;border: 0;height: auto;outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;" height="24" width="24" class=""></a>
                                                                                </td>


                                                                        </tr>
                                                                    </tbody></table>
                                                                </td>
                                                            </tr>
                                                        </tbody></table>
                                                    </td>
                                                </tr>
                                            </tbody></table>

                                        <!--[if mso]>
                                        </td>
                                        <![endif]-->

                                    <!--[if mso]>
                                    </tr>
                                    </table>
                                    <![endif]-->
                                </td>
                            </tr>
                        </tbody></table>
                    </td>
                </tr>
            </tbody></table>
        </td>
    </tr>
</tbody></table>

            </td>
        </tr>
    </tbody>
</table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnTextBlock" style="min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
    <tbody class="mcnTextBlockOuter">
        <tr>
            <td valign="top" class="mcnTextBlockInner" style="padding-top: 9px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;">
              	<!--[if mso]>
	<table align="left" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;">
	<tr>
	<![endif]-->

	<!--[if mso]>
	<td valign="top" width="600" style="width:600px;">
	<![endif]-->
                <table align="left" border="0" cellpadding="0" cellspacing="0" style="max-width: 100%;min-width: 100%;border-collapse: collapse;mso-table-lspace: 0pt;mso-table-rspace: 0pt;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;" width="100%" class="mcnTextContentContainer">
                    <tbody><tr>

                        <td valign="top" class="mcnTextContent" style="padding-top: 0;padding-right: 18px;padding-bottom: 9px;padding-left: 18px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;word-break: break-word;color: #FFFFFF;font-family: Helvetica;font-size: 12px;line-height: 150%;text-align: center;">

                            <em>Copyright © *|CURRENT_YEAR|* *|LIST:COMPANY|*, All rights reserved.</em>
<br>
*|IFNOT:ARCHIVE_PAGE|*
    *|LIST:DESCRIPTION|*
    <br>
    <br>
    <strong>Our mailing address is:</strong>
    <br>
    *|HTML:LIST_ADDRESS_HTML|* *|END:IF|*
    <br>
    <br>
	Want to change how you receive these emails?<br>
    You can <a href="*|UPDATE_PROFILE|*" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;color: #FFFFFF;font-weight: normal;text-decoration: underline;">update your preferences</a> or <a href="*|UNSUB|*" style="mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%;color: #FFFFFF;font-weight: normal;text-decoration: underline;">unsubscribe from this list</a>
    <br>
    <br>
    *|IF:REWARDS|* *|HTML:REWARDS|*
*|END:IF|*
                        </td>
                    </tr>
                </tbody></table>
	<!--[if mso]>
	</td>
	<![endif]-->

	<!--[if mso]>
	</tr>
	</table>
	<![endif]-->
            </td>
        </tr>
    </tbody>
</table></td>
	</tr>
	</table>
	<!--[if gte mso 9]>
	</td>
	</tr>
	</table>
	<![endif]-->
	</td>
                            </tr>
                        </table>
                        <!-- // END TEMPLATE -->
                    </td>
                </tr>
            </table>
        </center>
    </body>
</html>
';
  return $html;

}


}
