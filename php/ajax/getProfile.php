<?php
session_start();
include '../dbinfo.php';
$stmt = $conn->prepare("SELECT `email`,`firstname`,`lastname`,`company` FROM `login_information` WHERE `userid` = ?");
$stmt->bind_param('s',$_SESSION['userid']);
if(!$stmt->execute()){
  header('Location: /login.php');
}
$stmt->bind_result($email,$firstname,$lastname,$company);
$stmt->fetch();
$userid = $_SESSION['userid'];
unset($conn);
?>
<form action="" method="POST" enctype= "multipart/form-data">

    <div class="user-profile-pic"> </div>
      <div class="upload-img">
        <div class="uploaded-img-square"><img src="http://avocadoandtoast.com/images/user/<?php echo $userid ;?>.jpg" onerror="this.src=`/assets/images/default-photo.png`" style="height:150px; width:150px;"> </div>
        <div class="profile-title"> Your Avatar </div>
          <input type="file" class="upload-img-btn avocado-hover avocado-focus" name="image" >  Upload Image
          </div>


    <label class="title"> Company Name </label>
    <br/>
    <input type="text" id="company" name="company" class="form-control category avocado-focus" value="<?php echo $company;?>" maxlength="100" style="">
  </input>
    <label class="title"> First Name  </label>
    <br/>
    <input name="firstname" type="text" class="form-control category avocado-focus" value="<?php echo $firstname;?>"  style="" maxlength="100">
  </input>

  <label class="title"> Last Name  </label>
  <br/>
  <input  name="lastname" type="text" class="form-control category avocado-focus" value="<?php echo $lastname;?>"  style="" maxlength="100">
  </input>

    <label class="title"> Email </label>
    <br/>
    <input name="email" type="email" class="form-control category avocado-focus" value="<?php echo $email;?>"  style="" maxlength="100">
  </input>

    <button class="update-profile-btn col-xs-12"  style="margin-top:30px;" id="submit" type="submit" name="profile"> Update Profile </button>
    <button class="update-password-btn col-xs-12"  style="margin-top:30px;" id="getPassword" type="button" name="profile"> Change Password </button>
    </form>
