<?php
/**
 * Created by PhpStorm.
 * User: apersinger
 * Date: 3/14/2016
 * Time: 11:29 AM
 */
?>
<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="http://getbootstrap.com/favicon.ico">

    <title>Starter</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
          integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="dist/css/main.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="http://getbootstrap.com/examples/starter-template/#">Project name</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="http://getbootstrap.com/examples/starter-template/#">Home</a></li>
                <li><a href="http://getbootstrap.com/examples/starter-template/#about">About</a></li>
                <li><a href="http://getbootstrap.com/examples/starter-template/#contact">Contact</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>

<div class="container">

    <div class="starter-template">
        <div class="row">
            <div class="col-md-2">
                <button type="button" id="button_1" class="btn btn-primary">Show Generated Players from DB</button>
                <br/>
                <br/>
                <button type="button" id="button_2" class="btn btn-primary" disabled>Generate Players</button>
                <br/>
                <br/>
                <button type="button" id="button_3" class="btn btn-primary">Show Processed Players</button>
            </div>
            <div class="col-md-10">
                <div id="dyn_content">
                    <div id="nosql" class="col-md-6"></div>
                    <div id="mysql" class="col-md-6"></div>
                </div>
            </div>


        </div>

    </div>

</div><!-- /.container -->



<!-- Bootstrap core JavaScript
================================================== -->
<!-- Latest compiled and minified JavaScript -->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins)-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
        integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
        crossorigin="anonymous"></script>
<script src="/dist/js/ld_main.js"></script>
<script>

    $('#button_1').on('click', function()
        {
            GetBucketSummonerData();
        }
    );

    $('#button_2').on('click', function()
        {
            TestMongo();
        }
    );

</script>


</body></html>
