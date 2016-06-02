<?php
/**
 * Created by PhpStorm.
 * User: apersinger
 * Date: 5/26/2016
 * Time: 12:56 PM
 */
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
require_once ("$root/connections/mongo_connection.php");
require_once ("MongoUtility.php");

class LeagueCollection extends MongoUtility {

    var $leagueCollection = "league_degree";

    function __construct($id = -1)
    {
        parent::__construct($id);

    }

    function InsertIntoCollection($document) {
        $this->SelectCollection($this->leagueCollection);
        $result = $this->collection->insert($document);
        return $result;
    }

    function DeleteFromCollectionByTitle($title) {
        $this->SelectCollection($this->leagueCollection);
        $result = $this->collection->remove($title, array("justOne" => false));
        return $result;
    }

    function DeleteFromCollectionByBucketId($bId, $justOne) {
        $this->SelectCollection($this->leagueCollection);
        $result = $this->collection->remove($bId, array("justOne" => $justOne));
        return $result;
    }

    function GetMaxBucketId() {
        $allBucketIds = $this->GetAllBucketIds();
        $max = -1;

        foreach($allBucketIds as $id) {
            $curr_id = $id["bucket_id"];
            if($curr_id > $max) {
                $max = $curr_id;
            }
        }

        return $max;
    }

    function GetAllBucketIds() {
        $this->SelectCollection($this->leagueCollection);
        $bucket_query = array('bucket_id' => 1, '_id' => 0);
        $result = $this->ProjectSpecific($bucket_query);
        return $result;
    }
}