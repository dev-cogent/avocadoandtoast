<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
include 'php/registerinfo.php';
}

?>
<!DOCTYPE html>
<head>
  <?php include 'html/head.html' ?>
    <title>Sign Up | Avocado & Toast</title>

</head>


  <header class="header avocado-header">


<div class="row avocado-row">


<nav class="navbar">
    <div class="container-fluid">

        <div class="navbar-header">
           <a class="navbar-brand" href="/index.php"><img src="assets/images/at-logo-black.png" class="logo-nav-index"> </a>
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

<div class="container-fluid signup">
  <div class="row">
    <div class="col-xs-12 signup-col">
        <div class="signup-header"> SIGN UP NOW </div>
          <div class="signup-subheader"> ARE YOU A BRAND OR BUSINESS? <br>
            IT'S TIME TO PUT SOME AVOCADO ON YOUR TOAST </div>
    </div>
  </div>
<form method="POST" action="">
  <div class="row signup-form">
          <div class="col-xs-6 form-col">
                <div class="input-group name">
                    <span class=""><i class="glyphicon glyphicon-user mycolor"></i><p id="first-error" style="display:inline; color:#ff5151; visibility:hidden;">First name must be filled out.</p></span>
                      <input size="60" maxlength="255" class="form-control avocado-focus " style="color:#515862;" placeholder="FIRST NAME*" id="field" type="text" name="firstname">
                  </div>

                  <div class="input-group email">
                    <span class=""><i class="glyphicon glyphicon-user mycolor"></i><p id="email-error" style="display:inline; color:#ff5151; visibility:hidden;">Please enter a valid email </p></span>
                    <input size="60" maxlength="255" class="form-control avocado-focus " placeholder="EMAIL*"  id="field" type="email" name="email">
                  </div>

                  <div class="input-group password">
                      <span class=""><i class="glyphicon glyphicon-user mycolor"></i><p id="password-error" style="display:inline; color:#ff5151; visibility:hidden;">Password Must be at least 6 characters long  </p></span>
                        <input data-toggle="tooltip" data-placement="right" data-trigger="click" data-original-title="Click to tooltip"  size="60" maxlength="255" class="form-control avocado-focus password" placeholder="PASSWORD*"  id="field" type="password" name="password">
                    </div>
                </div>

                <div class="col-xs-6 form-col">
                      <div class="input-group password">
                          <span class=""><i class="glyphicon glyphicon-user mycolor"></i><p id="last-error" style="display:inline; color:#ff5151; visibility:hidden;">Last Name must be filled out </p></span>
                            <input size="60" maxlength="255" class="form-control avocado-focus " placeholder="LAST NAME*"  id="field" type="text" name="lastname">
                        </div>

                        <div class="input-group">
                          <span class=""><i class="glyphicon glyphicon-user mycolor"></i><p id="company" style="display:inline; color:#ff5151; visibility:hidden;">Company Must be filled out </p></span>
                          <input size="60" maxlength="255" class="form-control avocado-focus " placeholder="COMPANY*" name="company" id="field" >
                        </div>

                        <div class="input-group password">
                            <span class=""><i class="glyphicon glyphicon-user mycolor"></i><p id="confirm-error" style="display:inline; color:#ff5151; visibility:hidden;">Passwords do not match</p></span>
                              <input size="60" maxlength="255" class="form-control avocado-focus " placeholder="VERIFY PASSWORD*" name="confirm" id="field" type="password">
                          </div>
                      </div>
  </div>

    <div class="row signup-btn-row">


              <div class="col-sm-4">

                  </div>

                  <div class="col-sm-4 signup-btn-col">
                      <div class="started-btn-div">
                          <button class="get-started-btn" type="submit">  GET STARTED
                          </button>
                        </div>
                      </div>

                  <div class="col-sm-4">

                      </div>
  </div>
</form>


</div>

</div>


<footer class="avocado-footer">
    <div class="container">
      <div class="row">
        <div class="col-xs-3">
            <ul class="nav nav-pills nav-stacked">
                <li class="footer-title"> Who are you? </li>
                  <li class="footer-links"> Agencies </li>
                  <li class="footer-links"> Influencers </li>
                </ul>
              </div>

              <div class="col-xs-3">
                  <ul class="nav nav-pills nav-stacked">
                      <li class="footer-title"> Quick links </li>
                        <li class="footer-links"> The Global Hype </li>
                        <li class="footer-links"> About us </li>
                        <li class="footer-links"> Login </li>
                      </ul>
                    </div>

          <div class="col-xs-3">
            <ul class="nav nav-pills nav-stacked">
                <li class="footer-title"> Sales </li>
                  <li class="footer-links sales"> Sales@AvocadoandToast.com </li>
                  <li class="footer-links"> 917.243.4354</li>
                </ul>
              </div>


              <div class="col-xs-3">
                <ul class="nav nav-pills nav-stacked">
                    <li class="footer-title"> Support </li>
                      <li class="footer-links support"> Support@AvocadoandToast.com </li>
                      <li class="footer-links"> 917.454.3645 </li>
                    </ul>
                  </div>

        </div>             <!-- first row on footer ends -->

        <div class="row">
            <div class="col-xs-8">
              <ul class="nav nav-pills nav-stacked">
                <li class="footer-offices-title"> Our Offices </li>
                <li class="footer-office">
                   <img src="assets/images/newyorkmap.png" class="newyork-map">
                   <div class="office-loc">  <h6 class="new-york"> New York </h6> </br>  <div class="address">150 5th Ave </br> New York, NY 10011 </div> </div> </li>
              </ul>
            </div>

            <div class="col-xs-4">
              <ul class="nav nav-pills nav-stacked">
                <li class="footer-title">  </li>
                <li class="footer-office">  </li>
              </ul>
            </div>



          </div>


      </div>      <!-- foooter container ends  -->


    </footer>

<script src="/assets/js/signup.js"></script>