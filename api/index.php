<?php

$weather = "";
$error = "";

if ($_GET['city']) {

 /*  echo file_get_contents("http://api.openweathermap.org/data/2.5/forecast?id=".$_GET['city']."&APPID=ace50fdef991517ce32c2ee8d4e475bf");*/


    $urlContents = file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=".urlencode($_GET['city']).",uk&appid=4b6cbadba309b7554491c5dc66401886");

    $weatherArray = json_decode($urlContents, true);

    /*print_r($weatherArray);*/

    if ($weatherArray['cod'] == 200) {

        $weather = "The weather in ".$_GET['city']." is currently '".$weatherArray['weather'][0]['description']."'. ";

        $tempInCelcius = intval($weatherArray['main']['temp'] - 273);

        $weather .= " The temperature is ".$tempInCelcius."&deg;C and the wind speed is ".$weatherArray['wind']['speed']."m/s.";

    } else {

        $error = "Could not find city - please try again.";

    }

}

?>




<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <title>Weather Scraper</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
          integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">


<style type="text/css">

    html {
        background: url(background.jpeg) no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }

    body {

        background: none;

    }

    .container {

         text-align: center;
        padding-top: 100px;
        width: 450px;
    }

    input {

        margin: 20px 0;

    }

    #weather {

        margin-top: 15px;

    }


</style>


</head>
<body>

<div class="container">

    <h1>What's The Weather?</h1>



    <form>
        <fieldset class="form-group">
            <label for="city">Enter the name of a city in United Kingdom.</label>
            <input type="text" class="form-control" name="city" id="city" placeholder="Eg. London, Tokyo" value = "<?php echo $_GET['city']; ?>">
        </fieldset>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

        <div id="weather"><?php

        if ($weather) {

            echo '<div class="alert alert-success" role="alert">
            '.$weather.'
        </div>';

        } else if ($error) {

            echo '<div class="alert alert-danger" role="alert">
            '.$error.'
        </div>';

        }

        ?></div>
</div>

<!-- jQuery first, then Bootstrap JS. -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js" integrity="sha384-vZ2WRJMwsjRMW/8U7i6PWi6AlO1L79snBrmgiDpgIWJ82z8eA5lenwvxbMV1PAh7" crossorigin="anonymous"></script>
</body>
</html>