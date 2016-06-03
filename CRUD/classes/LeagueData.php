<?php

/**
 * Created by PhpStorm.
 * User: apersinger
 * Date: 6/3/2016
 * Time: 12:44 PM
 */

$root = realpath($_SERVER["DOCUMENT_ROOT"]);
require_once($root . '/connections/ld_connection.php');
require_once($root . '/settings/settings.php');
require_once("$root/CRUD/classes/RiotApi.php");

include($root . '/CRUD/classes/Champion.php');
include($root . '/CRUD/classes/Team.php');

class LeagueData extends RiotApi
{
    var $summoner_id = 0;
    var $summoner_name = '';
    var $url_league = '';
    var $league_version = LD_LEAGUE_VERSION;
    function __construct() {
        parent::__construct();
    }

    function SearchForLeagueDataBySummonerID($id, $cron = 0) {
        $this->SetLeagueURL($id);
        $string = "";
        if($cron > 0) {
            $string = "CRONJOB: SummonerInfo - SearchForLeagueDataBySummonerID( $id )";
        } else {
            $string = "SummonerInfo - SearchForLeagueDataBySummonerID( $id )";
        }
        return $this->MakeCURLCall($this->url_league, $string);
    }

    /* SETTERS */

    /*
     *
     */
    function SetLeagueURL($data) {
        $this->url_league = $this->GetURLPre() . '' . $this->GetRegion() . '/';
        $this->url_league .= 'v'.$this->league_version.'/league/by-summoner/' . $data . '/entry?api_key=' . $this->GetKey();
    }

    /* GETTERS */
    function GetSummonerName() {
        return $this->summoner_name;
    }
    function GetSummonerID() {
        return $this->summoner_id;
    }
}