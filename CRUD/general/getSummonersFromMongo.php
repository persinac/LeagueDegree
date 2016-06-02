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
$mongoObj = new LeagueCollection();
$mongoObj->SelectDBToUse(MONGO_DB);
$mongoObj->SelectCollection($collectionToUse);


$cursor = $mongoObj->FindAll();
$html = "";
$html .= "<h2>MongoDB</h2>";
$html .= "<table><tr>";
$html .= "<th>Bucket ID</th>";
$html .= "<th>Summoner ID</th>";
$html .= "<th>Created On</th>";
$html .= "</tr>";
foreach($cursor as $document) {
    //var_dump($document);
    foreach($document["summoners"] as $s_id){
        $html .= "<tr>";
        $html .= "<td>".$document["bucket_id"]."</td>";
        $html .= "<td>".$s_id."</td>";
        $html .= "<td>".$document["created_on"]."</td>";
        $html .= "</tr>";
    }
}
$html .= "</table>";
echo $html;
