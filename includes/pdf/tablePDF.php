<?php 
session_start();
require  "autoload.php"; 
include '../numberAbbreviation.php';
$configuration = DocRaptor\Configuration::getDefaultConfiguration();
$configuration->setUsername("iLYpGOvi5Y02WmSLsI"); # this key works for test documents
$configuration->setSSLVerification(false);
//$configuration->setDebug(true);
$html = $_SESSION['users'];
$html = str_replace('<td class="sorting_1"><input type="checkbox" class="testcheck" id="check"></td>','',$html);
$list = $_SESSION['list'];
$summary = $_SESSION['summary'];
$docraptor = new DocRaptor\DocApi();

  $doc = new DocRaptor\Doc();
  $doc->setTest(true); 
              # test documents are free but watermarked
  $doc->setDocumentContent('  <head>
    <title>Cogent Influencer Deck</title>
    <link rel="shortcut icon" href="http://cogenttools.com/cogent-favicon.png">
    <style type="text/css">


/* Set the content of an H3 to the identifier "doctitle" */
h3 { string-set: doctitle content(); }
/* Use the value from "doctitle" as the content for headers */
@page {
margin: 20px;

}

h1{ text-align: center }

.row {
    margin-left: 0px;
    margin-right: 0px;
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
h3 {
    line-height: 1.1;
    font-size: 36px;
    margin-bottom: 0px;
    margin-top: 0px;
    font-family: "Helvetica", sans-serif !important;
}
.col-xs-12 {
    width: 100%;
}
.col-lg-3 {
    width: 25%;
}
.col-sm-6 {
    width: 50%;
}
.col-lg-1, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-lg-10, .col-lg-11, .col-lg-12 {
    float: left;
    position: relative;
    min-height: 1px;
    padding-left: 0.9375rem;
    padding-right: 0.9375rem;
}
.card {
    background: #f2f2f2 !important;
    color: #262932 !important;
    border-color: #f2f2f2 !important;
        display: block;
    margin-bottom: 0.75rem;
    border-radius: 0.25rem;
}
.bs-card {
    border: 0;
    position: relative;
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
.card-block {
    padding: 1.25rem;
}
.bs-card .card-title {
    text-transform: uppercase;
    font-size: 16px;
    font-weight: 700;
}
.m-b-20 {
    margin-bottom: 20px !important;
}

.w-50 {
    max-width: 50px;
}
.m-r-20 {
    margin-right: 20px !important;
}
.img-circle {
    border-radius: 50%;
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
    font-family: helvetica;
    font-size: 12px;
}

.m-t-5 {
    margin-top:5px;
}


th, td {
    text-align:left;
    font-family: helvetica neue;
    font-weight: 200;
    font-size:14px;
}

td {
    width: 17.5%;
}

table {
    background-color: transparent;
}

.table > tbody > tr > td {

    border-top: 1px solid #ececec;
}

.table > thead:first-child > tr:first-child > th {

    border-left-width: 0;
}

table.dataTable {
    clear: both;
    margin-top: 6px !important;
    margin-bottom: 6px !important;
    }

table.dataTable thead > tr > th.sorting {

        padding-right: 30px;
}

/* table-bordered */

.table-bordered {
    border-color: #ececec;
    border: 1px solid #eceeef;
}

.table-bordered th, .table-bordered td {
    border: 1px solid #eceeef;
}

.table-bordered > tbody > tr > td {

        border-color: #ececec;
}


/* table.table-bordered */

table.table-bordered.dataTable {
    border-collapse: separate !important;
}

table.table-bordered.dataTable tbody td {
    border-bottom-width: 0;
}

table.table-bordered.dataTable td {
    border-left-width: 0;
}

/* Table Striped */

.table-striped tbody tr:nth-of-type(odd) {
    background-color: #f9f9f9;
}

.table-striped > tbody > tr:nth-child(odd) > td {
        background-color: #f2f2f2;

}

.table-striped > tbody > tr:nth-child(even) > td {
    background-color: #ffffff;

}
a{
    text-decoration:none;
}
#hideThis{
    display:none;
}
#socialicon{
    width:20px;
    height:20px;
    }

.table td{
    padding:10px;
    line-height:1.5;
    vertical-align:top;
}

#table{
  width:100% !important;

}

#example-2{

  width: 100% !important; 
}

    </style>

</head>

<body style="width:100%">

    <div class="col-xs-12" style="border-bottom: 1px solid #999999;display:inline-block;">
        <div id="title" style="float:left;width:75%;margin-top:15px;">
        <h3 style="text-transform:uppercase;color:#084588;font-weight:800;font-family: helvetica;">'.$list.' List</h3>
        </div>
        <img style="height:60px; width:150px;"class="img-circle img-fluid profile-image" src="http://cogenttools.com/includes/pdf/cogentblimp.png">
    </div>

    <!-- END HEADER DIV -->
<div class="col-xs-12" style="display:inline-block;margin-top:20px;margin-bottom:20px;">
'.$summary.'
</div>

<div id="table" class="col-xs-12">

<table id="example-2" class="table table-hover table-striped table-bordered dataTable no-footer" cellspacing="0" role="grid" aria-describedby="example-2_info">


'.$html .'

</table>
        <!-- END TABLE -->

        </div>
        <!-- END TABLE DIV -->
 



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