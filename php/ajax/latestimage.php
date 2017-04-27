<?php
error_reporting(0);
$instuser = $_POST['inst_user'];
$html = instcurl('https://www.instagram.com/'.$instuser.'/');
$code = explode('"code":',$html);
foreach($code as $info){
$link = explode('"',$info);
$link = $link[1];
$image = explode('"display_src":',$info);
$image = explode('"',$image[1]);
$image = $image[1];

if($image == NULL)
continue;
echo '<div class="col-xs-12 col-sm-6  col-lg-6 col-xl-4 image-container">
               <a href="https://instagram.com/p/'.$link.'" target="_blank"><img class="col-xs-12 image-size" src="'.$image.'"></a>
      </div>';
}













 function instcurl($url){
        $ch = curl_init();  // Initialising cURL
        curl_setopt($ch, CURLOPT_URL, $url);    // Setting cURL's URL option with the $url variable passed into the function
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); // Setting cURL's option to return the webpage data
        $data = curl_exec($ch); // Executing the cURL request and assigning the returned data to the $data variable
        curl_close($ch);    // Closing cURL
        return $data;   // Returning the data from the function

 } // end instcurl
