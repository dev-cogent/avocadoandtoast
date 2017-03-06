<div class="site-menubar" id="">
    <ul class="site-menu" data-plugin="menu">
      <li class="site-menu-item has-sub">
        <a href="javascript:void(0)">
          <i class="site-menu-icon wb-signal" aria-hidden="true"></i>
          <span class="site-menu-title">Insights</span>
          <span class="site-menu-arrow"></span>
        </a>
        <ul class="site-menu-sub">
          <li class="site-menu-item">
            <a class="animsition-link" href="../v2/html/index.html">
              <span class="site-menu-title">Summary</span>
            </a>
          </li>
          <li class="site-menu-item">
            <a class="animsition-link" href="../v2/html/dashboard/v2.html">
              <span class="site-menu-title">Social Community</span>
            </a>
          </li>
          <li class="site-menu-item">
            <a class="animsition-link" href="../v2/html/dashboard/ecommerce.html">
              <span class="site-menu-title">Content</span>
            </a>
          </li>
          <li class="site-menu-item">
            <a class="animsition-link" href="../v2/html/dashboard/analytics.html">
              <span class="site-menu-title">Engagement</span>
            </a>
          </li>
          <li class="site-menu-item">
            <a class="animsition-link" href="../v2/html/dashboard/team.html">
              <span class="site-menu-title">Exports</span>
            </a>
          </li>
        </ul>
      </li>
      <li class="site-menu-item has-sub">
        <a href="javascript:void(0)">
          <i class="site-menu-icon wb-wrench" aria-hidden="true"></i>
          <span class="site-menu-title">Tools</span>
          <span class="site-menu-arrow"></span>
        </a>
        <ul class="site-menu-sub">
          <li class="site-menu-item">
            <a class="animsition-link" href="/campaign-calculator.php">
              <span class="site-menu-title">Campaign Calculator</span>
            </a>
          </li>
          <li class="site-menu-item">
            <a class="animsition-link" href="#">
              <span class="site-menu-title">Compare Influencers</span>
            </a>
          </li>
          <li class="site-menu-item">
            <a class="animsition-link" href="#">
              <span class="site-menu-title">Hashtag Tracker</span>
            </a>
          </li>


        </ul>
      </li>

       <li class="site-menu-item has-sub">
        <a href="javascript:void(0)">
          <i class="site-menu-icon wb-search" aria-hidden="true"></i>
          <span class="site-menu-title">Search</span>
          <span class="site-menu-arrow"></span>
        </a>
        <ul class="site-menu-sub">
          <li class="site-menu-item">
            <a class="animsition-link" href="#">
              <span class="site-menu-title">Discover Influencers</span>
            </a>
          </li>
          <li class="site-menu-item">
            <a class="animsition-link" href="#">
              <span class="site-menu-title">Discover Media</span>
            </a>
          </li>
        </ul>
      </li>


       <li class="site-menu-item has-sub">
        <a  href="javascript:void(0)">
          <i class="site-menu-icon wb-list" aria-hidden="true"></i>
          <span class="site-menu-title">Campaigns</span>
          <span class="site-menu-arrow"></span>
        </a>
        <ul class="site-menu-sub">
        <?php
          if(!isset($_SESSION)) session_start();
          foreach($_SESSION['campaigns'] as $campaign){
            echo '<li class="site-menu-item">
                    <a class="animsition-link" href="/campaign/?c='.$campaign.'">
                      <span class="site-menu-title">'.$campaign.'</span>
                    </a>
                 </li>';
          }
          ?>
          <li class="site-menu-item">
            <a class="login" data-href="/campaign/create.php">
              <span class="site-menu-title">Create Campaign</span>
            </a>
          </li>
        </ul>
      </li>

    <li class="site-menu-item">
        <a class="login" data-href="/favorite/">
          <i class="site-menu-icon wb-heart" aria-hidden="true"></i>
          <span class="site-menu-title">Favorites</span>
          <span class="site-menu-arrow"></span>
        </a>
      </li>


       <li class="site-menu-item has-sub">
        <a href="javascript:void(0)">
          <i class="site-menu-icon wb-file" aria-hidden="true"></i>
          <span class="site-menu-title">Reports</span>
          <span class="site-menu-arrow"></span>
        </a>
        <ul class="site-menu-sub">
          <li class="site-menu-item">
            <a class="animsition-link" href="#">
              <span class="site-menu-title">Exported Reports</span>
            </a>
          </li>
          <li class="site-menu-item">
            <a class="animsition-link" href="#">
              <span class="site-menu-title">Settings</span>
            </a>
          </li>
        </ul>
      </li>



        </ul>
      </div>
    </div>
  </div>

  <script src="/includes/javascript/checklogin.js"></script>
