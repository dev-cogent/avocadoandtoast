<?php 
if($_SERVER['REQUEST_METHOD'] === 'POST') {
include 'includes/sendconfirmation.php';
}
?>
<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
  <?php include 'includes/head.php' ?>
  <style>
  .error{
      color:red;
  }
  .success{
      color:green;
  }
  .secondarybutton{
  border:none; 
  width:72%; 
  height:50px; 
  background-color:white; 
  color:rgb(23,38,76);
  margin-bottom:30px; 
  cursor:pointer; 
  margin-left:14%; 
  border:1px solid rgb(226,225,229);    
  
  }
  button:hover{
      color:black;
  }

  .mainbutton{
  border:none; 
  width:72%; 
  height:50px; 
  background-color:rgb(249,44,72); 
  color:white; 
  margin-bottom:30px; 
  cursor:pointer; 
  margin-left:14%;    
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


<body>

   <?php include 'includes/nav.php' ?>
   <div class="p-b-50"></div>

   <div class="container"> 

    <h1 style="text-align:center;"> Resend Email Confirmation </h1>

            <div id="centercontent" style="text-align:center;">

                        <p> Please provide your email below and a new confirmation link will be sent to you.</p>
                        <?php 
                        if(isset($message)){
                            echo $message;
                        }
                        ?>
                        <form method="POST" action="#"> 
                        <input style="width:72%; height:50px; margin-left:14%; margin-top:10%;"type="email" class="form-control" id="inputPlaceholder" name="email" placeholder="Email">

                        <div id="resend" style="padding-top:5%; ">
                             <button class="form-control secondarybutton" type="submit" name="send"> Re-Send Email </button>
                        </div>
                        </form>
                        <div id="resend" style="padding-top:5%; ">
                            <a href="/login.php" style="text-decoration:none;"> <button class="form-control mainbutton" style="width:40%; margin-left:30%;"> LOGIN </button></a>
                        </div>
          </div>
   
 </div>





<div style="padding-bottom:100px;"></div>


     <?php include 'includes/footer.php' ?>



</body>
</html>
