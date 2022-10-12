<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<style>
    body {
        background-image: url("assets/img/bg1.png");
        background-size: cover;
        background-repeat: no-repeat;
        background-position: top;
    }

    a {
        font-weight: bold;
        color: white;
    }

    a:hover {
        color: goldenrod;
    }

    #myChart {
        border-radius: 15px;
    }
</style>

<body>

<nav class="navbar navbar-expand-lg navbar-dark pt-4 mb-5">
    <div class="container-md">
        <a class="navbar-brand text-uppercase fw-normal" href="#">Crypto-app</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto text-center">
                <li class="nav-item">
                    <a class="nav-link active fw-normal" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active fw-normal" aria-current="page" href="coins.php?page=0">coins</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active fw-normal" aria-current="page" href="#">log in</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container-md text-light mt-5">
    <div class="row">
        <div class="col-12 col-md-6 text-center text-md-start">
            <?php
            $page = $_GET['page'];

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.coinranking.com/v2/coin/' . $page . '',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    "x-access-token: your-api-key"
                ),
            ));

            $response = json_decode(curl_exec($curl));
            if ($response->status != "fail") {

                $coin = $response->data->coin;
                curl_close($curl);

                echo '<script>console.log(' . json_encode($coin) . ');</script>';

                echo '<div class="d-md-flex"><img width="80px" height="80px" src="' . $coin->iconUrl . '" />';
                echo '<h2 class="display-3"> ' . $coin->name . '</h2></div>';
                echo '<p class="fw-bold h3">Actual Price: ' . number_format($coin->price, 2) . '</p>';
                echo '<p class="fw-bold h3">Market Cap: ' . number_format($coin->marketCap, 2) . '</p>';
                echo '<p class="fw-bold h3"> All Time High: ' . number_format($coin->allTimeHigh->price, 2) . '</p>';

            } else {
                echo 'dosažen api limit.';
            }

            ?>
        </div>
        <div class="col-12 col-md-6">
            <canvas id="myChart"></canvas>
            <div class="text-center">
                <?php
                echo '<a href=coin.php?page=' . $page . '&time=24h><button class="btn btn-outline-light m-1 m-sm-2">24h</button></a>';
                echo '<a href=coin.php?page=' . $page . '&time=7d><button class="btn btn-outline-light m-1 m-sm-2"">7d</button></a>';
                echo '<a href=coin.php?page=' . $page . '&time=30d><button class="btn btn-outline-light m-1 m-sm-2"">30d</button></a>';
                echo '<a href=coin.php?page=' . $page . '&time=1y><button class="btn btn-outline-light m-1 m-sm-2"">1y</button></a>';
                echo '<a href=coin.php?page=' . $page . '&time=3y><button class="btn btn-outline-light m-1 m-sm-2"">3y</button></a>';
                echo '<a href=coin.php?page=' . $page . '&time=5y><button class="btn btn-outline-light m-1 m-sm-2"">5y</button></a>';
                ?>
            </div>
        </div>
        <div class="col-12 text-left">
            <?php
            if ($response->status != "fail") {
                echo $coin->description;
                echo '<h3>Links:</h3>';
                foreach ($coin->links as $link) {
                    echo '<a href="' . $link->url . '"><span>' . $link->name . ' </span></a><span> ; </span>';
                }
            }
            ?>
        </div>
    </div>

</div>
<footer class="text-light">
    <div class="container-md py-5 border-0 border-top">
        <p>crypto-app</p>
    </div>
</footer>

<?php //Get history data
$curl = curl_init();

$timePeriod = $_GET['time'];

curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://api.coinranking.com/v2/coin/' . $page . '/history?timePeriod=' . $timePeriod . '',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
        "x-access-token: coinrankingd156d669aca5f63f0972b77fffb5a2c1dc6cef1d0660e3b8"
    ),
));

$response = json_decode(curl_exec($curl));

echo '<script>console.log(' . json_encode($response) . ');</script>';

$prices = array();

$posun = floor(count($response->data->history) / 15);

for ($i = 0; $i <= 15; $i++) {
    if ($response->data->history[$i * $posun] != null) {
        array_push($prices, $response->data->history[$i * $posun]->price);
    }
}

echo '<script>var historyPrices = ' . json_encode(array_reverse($prices)) . '; console.log(historyPrices);</script>';

$dates = array();
for ($i = 0; $i <= 15; $i++) {
    if ($response->data->history[$i * $posun] != null) {
        $timestamp = $response->data->history[$i * $posun]->timestamp;
        $dt = new DateTime("@$timestamp");  // convert UNIX timestamp to PHP DateTime
//    echo $dt->format('Y-m-d H:i:s'); // output = 2017-01-01 00:00:00
        if($timePeriod == "24h"){
            array_push($dates, $dt->format('m-d H:i'));
        }else{
            array_push($dates, $dt->format('Y-m-d'));
        }
    }
}

echo '<script>var historyDates = ' . json_encode(array_reverse($dates)) . '; console.log(historyDates); let label = ' . json_encode($coin->name) . ';</script>';

?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const labels = [
        'January',
        'February',
        'March',
        'April',
        'May',
        'June',
    ];


    const data = {
        labels: historyDates,
        datasets: [{
            label: label,
            fontColor: '#FFFFFFFF',
            backgroundColor: 'rgb(255,255,255)',
            borderColor: 'rgb(255,255,255)',
            canvasBackgroundColor: 'rgb(255,255,255)',
            tension: 0.4,
            data: historyPrices, //[0, 10, 5, 2, 20, 30, 45]
        }],
    };

    const plugin = {
        id: 'custom_canvas_background_color',
        beforeDraw: (chart) => {
            const {ctx} = chart;
            ctx.save();
            ctx.globalCompositeOperation = 'destination-over';
            ctx.fillStyle = 'rgba(0,0,0,0.4)';
            ctx.fillRect(0, 0, chart.width, chart.height);
            ctx.restore();
        }
    };

    const config = {
        type: 'line',
        data: data,
        plugins: [plugin],
        options: {
            responsive: true,
            scales: {
                y: {
                    ticks: {color: 'white', beginAtZero: false}
                },
                x: {
                    ticks: {color: 'white', beginAtZero: false}
                }
            }
        },
    };

    const myChart = new Chart(
        document.getElementById('myChart'),
        config
    );
</script>

</body>
</html>