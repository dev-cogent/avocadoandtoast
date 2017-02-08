
<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
  <?php include 'includes/head.php' ?>
  <style>
  @media (max-width:960px){
  #centercontent{
    padding-right: 0% !important; 
    padding-left: 0% !important;
  }
}
  #centercontent{
    padding-right:27%; 
    padding-left:27%;
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
</style>
    <title>Confirmation | Project Social</title>
<script src="/bootbox/bootbox.js"></script>
<script src="/includes/javascript/savecampaign.js"></script>
<script src="/includes/javascript/addtolist.js"></script>
<script src="/global/vendor/bootstrap/bootstrap.js"></script>
</head>
<body class=" ">
  <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
   <?php include 'includes/nav.php' ?>
   <div class="p-b-50"></div>
   <div class="container"> 

   <h1 style="text-align:center;"> Confirmation </h1>
    <div id="centercontent" style="text-align:center;">
       <i class="icon wb-envelope" aria-hidden="true" style="font-size:112px; padding-bottom:20px; padding-top:30px;"></i>
       <br/>
       <p style="text-align:center; display:inline; word-spacing:3px; font-size:15px;"> Please check your inbox to confirm your email.</p>
    
        <div id="resend" style="padding-top:5%; ">
          <a href="/login.php" style="text-decoration:none;"> <button class="form-control" style="border:none; width:72%; height:50px; background-color:rgb(249,44,72); color:white; margin-bottom:30px; cursor:pointer; margin-left:14%; "> LOGIN </button></a>
      </div>
      <div  style="padding-bottom:10px; ">
          <p style="text-decoration:none;">Didn't recieve a confirmation email? <a href="/resend.php" style="text-decoration: underline; color: rgba(58, 65, 93, 1); font-weight:bold;">Click here</a> </p>
      </div>


   </div>
   

   </div>

   <div style="padding-bottom:100px;"></div>


     <?php include 'includes/footer.php' ?>



</body>
</html>
