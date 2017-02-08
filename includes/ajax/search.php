<?php 
session_start();
include '../class/widget.php';
$userobj = new influencerWidget;
$favoriteinfluencers = $_SESSION['favoriteinfluencers'];
$conn = $userobj->dbinfo();
$search = '%'.$_POST['search'].'%';
$stmt = $conn->prepare("SELECT `id`,`image_url`,`user`,`total` FROM `Influencer_Information` WHERE `user` LIKE ? ORDER BY `total` DESC LIMIT 0,10");
$stmt->bind_param('s',$search);
$stmt->execute();
$stmt->bind_result($id,$image_url,$username,$total);
while($stmt->fetch()){
    echo '<div class="col-lg-3 text-center">
    <div class="example">
                      <img class="user img-circle" width="100" height="100" src="https://project.social/'.$image_url.'" onerror="this.src=`https://project.social/images/ps-square.jpg`" data-id="'.$id.'" data-img="'.$image_url.'" alt="...">
                    </div>
    <p style="font-weight: 800;">'.$username.'</p>
    <p>'.$userobj->numberAbbreviation($total).' Total Reach</p>';
    echo $userobj->checkFavorite($id,$favoriteinfluencers);
    echo '</div>'; 
}