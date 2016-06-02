<?php
/**
 * Created by PhpStorm.
 * User: apersinger
 * Date: 6/1/2016
 * Time: 2:25 PM
 */
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
require_once ("$root/mongo/CRUD/classes/LeagueCollection.php");
require_once("$root/CRUD/classes/SummonerBucket.php");

$collectionToUse = "league_degree";

$summonerObj = new SummonerBucket();
$details = $summonerObj->GetAllBucketSummoners();
echo json_encode($details);
