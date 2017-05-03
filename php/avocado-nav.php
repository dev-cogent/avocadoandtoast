<?php

include'verify-login.php';

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
                <a href="/dashboard.php">LISTS </a>
                <a href="/dashboard.php"> CURATED LISTS </a>
                <a href="/contact.php">CONTACT</a>
                <a href="/settings.php">SETTINGS</a>
                <a href="/logout.php">LOGOUT</a>

                <?php if($isLoggedin) echo'<a href="/logout.php">LOGOUT</a>';
                      else echo '<a href="/login.php">LOGIN</a>';
                ?>


            </div>



        </div>

                 <a href="javascript:void(0);" class="close-search-bar"  id="search"> <i class="input-search-icon wb-search" aria-hidden="true"></i> </a>

<div class="search-bar">
    <!--<div id=dismiss-button>x</div>-->
	<!--<a href="javascript:void(0);" class="ion-android-close" id="close-search-bar"><i class="icon pe-close" aria-hidden="true"></i> </a>-->
    <div class="search-bar-position">
        <input type="text" class="search-placeholder search-global" placeholder="Search here..." />
        <a href="javascript:void(0);" class="ion-android-close close-search-bar" ><div id="search-dismiss">x</div></a>
    </div>
</div>

          <div class="avo-navtabs"> <a href="/discover.php" class="link-pages <?php if($url == '/discover.php') echo 'active-tab';?>"> DISCOVER </a> </div>
          <div class="avo-navtabs dropdown"> <a href="/dashboard.php" class="link-pages <?php if($url == '/dashboard.php') echo 'active-tab';?>"> LISTS </a>
          <div class="dropdown-content">
                <a href="/curated-lists.php"> CURATED LISTS </a>

          </div>
        </div>
          <div class="avo-navtabs"> <a href="/contact.php" class="link-pages <?php if($url == '/contact.php') echo 'active-tab';?>">  CONTACT </a></div>
          <div class="avo-navtabs dropdown"> <a href="/settings.php" class="link-pages <?php if($url == '/settings.php') echo 'active-tab';?>"> ACCOUNT </a>
          <div class="dropdown-content">

                <a href="/settings.php">SETTINGS <i class="icon wb-settings nav-bar" aria-hidden="true"></i></a>
               
             <?php if($isLoggedin) echo' <a href="/logout.php">LOGOUT <i class="icon fa-power-off nav-bar" aria-hidden="true"></i></a>';
                      else echo '<a href="/login.php">LOGIN</a>';
                ?>
            
      
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
<div class="avocado-nav-spacing"></div>
<script>
    $('.search-global').keydown(function(e){
        if(e.which === 13 ){
            var searchVal = $(this).val();
            window.location = '/discover.php?q='+searchVal;
        }
    });
    $(document).ready(function() {
	$('a#search').on('click', function() {
		$('div.search-bar').slideDown('1500');
	});

	$('div.search-bar .close-search-bar').on('click', function() {
		$('div.search-bar').slideUp('1500');
	});

});


</script>
