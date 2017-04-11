<!DOCTYPE html>
<head>
  <?php include 'php/head.php' ?>
    <title>Avocado & Toast</title>
</head>


  <header class="header avocado-header">


    <!--test -->
      <!-- <div class="container-fluid avocado-container"> -->
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="row avocado-row">

        <nav class="navbar">
            <div class="container-fluid">
                <div class="navbar-header">
                   <a class="navbar-brand" href="/"><img src="assets/images/at-logo-black.png" class="logo-nav-index"> </a>
             <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse" aria-expanded="false">
               <span class="sr-only"> Toggle Navigation </span>
                      <span class="icon-bar"> </span>
                        <span class="icon-bar"> </span>
                      <i class="icon wb-menu" style=""></i>
                          <span class="icon-bar"> </span>
             </button>
           </div>



   <div class="collapse navbar-collapse" id="myNavBar">
      <ul class="nav navbar-nav avocado-ul center-ul">
          <li class="nav-href"><a href="#" class="main-nav-dark"> Influencers </li>
          <li class="nav-href"><a href="/agency.php" class="main-nav-dark"> Agencies </li>
          <li class="nav-href"><a href="#" class="about-us main-nav-dark"> About Us </li>
          </ul>

      <ul class="nav navbar-nav navbar-right login-sect">
          <li class="login border-dark"> <a href="/login.php" class="login-nav main-nav-dark"> LOGIN </a> </li>
        </ul>

      </div>
    </div>
  </nav>


</div>
</div>
</header>
<body class=" ">
  <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
   <div class="p-b-50"></div>
   <div class="container" style="padding-top:100px;"> 

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


     <?php include 'php/footer.php' ?>



</body>
</html>
