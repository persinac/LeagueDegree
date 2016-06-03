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
           if(response == 1) {
               GetBucketSummonerData();
           } else {
               $("#dyn_content").html("<h3>PROCESS IS CURRENTLY DISABLED</h3>");
           }

        }
    });
}

function GetBucketSummonerData() {
    response = "<h3>Currently loading...</h3>";
    $("#dyn_content").html("");
    var start = new Date().getTime();
    var t0 = performance.now();
    GetMongoBucketSummonerData(t0);
    GetMySQLBucketSummonerData(t0);
}

function GetMongoBucketSummonerData(startTime) {
    response = ""
    $.ajax({
        type: "POST",
        url: "/CRUD/general/getSummonersFromMongo.php",
        dataType: "json",
        success: function(response) {
            //console.log(response);
            var end = performance.now();
            var execTime = (end - startTime) / 1000.0;
            var title = "NoSQL - " + execTime;
            $("#dyn_content").append(CreateTableForShowBucketSummoners(response, 2, title));
        }
    });
}

function GetMySQLBucketSummonerData(startTime) {
    response = ""
    $.ajax({
        type: "POST",
        url: "/CRUD/general/getSummonersFromMySQL.php",
        dataType: "json",
        success: function(response) {
            //console.log(response);
            var end = performance.now();
            var execTime = (end - startTime) / 1000.0;
            var title = "MySQL - " + execTime;
            $("#dyn_content").append(CreateTableForShowBucketSummoners(response, 2, title));
        }
    });
}

function ProcessBucketSummonerData() {
    response = "Working...";
    $("#dyn_content").html(response);
    $.ajax({
        type: "POST",
        url: "/CRUD/general/processSummonerIds.php",
        dataType: "html",
        success: function(response) {
            //console.log(response);
            $("#dyn_content").html(response);
        }
    });
}

function ShowActualUsers() {
    response = "Working..."
    $.ajax({
        type: "POST",
        url: "/CRUD/general/getActualUsers.php",
        dataType: "html",
        success: function(response) {
            //console.log(response);
            $("#dyn_content").html(response);
        }
    });
}

function GetProcessedUsersDataFromAPI() {
    response = "Working...";
    $("#dyn_content").html(response);
    $.ajax({
        type: "POST",
        url: "/CRUD/general/getProcessedUsersDataFromAPI.php",
        dataType: "html",
        success: function(response) {
            //console.log(response);
            $("#dyn_content").html(response);
        }
    });
}