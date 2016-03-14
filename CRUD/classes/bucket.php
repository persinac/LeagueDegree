<?php

/**
 * Created by PhpStorm.
 * User: apersinger
 * Date: 3/14/2016
 * Time: 12:11 PM
 */
require_once ("../../connections/connection.php");

class bucket
{
    public $mys;
    var $bucket_id;

    function __construct($id = -1)
    {
        $this->bucket_id = $id;
        $this->NewConnection(DB_LD_HOST, DB_LD_USER, DB_LD_PASSWORD, DB_LD_NAME);
    }

    function NewConnection($host, $user, $pass, $database) {
        $this->mys = mysqli_connect($host, $user, $pass, $database);
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        }
    }
    function CloseConnection() {
        try {
            mysqli_close($this->mys);
            return true;
        } catch (Exception $e) {
            printf("Close connection failed: %s\n", $this->mys->error);
        }
    }
}

class SummonerBucket extends bucket
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
        $query = "SELECT MAX(bucket_id) AS id FROM bucket_summoners;";
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

    }

    function GenerateGroupOfSummonerIDs()
    {
        $limit = 8;

    }

    function GenerateNewBucketOfUsers()
    {
        $summoner_array = array();
        $detail = new stdClass();

        $detail->bucket_id = $this->GenerateBucketID();

        //$summoner_array[] =
        $detail->summoners = $summoner_array;
    }
}