<?php
session_start();
error_reporting(0);
include 'php/dbinfo.php';
include 'php/numberAbbreviation.php';

?>
<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
    <link rel="stylesheet" href="/assets/uislider/nouislider.css">
    <?php include 'html/head.html' ?>
    <title>Discover | Avocado & Toast</title>
    <script src="/bootbox/bootbox.js"></script>
    <script src="/global/vendor/bootstrap/bootstrap.js"></script>
    <script src="/global/js/jquery-ui-slider/jquery-ui.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700|Open+Sans:400,700" rel="stylesheet">
    <script src="/assets/js/abbreviatenumber.js"></script>
    <script src="/assets/wnumb/wNumb.js"></script>
    <script src="/assets/uislider/nouislider.js"></script>
    <script src="/assets/js/tokenfield/dist/bootstrap-tokenfield.js"></script>
    <script src="/assets/js/loading.js"></script>
    <script src="/assets/js/avocado-card-functions.js"></script>
    <script src="/assets/js/avocado-calculate.js"></script>
    <script src="assets/js/influencer_pullout.js"></script>
    <script src="assets/js/af-slidedown.js"></script>
    <link rel="stylesheet" href="/assets/js/tokenfield/dist/css/bootstrap-tokenfield.css">
    <link rel="stylesheet" href="/global/fonts/brand-icons/brand-icons.css">
    <link rel="stylesheet" href="/global/fonts/font-awesome/font-awesome.css">
    <link rel="stylesheet" href="assets/css/pullout.css">
    <link rel="stylesheet" href="assets/css/influencer-card.css">
    <link rel="stylesheet" href="assets/css/curated-lists.css">
    <link rel="stylesheet" href="/assets/css/discover.css">
    <link rel="stylesheet" href="/assets/css/af-slidedown.css">
    <link rel="stylesheet" href="/global/js/jquery-ui-slider/jquery-ui.min.css">
</head>

<body>
<?php include 'php/avocado-nav.php'; ?>

<!-- right side bar -->
    <div id="influencers-pullout">
      <img id="pulltab" src="assets/images/pulltab_icon.png" alt="">
      <header>
            <div id="num-influencers">__</div>
            <div id="header-text">
            Influencers in current campaign
            </div>
            <div id=dismiss-button>x</div>
      </header>

      <button type="button" name="button" id="calculate">Calculate campaign</button>


      <div  id="influencer-pullout-image-container">


 <!-- images go here -->


      </div>

      <div id="action-buttons">
        <button id="remove-button" class="greyed-out" type="button" name="button">Remove selected</button>
        <button id="remove-all-button" class="greyed-out" type="button" name="button">Remove all</button>
        <button id="undo-button" class="greyed-out" type="button" name="button"> Undo</button>
      </div>
    </div>

<!-- end right side bar -->

<!-- Add side bar here -->
<div id="loading"><img style="height:250px; width:250px;"src="/assets/images/loading.gif"/></div>



<!-- The third nav bar , we might be able to take this out. In the mean time, we'll keep it here -->

<div id="myNav" class="overlay"></div>
<div id="discover-container" class="curated-list-container">


<br>





    <div class="influencer-header"> CURATED LISTS </div>


       <!-- <div class="influencer-header">INFLUENCER RESULTS</div>-->
        <div  class="influencer-box curated-box col-xs-12 col-sm-6 col-md-4 col-lg-3" data-id="">

          <div class="influencer-card-discover curated-list">
            <a href="/curated-lists/?id=9Q3JmsuCUtYYweVcRQ8s"> <img src="/assets/images/fashion-blogger.png" class="curated-list-image-card">   </a>
            <div class="curated-text-area">
            <div class="handle-info col-xs-12">
                <div class="handle-text curated"> FASHION BLOGGERS </div>

             </div>

             <div class="curated-btn-container">
               <a href="/curated-lists/?id=9Q3JmsuCUtYYweVcRQ8s"><button class="secondary-button view-btn-curated"> VIEW </button></a>

             </div>
           </div>
           </div>
                   </div>

                   <div  class="influencer-box curated-box col-xs-12 col-sm-6 col-md-4 col-lg-3" data-id="">

                     <div class="influencer-card-discover curated-list">
                       <a href="/curated-lists/?id=33fXFCVVAhiP4W9zV9xE"> <img src="/assets/images/food.png" class="curated-list-image-card">   </a>
                       <div class="curated-text-area">
                       <div class="handle-info col-xs-12">
                           <div class="handle-text curated "> FOODIES </div>

                        </div>

                        <div class="curated-btn-container">
                          <a href="/curated-lists/?id=33fXFCVVAhiP4W9zV9xE"><button class="secondary-button view-btn-curated"> VIEW </button></a>

                        </div>
                      </div>
                      </div>
                              </div>




          <div  class="influencer-box curated-box col-xs-12 col-sm-6 col-md-4 col-lg-3" data-id="">

            <div class="influencer-card-discover curated-list">
              <a href="/curated-lists/?id=oIkYtVXnRQpe1ZbT54IP"> <img src="/assets/images/yoga.png" class="curated-list-image-card">   </a>
              <div class="curated-text-area">
              <div class="handle-info col-xs-12">
                  <div class="handle-text curated"> YOGIES  </div>

               </div>

               <div class="curated-btn-container">
                 <a href="/curated-lists/?id=oIkYtVXnRQpe1ZbT54IP"><button class="secondary-button view-btn-curated"> VIEW </button></a>

               </div>
             </div>
             </div>
                     </div>


             <div  class="influencer-box curated-box col-xs-12 col-sm-6 col-md-4 col-lg-3" data-id="">

               <div class="influencer-card-discover curated-list">
                 <a href="/curated-lists/?id=4GxS3Wpl73RvMbtf7rCY"> <img src="http://68.media.tumblr.com/eb46bb60eb377e323b82f21be111bd37/tumblr_nyydepPk1r1tc31mqo1_1280.jpg" class="curated-list-image-card">   </a>
                 <div class="curated-text-area">
                 <div class="handle-info col-xs-12">
                     <div class="handle-text curated"> PETS </div>

                  </div>

                  <div class="curated-btn-container">
                    <a href="/curated-lists/?id=4GxS3Wpl73RvMbtf7rCY"><button class="secondary-button view-btn-curated"> VIEW </button></a>

                  </div>
                </div>
                </div>
                        </div>


                <div  class="influencer-box curated-box col-xs-12 col-sm-6 col-md-4 col-lg-3" data-id="">

                  <div class="influencer-card-discover curated-list">
                    <a href="/curated-lists/?id=NKmG4VDYoJSoZ6ZCWbYB"> <img src="/assets/images/photography-pic.png" class="curated-list-image-card">   </a>
                    <div class="curated-text-area">
                    <div class="handle-info col-xs-12">
                        <div class="handle-text curated "> PHOTOGRAPHY </div>

                     </div>

                     <div class="curated-btn-container">
                       <a href="/curated-lists/?id=NKmG4VDYoJSoZ6ZCWbYB"><button class="secondary-button view-btn-curated"> VIEW </button></a>

                     </div>
                   </div>
                   </div>
                           </div>

             <div  class="influencer-box curated-box col-xs-12 col-sm-6 col-md-4 col-lg-3" data-id="">

               <div class="influencer-card-discover curated-list">
                 <a href="/curated-lists/?id=7y1LSNCmz7PmRc3W7GUv"> <img src="/assets/images/baby.png" class="curated-list-image-card">   </a>
                 <div class="curated-text-area">
                 <div class="handle-info col-xs-12">
                     <div class="handle-text curated "> BABIES </div>

                  </div>

                  <div class="curated-btn-container">
                    <a href="/curated-lists/?id=7y1LSNCmz7PmRc3W7GUv"><button class="secondary-button view-btn-curated"> VIEW </button></a>

                  </div>
                </div>
                </div>
                        </div>


            <div  class="influencer-box curated-box col-xs-12 col-sm-6 col-md-4 col-lg-3" data-id="">

              <div class="influencer-card-discover curated-list">
                <a href="/curated-lists/?id=8rhdnqMjAkXJa1swuX8p"> <img src="/assets/images/youtube-vlogger.png" class="curated-list-image-card">   </a>
                <div class="curated-text-area">
                <div class="handle-info col-xs-12">
                    <div class="handle-text curated "> YOUTUBE VLOGGERS </div>

                 </div>

                 <div class="curated-btn-container">
                   <a href="/curated-lists/?id=8rhdnqMjAkXJa1swuX8p"><button class="secondary-button view-btn-curated"> VIEW </button></a>

                 </div>
               </div>
               </div>
                       </div>


           <div  class="influencer-box curated-box col-xs-12 col-sm-6 col-md-4 col-lg-3" data-id="">

             <div class="influencer-card-discover curated-list">
               <a href="/curated-lists/?id=h2cj2oc7sVXxBvpErP0z"> <img src="/assets/images/model2.png" class="curated-list-image-card">   </a>
               <div class="curated-text-area">
               <div class="handle-info col-xs-12">
                   <div class="handle-text curated "> MODELS </div>

                </div>

                <div class="curated-btn-container">
                  <a href="/curated-lists/?id=h2cj2oc7sVXxBvpErP0z"><button class="secondary-button view-btn-curated"> VIEW </button></a>

                </div>
              </div>
              </div>
                      </div>


            <div  class="influencer-box curated-box col-xs-12 col-sm-6 col-md-4 col-lg-3" data-id="">

              <div class="influencer-card-discover curated-list">
                <a href="/curated-lists/?id=qNUqTT2Q51sdztYrgANQ"> <img src="/assets/images/athlete.png" class="curated-list-image-card">   </a>
                <div class="curated-text-area">
                <div class="handle-info col-xs-12">
                    <div class="handle-text curated "> ATHLETES </div>

                 </div>

                 <div class="curated-btn-container">
                   <a href="/curated-lists/?id=qNUqTT2Q51sdztYrgANQ"><button class="secondary-button view-btn-curated"> VIEW </button></a>

                 </div>
               </div>
               </div>
                       </div>





               <div  class="influencer-box curated-box col-xs-12 col-sm-6 col-md-4 col-lg-3" data-id="">

                 <div class="influencer-card-discover curated-list ">
                   <a href="/curated-lists/?id=KHKlca0EZ1eTTkyWTt6U"> <img src="/assets/images/makeup-vlogger.png" class="curated-list-image-card">   </a>
                   <div class="curated-text-area">
                   <div class="handle-info col-xs-12">
                       <div class="handle-text curated "> MAKEUP BLOGGERS  </div>

                    </div>

                    <div class="curated-btn-container">
                      <a href="/curated-lists/?id=KHKlca0EZ1eTTkyWTt6U"><button class="secondary-button view-btn-curated"> VIEW </button></a>

                    </div>
                  </div>
                  </div>
                          </div>

              <div  class="influencer-box curated-box col-xs-12 col-sm-6 col-md-4 col-lg-3" data-id="">

                <div class="influencer-card-discover curated-list">
                  <a href="/curated-lists/?id=0gdACQcmFWzpDjLQtMvt"> <img src="/assets/images/hair-stylist2.png" class="curated-list-image-card">   </a>
                  <div class="curated-text-area">
                  <div class="handle-info col-xs-12">
                      <div class="handle-text curated ">  HAIR STYLISTS </div>

                   </div>

                   <div class="curated-btn-container">
                     <a href="/curated-lists/?id=0gdACQcmFWzpDjLQtMvt"><button class="secondary-button view-btn-curated"> VIEW </button></a>

                   </div>
                 </div>
                 </div>
                         </div>



              <div  class="influencer-box curated-box col-xs-12 col-sm-6 col-md-4 col-lg-3" data-id="">

                <div class="influencer-card-discover curated-list">
                  <a href="/curated-lists/?id=eNDkuZZYI0ipzwoLfsYm"> <img src="/assets/images/sneakerheads.png" class="curated-list-image-card">   </a>
                  <div class="curated-text-area">
                  <div class="handle-info col-xs-12">
                      <div class="handle-text curated "> SNEAKERHEADS </div>

                   </div>

                   <div class="curated-btn-container">
                     <a href="/curated-lists/?id=eNDkuZZYI0ipzwoLfsYm"><button class="secondary-button view-btn-curated"> VIEW </button></a>

                   </div>
                 </div>
                 </div>
                         </div>



              <div  class="influencer-box curated-box col-xs-12 col-sm-6 col-md-4 col-lg-3" data-id="">

                <div class="influencer-card-discover curated-list">
                  <a href="/curated-lists/?id=q7nXli9c9iFhJWv6nhpX"> <img src="/assets/images/media.png" class="curated-list-image-card">   </a>
                  <div class="curated-text-area">
                  <div class="handle-info col-xs-12">
                      <div class="handle-text curated "> DIGITAL MEDIA  </div>

                   </div>

                   <div class="curated-btn-container">
                     <a href="/curated-lists/?id=q7nXli9c9iFhJWv6nhpX"><button class="secondary-button view-btn-curated"> VIEW </button></a>

                   </div>
                 </div>
                 </div>
                         </div>


           <div  class="influencer-box curated-box col-xs-12 col-sm-6 col-md-4 col-lg-3" data-id="">

             <div class="influencer-card-discover curated-list">
               <a href="/curated-lists/?id=CnGMp9jT7siyzFvVYF87"> <img src="/assets/images/tv-channels.png" class="curated-list-image-card">   </a>
               <div class="curated-text-area">
               <div class="handle-info col-xs-12">
                   <div class="handle-text curated "> TV CHANNELS </div>

                </div>

                <div class="curated-btn-container">
                  <a href="/curated-lists/?id=CnGMp9jT7siyzFvVYF87"><button class="secondary-button view-btn-curated"> VIEW </button></a>

                </div>
              </div>
              </div>
                      </div>


          <div  class="influencer-box curated-box col-xs-12 col-sm-6 col-md-4 col-lg-3" data-id="">

            <div class="influencer-card-discover curated-list">
              <a href="/curated-lists/?id=XNpGJVM6cc4PAKBZUVS2"> <img src="/assets/images/magazine3.png" class="curated-list-image-card">   </a>
              <div class="curated-text-area">
              <div class="handle-info col-xs-12">
                  <div class="handle-text curated "> MAGAZINES </div>

               </div>

               <div class="curated-btn-container">
                 <a href="/curated-lists/?id=XNpGJVM6cc4PAKBZUVS2"><button class="secondary-button view-btn-curated"> VIEW </button></a>

               </div>
             </div>
             </div>
                     </div>








            <div  class="influencer-box curated-box col-xs-12 col-sm-6 col-md-4 col-lg-3" data-id="">

              <div class="influencer-card-discover curated-list">
                <a href="/curated-lists/?id=nbAXR5SPK0XHNnoxibEv"> <img src="/assets/images/memes.png" class="curated-list-image-card">   </a>
                <div class="curated-text-area">
                <div class="handle-info col-xs-12">
                    <div class="handle-text curated "> MEMES  </div>

                 </div>

                 <div class="curated-btn-container">
                   <a href="/curated-lists/?id=nbAXR5SPK0XHNnoxibEv"><button class="secondary-button view-btn-curated"> VIEW </button></a>

                 </div>
               </div>
                       </div>




        <div class="found-influencers col-xs-12">
            <?php
                //If this is a get request, then we will make a script here to collect the parameters from the GET request. Afterwards we will apply this script at the end of the page.
                if($_GET['q']){
                    $queryArr = explode(' ' ,$_GET['q']);
                    $queryArr = json_encode($queryArr);
                    $javaquery = "
                    <script>
                        var keywordsarr = '$queryArr';
                        keywordsarr = JSON.parse(keywordsarr);
                        filters['keywords'] = keywordsarr;
                        applyFilters(filters);
                        keywordsarr.forEach(function(element){
                            $('#tokenfield').tokenfield('createToken', element);
                        });
                    </script>
                    ";
                }
            ?>
        </div>
    </div>
</div>


</body>
</html>
