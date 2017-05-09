<?php
function connect() {
    return new PDO('mysql:host=50.87.144.169;dbname=cogentwo_words', 'cogentwo_user', 'Platinum1!', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
}

$pdo = connect();
$keyword = '%'.$_POST['keyword'].'%';
$sql = "SELECT `word` FROM `newwords` WHERE `word` LIKE (:keyword) ORDER BY `word` DESC LIMIT 0, 1";
$query = $pdo->prepare($sql);
$query->bindParam(':keyword', $keyword, PDO::PARAM_STR);
$query->execute();
$list = $query->fetchAll();
foreach ($list as $rs) {
	// put in bold the written text

	// add new option
    echo $rs['word'];
}
