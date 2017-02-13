<?php 
$facebooktoken = '1075628395822185|Y0CgNIZP8EiF2esClPtNaki4hiE';
$facebookhandle = $_POST['facebook_handle'];
$info = curl('https://graph.facebook.com/v2.7/'.$facebookhandle.'?fields=posts.limit(10){permalink_url}&access_token='.$facebooktoken);
$facebookpost = array();  
foreach($info['posts']['data'] as $id ){
    array_push($facebookpost,$id['permalink_url']);
}
foreach($facebookpost as $id){

    echo '<div class="fb-post" data-href="'.$id.'"></div>';
}







function curl($url) {
    $curl_connection = curl_init($url);
    curl_setopt($curl_connection, CURLOPT_CONNECTTIMEOUT, 30);
    curl_setopt($curl_connection, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl_connection, CURLOPT_SSL_VERIFYPEER, false);
    $json = json_decode(curl_exec($curl_connection), true); 
    curl_close($curl_connection);
    return $json;     
    
} // end curl 
    