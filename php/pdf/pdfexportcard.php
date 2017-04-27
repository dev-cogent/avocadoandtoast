<?php 
session_start();
require  "autoload.php"; 
include '../numberAbbreviation.php';
include '../dbinfo.php';
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
}
foreach($arrplat as $plat){
$url = $plat['sqlurl'];
$count = $plat['sqlcount'];
$sqlselect .= "`$url`,`$count`,";
}
$users = $_SESSION['users'];
$list = $_SESSION['list'];
$summary = $_SESSION['summary'];
$order = $_SESSION['orderby'];
if($order == 'desc')
$orderby = "ORDER BY `user` DESC";
elseif($order == 'asc')
$orderby = "ORDER BY `user` ASC";
elseif($order != 'total')
$orderby = "ORDER BY `".$order."_count` DESC";
else{
$orderby = "ORDER BY `total` DESC";
}
foreach($users as $id){
$in .= "'$id',";
}
$in = substr($in, 0, -1);
$row = mysqli_query($conn,"SELECT `image_url`,`user`, $sqlselect `category`, `pdf_note`, `total` FROM `User_Information` WHERE `id` IN ($in) $orderby");
$num_rows = mysqli_num_rows($row);
if ($num_rows > 0){
while($r = mysqli_fetch_array($row, MYSQLI_ASSOC)) { 
$category = $r['category'];
$user = $r['user'];
$instagram_url = $r['instagram_url'];
$instagram_count = numberAbbreviation($r['instagram_count']);
$facebook_url = $r['facebook_url'];
$facebook_count = numberAbbreviation($r['facebook_count']);
$twitter_url = $r['twitter_url'];
$twitter_count = numberAbbreviation($r['twitter_count']);
$youtube_url = $r['youtube_url'];
$youtube_count = numberAbbreviation($r['youtube_count']);
$total = numberAbbreviation($r['total']);
$notes = $r['pdf_note'];
$image = $r['image_url'];
$bio = $r['bio'];
$pdfnotes = $r['pdf_note'];
$html .='
<div class="card-frame">
<div class="card bs-card"> 
<img class="card-img-top" src="http://cogenttools.com/'.$image.'" alt="">

<div class="card-block">
<h4 class="card-title p-t-10 " style="font-size:14px;font-weight:800;padding:5px;margin-top:5px;margin-bottom:0px;">'.$user.' | '.$total.'</h4> 
<div style="height:95px;  padding:0 5px 0 5px;"> <p class="card-text">'.$pdfnotes.'</p></div>
<table style="width: 100%;">
<tbody>
<tr style="text-align:center; color:#fff; font-weight:800;">

';
foreach($arrplat as $platform => $value){
if($platform === 'instagram'){
$html .='<td class="social-table" style="background:#517fa4;"><a class="count-link" href="'.$instagram_url.'" target="_blank">'.$instagram_count.'<br><img src="http://www.cogenttools.com/images/instagram_logo.png" class="img20"></a></td>';
}
if($platform === 'facebook'){
$html .='<td class="social-table" style="background:#3b5998;"><a class="count-link" href="'.$facebook_url.'" target="_blank">'.$facebook_count.'<br><img src="http://www.cogenttools.com/images/facebook_logo.png" class="img20"></a></td>';
}
if($platform === 'twitter'){
$html .='<td class="social-table" style="background:#00aced;"><a class="count-link" href="'.$twitter_url.'" target="_blank">'.$twitter_count.'<br><img src="http://www.cogenttools.com/images/twitter_logo.png" class="img20"></a></td>';
}

if($platform === 'youtube'){
$html .='<td class="social-table" style="background:#e52d27;"><a class="count-link" href="'.$youtube_url.'" target="_blank">'.$youtube_count.'<br><img src="http://www.cogenttools.com/images/youtube_logo.png" class="img20"></a></td>';
}

}

$html.='
</tr>
</tbody>
</table>
</div>

</div>
</div>
';
//end sql loops 

}
}



$docraptor = new DocRaptor\DocApi();
$doc = new DocRaptor\Doc();
$doc->setTest(false); 
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

                .card-frame {

                    width: 194px;
                    float:left;
                    padding: 0 5px 5px 5px
                    }


                    .social-table {
                        width: 48.5px;
                    font-size: 12px;
                        }

                        .img20 {

                            width:20px;
                            text-decoration: none;
                            }

                            .count-link {

                                color:#fff !important;
                                text-decoration: none;

                                }


               .card {
    background: #f2f2f2 !important;
    color: #262932 !important;
    border-color: #f2f2f2 !important;
    page-break-inside:avoid;
}

.bs-card {
    border: 0;
    position: relative;
}

.card {
    position: relative;
    display: block;
    margin-bottom: 0.75rem;
    background-color: #fff;
    border: 1px solid #e5e5e5;
    border-radius: 0.25rem;
}

.card .card-img, .card .card-img-top {
    width: 100%;
}

.card-img-top {
    border-radius: 0.25rem 0.25rem 0 0;
}

img {
    vertical-align: middle;
    border: 0;
}

.bs-card .card-block {
    position: relative;
}

.p-t-10 {
    padding-top: 10px !important;
}

.m-b-10 {
    margin-bottom: 10px !important;
}

h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6 {

    font-family: helvetica neue;

    }

    .bs-card .card-text {
    font-size: 14px;
    margin:0px;
}

.centered {

text-align: center;

}

.h3center {
text-transform: uppercase;
color: #ffffff;
font-weight: bold;
font-family: helvetica;
text-align: center;
}
                        
.col700 {width:700px;}
.col800 {width: 800px;padding-left: 10px;padding-right: 10px;}
                        

    </style>

</head>

<body style="margin:0px;">

    <div class="col-xs-12 centered" id="redtop" style="background: '.$color.'; min-height: 75px;padding: 0px; margin:0px;">
            
            <div style="padding-top:15px;">
            <img src="'.$pdflogo.'"></img> 
            </div>
        
            <div id="title" style="margin-top:15px;">
            <h3 class="h3center">'.$list.' LIST</h3>
            </div>
        
    </div>

    <!-- END HEADER DIV -->

<div class="col800 m-t-10 centered" style="margin-left:15px;margin-right:15px;">
  
  '.$summary.' 
  
  </div>


<div id="table" class="col-xs-12">

<!-- START TABLE PDF -->


 
            '.$html.'

        <!-- END TABLE -->



</div>
<!-- END TABLE DIV -->

  

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