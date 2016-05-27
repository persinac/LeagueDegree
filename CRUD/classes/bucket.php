<?php

/**
 * Created by PhpStorm.
 * User: apersinger
 * Date: 3/14/2016
 * Time: 12:11 PM
 */

$root = realpath($_SERVER["DOCUMENT_ROOT"]);
require_once ("$root/connections/ld_connection.php");
require_once ("$root/settings/settings.php");

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