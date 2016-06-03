<?php
/**
 * Created by PhpStorm.
 * User: apersinger
 * Date: 6/3/2016
 * Time: 10:03 AM
 */

$root = realpath($_SERVER["DOCUMENT_ROOT"]);
require_once ("$root/mongo/CRUD/classes/LeagueCollection.php");
require_once("$root/CRUD/classes/SummonerBucket.php");

$collectionToUse = "league_degree";
$mongoObj = new LeagueCollection();
$mongoObj->SelectDBToUse(MONGO_DB);
$mongoObj->SelectCollection($collectionToUse);

$cursor = $mongoObj->FindAll();
$toReturn = array();
foreach($cursor as $document) {
    foreach($document["summoners"] as $summoner){
        //var_dump($summoner);

        if($summoner["has_been_processed"] == 1 &&
            $summoner["is_actual_user"] == 1)
        {
            $details = new stdClass();
            $details->bucket_id = $document["bucket_id"];
            $details->summoner_id = $summoner['s_id'];
            $details->created_on = $document["created_on"];
            $details->has_been_processed = $summoner["has_been_processed"];
            $details->is_actual_user = $summoner["is_actual_user"];
            $toReturn[] = $details;
        }
    }
}
echo json_encode($toReturn);