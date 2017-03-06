<?php 
session_start();
require  "autoload.php"; 

$configuration = DocRaptor\Configuration::getDefaultConfiguration();
$configuration->setUsername("iLYpGOvi5Y02WmSLsI"); # this key works for test documents
$configuration->setSSLVerification(false);
//$configuration->setDebug(true);
$docraptor = new DocRaptor\DocApi();

  $doc = new DocRaptor\Doc();
  $doc->setTest(true); 
  $count = 0;
  $html = '<p> hello </p>';
                                            # test documents are free but watermarked
  $doc->setDocumentContent('
  <html>
  <head>
    <title>Cogent Influencer Deck</title>
    <link rel="shortcut icon" href="http://cogenttools.com/cogent-favicon.png">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700|Open+Sans:400,700|Nothing+You+Could+Do|" rel="stylesheet">
<style type="text/css">

/* Set the content of an H1 to the identifier "doctitle" */
h3 { string-set: doctitle content(); }

@page {
margin: 20px;
 
}
@page {
margin-left: 20px;
margin-right:20px;
}
body{
  margin-right:20px;
  margin-left:20px;
}
img{
  margin-left:-20px;
}

#title{
  font-size:60px;
    margin-top:0px;
}

#brand{
  font-size:35px;
  margin-bottom:0px;
}

#summary{
  width:400px;
}

#request{
  width:400px;
}

#key li{
  list-style-type:none;
}
#key{
  margin-top:-80px;
}
</style>
<!-- New influencer display style -->
<!-- Starts here -->

<div class="header"><img src="http://avocadoandtoast.com/assets/images/at-logo-black.png">
<p style="float:right;">03.01.2017 </p>
</div>



<div id="brand-name">
  <h2 id="brand">BRAND NAME </h2>
  <h1 id="title">Campaign Title</h1>
  
</div>

<div id="summary">
   <p id="summary-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin in quam porttitor, pulvinar est id, pulvinar ante. Nulla eget justo dapibus, egestas nunc vel, maximus velit. Fusce sed accumsan justo. Morbi vehicula metus condimentum augue laoreet, ac posuere mi rutrum. Aliquam turpis magna, pretium eu venenatis eu, suscipit non magna. Nam rhoncus venenatis lorem. Vestibulum rutrum dolor in mi ullamcorper, sit amet </p>
</div>


<div id="request">
   <p id="summary-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin in quam porttitor, pulvinar est id, pulvinar ante. Nulla eget justo dapibus, egestas nunc vel, maximus velit. Fusce sed accumsan justo. Morbi vehicula metus condimentum augue laoreet, ac posuere mi rutrum. Aliquam turpis magna, pretium eu venenatis eu, suscipit non magna. Nam rhoncus venenatis</p>
</div>
<div style="float:right;" id="key">
  <li style="color:green;">POSTS</li>
  <li style="color:blue;">IMPRESSION</li>
  <li style="color:orange;">ENGAGEMENT</li>
  <li style="color:red;">SOCIAL FOLLOWING</li>
</div>




<table>
  <th style="width:300px;"> </th>
  <th>Meh</th>
  <th>blarg</th>
  
</table>


</div>
</body>
</html>
  ');     # supply content directly
  # $doc->setDocumentUrl("http://docraptor.com/examples/invoice.html");  # or use a url
  $doc->setName("docraptor-php.pdf");                                    # help you find a document later
  $doc->setDocumentType("pdf");                                          # pdf or xls or xlsx
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
header('Content-Disposition: attachment; filename= '.$list.'.pdf');
header('Content-Transfer-Encoding: binary');
header('Expires: 0');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Pragma: public');
header('Content-Length: ' . strlen($create_response));
ob_clean();
flush();
echo($create_response);
session_destroy();
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