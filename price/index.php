<?php
session_start();
$firstname = $_SESSION['firstname'];
$lastname = $_SESSION['lastname'];
$email = $_SESSION['email'];
$company = $_SESSION['company'];
?>
<script> var campaignid = '<?php echo $_GET['id']; ?>'; </script>


<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
    <head> 
    <?php include '../html/head.html' ?>
        <title>Avocado & Toast</title>
        <script src="/assets/js/price-campaign.js"></script>
        <script src="/bootbox/bootbox.js"></script>
        <script src="/global/vendor/bootstrap/bootstrap.js"></script>
        <link rel="stylesheet" href="/global/fonts/brand-icons/brand-icons.css">
        <link rel="stylesheet" href="/global/fonts/font-awesome/font-awesome.css">
        <link rel="stylesheet" href="/assets/css/discover.css">
        <link rel="stylesheet" href="/assets/css/edit-campaign.css">
        
    </head>

    <body>

    <?php include '../php/avocado-nav.php';?>

    <div class="center-form-content">

            <div class="input-container">
                <div class="desc-header" id="campaign-name"> Price </div>
                <br/>

                <h4 class="sub-heading">Contact Information </h4>
                <hr>

                <label class="title">Email</label>
                <br/>
                <input type="text" class="form-control category avocado-focus" id="brand" value="<?php echo $_SESSION['email'] ?> " placeholder="required*">

                <label class="title">Name</label>
                <br/>
                <input type="text" class="form-control category avocado-focus" id="brand" value="<?php echo $firstname.' '.$lastname ; ?>" placeholder="required*">

                <label class="title">Company</label>
                <br/>
                <input type="text" class="form-control category avocado-focus" id="brand" value="<?php echo $company ; ?>" placeholder="required*">


                <label class="title">Title</label>
                <br/>
                <input type="text" class="form-control category avocado-focus" id="brand" value="" placeholder="required*">


                <label class="title">Phone Number</label>
                <br/>
                <input type="text" class="form-control category avocado-focus" id="brand" value="" placeholder="required*">

                <br/>
                <h4 class="sub-heading">Campaign Information</h4>
                <hr>

                <label class="title">Brand</label>
                <br/>
                <input type="text" class="form-control category avocado-focus" id="brand-name" value="" placeholder="required*">

                <label class="title">Budget</label>
                <br/>
                <input type="text" class="form-control category avocado-focus" id="brand" value="" placeholder="Required*">

                <label class="title">Offer Expiration Date</label>
                <br/>
                <input type= "text" class="form-control category avocado-focus" id="campaign-request">

                <label class="title">Campaign Details </label>
                <br/>
                <label>Overview, Launch Date, Duration etc </label>
                <textarea type="text" class="form-control category avocado-focus" id="campaign-details" style="height:150px;" > </textarea> 

                <label class="title">Target Demographic</label>
                <br/>
                <input type="text" class="form-control category avocado-focus" id="payout" value="" placeholder="Required">
                <br/>

                <label class="title">Influencer Services</label>
                <br/>

                <li class="social-list"><input class="social" type="checkbox"><div class="social-text">Instagram</div></li>
                <li class="social-list"><input class="social" type="checkbox"><div class="social-text">Facebook</div></li>
                <li class="social-list"><input class="social" type="checkbox"><div class="social-text">Twitter</div></li>
                <li class="social-list"><input class="social" type="checkbox"><div class="social-text">Youtube</div></li>

                <br/>

                <button class="col-xs-12 avo-btn-edit-primary pricing" id="price-campaign">SUBMIT FOR PRICING</button>
                
            </div>

    </div>

    </body>

</html>