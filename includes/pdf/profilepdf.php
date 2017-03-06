<?php 
session_start();
require  "autoload.php"; 
include '../numberAbbreviation.php';
include '../dbinfo.php';
$user = $_SESSION['user'];
$configuration = DocRaptor\Configuration::getDefaultConfiguration();
$configuration->setUsername("iLYpGOvi5Y02WmSLsI"); # this key works for test documents
$configuration->setSSLVerification(false);
//$configuration->setDebug(true);
$html = $_SESSION['html'];
$docraptor = new DocRaptor\DocApi();
$doc = new DocRaptor\Doc();
$doc->setTest(true);  
# test documents are free but watermarked
$doc->setDocumentContent($html);     # supply content directly
  # $doc->setDocumentUrl("http://docraptor.com/examples/invoice.html");  # or use a url
$doc->setName("docraptor-php.pdf");                                    # help you find a document later
$doc->setDocumentType("pdf");                                          # pdf or xls or xlsx
$doc->setJavascript(true);                                           # enable JavaScript processing
$prince_options = new DocRaptor\PrinceOptions();                     # pdf-specific options
$doc->setPrinceOptions($prince_options);
   //$prince_options->setMedia("screen");                                 # use screen styles instead of print styles
   //$prince_options->setBaseurl("http://hello.com");                     # pretend URL when using document_content
$create_response = $docraptor->createAsyncDoc($doc);
$create_response = $docraptor->createDoc($doc);
//var_dump($create_response);
header('Content-Description: File Transfer');
header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename='.$user.'.pdf');
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