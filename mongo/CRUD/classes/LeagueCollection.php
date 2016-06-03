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

    function UpdateSpecifcSummonerById($bucket_id, $summoner_id, $field, $value) {
        /*
         *  db.league_degree.update({bucket_id: 1, "summoners.s_id":1603136}, {'$set':{"summoners.$.has_been_processed":1}});
         * */
        $filter = array('bucket_id' => $bucket_id, 'summoners.s_id'=>$summoner_id);
        $update = array('$set' => array('summoners.$.'.$field.'' => $value));
        $result = $this->UpdateSpecific($filter, $update);
        return $result;
    }

    function GetActualPlayers($arrayName, $fieldToSearch, $value) {
        $result = $this->FindAll();
        return $result;

    }
}