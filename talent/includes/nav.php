<nav class=" navbar navbar-default navbar-fixed-top " role="navigation">

      <div class="navbar-header site-navbar-small">
<!--       mobile side menu  -->
      <!-- <button type="button" class="navbar-toggler hamburger hamburger-close navbar-toggler-left hided"
      data-toggle="menubar">
        <span class="sr-only">Toggle navigation</span>
        <span class="hamburger-bar"></span>
      </button> -->


<!--       <button type="button" class="navbar-toggler" data-target=""
      data-toggle="">
        <i class="icon wb-more-horizontal" aria-hidden="true"></i>
      </button> -->
  <!--     <div class="navbar-brand navbar-brand-center" data-toggle="gridmenu">
        <a class="navbar-brand" href="#"> project.social </a>
        <img class="navbar-brand-logo" src="/assets/images/logo.png" title="Remark">
        <span class="navbar-brand-text hidden-xs-down"> Project Social Beta</span>
      </div> -->
      <button type="button" class="navbar-toggler collapsed" data-target="#site-navbar-search"
      data-toggle="collapse">
        <span class="sr-only">Toggle Search</span>
        <i class="icon wb-search" aria-hidden="true"></i>
      </button>


      <div class="navbar-brand " data-toggle="gridmenu">
         <a class="navbar-brand" href="#"> project.social </a>
         <!-- <img class="navbar-brand-logo" src="/assets/images/logo.png" title="Remark"> -->
       <!--   <span class="navbar-brand-text hidden-xs-down"> Project Social Beta</span> -->
       </div>
       <div class="hamburger-button-div">
       <button type="button" class="navbar-toggle button btn-open" data-toggle="collapse" data-target=".navbar-collapse">
         <img src="assets/images/hamburger.png" class="hamburger-icon">
</button>
    </div> 

      <!-- <div class="button">
        <a class="btn-open" href="#"></a>
      </div> -->




    </div>
    <div class="navbar-container">

      <!-- Navbar Collapse -->
      <div class="collapse navbar-collapse navbar-collapse-toolbar" id="site-navbar-collapse">
        <!-- Navbar Toolbar -->
        <ul class="nav navbar-toolbar">
      <!--   dropdown menu begins here  -->
          <li class="nav-item dropdown" id="">
         <!--  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"> -->
            <!-- <a class="nav-link dropdown-toggle btn-open" data-toggle="dropdown" href="#" role="button">
              <i class="icon hamburger hamburger-arrow-left">
                  <span class="sr-only">Toggle menubar</span>
                  <span class="hamburger-bar icon-bar"></span>
                  <span class="icon-bar"> </span>
                  <span class="icon-bar"> </span>
                </i>
            </a> -->
         <!--    </button> -->


                   <!-- <li class="dropdown dropdown-submenu dropdown-item">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"> Insights </a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-item"> <a href="#"> Summary </a></li>
                        <li class="dropdown-item"><a href=""> Engagement </a></li>
                        <li class="dropdown-item"><a href="">  Other   </a></li>
                        <li class="dropdown-item"><a href=""> Export  </a></li>
                        </ul> <
                  </li>

                <li class="dropdown-item"> <a href="#"> Campaign </a> </li>

                <li class="dropdown-item"> <a href="#"> Favorites </a> </li>


                  <li class="dropdown dropdown-submenu">
                    <a href="#" class="drodown-toggle" data-toggle="dropdown"> Search </a>
                    <ul class="dropdown-menu">
                      <li class="dropdown-item"> <a href="#"> Discover Influencers </a> </li>
                      <li class="dropdown-item"> <a href=""> Discover Media </a> </li>
                      </ul>
                      </li> -->
                     <!-- overall hamburger dropdown menu ends  -->



        </ul>
        <!-- End Navbar Toolbar -->
        <!-- Navbar Toolbar Right -->
        <ul class="nav navbar-toolbar navbar-right navbar-toolbar-right">

          <li class="nav-item hidden-float">
            <a class="nav-link icon wb-search" data-toggle="collapse" href="#" data-target="#site-navbar-search"
            role="button">
              <span class="sr-only">Toggle Search</span>
            </a>
          </li>

          <!-- repeat this -->
          <?php
          /*
          if(!class_exists('userOptions')){
          include 'class/useroptions.php';
          }
          if(!isset($useroptionsobj))
          $useroptionsobj = new userOptions;

          foreach($_SESSION['instagram_accounts'] as $id){
          $userinfo = $useroptionsobj->getNavBarUsers($id);
          echo'<li class="nav-item dropdown">
            <a id="'.$id.'" class="switch nav-link navbar-avatar" data-toggle="dropdown" href="#" aria-expanded="false"
            data-animation="scale-up" role="button">
              <span class="avatar avatar-online">
                <img src="'.$userinfo['profile_picture'].'" alt="...">
                <i></i>
              </span>
            </a>
          </li>';

          }
          */
          ?>

          <!-- <li class="nav-item dropdown">
          <a href="javascript: void(0);" class="nav-link" data-placement="" data-toggle="tooltip" data-original-title="Settings">
                <span class="icon wb-settings" aria-hidden="true"></span>
              </a>
          <li> -->



          <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="javascript:void(0)" title="Notifications"
            aria-expanded="false" data-animation="scale-up" role="button">
              <i class="icon wb-bell" aria-hidden="true"></i>
              <span class="label label-pill label-danger up">5</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-menu-media" role="menu">
              <div class="dropdown-menu-header">
                <h5>NOTIFICATIONS</h5>
                <span class="label label-round label-danger">New 5</span>
              </div>
              <div class="list-group">
                <div data-role="container">
                  <div data-role="content">
                    <a class="list-group-item dropdown-item" href="javascript:void(0)" role="menuitem">
                      <div class="media">
                        <div class="media-left p-r-10">
                          <i class="icon wb-order bg-red-600 white icon-circle" aria-hidden="true"></i>
                        </div>
                        <div class="media-body">
                          <h6 class="media-heading">A new order has been placed</h6>
                          <time class="media-meta" datetime="2016-06-12T20:50:48+08:00">5 hours ago</time>
                        </div>
                      </div>
                    </a>
                    <a class="list-group-item dropdown-item" href="javascript:void(0)" role="menuitem">
                      <div class="media">
                        <div class="media-left p-r-10">
                          <i class="icon wb-user bg-green-600 white icon-circle" aria-hidden="true"></i>
                        </div>
                        <div class="media-body">
                          <h6 class="media-heading">Completed the task</h6>
                          <time class="media-meta" datetime="2016-06-11T18:29:20+08:00">2 days ago</time>
                        </div>
                      </div>
                    </a>
                    <a class="list-group-item dropdown-item" href="javascript:void(0)" role="menuitem">
                      <div class="media">
                        <div class="media-left p-r-10">
                          <i class="icon wb-settings bg-red-600 white icon-circle" aria-hidden="true"></i>
                        </div>
                        <div class="media-body">
                          <h6 class="media-heading">Settings updated</h6>
                          <time class="media-meta" datetime="2016-06-11T14:05:00+08:00">2 days ago</time>
                        </div>
                      </div>
                    </a>
                    <a class="list-group-item dropdown-item" href="javascript:void(0)" role="menuitem">
                      <div class="media">
                        <div class="media-left p-r-10">
                          <i class="icon wb-calendar bg-blue-600 white icon-circle" aria-hidden="true"></i>
                        </div>
                        <div class="media-body">
                          <h6 class="media-heading">Event started</h6>
                          <time class="media-meta" datetime="2016-06-10T13:50:18+08:00">3 days ago</time>
                        </div>
                      </div>
                    </a>
                    <a class="list-group-item dropdown-item" href="javascript:void(0)" role="menuitem">
                      <div class="media">
                        <div class="media-left p-r-10">
                          <i class="icon wb-chat bg-orange-600 white icon-circle" aria-hidden="true"></i>
                        </div>
                        <div class="media-body">
                          <h6 class="media-heading">Message received</h6>
                          <time class="media-meta" datetime="2016-06-10T12:34:48+08:00">3 days ago</time>
                        </div>
                      </div>
                    </a>
                  </div>
                </div>
              </div>
              <div class="dropdown-menu-footer">
                <a class="dropdown-menu-footer-btn" href="javascript:void(0)" role="button">
                  <i class="icon md-settings" aria-hidden="true"></i>
                </a>
                <a class="dropdown-item" href="javascript:void(0)" role="menuitem">
                    All notifications
                  </a>
              </div>
            </div>
          </li>




          <li class="nav-item dropdown">
            <a class="nav-link navbar-avatar" data-toggle="dropdown" href="#" aria-expanded="false"
            data-animation="scale-up" role="button">
              <span class="avatar avatar-online">
                <img src="https://project.social/images/ps-square.jpg" alt="...">
                <i></i>
              </span>
            </a>
            <div class="dropdown-menu" role="menu">
              <a class="dropdown-item" href="/user/general.php" role="menuitem"><i class="icon wb-user" aria-hidden="true"></i>General Settings</a>
              <a class="dropdown-item" href="/user/security.php" role="menuitem"><i class="icon wb-payment" aria-hidden="true"></i>Security</a>
              <!--<a class="dropdown-item" href="javascript:void(0)" role="menuitem"><i class="icon wb-settings" aria-hidden="true"></i> Settings</a>
              <div class="dropdown-divider" role="presentation"></div>-->
              <a id="logout" class="dropdown-item" href="javascript:void(0)" role="menuitem"><i class="icon wb-power" aria-hidden="true"></i> Logout</a>
            </div>
          </li>

          <!-- end repeat -->





        </ul>
        <!-- End Navbar Toolbar Right -->
      </div>
      <!-- End Navbar Collapse -->
      <!-- Site Navbar Seach -->
      <div class="collapse navbar-search-overlap" id="site-navbar-search">
        <form role="search">
          <div class="form-group">
            <div class="input-search">
              <i class="input-search-icon wb-search" aria-hidden="true"></i>
              <input type="text" class="form-control search" name="site-search" placeholder="Search for influencer, keyword or location..">
              <button type="button" class="input-search-close icon wb-close" data-target="#site-navbar-search"
              data-toggle="collapse" aria-label="Close"></button>
            </div>
          </div>
        </form>
      </div>
      <!-- End Site Navbar Seach -->

      <div class="overlay2">
        <div class="wrap ">
          <ul class="wrap-nav">
            <a class="" href="/"><img src="https://cdn.sstatic.net/Sites/graphicdesign/img/apple-touch-icon@2.png?v=5078cbcb62f3" class="logo">  </a>

            <li><a href="/discover.php"> Discover </a></li>
            <li><a href="/createlist.php">Create Campaign</a></li>
            <li><a href="/mylists.php">My Lists</a></li>
            <li><a href="#">Tools</a></li>
            <li><a href="#">Price Campaign</a></li>
            <li><a href="#">Favorites </a></li>
            <li class=x-button>    <i class="fa fa-times fa-border" aria-hidden="true"></i> </li>
            </ul>

          </div>
        </div>




  </nav>

  <script src="/includes/javascript/switch.js"></script>
  <script src="/includes/javascript/settings.js"></script>
