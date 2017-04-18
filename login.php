<?php
session_start();
session_destroy();
unset($_SESSION);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
include 'php/verify.php';

}

?>
<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
<style>
#email{
    height:30px;
}
#email:focus{
    outline:none;
}
#spacing{
    width:100%;
    height:100px;
}

.login-form{
    margin-top:100px;

}

#login-button{
border:none; 
width:72%; 
height:50px; 
background-color:#73C48D;
color:white; 
margin-bottom:30px; 
cursor:pointer; 
margin-left:14%; 
float:left;
font-family: 'Montserrat', sans-serif;
font-size: 16px;
border-radius:0px;
}

#register-button{
border:1px solid #1F232A; 
width:72%; 
height:50px; 
color:#1F232A; 
cursor:pointer; 
margin-left:14%;
font-family: 'Montserrat', sans-serif;
font-size: 16px;
border-radius:0px;
}

#register-button:hover{
    border:1px solid #73C48D;
    color:#73C48D;
}
  @media (max-width:960px){
  #centercontent{
    padding-right: 0% !important; 
    padding-left: 0% !important;
  }
}
  #centercontent{
    padding-right:27%; 
    padding-left:27%;
    padding-top:50px;
  }
  #footer {
   position:absolute;
   bottom:0;
   width:100%;
   height:60px;   /* Height of the footer */
   background:#6cf;
}
#agency{
    display: inline;
    border-right: 1px solid rgb(226,225,229);
    border-left: 1px solid rgb(226,225,229);
    border-top: 1px solid rgb(226,225,229);
    border-radius:2px;
    padding-right: 9.5%;
    padding-left: 9.5%;
    padding-top: 1.7%;
    padding-bottom:1.7%;
  
}
#influencer{
    display: inline;
    border-right: 1px solid rgb(226,225,229);
    border-top: 1px solid rgb(226,225,229);
    border-left:1px solid rgb(226,225,229);
    border-radius:2px;
    padding-right: 9.5%;
    padding-left: 9.5%;
    padding-top: 1.7%; 
    padding-bottom:1.7%;
}
::-webkit-input-placeholder { /* Chrome/Opera/Safari */
  color: #c4c4c4 !important;
}

#header-text{
    text-align:center; 
    font-family:'Montserrat', sans-serif; 
    color:#515862; 
    letter-spacing: 2px; 
    font-size:55px; 
    padding-bottom:50px; 
    padding-top:25px;
}

@media screen and (max-width:480px){
    #header-text{
    text-align:center; 
    font-family:'Montserrat', sans-serif; 
    color:#515862; 
    letter-spacing: 2px; 
    font-size:25px; 
    padding-bottom:50px; 
    padding-top:50px;
}

    #icon{
        height:90px;
        width:97px;
    }


}

</style>
  <?php include 'html/head.html' ?>
    <title>Login | Avocado & Toast</title>
<script src="/bootbox/bootbox.js"></script>
<script src="/global/vendor/bootstrap/bootstrap.js"></script>
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700|Open+Sans:400,700" rel="stylesheet">
<script src="/assets/wnumb/wNumb.js"></script>
<script src="/assets/uislider/nouislider.js"></script>
<link rel="stylesheet" href="/assets/uislider/nouislider.css">
<link rel="stylesheet" href="/global/fonts/brand-icons/brand-icons.css">
<link rel="stylesheet" href="/global/fonts/font-awesome/font-awesome.css">
<link rel="stylesheet" href="/assets/css/discover.css">

</head>

<body class="col-xs-12" style="padding-left:0px;padding-right:0px;">
    <div class="col-xs-12" style="border-top: 1px solid rgb(210,215,220); border-bottom:1px solid white; height:66px; background-color:#f7f7f7;">
       <img src="/assets/images/at-logo-black.png" style="margin-top:-8px;">

</div>


<!-- logo goes here -->
<div id="spacing"></div>
<div class="col-xs-1 col-xl-4" style="height: 100%;margin-top: -35px;background-color: #f7f7f7;"></div>
<div class="col-xs-10 col-xl-4"> 

<div style="text-align:center; padding-top:30px;"> <img id="icon" src="/assets/images/avocado.png"></div>
    <h1 id="header-text"> SIGN IN </h1>
        <div style="text-align:center;">
                <form method="POST" action="">
                <input style="width:72%; height:50px; margin-left:14%; text-transform:none; "type="email" class="avocado-focus form-control m-b-30"  name="email"    placeholder="Email">
                <input style="width:72%; height:50px; margin-left:14%; text-transform:none; "type="password" class="avocado-focus form-control m-b-30"  name="password" placeholder="Password">
                <p style="font-size:10px; float:left; margin-left:14%;"><strong style="text-decoration: underline; color:#1F232A">FORGOT PASSWORD</strong> </p>
                <br/>
                <button class="form-control" id="login-button"> SIGN IN </button>
                </form>
                <a href="/signup.php" style="text-decoration:none;"><button class="form-control" id="register-button" > REGISTER </button></a>
    </div>
</div>

<div class="col-xs-1 col-xl-4" style="height: 100%;margin-top: -35px;background-color: #f7f7f7;"></div>




</body>
</html>
