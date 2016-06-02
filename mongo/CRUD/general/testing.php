<?php
/**
 * Created by PhpStorm.
 * User: apersinger
 * Date: 5/26/2016
 * Time: 11:41 AM
 */
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
require_once ("$root/mongo/CRUD/classes/LeagueCollection.php");
require_once("$root/CRUD/classes/SummonerBucket.php");

$collectionToUse = "league_degree";

$summonerObj = new SummonerBucket();
$details = $summonerObj->GenerateNewBucketOfSummonerIds();

$results = $summonerObj->InsertNewBucketOfSummonerIds($details->bucket_id, $details->summoners);

$mongoObj = new LeagueCollection();
$mongoObj->SelectDBToUse(MONGO_DB);
$mongoObj->SelectCollection($collectionToUse);

$max_id = $mongoObj->GetMaxBucketId();
if($max_id < 0) {
    $new_bucket_id = $max_id + 2;
} else {
    $new_bucket_id = $max_id + 1;
}
$details->bucket_id = $new_bucket_id;
echo "<h3>Max Bucket ID: ". $details->bucket_id ."</h3>";
$mongoObj->InsertIntoCollection($details);
//
//$cursor = $mongoObj->FindAll();
//echo "<h2>Buckets and summoners</h2>";
//foreach($cursor as $document) {
//    //var_dump($document);
//    echo "<h3>Bucket ID: ".$document["bucket_id"]."</h3>";
//    foreach($document["summoners"] as $s_id){
//        echo "<p>Summoner ID: ".$s_id."</p>";
//    }
//    echo "</br>";
//    echo "</br>";
//}
