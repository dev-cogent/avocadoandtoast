<?php include 'html/head.html'; ?>
<?php 
$url = $_SERVER['REQUEST_URI'];
?>
<div class="avocado-nav-container "> 
  <div class="logo-container col-xs-2">
        <a href="/discover.php"><img src="/assets/images/at-logo-black.png"></a>
  </div>
<!-- Content where the discover, communicatie, order management would be -->
 <div class="avo-nav col-xs-10">
      <div class="floater-border navbar-collapse">
          <div class="collapse-icon dropdown"><i class="fa fa-bars bar-settings" aria-hidden="true"></i>
            <div class="dropdown-content">
                <a href="/discover.php">DISCOVER </a>
                <a href="/dashboard.php">DASHBOARD</a>
                <a href="/price.php">PRICE</a>
                <a href="/settings.php">SETTINGS</a>
                <a href="#">CONTACT</a>
                <a href="/logout.php">LOGOUT</a>
            </div>           
              
              
              
        </div>  
          <div class="avo-navtabs"> <a href="/discover.php" class="link-pages <?php if($url == '/discover.php') echo 'active-tab';?>"> DISCOVER </a> </div>
          <div class="avo-navtabs"> <a href="/dashboard.php" class="link-pages <?php if($url == '/dashboard.php') echo 'active-tab';?>">DASHBOARD </a> </div>
          <div class="avo-navtabs"> <a href="/price.php" class="link-pages <?php if($url == '/price.php') echo 'active-tab';?>">  PRICE CAMPAIGN </a></div>
          <div class="avo-navtabs dropdown"> <a href="/settings.php" class="link-pages <?php if($url == '/settings.php') echo 'active-tab';?>"> ACCOUNT </a>
            <div class="dropdown-content">
                <a href="/settings.php">SETTINGS</a>
                <a href="#">CONTACT</a>
                <a href="/logout.php">LOGOUT</a>
            </div>       
        
          </div>
      </div> <!--closes floater div -->
         
  </div>

 
 <div class="col-xs-12 nav-bottom"> </div>


</div>
<script src="/assets/js/nav.js"></script>



  