<?php 
include 'includes/dbinfo.php';
if(isset($_POST['submit'])){

include 'includes/class/usersettings.php';
$usersettingsobj = new userSettings;
unset($_POST['submit']);
$check = true;
foreach($_POST as $item){
  if($item == ""){
     $error = "Please make sure all fields are filled out";
     $check = false;
  }
}
if($check){
    $conn = $usersettingsobj->dbinfo();
    $id = $usersettingsobj->randomString(10);
    $stmt = $conn->prepare('INSERT INTO `index_form`  (`id`,`first_name`,`last_name`,`email`,`company_name`,`company_type`) VALUES (?,?,?,?,?,?)');
    $stmt->bind_param('ssssss',$id,$_POST['firstname'],$_POST['lastname'],$_POST['email'],$_POST['companyname'],$_POST['accounttype']);
    if($stmt->execute()){
        $success = true;
        $message = 'Thank you for submitting your information. We will be in touch with you shortly.';
        $headers = "From: support@project.social \r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
        mail('dev@cogentworld.com','Form Submission','<p>Name:'.$_POST['firstname']. ' '.$_POST['lastname']. '</p> <p>Email: '.$_POST['email'].'</p> <p>Company name: ' .$_POST['companyname']. '</p> <p>Company Type: '.$_POST['accounttype'].'</p>',$headers);
        }
    }
}





?>
<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="bootstrap admin template">
  <meta name="author" content="">
  <title>Coming Soon | Project Social</title>
  <link rel="apple-touch-icon" href="../../assets/images/apple-touch-icon.png">
  <link rel="shortcut icon" href="../../assets/images/favicon.ico">
  <!-- Stylesheets -->
  <link rel="stylesheet" href="../../../global/css/bootstrap.min.css">
  <link rel="stylesheet" href="../../../global/css/bootstrap-extend.min.css">
  <link rel="stylesheet" href="../../assets/css/site.min.css">
  <!-- Plugins -->
  <link rel="stylesheet" href="../../../global/vendor/animsition/animsition.css">
  <link rel="stylesheet" href="../../../global/vendor/asscrollable/asScrollable.css">
  <link rel="stylesheet" href="../../../global/vendor/switchery/switchery.css">
  <link rel="stylesheet" href="../../../global/vendor/intro-js/introjs.css">
  <link rel="stylesheet" href="../../../global/vendor/slidepanel/slidePanel.css">
  <link rel="stylesheet" href="../../../global/vendor/jquery-mmenu/jquery-mmenu.css">
  <link rel="stylesheet" href="../../../global/vendor/flag-icon-css/flag-icon.css">
  <link rel="stylesheet" href="../../../global/vendor/jquery-mmenu/jquery-mmenu.css">
  <link rel="stylesheet" href="../../assets/examples/css/pages/maintenance.css">
  <!-- Fonts -->
  <link rel="stylesheet" href="../../../global/fonts/web-icons/web-icons.min.css">
  <link rel="stylesheet" href="../../../global/fonts/brand-icons/brand-icons.min.css">
  <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>
  <!--[if lt IE 9]>
    <script src="../../../global/vendor/html5shiv/html5shiv.min.js"></script>
    <![endif]-->
  <!--[if lt IE 10]>
    <script src="../../../global/vendor/media-match/media.match.min.js"></script>
    <script src="../../../global/vendor/respond/respond.min.js"></script>
    <![endif]-->
  <!-- Scripts -->
  <script src="../../../global/vendor/breakpoints/breakpoints.js"></script>
  <script>
  Breakpoints();
  </script>
</head>
<body class="animsition page-maintenance layout-full">
  <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
  <!-- Page -->
  <div class="page vertical-align text-xs-center" data-animsition-in="fade-in" data-animsition-out="fade-out">>
    <div class="page-content vertical-align-middle">
     <!-- <i class="icon wb-signal page-maintenance-icon" aria-hidden="true"></i> -->
      <h2>PROJECT SOCIAL</h2>
      <?php if($success) echo'<p style="color:#46be8a">'.$message.'</p>'; 
            else echo '<p>SIGN UP BELOW FOR EARLY ACCESS TO PROJECT SOCIAL.</p>';
      ?>
      <div class="example">
        <?php if(!isset($success)){
              if(isset($error))
                echo '<h5 style="color:#f96868;">'.$error.'</h5>';
                echo '
                  <form class="" method="POST" action="#" >
                    <div class="row">
                      <div class="form-group col-sm-6">
                        <input type="text" class="form-control" name="firstname" placeholder="First Name" autocomplete="off">
                      </div>
                      <div class="form-group col-sm-6">
                        <input type="text" class="form-control" name="lastname" placeholder="Last Name" autocomplete="off">
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <input type="email" class="form-control" name="email" placeholder="Email Address" autocomplete="off">
                    </div>
                    <div class="form-group">
            <label class="sr-only" for="inputName">Company Name</label>
            <input type="text" class="form-control" id="inputName" name="companyname" placeholder="Company Name">
          </div>
                    <div class="form-group">
                    <select class="form-control" id="companytype" name="accounttype" required="" data-fv-field="company">
                      <option value="">Company Type</option>
                      <option value="Self-Employed">Self-Employed</option>
                      <option value="Small Business">Small Business</option>
                      <option value="Agency">Agency</option>
                      <option value="Brand">Brand</option>
                      <option value="Enterprise">Enterprise</option>
                    </select>
                  <small class="help-block" data-fv-validator="notEmpty" data-fv-for="company" data-fv-result="NOT_VALIDATED" style="display: none;">Please company</small></div>
                    <div class="form-group">
                      <button type="submit" name="submit" class="btn btn-primary btn-block">Submit</button>
                    </div>
                  </form>';
          }
          ?>
                </div>
      <footer class="page-copyright">
      
        <p>© Project Social 2016. All RIGHT RESERVED.</p>
        <!--
<div class="social">
          <a href="javascript:void(0)">
            <i class="icon bd-twitter" aria-hidden="true"></i>
          </a>
          <a href="javascript:void(0)">
            <i class="icon bd-facebook" aria-hidden="true"></i>
          </a>
          <a href="javascript:void(0)">
            <i class="icon bd-dribbble" aria-hidden="true"></i>
          </a>
        </div>

-->
      </footer>
    </div>
  </div>
  <!-- End Page -->
  <!-- Core  -->
  <script src="../../../global/vendor/babel-external-helpers/babel-external-helpers.js"></script>
  <script src="../../../global/vendor/jquery/jquery.js"></script>
  <script src="../../../global/vendor/tether/tether.js"></script>
  <script src="../../../global/vendor/bootstrap/bootstrap.js"></script>
  <script src="../../../global/vendor/animsition/animsition.js"></script>
  <script src="../../../global/vendor/mousewheel/jquery.mousewheel.js"></script>
  <script src="../../../global/vendor/asscrollbar/jquery-asScrollbar.js"></script>
  <script src="../../../global/vendor/asscrollable/jquery-asScrollable.js"></script>
  <!-- Plugins -->
  <script src="../../../global/vendor/jquery-mmenu/jquery.mmenu.min.all.js"></script>
  <script src="../../../global/vendor/switchery/switchery.min.js"></script>
  <script src="../../../global/vendor/intro-js/intro.js"></script>
  <script src="../../../global/vendor/screenfull/screenfull.js"></script>
  <script src="../../../global/vendor/slidepanel/jquery-slidePanel.js"></script>
  <!-- Scripts -->
  <script src="../../../global/js/State.js"></script>
  <script src="../../../global/js/Component.js"></script>
  <script src="../../../global/js/Plugin.js"></script>
  <script src="../../../global/js/Base.js"></script>
  <script src="../../../global/js/Config.js"></script>
  <script src="../../assets/js/Section/Menubar.js"></script>
  <script src="../../assets/js/Section/Sidebar.js"></script>
  <script src="../../assets/js/Section/PageAside.js"></script>
  <!-- Config -->
  <script src="../../../global/js/config/colors.js"></script>
  <script src="../../assets/js/config/tour.js"></script>
  <script>
  Config.set('assets', '../../assets');
  </script>
  <!-- Page -->
  <script src="../../assets/js/Site.js"></script>
  <script src="../../../global/js/Plugin/asscrollable.js"></script>
  <script src="../../../global/js/Plugin/slidepanel.js"></script>
  <script src="../../../global/js/Plugin/switchery.js"></script>
  <script>
  (function(document, window, $) {
    'use strict';
    var Site = window.Site;
    $(document).ready(function() {
      Site.run();
    });
  })(document, window, jQuery);
  </script>
</body>
</html>
