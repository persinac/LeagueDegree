/**
 * Created by apersinger on 5/25/2016.
 */

function GenerateSummonerIds() {
    response = "<h3>Currently loading...</h3>";
    $("#dyn_content").html(response);
    $.ajax({
        type: "POST",
        url: "/CRUD/general/generateSummonerIds.php",
        dataType: "html",
        success: function(response) {
            //console.log(response);
            $("#dyn_content").html(response);
        }
    });
}

function TestMongo() {
    response = "<h3>Currently loading...</h3>";
    $("#dyn_content").html(response);
    $.ajax({
        type: "POST",
        url: "/mongo/CRUD/general/testing.php",
        dataType: "html",
        success: function(response) {
            //console.log(response);
            GetBucketSummonerData();
        }
    });
}

function GetBucketSummonerData() {
    response = "<h3>Currently loading...</h3>";
    $("#nosql").html(response);
    $("#mysql").html(response);
    GetMongoBucketSummonerData();
    GetMySQLBucketSummonerData();
}

function GetMongoBucketSummonerData() {
    response = ""
    $.ajax({
        type: "POST",
        url: "/CRUD/general/getSummonersFromMongo.php",
        dataType: "html",
        success: function(response) {
            //console.log(response);
            $("#nosql").html(response);
        }
    });
}

function GetMySQLBucketSummonerData() {
    response = ""
    $.ajax({
        type: "POST",
        url: "/CRUD/general/getSummonersFromMySQL.php",
        dataType: "html",
        success: function(response) {
            //console.log(response);
            $("#mysql").html(response);
        }
    });
}