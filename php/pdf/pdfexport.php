<?php 
error_reporting(0);
session_start();
require  "autoload.php"; 
include '../numberAbbreviation.php';
include '../dbinfo.php';
include '../dbinfolist.php';
$pdflogo = $_SESSION['pdf_picture'];
$day = date('m.d.y');
$daybefore = date('m.d.y', strtotime('-1 day'));
if ($_SESSION['listid'] == 'e28dfc6b390a6ce981c1bbf47bd481f9'){
$color = '#2A2725';
}
else{
$color = '#bc0001';
}

$pdflogo = 'http://cogenttools.com/assets/assets/cogent_logo.png';
$configuration = DocRaptor\Configuration::getDefaultConfiguration();
$configuration->setUsername("iLYpGOvi5Y02WmSLsI"); # this key works for test documents
$configuration->setSSLVerification(false);
//$configuration->setDebug(true);
$platforms = $_SESSION['platforms'];

$arrplat = array();
foreach($platforms as $platform){
$arrplat[$platform]['sqlcount'] = $platform.'_count';
$arrplat[$platform]['sqlurl'] = $platform.'_url';
$arrplat[$platform]['headerimage'] = '<th><img src="http://cogenttools.com/assets/images/'.$platform.'_black.png" class="img50"></th>';
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
$stmt = $conn->prepare("SELECT `engagement` FROM `User_Information` WHERE `id` = ?");
$stmt->bind_param('s',$id);
$stmt->execute();
$stmt->bind_result($information);
$stmt->fetch();
unset($stmt);   
$information = json_decode($information,true);
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
$html .=        '<tr><td class="firstTD" id="td1">
                    <div id="div1" style="margin-left:37px;">
                    <img src="http://cogenttools.com/'.$image.'" class="roundimg">
                    </div>
                    <div class="div2">
                    <p class="username">'.$user.'</p>
                    <p style="font-weight:normal">'.$notes.'</p>
                    </div>
                    </td>';
#We are going to check for each platform and check if it's there.
foreach($arrplat as $platform => $value){
if($platform === 'instagram'){
$total += $instagram_count;
$html .='   <td class="socialtd firstTD">   
                <table border="0" style="margin: 0px auto;">
                <td><p class="font12">FOLLOWERS</p></td>
                <td style="padding-left:4px;"><p class="font12">ENGAGEMENT*</p></td>
                <tr>
                <td class="sociallink" style="text-align:center;"><a class="sociallink" href="'.$instagram_url.'" target="_blank">'.number_format($instagram_count).'</a></td>
                <td class="sociallink" style="text-align:center;padding-left:4px;"><a class="sociallink" href="'.$instagram_url.'" target="_blank">'.number_format((($information['instagram']['average_engagement']/$instagram_count)*100),2,'.','').'%</a></td></tr>
                </table>
            </td>';
}

if($platform === 'twitter'){
$total += $twitter_count;
$html .='           
<td class="socialtd firstTD">   
                <table border="0" style="margin: 0px auto;">
                <td><p class="font12">FOLLOWERS</p></td>
                <td style="padding-left:4px;"><p class="font12">ENGAGEMENT*</p></td>
                <tr>
                <td class="sociallink" style="text-align:center;"><a class="sociallink" href="'.$twitter_url.'" target="_blank">'.number_format($twitter_count).'</a></td>
                <td class="sociallink" style="text-align:center;padding-left:4px;"><a class="sociallink" href="'.$twitter_url.'" target="_blank">'.number_format((($information['twitter']['average_engagement']/$twitter_count)*100),2,'.','').'%</a></td></tr>
                </table>
            </td>';
}


if($platform === 'facebook'){
$total += $facebook_count;
$html.= '<td class="socialtd firstTD">   
                <table border="0" style="margin: 0px auto;" >
                <td><p class="font12">FOLLOWERS</p></td>
                <td style="padding-left:4px;"><p class="font12">ENGAGEMENT*</p></td>
                <tr>
                <td class="sociallink" style="text-align:center"><a class="sociallink" href="'.$facebook_url.'" target="_blank">'.number_format($facebook_count).'</a></td>
                <td class="sociallink" style="text-align:center;padding-left:4px;"><a class="sociallink" href="'.$facebook_url.'" target="_blank">'.number_format((($information['facebook']['average_engagement']/$facebook_count)*100),2,'.','').'%</a></td></tr>
                </table>
            </td>';
}

if($platform === 'youtube'){
$total += $youtube_count;
$html.=' 
<td class="socialtd firstTD">
<a href="'.$youtube_url.'" class="sociallink">'.number_format($youtube_count).'</a>
<br><p class="font12">SUBSCRIBERS</p>
</td>';
        }
    }
#end foreach. 

$html .= '    
 <td class="socialtd firstTD" style="border-right:none;">
 <p class="totalnum">'.number_format($total).'</p>
 <p class="font12">TOTAL REACH</p>
 </td> </tr>';


unset($total);
//end sql loops 
}

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

        margin: 145px 0 75px 0;
        @top {
          content: flow(header);
          vertical-align: top;
        }

        @bottom {
          content: "COGENT ENTERTAINMENT MARKETING | 150 5TH AVENUE 4TH FLOOR NEW YORK, NY 100011";
          background-color: #BC0001;
          color: #fff;
          font-family: helvetica neue;
          width: 816px;
          font-size:12px;
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
                float: left;
                padding-top:10px;
                padding-left:10px;

                    }

                .div2 {

                width: 150px;
                float: left; 
                padding-left:10px;
                display:block;

                    }


                 .div3 {

                width: 190px;
                float: left; 
                padding-left:10px;
                display:block;

                    }

                .sociallink {

                font-weight: bold;
                color: #BC0001 !important;
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
                    font-size: 22px;
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
                color: black;
                font-family: helvetica neue;
                font-weight: bold;
                text-align: center;
                font-size:12px;
                
                }
                
                table tr {
                
                border-bottom:1px solid #d1d1d1;
                page-break-inside: avoid;
                
                }
                
                .firstTD {
                
                border-right:1px solid #d1d1d1;
                border-bottom:1px solid #d1d1d1;
                padding:10px 0 10px 0;
                
                }

                .img50 {
                padding-bottom:5px;
                width: 19px;
                height:15px;

                }

                .h3center {

                        text-transform: uppercase;
                        color: #ffffff;
                        font-weight: bold;
                        font-family: helvetica;
                        text-align: center;
                        letter-spacing: 1px;

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
  
    <div class="col-xs-12 centered" id="redtop" style="background: '.$color.'; min-height: 75px;padding: 0px; margin:0px;">
            
            <div style="padding-top:20px;">
            <img style="width:100px; height:39px;" src="'.$pdflogo.'"></img> 
            </div>
        
            <div id="title" style="margin-top:10px; padding-bottom:10px;">
            <h3 class="h3center">'.$list.' LIST</h3>
            </div>
        
    </div>

    <!-- END HEADER DIV -->
<div class="col-xs-12 m-t-10 centered" style="padding-left:5px;">

  '.$summary.' 

  </div>


<div id="table" class="col-xs-12">

<!-- START TABLE PDF -->

<table cellspacing="0" style="width:816px;margin-top:30px;">
            <thead>
                <tr>
                <th><div class="div2">INFLUENCER</div></th>
                '.$thead.'
                <th>TOTAL</th>
                </tr>
            </thead>


            <tbody>
 
            '.$html.'

            </tbody>
        </table>
        <div class="sidebar"style="height:100%; width:40px; background-color:white; float:left; position:fixed;"></div>
       <p style="padding-top:20px; padding-right:10px; float:right; font-size:12px; font-weight:bold;" class="font12">*Engagement is based on last 12 posts </p>
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