<?php
include '../class/list.php';
$listnames = array();
$obj = new listOptions;
$listconn = $obj->listDB();
$gendb = $obj->dbinfo();
$stmt = $listconn->prepare("SELECT table_name FROM information_schema.tables where table_schema='l5o0c8t4_list';");
$stmt->execute();
$stmt->bind_result($list);
while($stmt->fetch()){
array_push($listnames,$list);
}
unset($stmt);
foreach($listnames as $list){
$comment = array();
$total = 0;
$growth = 0;

$stmt = $listconn->prepare("SELECT `influencer_id` FROM `$list`");
$stmt->execute();
$stmt->bind_result($influencer);
    while($stmt->fetch()){
        $genstmt = $gendb->prepare("SELECT `total`,`growth` FROM `Influencer_Information` WHERE `id` = ?");
        $genstmt->bind_param('s',$influencer);
        $genstmt->execute();
        $genstmt->bind_result($emptotal,$tempgrowth);
        $genstmt->fetch();
        $total += $tempgrowth;
        $growth += $tempgrowth;   
        unset($genstmt);
    }
var_dump($list);
$comment['total'] = $total;
$comment['growth'] = $growth;
$comment = json_encode($comment);
$update = $obj->updateListSummary($list,$comment);
var_dump($update);
}
?>