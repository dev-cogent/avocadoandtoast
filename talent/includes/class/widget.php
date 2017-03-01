<?php 


include 'favorite.php';
class influencerWidget extends favorite{



public function defaultUsers(){
if(!isset($_SESSION)) session_start();
$favoriteinfluencers = $_SESSION['favoriteinfluencers'];
$conn = $this->dbinfo();    
$stmt = $conn->prepare("SELECT `id`,`image_url`,`user`,`total` FROM `Influencer_Information` ORDER BY `total` DESC LIMIT 0,20");
$stmt->execute();
$stmt->bind_result($id,$image_url,$username,$total);
while($stmt->fetch()){
   $html .= '
  <div class="col-lg-3 text-center">
      <div class="example">
        <img class="user img-circle" width="100" height="100" src="https://project.social/'.$image_url.'" onerror="this.src=`https://project.social/images/ps-square.jpg`" data-id="'.$id.'" data-img="'.$image_url.'" alt="...">
      </div>
      <p style="font-weight: 800;">'.$username.'</p>
      <p>'.$this->numberAbbreviation($total).' Total Reach</p>';
      if($favoriteinfluencers !== NULL){
          $html.= $this->checkFavorite($id,$favoriteinfluencers);
      }
      else{
      $html .= '<!--<p class="campaign" data-id="'.$id.'">ADD TO CAMPAIGN </p--> <i data-id="'.$id.'" class="favorite icon fa-heart-o" aria-hidden="true"></i>';
      }
  $html .= '</div>'; 

}
return $html;
}


public function userWidget($influencerid){
$conn = $this->dbinfo();    
$stmt = $conn->prepare("SELECT `image_url`,`user`,`total` FROM `Influencer_Information` WHERE `id` = ?");
$stmt->bind_param('s',$influencerid);
$stmt->execute();
$stmt->bind_result($id,$image_url,$username,$total);
$stmt->fetch();
$html =   '<div class="col-lg-3 text-center">
      <div class="example">
        <img class="user img-circle" width="100" height="100" src="https://project.social/'.$image_url.'" onerror="this.src=`https://project.social/images/ps-square.jpg`" data-id="'.$id.'" data-img="'.$image_url.'" alt="...">
      </div>
      <p style="font-weight: 800;">'.$username.'</p>
      <p>'.$this->numberAbbreviation($total).' Total Reach</p>
      <!--<p class="campaign" data-id="'.$id.'">ADD TO CAMPAIGN </p--> <i data-id="'.$id.'" class="favorite icon fa-heart-o" aria-hidden="true"></i> 
  </div>'; 
return $html;
}



public function multipleUserWidget($influencerids,$userid){
    $conn = $this->dbinfo();
    if(!isset($_SESSION)) session_start();
    $favoriteinfluencers = $_SESSION['favoriteinfluencers'];
    
    foreach($influencerids as $influencer)
            $sql .= "'$influencer',";

    $sql = substr($sql, 0, -1);
    $stmt = $conn->prepare("SELECT `id`,`image_url`,`user`,`total` FROM `Influencer_Information` WHERE `id` IN ($sql)");
    $stmt->execute();
    $stmt->bind_result($id,$image_url,$username,$total);
    while($stmt->fetch()){
    $html .= '
    <div class="col-lg-3 text-center">
        <div class="example">
            <img class="user img-circle" width="100" height="100" src="https://project.social/'.$image_url.'" onerror="this.src=`https://project.social/images/ps-square.jpg`" data-id="'.$id.'" data-img="'.$image_url.'" alt="...">
        </div>
        <p style="font-weight: 800;">'.$username.'</p>
        <p>'.$this->numberAbbreviation($total).' Total Reach</p>
        <p class="campaign" data-id="'.$id.'">ADD TO CAMPAIGN </p>'; 
        $html.= $this->checkFavorite($id,$favoriteinfluencers);
        $html .='</div>';
    }

    return $html;



}





public function numberAbbreviation($number) {
        if($number == NULL || $number == 0){
          $number = "0";
          return $number;
        }
        $abbrevs = array(12 => "T", 9 => "b", 6 => "m", 3 => "k", 0 => "");
          foreach($abbrevs as $exponent => $abbrev) {
        if($number >= pow(10, $exponent)) {
            $display_num = $number / pow(10, $exponent);
            $decimals = ($exponent >= 3 && round($display_num) < 100) ? 1 : 0;
            return number_format($display_num,$decimals) . $abbrev;
        }}}











}