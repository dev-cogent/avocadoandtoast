<?php 

include 'savecampaign.php';
class launchCampaign extends saveCampaign{



function launch($campaignid,$campaignname,$columnid){
$launchconn = $this->launchDB();
$genconn = $this->dbinfo();
$stmt = $genconn->preapre('INSERT INTO `launch_campaign_link` (`campaign_name`,`column_id`,`campaign_id`) VALUES(?,?,?)');
$stmt->bind_param('sss',$campaignname,$columnid,$campaignid);
if(!$stmt->execute()) return false; 
//$stmt

//Create launch campaign in launch link. 
}










function launchDB(){
date_default_timezone_set('EST'); # setting timezone
$dbusername ='l5o0c8t4_blaze'; 
$password = 'Platinum1!'; 
$db = 'l5o0c8t4_launched_campaign'; 
$servername = '162.144.181.131'; 
$conn = new mysqli($servername, $dbusername, $password, $db);
$date = new DateTime();
$last_updated = $date->getTimestamp();
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}     
}



}

