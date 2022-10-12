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
        background-image: url("assets/img/bg.jpg");
        background-size: cover;
        background-repeat: no-repeat;
        background-position: top;
    }

    #main {

    }

    table {
        background-color: rgba(0, 0, 0, 0.6);
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
    }

    .bg-dark-6 {
        background-color: rgba(0, 0, 0, 0.6);
    }
    .filter{
        background-color: rgba(0, 0, 0, 0.6);
        border-radius: 15px;
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

<div class="container-md text-light my-4 text-center" id="main">

    <h1 class="display-1 fw-bold">Coins</h1>
    <div class="text-start my-2 filter p-2">
        <button class="btn btn-outline-light text-uppercase" type="button" data-toggle="collapse" data-target="#filter" aria-expanded="false" aria-controls="filter">Filter</button>
        <div class="collapse multi-collapse" id="filter">nvm</div>
    </div>
    <table class="table text-light text-center fw-bold mb-0">
        <thead>
        <tr>
            <th scope="col">#</th>
            <!--            <th scope="col">icon</th>-->
            <th scope="col">Symbol</th>
            <th scope="col">Price</th>
            <th scope="col">MarketCap</th>
        </tr>
        </thead>
        <tbody>

        <?php
        $curl = curl_init();
        $page = $_GET['page'];
        $offset = ($_GET['page'] * 25);

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.coinranking.com/v2/coins?limit=25&offset=' . $offset . '',
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

        foreach ($response->data->coins as &$value) {

            $nvm = '<tr scope="row"><td><span class="my-4">' . $value->rank . ' </span><a href="coin.php?page=' . $value->uuid . '&time=24h"><img class="my-4" src="' . $value->iconUrl . '" width="20px" height="20px" /></a></td><td><a class="my-4" href="coin.php?page=' . $value->uuid . '&time=24h"><div class="btn btn-outline-light my-4">' . $value->symbol . '</div></a></td><td><p class="my-4">' . number_format($value->price, 4) . '</p></td><td><p class="my-4">' . $value->marketCap . '</p></td></tr>';

//            echo'<script>console.log('. $nvm. ')</script>';
//
//            echo '<tr scope="row"><td><img src="' . $value->iconUrl . '" width="20px" height="20px" /></td>';
//
//            echo '<td><a href="coin.php?page='.$value->uuid.'">' . $value->symbol . '</a></td>';
//
//            echo '<td>' . number_format($value->price,4) . '</td>';
//
//            echo '<td>' . $value->marketCap . '</td></tr>';

            echo $nvm;
        }

        curl_close($curl);
        echo '<script>let maxCount = ' . json_encode($response->data->coins) . ';console.log(maxCount)</script>';
        ?>

        </tbody>
    </table>
    <div class="bg-dark-6 py-3">
        <?php
        if ($page > 0) {
            echo '<a href="coins.php?page=0"><button class="btn btn-outline-light mx-1">first</button></a>';
            echo '<a href="coins.php?page=' . ($_GET["page"] - 1) . '"><button class="btn btn-outline-light">prev</button></a>';
        }else{
            echo '<button class="btn btn-outline-light mx-1" disabled>first</button>';
            echo '<button class="btn btn-outline-light" disabled>prev</button>';
        }
        echo '<span class="px-5">' . ($_GET["page"] + 1) . '</span>';
        if ($page < floor($response->data->stats->total / 25)) {
            echo '<a href="coins.php?page=' . ($_GET["page"] + 1) . '"><button class="btn btn-outline-light">next</button>';
            echo '<a href="coins.php?page=' . (floor($response->data->stats->total / 25)) . '"><button class="btn btn-outline-light mx-1">last</button>';
        }else{
            echo '<button class="btn btn-outline-light" disabled>next</button>';
            echo '<button class="btn btn-outline-light mx-1" disabled>last</button>';
        }
        ?>
    </div>
</div>
<footer class="text-light">
    <div class="container-md py-5 border-0 border-top">
        <p>crypto-app</p>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>