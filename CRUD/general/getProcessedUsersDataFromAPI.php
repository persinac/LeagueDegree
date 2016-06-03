<?php
/**
 * Created by PhpStorm.
 * User: apersinger
 * Date: 6/3/2016
 * Time: 1:03 PM
 */

$root = realpath($_SERVER["DOCUMENT_ROOT"]);
require_once ("$root/mongo/CRUD/classes/LeagueCollection.php");
require_once("$root/CRUD/classes/SummonerBucket.php");
require_once("$root/CRUD/classes/LeagueData.php");
$league_data = new LeagueData();
//$mysql = new SummonerBucket();
$collectionToUse = "league_degree";
$mongoObj = new LeagueCollection();
$mongoObj->SelectDBToUse(MONGO_DB);
$mongoObj->SelectCollection($collectionToUse);

$cursor = $mongoObj->FindAll();
$toReturn = "NOTHING";
foreach($cursor as $document) {
    foreach($document["summoners"] as $summoner){

        if($summoner["has_been_processed"] == 1 &&
            $summoner["is_actual_user"] == 1)
        {
            $details = new stdClass();
            $details->summoner_id = $summoner['s_id'];

            var_dump(json_decode($league_data->SearchForLeagueDataBySummonerID($details->summoner_id)));
        }
        sleep(1);
    }
}

$league_data->CloseConnection();
//$mysql->CloseConnection();
echo $toReturn;