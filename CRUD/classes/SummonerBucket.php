<?php

/**
 * Created by PhpStorm.
 * User: apersinger
 * Date: 5/25/2016
 * Time: 2:50 PM
 */

require_once("Bucket.php");

class SummonerBucket extends Bucket
{
    function __construct($id = -1)
    {
        parent::__construct($id);
    }

    /***
     * Get the max summoner bucket id from bucket_summoners
     * Will need to +1 to return value if inserting new bucket
     * value(s)
     *
     * @return int - ID of the max bucket
     */
    function GetMaxBucketID()
    {
        $query = "SELECT MAX(bucket_id) AS id FROM buckets_summoners;";
        if ($result = $this->mys->query($query)) {
            while ($row = $result->fetch_assoc()) {
                $retVal = $row["id"];
            }
            $result->free();
        } else {
            $retVal = -1;
        }
        return $retVal;
    }

    function GenerateBucketID()
    {
        $new_id = $this->GetMaxBucketID();
        if($new_id == -1) {
            exit();
        } else if(is_null($new_id)) {
            $new_id = 1;
        } else {
            $new_id = $new_id + 1;
        }

        return $new_id;

    }

    function GetMaxSummonerID()
    {
        $query = "SELECT MAX(summoner_id) AS id FROM bucket_summoners;";
        if ($result = $this->mys->query($query)) {
            while ($row = $result->fetch_assoc()) {
                $retVal = $row["id"];
            }
            $result->free();
        } else {
            $retVal = -1;
        }
        return $retVal;
    }

    function GenerateSummonerID()
    {
        //generate a random summoner ID between
        //1 and MAX_SUMMONER_ID without any repeats
        $new_id = rand(1, MAX_SUMMONER_ID);
        while($this->DoesSummonerIdAlreadyExist($new_id) > 0) {
            $new_id = rand(1, MAX_SUMMONER_ID);
        }
        return $new_id;
    }

    function GenerateGroupOfSummonerIDs()
    {
        $temp_arr = array();
        while(sizeof($temp_arr) < MAX_BUCKET_SIZE) {
            $new_id = $this->GenerateSummonerID();
            $temp_arr[] = $new_id;
        }
        return $temp_arr;
    }

    function GenerateGroupOfSummonerIDsForMongo()
    {
        $temp_arr = array();
        while(sizeof($temp_arr) < MAX_BUCKET_SIZE) {
            $new_id = new stdClass();
            $new_id->s_id = $this->GenerateSummonerID();
            $new_id->has_been_processed = 9;
            $new_id->is_actual_user = 9;
            $temp_arr[] = $new_id;
        }

        return $temp_arr;
    }

    function GenerateNewBucketOfSummonerIds($isMongo = -1)
    {
        $detail = new stdClass();
        $detail->bucket_id = $this->GenerateBucketID();
        if($isMongo < 0) {
            $detail->summoners = $this->GenerateGroupOfSummonerIDs();
            $detail->created_on = date("Y-m-d H:i:s");
            $detail->has_been_processed = 9;
            $detail->is_actual_user = 9;
        } else {
            $detail->summoners = $this->GenerateGroupOfSummonerIDsForMongo();
            $detail->created_on = date("Y-m-d H:i:s");
        }
        return $detail;
    }

    function InsertSummonerIdIntoBucket($stmt, $bucketId, $bucketOfSummonerIds, $createdOn)
    {
        $retVal = array();
        $summonerId = -1;
        $stmt->bind_param('iis', $bucketId, $summonerId, $createdOn);
        for($i = 0; $i < sizeof($bucketOfSummonerIds); $i++) {
            $summonerId = $bucketOfSummonerIds[$i]->s_id;
            $result = $stmt->execute();
            if ($result) {
                $retVal[] = 1;
            } else {
                $retVal[] = 0;
            }
            $this->mys->next_result();
        }
        return $retVal;

    }

    function InsertNewBucketOfSummonerIds($bucketId, $bucketOfSummonerIds)
    {
        try
        {
            date_default_timezone_set('America/New_York');
            $createdOn = date("Y-m-d H:i:s");
            $query = "INSERT INTO buckets_summoners VALUES(?,?,?,9,9);";
            $stmt = $this->mys->prepare($query);
            $retVal = $this->InsertSummonerIdIntoBucket($stmt, $bucketId, $bucketOfSummonerIds, $createdOn);
        }
        catch (mysqli_sql_exception $e)
        {
            $retVal = $e->getMessage();
        }
        $stmt->close();
        return $retVal;
    }

    function DoesSummonerIdAlreadyExist($summonerId)
    {
        $query = "SELECT count(*) AS id FROM buckets_summoners WHERE summoner_id = ".$summonerId.";";
        if ($result = $this->mys->query($query)) {
            //var_dump($result);
            while ($row = $result->fetch_assoc()) {
                $retVal = $row["id"];
            }
            $result->free();
        } else {
            $retVal = -1;
        }
        return $retVal;
    }

    function GetAllBucketSummoners() {
        $summoners = array();
        $query = "select * from buckets_summoners where bucket_id > 0
                  order by bucket_id, summoner_id";
        //$this->mys->next_result();
        if ($result = $this->mys->query($query)) {
            while ($row = $result->fetch_assoc()) {
                $detail = new stdClass();
                $detail->bucket_id = $row['bucket_id'];
                $detail->summoner_id = $row['summoner_id'];
                $detail->created_on = $row["created_on"];
                $detail->has_been_processed = $row["has_been_processed"];
                $detail->is_actual_user = $row["is_actual_user"];
                $summoners[] = $detail;
            }
            $result->free();
        }
        return $summoners;
    }
}