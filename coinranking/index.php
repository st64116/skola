<!--coinrankingd156d669aca5f63f0972b77fffb5a2c1dc6cef1d0660e3b8-->
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

    .img{
        transform: skewY(3deg);
        -webkit-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.70);
        -moz-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.70);
        box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.70);
        border-radius: 20px;
        /*border: 5px solid #180e06;*/
    }

    .btn{
        position: relative;
    }

    .btn::after{
        content: "";
        position: absolute;
        width: 100%;
        height: 100%;
        right: 10px;
        top: 10px;
        background: #321c0c;
        z-index: -1;
        border-radius: 5px;
    }
</style>

<body>

<nav class="navbar navbar-expand-lg navbar-dark pt-4 mb-5">
    <div class="container-md">
        <a class="navbar-brand text-uppercase" href="#">Crypto-app</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto text-center">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="coins.php?page=0">coins</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">log in</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container-md text-light my-4">

    <div class="row">
        <div class="col-12 col-md-6 text-center ms-auto">
            <h1 class="display-1 fw-bold text-left">watch <span id="numberOfCoins">14500</span> cryptocurencies on 1 site</h1>
            <a href="coins.php?page=0"><button class="btn btn-lg btn-outline-light my-5"><span class="p-5">Coins</span></button> </a>
        </div>
        <div class="col-12 col-md-4 text-center text-md-start me-auto">
            <img class="img-fluid img" src="./assets/img/coins.jpg" width="60%"/>
        </div>
    </div>

    <div class="row my-5">
        <div class="col-12 col-md-6 text-center ms-auto">
            <h2 class="display-1 fw-bold text-left">List through and check all data about crypto you like.</h2>
            <a href="coin.php?page=Qwsogvtv82FCd&time=24h">
                <button class="btn btn-lg btn-outline-light my-5"><span class="p-5">BTC</span></button>
            </a>
        </div>
        <div class="col-12 col-md-4  text-center text-md-start me-auto">
            <img class="img" src="./assets/img/coin.jpg" width="60%"  style="top: 0%; left: 60%; z-index: -10" />
        </div>
    </div>

    <?php
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.coinranking.com/v2/coins?rank=1",
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

    curl_close($curl);
    echo '<script>let maxCount = '.json_encode($response->data->stats->total ).';console.log(maxCount)</script>';
    ?>

    <?php
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.coinranking.com/v2/coin/Qwsogvtv82FCd/history',
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

//    echo json_encode(gmdate('r', $response->data->history[0]->timestamp));

    curl_close($curl);

    $js_code = 'console.log(' . json_encode($response->data) . ');';
//    echo '<script>' . $js_code . '</script>';
//    echo "nvm";
//    echo $curl;
    ?>
</div>
<footer class="text-light mt-5">
    <div class="container-md py-5 border-0 border-top">
        <p>crypto-app</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
<script>
    let cryptoText = document.getElementById("numberOfCoins");
    let actualCount = 0;

    function isLess(num){
        if(num <= maxCount){
            return 1;
        }else{
            return 0;
        }
    }

    function count() {
        if (actualCount <= maxCount) {
            for(let i = 0; i < 30;i++){
                actualCount = actualCount + isLess(actualCount);
            }
            cryptoText.innerText = actualCount;
            setTimeout(count, 1);
        }
    }

    count();


</script>
</body>

</html>



