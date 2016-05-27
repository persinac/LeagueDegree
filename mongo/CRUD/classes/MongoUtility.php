<?php

/**
 * Created by PhpStorm.
 * User: apersinger
 * Date: 5/26/2016
 * Time: 1:03 PM
 */
class MongoUtility
{
    public $connection;
    public $db;
    public $collection;

    function __construct($id = -1)
    {
        $this->NewConnection(MONGO_HOST, MONGO_PORT, MONGO_DB);
    }

    function NewConnection($host, $port, $database) {
        $connecting_string =  sprintf('mongodb://%s:%d/%s', $host, $port, $database);
        $this->connection = new MongoClient($connecting_string);
    }
    function CloseConnection() {
        //no idea how to close mongo db connection
    }

    function CreateNewDatabase() {
        //$this->connection->
        //TBD
    }

    function CreateNewCollection($dbToUse, $newCollectionName) {
        $this->db = $this->connection->selectDB($dbToUse);
        $result = $this->db->createCollection($newCollectionName);
        return $result;
    }

    function SelectDBToUse($dbToUse) {
        $this->db = $this->connection->selectDB($dbToUse);
    }

    function SelectCollection($collectionToUse) {
        $this->collection = $this->db->selectCollection($collectionToUse);
    }

    function ListAllCollections() {
        return $this->db->getCollectionNames();
    }

    function FindAll() {
        return $this->collection->find();
    }

    function FindSpecific($query) {
        return $this->collection->find(array(),$query);
    }

}