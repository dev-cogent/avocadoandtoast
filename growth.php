<?php 
include 'includes/class/searchclass.php';
$getinformation = new search();
$conn = $getinformation->dbinfo();
$date = date('m.d.y');
$previousday = date('m.d.y',strtotime(' -1 day'));
$sql = "ALTER TABLE `Growth_Influencer_Information`
ADD `$date` BLOB(200)";
if($conn->query($sql) == true){
echo "Altered!";
}
else{
   echo $conn->error;
   echo "Table already has been altered. Going to continue anyway";
}

$count = 1;
$row = mysqli_query($conn,"Select `id`,`facebook_url`, `instagram_url`, `twitter_url`, `youtube_url` FROM User_Information");
$num_rows = mysqli_num_rows($row); 
if ($num_rows > 0){
while($r = mysqli_fetch_array($row, MYSQLI_ASSOC)) {
        #Initalize all the information from the database. 
        $id = $r['id'];
        $facebook_url = $r['facebook_url'];
        $instagram_url = $r['instagram_url'];
        $twitter_url = $r['twitter_url'];
        $youtube_url = $r['youtube_url']; 
        $arr = array();
        #Before we continue, let's check if the user has been updated in our table.'
        $chrow = mysqli_query($conn,"Select `$date` FROM `Growth_Influencer_Information` WHERE `id` = '$id'");
        $chnum_rows = mysqli_num_rows($chrow);
        if ($chnum_rows > 0){
            while($chr = mysqli_fetch_array($chrow, MYSQLI_ASSOC)) {
                $chekdate = $chr[$date];
             }
            }
        else{
                $sql = "INSERT INTO `Growth_Influencer_Information` (id) VALUES ('$id')";
                if($conn->query($sql) == true) echo "$id has been added to Growth.";
            }
        if($chekdate != NULL) continue;
        

        #Get the facebook likes. 
        if($facebook_url != null){
            $facebook_new_count = $getinformation->facebook($facebook_url, true); // @params facebook url, if true returns just likes else returns array 
            if($facebook_new_count == NULL || !is_int($facebook_new_count)) $facebook_new_count = 0;
        }
        else $facebook_new_count = 0;

        #Get instagram information
        if($instagram_url != null){
            $instagram_new_count = $getinformation->instagram($instagram_url, true); // @params instagram url, if true returns just likes else returns array 
            //In the case that likes for some reason returns empty. 
            if($instagram_new_count == NULL) $instagram_new_count = 0;
        }
        else $instagram_new_count = 0;
        

        #Get twitter information 
        if($twitter_url != null){
            $twitter_new_count = $getinformation->twitterDataScrape($twitter_url,true); // @params twitter url, if true returns just followers
            if($twitter_new_count == NULL) $twitter_new_count = 0;
        }
        else $twitter_new_count = 0;
        
        #Get youtube information
        if($youtube_url != null){
            $youtube_new_count = $getinformation->youtube($youtube_url); // @params twitter url, if true returns just followers
            //In the case that followers for some reason returns empty. 
            if($youtube_new_count == NULL)
            $youtube_new_count = 0;
        }
        else $youtube_new_count = 0;
        
        #End youtube information        
        #Now we have to create a specific way to input the information, and break it down afterwards.
        $new_total = $facebook_new_count + $youtube_new_count + $twitter_new_count + $instagram_new_count;
        $arr['facebook'] = $facebook_new_count;
        $arr['twitter'] = $twitter_new_count;
        $arr['instagram'] = $instagram_new_count;
        $arr['youtube'] = $youtube_new_count;
        $arr['total'] = $new_total;
        //Now we have to find if they had a previous date. 
        $stmt = $conn->prepare("SELECT `$previousday` FROM `Growth_Influencer_Information` WHERE `id` = ? ");
        if($stmt != false){
           $stmt->bind_param('s',$id);
           $stmt->execute();
           $stmt->bind_result($info);
           $stmt->fetch();
           if($info != NULL){
               $info = json_decode($info,true);
               $arr['growth']['facebook'] = $arr['facebook'] - $info['facebook'];
               $arr['growth']['twitter'] = $arr['twitter'] - $info['twitter'];
               $arr['growth']['instagram'] = $arr['instagram'] - $info['instagram'];
               $arr['growth']['youtube'] = $arr['youtube'] - $info['youtube']; 
               $arr['growth']['total'] = $arr['total'] - $info['total'];
               $growth = $arr['growth']['total'];
           }
        }

        if($info != NULL){
            $growthpercentage = 100*($arr['growth']['total']/$arr['total']);
            $growthpercentage = number_format($growthpercentage, 3, '.', ' '); 
        }
        else $growthpercentage = 0;
        unset($stmt);
        $arr = json_encode($arr);
        echo $arr;
        $stmt = $conn->prepare("UPDATE `Growth_Influencer_Information` SET `$date` = ? WHERE `id` = ?");
        $stmt->bind_param('ss',$arr,$id);
        if($stmt->execute()) echo $id.' has been updated';
        unset($stmt);

        $stmt = $conn->prepare("UPDATE `User_Information` SET `facebook_count` = ?, `instagram_count` = ?,  `twitter_count` = ?, `youtube_count` = ?, `growth` = ?, `growth_percentage` = ?, `total` = ? WHERE `id` = ?");
        $stmt->bind_param('iiiiiiis',$facebook_new_count,$instagram_new_count,$twitter_new_count,$youtube_new_count, $new_total, $growth,$growthpercentage,$id);
        if($stmt->execute()) echo $id. 'has been updated in the system';
        echo '<br/>';

        unset($facebook_new_count);
        unset($youtube_new_count);
        unset($twitter_new_count);
        unset($instagram_new_count);
        unset($new_total);
        unset($id);
        unset($stmt);
        unset($arr);
        $count++;



    } // end while 
} // end if 













?>