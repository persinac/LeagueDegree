<?php
/**
 * Created by PhpStorm.
 * User: apersinger
 * Date: 5/25/2016
 * Time: 3:50 PM
 */

require_once ("../classes/SummonerBucket.php");

$obj = new SummonerBucket();
$details = $obj->GenerateNewBucketOfSummonerIds();
//print_r($details);
$results = $obj->InsertNewBucketOfSummonerIds($details->bucket_id, $details->summoners);
print_r($results);
$obj->CloseConnection();