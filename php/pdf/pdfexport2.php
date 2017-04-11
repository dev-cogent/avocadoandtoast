<?php 
session_start();
require  "autoload.php"; 
include '../numberAbbreviation.php';
include '../dbinfo.php';
include '../dbinfolist.php';
$pdflogo = $_SESSION['pdf_picture'];
if ($_SESSION['listid'] == 'e28dfc6b390a6ce981c1bbf47bd481f9'){
$color = '#2A2725';
}
else{
$color = '#bc0001';
}
if(is_null($pdflogo)){
$pdflogo = 'http://cogenttools.com/assets/assets/cogent-white-100.png';
}
$configuration = DocRaptor\Configuration::getDefaultConfiguration();
$configuration->setUsername("iLYpGOvi5Y02WmSLsI"); # this key works for test documents
$configuration->setSSLVerification(false);
//$configuration->setDebug(true);
$platforms = $_SESSION['platforms'];

$arrplat = array();
foreach($platforms as $platform){
$arrplat[$platform]['sqlcount'] = $platform.'_count';
$arrplat[$platform]['sqlurl'] = $platform.'_url';
$arrplat[$platform]['headerimage'] = '<th><img src="http://cogenttools.com/images/'.$platform.'_logo.png" class="img50"></th>';
}
foreach($arrplat as $plat){
$thead .= $plat['headerimage'];
$url = $plat['sqlurl'];
$count = $plat['sqlcount'];
$sqlselect .= "`$url`,`$count`,";
}
$users = $_SESSION['users'];
$list = $_SESSION['list'];
$summary = $_SESSION['summary'];
foreach ($users as $id){
//echo"SELECT `image_url`,`user`, $sqlselect `category`, `pdf_note`, `total` FROM `$list` WHERE `id` = '$id'";
$row = mysqli_query($listconn,"SELECT `image_url`,`user`, $sqlselect `category`, `pdf_note`, `total` FROM `$list` WHERE `id` = '$id'");
$num_rows = mysqli_num_rows($row);
if ($num_rows > 0){
while($r = mysqli_fetch_array($row, MYSQLI_ASSOC)) { 
$category = $r['category'];
$user = $r['user'];
$instagram_url = $r['instagram_url'];
$instagram_count = $r['instagram_count'];
$facebook_url = $r['facebook_url'];
$facebook_count = $r['facebook_count'];
$twitter_url = $r['twitter_url'];
$twitter_count = $r['twitter_count'];
$youtube_url = $r['youtube_url'];
$youtube_count = $r['youtube_count'];
$notes = $r['pdf_note'];
$image = $r['image_url'];
$html .=         '
<div class="col-xs-12 m-t-10" style="float: left;border-bottom: 1px solid #ddd;">
    <!-- start user photo -->
                  <div id="photo" style="width: 50px;float: left;text-align: center;padding: 10px;">
                  <img src="http://cogenttools.com/'.$image.'" class="roundimg">
                  </div>
                <!-- end user photo --> 
                <!-- Start Name + Bio + Social -->
                <div id="name+bio" style="width: 716px;float: left;">
                <p class="username">'.$user.'</p>         
                <p style="font-weight:normal;font-size: 12px;word-wrap: break-word;white-space: normal;">'.$notes.'</p>';
#We are going to check for each platform and check if it's there.
foreach($arrplat as $platform => $value){
if($platform === 'instagram'){
$total += $instagram_count;
$html .='<div style="width:143.2px;float:left;">

        <div style="width:25%;float:left;">
        <img src="http://cogenttools.com/images/instagram_logo.png" class="img50">
        </div>

        <div style="width: auto;float:left;padding: 12px;text-align: center;">
        <a href="'.$instagram_url.'" target="_blank" class="sociallink">'.number_format($instagram_count).'</a>
        <p class="font12">FOLLOWERS</p>
        </div> 
        </div>';
}

if($platform === 'twitter'){
$total += $twitter_count;
$html .='           
        <div style="width:143.2px;float:left;">
        
        <div style="width:25%;float:left;">
        <img src="http://cogenttools.com/images/twitter_logo.png" class="img50">
        </div>
        
        <div style="width: auto;float:left;padding: 12px;text-align: center;">
        <a href="'.$twitter_url.'" target="_blank" class="sociallink">'.number_format($twitter_count).'</a>
        <p class="font12">FOLLOWERS</p>
        </div>
        </div>';
}


if($platform === 'facebook'){
$total += $facebook_count;
$html.= '<div style="width:143.2px;float:left;">
        <div style="width:25%;float:left;">
        <img src="http://cogenttools.com/images/facebook_logo.png" class="img50">
        </div>

        <div style="width: auto;float:left;padding: 12px;text-align: center;">
        <a href="'.$facebook_url.'" target="_blank" class="sociallink">'.number_format($facebook_count).'</a>
        <p class="font12">LIKES</p>
        </div>
                        
        </div>
';
}

if($platform === 'youtube'){
$total += $youtube_count;
$html.=' 
        <div style="width:143.2px;float:left;">
        
        <div style="width:25%;float:left;">
        <img src="http://cogenttools.com/images/youtube_logo.png" class="img50">
        </div>

        <div style="width: auto;float:left;padding: 12px;text-align: center;">
        <a href="'.$youtube_url.'" target="_blank" class="sociallink">'.number_format($youtube_count).'</a>
        <p class="font12">SUBSCRIBERS</p>
        </div>              
        </div>';
        }
    }
#end foreach. 

$html .= '  
        <div style="width:143.2px;float:left;">
        
        <div style="width:25%;float:left;">
        </div>

        <div style="width: auto;float:left;padding: 12px;text-align: center;">
        '.number_format($total).'
        <p class="font12">TOTAL REACH</p>
        </div>              
        </div>
        </div>
   </div>
';


unset($total);
//end sql loops 
}

}
}



$docraptor = new DocRaptor\DocApi();
$doc = new DocRaptor\Doc();
$doc->setTest(true); 
              # test documents are free but watermarked
$doc->setDocumentContent(' <head>
    <title>New List PDF Export</title>
    <link rel="shortcut icon" href="http://cogenttools.com/cogent-favicon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <style type="text/css">
    
@page {
        margin: 115px 0 75px 0;
        @top {
          content: flow(header);
          vertical-align: top;
        }
        @bottom {
          content: "COGENT ENTERTAINMENT MARKETING | 150 5TH AVENUE 4TH FLOOR NEW YORK, NY 100011 ";
          background-color: #BC0001;
          color: #fff;
          font-family; helvetica neue;
          width: 816px;
          font-size:14px;
        }
      }
      #redtop { flow: static(header); }
        
                .col-xs-12 {

                    width: 816px;
                }

                .row {

                    margin-left: 0px;
                    margin-right: 0px;
                }
                

                #td1 {

                width: 300px;
            
                    }
                .socialtd{
                    width:123.2px;
                    text-align: center;
                    }

                .username {
                
                text-transform: uppercase;
                font-weight: bold;
                color: #4c4c4c;
                font-family:Helvetica neue;
                padding-bottom:5px;
                padding-top:15px;

                }    

                .notes {
                color: #4c4c4c;
                font-family:Helvetica neue;
                padding-bottom:5px;
                padding-top:5px;

                }  
                #div1 {

                width: 50px;
                display: inline-block;
                float: left;
                padding-top:10px;
                padding-left:10px;

                    }

                #div2 {

                width: 200px;
                display: inline-block;
                float: left;
                padding-left:10px;

                    }

                .sociallink {

                font-weight: bold;
                color: blue !important;
                text-decoration: underline;
                text-transform: uppercase;
                font-family: helvetica neue;
                font-size: 12px;

                    }
                    
                    .totalnum {
                    font-weight: bold;
                    text-transform: uppercase;
                    font-family: helvetica neue;
                    padding-bottom: 0px;
                    }

                .centered {

                text-align: center;

                    }

                .noborderright {

                border-right: none;

                    }

                h1 { 
                    
                    text-align: center 

                }

                 h3 {
                    line-height: 1.1;
                    font-size: 36px;
                    margin-bottom: 0px;
                    margin-top: 0px;
                    font-family: "Helvetica", sans-serif !important;
                }

                h4 {

                    text-align: left;
                    text-transform:uppercase;
                    font-weight:bold;
                    line-height: .5px;
                    font-family: helvetica;
                    display:inline;
                    font-size:12px;
                }
               
                
                img {
                    vertical-align: middle;
                    border: 0;
                }

                .roundimg {

                width:50px; 
                border-radius:150px;
                margin-right: 10px;
                    
                    }

                .m-b-20 {
                    margin-bottom: 20px !important;
                }

                .m-r-20 {
                    margin-right: 20px !important;
                }
                
                .col-md-4 {
                    width: 33.33333%;
                    float:left;
                }
                .col-xs-6 {
                    width: 50%;
                    float:left;
                }


                p {
                    display: block;
                    margin: 0px;
                    font-family: helvetica neue;
                    font-size: 12px;
                    font-weight: bold;
                }


                th, td {
                    text-align:left;
                }

                table th {
                
                border-bottom:1px solid #d1d1d1;
                color: #d2d2d2;
                font-family: helvetica neue;
                font-weight: bold;
                text-align: center;
                font-size:12px;
                
                }
                
                table tr {
                
                border-bottom:1px solid #d1d1d1;
                
                }
                
                table td {
                
                border-right:1px solid #d1d1d1;
                border-bottom:1px solid #d1d1d1;
                padding:10px 0 10px 0;
                
                }

                .img50 {

                width: 50px;

                }

                .h3center {

                        text-transform: uppercase;
                        color: #ffffff;
                        font-weight: bold;
                        font-family: helvetica;
                        text-align: center;

                        }

                .font12 {

                font-size:8px;
                
                }

                .pcenter {
                    
                display: block;
                text-align: center;
                    
                }

                .m-t-10 {
                    
                margin-top:10px;

                }

    </style>

</head>

<body style="margin:0px;">


<!-- START HEADER -->

    <div class="col-xs-12 centered" id="redtop" style="background: #bc0001; min-height: 75px;padding: 0px; margin:0px;">
            
            <div style="padding-top:15px;">
            <img src="http://cogenttools.com/assets/assets/cogent-white-100.png"> 
            </div>
        
            <div id="title" style="margin-top:15px;">
            <h3 class="h3center">'.$list.'</h3>
            </div>
        
    </div>

<!-- END HEADER DIV -->


<div class="col-xs-12 m-t-10 centered" style="padding-left:5px;">
  
  '.$summary.' 
  
  </div> 
            '.$html.'


</body>
</html>');     # supply content directly
  # $doc->setDocumentUrl("http://docraptor.com/examples/invoice.html");  # or use a url
$doc->setName("docraptor-php.pdf");                                    # help you find a document later
$doc->setDocumentType("pdf");      
                                   # pdf or xls or xlsx
  // $doc->setJavascript(true);                                           # enable JavaScript processing
   //$prince_options = new DocRaptor\PrinceOptions();                     # pdf-specific options
   //$doc->setPrinceOptions($prince_options);
   //$prince_options->setMedia("screen");                                 # use screen styles instead of print styles
   //$prince_options->setBaseurl("http://hello.com");                     # pretend URL when using document_content
$create_response = $docraptor->createAsyncDoc($doc);
$create_response = $docraptor->createDoc($doc);
//var_dump($create_response);
header('Content-Description: File Transfer');
header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename='.$list.'.pdf');
header('Content-Transfer-Encoding: binary');
header('Expires: 0');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Pragma: public');
header('Content-Length: ' . strlen($create_response));
ob_clean();
flush();
echo($create_response);
function generateRandomString($length = 5) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
 
 


?>