<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
    <title>Wearables - D3 Visualizations</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/skeleton.css">
    <link rel="stylesheet" href="css/charts.css">

    <script src="scripts/jquery.js"></script>
    <script src="https://d3js.org/d3.v4.min.js"></script>
    <script src="scripts/wearables-api.js"></script>
    <script src="scripts/charts.js"></script>
</head>

<body>
    <div id="nav">
        <button class="button-primary"><a href="/index.php">Home</a></button>
    </div>
    <div class="container">
        <div id="game-select">
            <div class="row">
                <div class="twelve columns session">
                    Session 1 (03-17-2017): <br />
                    <button id="s1g1">Game One: 21:23:01 to 21:30:00</button>
                    <button id="s1g2">Game Two: 21:37:00 to 21:44:00</button>
                    <button id="s1g3">Game Three: 21:48:00 to 21:55:00</button>
                    <button id="s1g4">Game Four: 22:00:00 to 22:07:00</button>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="twelve columns session">
                    Session 2 (03-17-2017): <br />
                    <button id="s2g1">Game One: 22:22:00 to 22:29:00</button>
                    <button id="s2g2">Game Two: 22:35:00 to 22:42:00</button>
                    <button id="s2g3">Game Three: 22:45:00 to 22:52:00</button>
                    <button id="s2g4">Game Four: 22:54:00 to 23:01:00</button>
                    <button id="s2g5">Game Five: 23:07:00 to 23:14:00</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

