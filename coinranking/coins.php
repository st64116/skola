<?php // get coins
$curl = curl_init();
$page = $_GET['page'];
$offset = ($_GET['page'] * 25);
$search = "";
if (isset($_GET['search'])) {
    $search = $_GET['search'];
}
$tags = [];
$symbols = [];
$tagsUrl = "";
$symbolsUrl = "";
//        echo json_encode($tags);

if (isset($_GET['tags'])) {
    $tags = $_GET['tags'];
    foreach ($tags as $tag) {
        $tagsUrl = $tagsUrl . "&tags[]=" . $tag;
    }
}

if (isset($_GET['symbols'])) {
    $symbols = $_GET['symbols'];
    foreach ($symbols as $symbol) {
        $symbolsUrl = $symbolsUrl . "&symbols[]=" . $symbol;
    }
}

echo '<script>var page = ' . $page . '; var tags = ' . json_encode($tags) . '; var name = ' . json_encode($search) . '; var symbols = ' . json_encode($symbols) . '</script>';

curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://api.coinranking.com/v2/coins?limit=25&offset=' . $offset . '&search=' . $search . '' . $tagsUrl . '',
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

?>

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

    .filter {
        background-color: rgba(0, 0, 0, 0.6);
        border-radius: 15px;
    }

    input {
        background-color: rgba(50, 28, 12, 0);
        border-radius: 15px;
        border: 2px solid white;
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
        <button class="btn btn-outline-light text-uppercase" type="button" data-bs-toggle="collapse"
                data-bs-target="#filter" aria-expanded="false" aria-controls="filter">Filter
        </button>
        <div class="collapse" id="filter">
            <div class=" m-4 px-2 py-3 p-sm-5 border border-white rounded-3">
                <label class="col-12 col-sm-2">Coin name:</label><input type="text"
                                                                        class="col-12 col-sm-8 text-white mb-2 mb-sm-0"
                                                                        id="input-name"
                                                                        placeholder="bitcoin"/>
                <label class="col-12 col-sm-2 my-sm-3">Coin symbols:</label><input type="text"
                                                                                   class="col-12 col-sm-8 text-uppercase text-white mb-2 mb-sm-0"
                                                                                   id="input-symbol"
                                                                                   placeholder="BTC,ETH,DOGE"/>
                <br>
                <div id="tags-buttons">
                    <button class="btn btn-outline-light" onclick='btnChange(this)' id="defi">defi</button>
                    <button class="btn btn-outline-light" onclick='btnChange(this)' id="stablecoin">stablecoin</button>
                    <button class="btn btn-outline-light" onclick='btnChange(this)' id="nft">nft</button>
                    <button class="btn btn-outline-light" onclick='btnChange(this)' id="dex">dex</button>
                    <button class="btn btn-outline-light" onclick='btnChange(this)' id="exchange">exchange</button>
                    <button class="btn btn-outline-light" onclick='btnChange(this)' id="staking">staking</button>
                    <button class="btn btn-outline-light" onclick='btnChange(this)' id="dao">dao</button>
                    <button class="btn btn-outline-light" onclick='btnChange(this)' id="meme">meme</button>
                    <button class="btn btn-outline-light" onclick='btnChange(this)' id="privacy">privacy</button>
                    <button class="btn btn-outline-light" onclick='btnChange(this)' id="metaverse">metaverse</button>
                    <button class="btn btn-outline-light" onclick='btnChange(this)' id="gaming">gaming</button>
                    <button class="btn btn-outline-light" onclick='btnChange(this)' id="wrapped">wrapped</button>
                    <button class="btn btn-outline-light" onclick='btnChange(this)' id="layer-1">layer-1</button>
                    <button class="btn btn-outline-light" onclick='btnChange(this)' id="layer-2">layer-2</button>
                    <br>
                </div>
                <div class="row">
                    <div class="mt-3 text-start col-6">
                        <button class="btn btn-lg btn-outline-danger text-uppercase" onclick="clearForm()">clear
                        </button>
                    </div>
                    <div class="mt-3 text-end col-6">
                        <button class="btn btn-lg btn-outline-danger text-uppercase" onclick="search()">search</button>
                    </div>
                </div>
            </div>
        </div>
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
        if (isset($response->data->coins)) {

            foreach ($response->data->coins as &$value) {
                $nvm = '<tr scope="row"><td><span class="my-4">' . $value->rank . ' </span><a href="coin.php?page=' . $value->uuid . '&time=24h"><img class="my-4" src="' . $value->iconUrl . '" width="20px" height="20px" /></a></td><td><a class="my-4" href="coin.php?page=' . $value->uuid . '&time=24h"><div class="btn btn-outline-light my-4">' . $value->symbol . '</div></a></td><td><p class="my-4">' . number_format($value->price, 4) . '</p></td><td><p class="my-4">' . $value->marketCap . '</p></td></tr>';
                echo $nvm;
            }
            echo '<script>let maxCount = ' . json_encode($response->data->coins) . ';console.log(' . json_encode($response) . ')</script>';
        }

        curl_close($curl);

        ?>

        </tbody>
    </table>
    <div class="bg-dark-6 py-3">
        <?php //pegination
        if (isset($response->data->stats)) {
            if ($page > 0) {
                echo '<a href="coins.php?page=0"><button class="btn btn-outline-light mx-1">first</button></a>';
                echo '<a href="coins.php?page=' . ($_GET["page"] - 1) . '"><button class="btn btn-outline-light">prev</button></a>';
            } else {
                echo '<button class="btn btn-outline-light mx-1" disabled>first</button>';
                echo '<button class="btn btn-outline-light" disabled>prev</button>';
            }
            echo '<span class="px-5">' . ($_GET["page"] + 1) . '</span>';
            if ($page < floor($response->data->stats->total / 25)) {
                echo '<a href="coins.php?page=' . ($_GET["page"] + 1) . '"><button class="btn btn-outline-light">next</button></a>';
                echo '<a href="coins.php?page=' . (floor($response->data->stats->total / 25)) . '"><button class="btn btn-outline-light mx-1">last</button></a>';
            } else {
                echo '<button class="btn btn-outline-light" disabled>next</button>';
                echo '<button class="btn btn-outline-light mx-1" disabled>last</button>';
            }
        } else {
            echo 'nothing to find';
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
<script>
    function btnChange(that) {
        if (that.classList.contains("btn-outline-light")) {
            that.classList.remove("btn-outline-light");
            that.classList.add("btn-danger");
            tags.push(that.innerHTML);
        } else {
            that.classList.add("btn-outline-light");
            that.classList.remove("btn-danger");
            var index = tags.indexOf(that.innerHTML);
            if (index !== -1) {
                tags.splice(index, 1);
            }
        }
        console.log(tags);
    }

    function search() {
        var symbol = document.getElementById("input-symbol").value;
        var name = document.getElementById("input-name").value;
        var tagUrl = "";
        tags.forEach(tag => {
            tagUrl += "&tags[]=" + tag;
        })
        symbolsUrl = "";

        if (symbol != "") {
            symbols = symbol.split(',');
            symbols.forEach(symbol => {
                symbolsUrl += "&symbols[]=" + symbol;
            })
        }

        window.location.href = `coins.php?page=${page}&search=${name}${symbolsUrl}${tagUrl}`;
    }

    function clearForm() {
        document.getElementById("input-symbol").value = "";
        document.getElementById("input-name").value = "";
        tagsCoppy = [...tags];
        tagsCoppy.forEach(tag => {
            console.log("clr btn");
            btnChange(document.getElementById(tag));
        });
    }

    function setForm() {
        var buttons = document.getElementById("tags-buttons");
        var input_name = document.getElementById("input-name").value = name;
        var input_symbol = document.getElementById("input-symbol");
        symbols.forEach((symbol, i) => {
            if (i != symbols.length - 1) {
                input_symbol.value += symbol + ",";
            } else {
                input_symbol.value += symbol;
            }
        });
        tagsCoppy = [...tags];
        tags = [];
        tagsCoppy.forEach(tag => {
            btnChange(document.getElementById(tag))
        });
        console.log(symbols);
        console.log(tags);
        console.log(page);
        console.log(name);

    }
    setForm();
</script>
</body>

</html>