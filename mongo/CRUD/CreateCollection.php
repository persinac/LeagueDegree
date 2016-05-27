<?php
/**
 * Created by PhpStorm.
 * User: apersinger
 * Date: 5/26/2016
 * Time: 12:47 PM
 */

$host = "localhost";
$port = "27017";

//$connecting_string =  sprintf('mongodb://%s:%d/%s', $hosts, $port,$database);
$connecting_string = sprintf('mongodb://%s:%d', $host, $port);
//$connection=  new MongoClient($connecting_string,array('username'=>$username,'password'=>$password));
$connection = new MongoClient($connecting_string);

$dbname = $connection->selectDB('test');
$listOfCollections = $dbname->getCollectionNames();
foreach($cursor as $document) {
    var_dump($document);
}
//$collection = $dbname->createCollection("league_degree");