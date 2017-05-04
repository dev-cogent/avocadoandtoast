<?php
// PDO connect *********
function connect() {
    return new PDO('mysql:host=50.87.144.169;dbname=cogentwo_words', 'cogentwo_user', 'Platinum1!', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
}
 
$pdo = connect();
$keyword = '%'.$_POST['keyword'].'%';
$sql = "SELECT `word`FROM `newwords` WHERE `word` LIKE (:keyword) ORDER BY `newword` DESC LIMIT 0, 10";
$query = $pdo->prepare($sql);
$query->bindParam(':keyword', $keyword, PDO::PARAM_STR);
$query->execute();
$list = $query->fetchAll();
foreach ($list as $rs) {
	// put in bold the written text
	$user = str_replace($_POST['keyword'], '<b>'.$_POST['keyword'].'</b>', $rs['user']);
	$image = $rs['image_url'];
	$total = numberAbbreviation($rs['total']);
	
	// add new option
    echo '<li onclick="set_itemsearch(\''.str_replace("'", "\'", $rs['user']).'\')"><img src="'.$image.'" width="20px" style="margin-right:3px; border-radius:50px;"/>'.$user.' | '.$total.' </li>';
}
?>