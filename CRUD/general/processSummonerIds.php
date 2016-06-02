<?php
/**
 * Created by PhpStorm.
 * User: apersinger
 * Date: 6/2/2016
 * Time: 9:11 AM
 */

$root = realpath($_SERVER["DOCUMENT_ROOT"]);
require_once ("$root/mongo/CRUD/classes/LeagueCollection.php");
require_once("$root/CRUD/classes/SummonerBucket.php");
require_once("$root/CRUD/classes/RiotApi.php");

$collectionToUse = "league_degree";
$mongoObj = new LeagueCollection();
$mongoObj->SelectDBToUse(MONGO_DB);
$mongoObj->SelectCollection($collectionToUse);

$query = array('bucket_id' => 1);
$cursor = $mongoObj->FindSpecific($query);

$summonerInfo = new SummonerInfo();

$html = "";
$html .= "<h2>Players</h2>";
$html .= "<table><tr>";
$html .= "<th>Bucket ID</th>";
$html .= "<th>Summoner ID</th>";
$html .= "<th>Match?</th>";
$html .= "<th>Summoner Name</th>";
$html .= "<th>Created On</th>";
$html .= "</tr>";
foreach($cursor as $document) {
    foreach($document["summoners"] as $summoner){
        //var_dump($summoner);
        $html .= "<tr>";
        $html .= "<td>".$document["bucket_id"]."</td>";
        $html .= "<td>".$summoner["s_id"]."</td>";

        $obj = json_decode($summonerInfo->SearchForSummonerByID($summoner["s_id"]));
        foreach($obj AS $i=>$val) {
            if($i == "status") {
                $html .= "<td>No</td>";
                $html .= "<td></td>";
            } else {
                $html .= "<td>Yes</td>";
                $html .= "<td>".$val->name."</td>";
            }
        }
        $html .= "<td>".$document["created_on"]."</td>";
        $html .= "</tr>";
    }
}
$html .= "</table>";
echo $html;