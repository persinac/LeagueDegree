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
$html = "";
$html .= "<h2>MySQL</h2>";
$html .= "<table><tr>";
$html .= "<th>Bucket ID</th>";
$html .= "<th>Summoner ID</th>";
$html .= "<th>Created On</th>";
$html .= "</tr>";
foreach($details as $summoner) {
    //var_dump($document);
    $html .= "<tr>";
    $html .= "<td>".$summoner->bucket_id."</td>";
    $html .= "<td>".$summoner->summoner_id."</td>";
    $html .= "<td>".$summoner->created_on."</td>";
    $html .= "</tr>";
}
$html .= "</table>";
echo $html;
