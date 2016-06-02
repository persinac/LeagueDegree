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
$details = $summonerObj->GenerateNewBucketOfSummonerIds(1);
//var_dump($details->summoners);
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
