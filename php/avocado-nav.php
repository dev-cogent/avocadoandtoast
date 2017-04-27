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
                <a href="/contact.php">CONTACT</a>
                <a href="/settings.php">SETTINGS</a>
                <a href="/logout.php">LOGOUT</a>
            </div>           
              
              
              
        </div>  

                 <a href="javascript:void(0);" class="" id="search"> <i class="input-search-icon wb-search" aria-hidden="true"></i> </a>

<div class="search-bar">
	<a href="javascript:void(0);" class="ion-android-close" id="close-search-bar"> <i class="icon pe-close" aria-hidden="true"></i> </a>
	<input type="text" class="search-placeholder" placeholder="Search here..." />
</div>

          <div class="avo-navtabs"> <a href="/discover.php" class="link-pages <?php if($url == '/discover.php') echo 'active-tab';?>"> DISCOVER </a> </div>
          <div class="avo-navtabs"> <a href="/dashboard.php" class="link-pages <?php if($url == '/dashboard.php') echo 'active-tab';?>">DASHBOARD </a> </div>
          <div class="avo-navtabs"> <a href="/contact.php" class="link-pages <?php if($url == '/contact.php') echo 'active-tab';?>">  CONTACT </a></div>
          <div class="avo-navtabs dropdown"> <a href="/settings.php" class="link-pages <?php if($url == '/settings.php') echo 'active-tab';?>"> ACCOUNT </a>
          <div class="dropdown-content">
                <a href="/settings.php">SETTINGS</a>
                <a href="/logout.php">LOGOUT</a>
          </div>       
        
          </div>

 
          <!--<div class="avo-navtabs"> 
              <a class="icon wb-search collapsed" data-toggle="collapse" href="#" data-target="#site-navbar-search" role="button" aria-expanded="false">
              <span class="sr-only">Toggle Search</span>
            </a>
          </div>-->
      </div> <!--closes floater div -->
         
  </div>

 
 <div class="col-xs-12 nav-bottom"> </div>


</div>

<script>
    $(document).ready(function() {
	$('a#search').on('click', function() {
		$('div.search-bar').slideDown('1500');
       $('.nav-bottom').css('z-index','2');
       $('.filter-section').css('padding-top', '70px');
	});
	
	$('div.search-bar a#close-search-bar').on('click', function() {
		$('div.search-bar').slideUp('1500');
         $('.filter-section').css('padding-top', '30px');
	});
});
</script>


  