<?php
require('mysql_conn.php');
require('api_background.php');
require('visitor_details/get_user_details.php');
require('conn/mysql_conn_phplogin.php');
require('radio/getJsonCountryCodes.php');

$numberOfVisitors = countVisitors($connection_if0_36973486_phplogin);
$tooltipVisitors = tooltipVisitors($connection_if0_36973486_phplogin);
$latLng = getVisitorInfo($connection_if0_36973486_phplogin);
$header_menu_sql = "SELECT * FROM header_menu";
$header_menu = $conn->query($header_menu_sql);

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $number = $_POST['number'];
    $date = $_POST['date'];

    $insert = mysqli_query($conn, "INSERT INTO `contact_form`(name, email, number, date) VALUES('$name','$email','$number','$date')") or die('query failed');

    if ($insert) {
        $message[] = 'randevunuz başarılı!';
    } else {
        $message[] = 'randevunuz başarısız';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="google-site-verification" content="zXc7CV_m1QpnawS8KN1jsvPnx5C50CtQww_1D6woABQ" />
        <meta name="description" content="Free Online Metal Radio">
        <meta name="keywords" content="free, radio, online, metal, rock, deathcore, metalcore, trash metal, heavy metal">
        <meta name="author" content="Plamen Dimitrov">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>🎸🥁</title>
        <link rel="icon" type="image/x-icon" href="images/logo.png">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/css/bootstrap.min.css">
        <script
            src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
        crossorigin="anonymous"></script>
        <link rel="stylesheet" href="css/style.css">

        <style>
            body {
                /*                border: solid 1px red;*/
                overflow: hidden;
                background-color: var(--black-body);
            }
            #radio {
                padding-top:90px;
            }
            .home{
                background:url(<?php echo $pics[0]; ?>) no-repeat;
                background-size: cover;
                background-position: center;
            }
            .hidden {
                display: none;
            }
            .banner {
                height: 40px;
                position: relative;
                overflow: hidden;
                font-weight: bold;
                font-size: large;
                line-height: 30px;
                min-width: 200vw;
                font-family:sans-serif;
                background-color: var(--orange);
                animation: bannermove 40s linear infinite;
                display: flex;
                justify-content: space-between;
                align-items: center;
                white-space: nowrap;
                width: fit-content;
            }

            .banner:hover {
                animation-play-state: paused;
            }

            @keyframes bannermove {
                0% {
                    transform: translateX(0);
                }
                100% {
                    transform: translateX(-50%);
                }
            }
            .banner div a{
                padding: 10px;
                color: #FFFFFF;
            }

            .btn-favorite {
                background-color: #212121;
                border: 1px solid var(--gray);
                color: #ff6666;
                padding: 5px;
                border-radius: 4px;
                top:-355px;
                left: -30px;
            }

            .fa-heart:hover {
                color: var(--red);

            }

            .combos-radio {
                display: flex;
                flex-direction: row;
            }

            .combo {
                margin: 3px;
                text-align: center;
                vertical-align: middle;
                padding-top: 10px;
                padding-bottom: 10px;
                flex: 50%;
            }

            .combos-radio .combo select {
                padding:5px 3px;
            }

            select.dropdown {
                border-width: 2px;
                border-style: solid;
                border-color: var(--gray);
            }

            .nav-menu {
                display: flex;
                flex-direction: row;
            }

            @media (max-width: 800px) {
                .combos-radio {
                    flex-direction: column;
                }
            }

            @media (max-width: 1000px) {
                .btn-favorite {
                    top:-345px;
                    left: -22px;
                }
            }

            *, *::before, *::after {
                box-sizing: border-box;
            }

            @keyframes rotate {
                100% {
                    transform: rotate(1turn);
                }
            }

            .player-frame-anime  {
                position: relative;
                z-index: 0;
                border-radius: 10px;
                overflow: hidden;
                padding: 4rem;

                &::before {
                    content: '';
                    position: absolute;
                    z-index: -2;
                    left: -50%;
                    top: -50%;
                    width: 200%;
                    height: 200%;
                    background-color: var(--black-body);
                    background-repeat: no-repeat;
                    background-position: 0 0;
                    background-image: conic-gradient(transparent, rgba(168, 239, 255, 1), transparent 30%);
                    animation: rotate 4s linear infinite;
                }

                &::after {
                    content: '';
                    position: absolute;
                    z-index: -1;
                    left: 6px;
                    top: 6px;
                    width: calc(100% - 12px);
                    height: calc(100% - 12px);
                    background: var(--black-body);
                    border-radius: 5px;
                }
            }

            .bottom-effect {
                margin-top: 0px;
                margin-bottom: 0px;
                width: 100%;
                height: 3px;
                background-color: var(--orange);

            }
            /* The Modal (background) */
            .modal {
                display: none; /* Hidden by default */
                position: fixed; /* Stay in place */
                z-index: 1; /* Sit on top */
                padding-top: 130px; /* Location of the box */
                left: 0;
                top: 0;
                width: 100%; /* Full width */
                height: 100%; /* Full height */
                overflow: auto; /* Enable scroll if needed */
                background-color: rgb(0,0,0); /* Fallback color */
                background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
            }

            /* Modal Content */
            .modal-content {
                background-color: var(--white);
                margin: auto;
                padding: 20px;
                border: 1.5px solid var(--orange);
                width: 30%;
            }

            /* The Close Button */
            .close {
                margin-right: 5px;
                position: absolute;
                top: 0;
                right: 0;
                color: var(--orange);
                font-size: 28px;
                font-weight: bold;
            }

            .close:hover,
            .close:focus {
                color: #000;
                text-decoration: none;
                cursor: pointer;
            }
        </style>
    </head>
    <body>
        <!-- The Modal -->
        <div id="myModal" class="modal">

            <!-- Modal content -->
            <div class="modal-content">
                <span class="close">&times;</span>
<!--                <p>Added to favorites!</p>-->
            </div>
        </div>

        <header class="header fixed-top">
            <div class="banner">
                <div><a href="#radio"><i class="fab fa-napster mr-2"></i>Rock Radio<i class="fab fa-napster ml-2"></i></a></div>
                <div><a href="#radio"><i class="fab fa-napster mr-2"></i>Heavy Metal Radio<i class="fab fa-napster ml-2"></i></a></div>
                <div><a href="#radio"><i class="fab fa-napster mr-2"></i>Death Metal Radio<i class="fab fa-napster ml-2"></i></a></div>
                <div><a href="#radio"><i class="fab fa-napster mr-2"></i>Trash Metal Radio<i class="fab fa-napster ml-2"></i></a></div>
                <div><a href="#radio"><i class="fab fa-napster mr-2"></i>Metalcore Radio<i class="fab fa-napster ml-2"></i></a></div>
                <div><a href="#radio"><i class="fab fa-napster mr-2"></i>Deathcore Radio<i class="fab fa-napster ml-2"></i></a></div>
                <div><a href="#radio"><i class="fab fa-napster mr-2"></i>Grindcore Radio<i class="fab fa-napster ml-2"></i></a></div>
            </div>



            <div class="topnav" id="myTopnav">
                <a href="#radio"><img src="images/logo.png" alt="Site Logo" style="width:22px;height:22px;"></a>
                <?php
                while ($row = mysqli_fetch_assoc($header_menu)) {
                    if ($row['class'] == 'location') {
                        //echo '<a href="location/location.html">' . $row['name'] . "</a>";
                    } else {
                        echo '<a style="padding-left: 20px; padding-right: 20px; "href="#' . $row['class'] . '">' . $row['name'] . "</a>";
                    }
                }
                ?>
                <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                    <i class="fa fa-bars"></i>
                </a>
            </div>
        </header>
        <div class="combos-radio" id="radio">
            <div class="combo">
                <select class="dropdown" id="genre-select">
                    <!--                        <option hidden selected>--</option>-->
                    <option value="none">Select Genre</option>
                    <option value="rock">Rock</option>
                    <option value="heavy_metal">Heavy Metal</option>
                    <option value="death">Death Metal</option>
                    <option value="trash">Trash Metal</option>
                    <option value="metalcore">Metalcore</option>
                    <option value="deathcore">Deathcore</option>
                    <option value="black_metal">Black Metal</option>
                </select>    
            </div>

            <div class="combo">
                <select class="dropdown" id="country-select">
                    <option value="none">Select Country</option>
                    <?php
                    foreach ($countryCodes as $vel) {
                        echo "<option value=" . $vel['code'] . ">" . $vel['name'] . "</option>";
                    }
                    ?>
                </select>   
            </div>

            <div class= "combo" id="station-select-title">
                <select class="dropdown" id="station-select" style="width:215px">
                    <option selected>Chose at least genre or country</option>
                </select>                        
            </div>

            <div class= "combo" id="station-favorite-title">
                <select class="dropdown" id="station-favorite" style="width:215px">
                    <option selected>Chose your favorite</option>
                </select>                                              
            </div> 



        </div>
        <div class="container-fluid mt-3" id="player">
            <iframe allowtransparency="true" id="radio_url" width="100%" height="320" src="https://radioplayer.link/iframe/index.php?autoplay=true&name=&logo=&bgcolor=212121&textcolor=FFFFFF&v=1&stream=" frameborder="0" scrolling="no" style="z-index: 0;" allow="autoplay"></iframe>
            <button id="btn-add-fav" data-text= "" class="hidden tooltip-visit"><i class="fa fa-heart-o fa-2x"></i></button>
            <button id="btn-rem-fav" data-text= "" class="hidden tooltip-visit"><i class="fa fa-heart fa-2x"></i></button>
        </div>

        <div class="footer" id="footer">

            <!-- Footer -->
            <footer class="text-lg-start text-white">
                <!-- Grid container -->
                <div class="container">
                    <!--Grid row-->
                    <div class="row d-flex">
                        <!-- Grid column -->
                        <div class="col-md-4 col-lg-4 col-xl-4 mx-auto mt-4">
                            <h3 class="mb-4 font-weight-bold">
                                About this website
                            </h3>
                            <p>
                                Welcome to this experimental website.
                                The content is not constant. It is changing occasionally.
                            </p>
                        </div>

                        <hr class="w-100 clearfix d-md-none" />

                        <!-- Grid column -->
                        <div class="col-md-3 col-lg-2 col-xl-3 mx-auto mt-4">
                            <h4 class="mb-4 font-weight-bold">
                                Admin panel
                            </h4>
                            <p>
                                <a class="text-white" href="index_admin.html" target="_blank">Your Account</a>
                            </p>
                            <p>
                                <a data-text= "<?php echo $tooltipVisitors; ?>" class="text-white tooltip-visit">You are visitor number: <?php echo $numberOfVisitors; ?> <i class="fa fa-question-circle mr-3" aria-hidden="true"></i></a>
                            </p>

                            <span class="text-white" id="tooltip-location" data-lat="<?php echo $latLng['latitude']; ?>" data-lng="<?php echo $latLng['longitude']; ?>">You are approx location <i class="fa fa-map-marker mr-3" aria-hidden="true"></i>
                                <span id="map-tip"></span>
                            </span>

                        </div>


                        <!-- Grid column -->
                        <hr class="w-100 clearfix d-md-none" />

                        <!-- Grid column -->
                        <div class="col-md-4 col-lg-4 col-xl-3 mx-auto mt-4">
                            <h4 class="mb-4 font-weight-bold">Contact</h4>
<!--                                <p><i class="fas fa-home mr-3"></i>Diana 10-A-13, Yambol, BG</p>-->
                            <p><i class="fas fa-envelope mr-3"></i>pgdimitrov@yahoo.com</p>
                            <p><i class="fas fa-phone mr-3"></i>+359 876 448303</p>

                        </div>
                        <!-- Grid column -->
                    </div>
                    <!--Grid row-->
                    <!-- Section: Links -->

                    <hr class="my-3">

                    <!-- Section: Copyright -->
                    <div class="p-3 pt-0">
                        <div class="row d-flex align-items-center">
                            <!-- Grid column -->
                            <div class="col-md-7 col-lg-8 text-md-start">
                                <!-- Copyright -->
                                <div class="p-3">
                                    © 2024 Copyright:
                                    <a class="text-white" href="https://plambe.wuaze.com/"
                                       >plambe.wuaze.com</a
                                    >
                                </div>
                                <!-- Copyright -->
                            </div>
                            <!-- Grid column -->

                            <!-- Grid column -->
                            <div class="col-md-5 col-lg-4 ml-lg-0 text-center text-md-end">
                                <!-- Facebook -->
                                <a
                                    class="btn btn-outline-light btn-floating m-1"
                                    class="text-white"
                                    role="button" href="https://www.facebook.com/plamen.dimitrov.10"
                                    ><i class="fab fa-facebook-f"></i
                                    ></a>              
                            </div>
                            <!-- Grid column -->
                        </div>
                    </div>
                    <!-- Section: Copyright -->
                </div>

                <!-- Grid container -->
            </footer>
            <!-- Footer -->


        </div>

        <hr class="bottom-effect">

        <script>
            window.onbeforeunload = function () {
                window.scrollTo(0, 0);
            };
        </script>
        <!--Google-->
        <script>
            var lat;
            var lng;
            var map;
            function initMap() {
                lat = $('#tooltip-location').data('lat');
                lng = $('#tooltip-location').data('lng');
                var coordinates = {lat: lat, lng: lng};
                map = new google.maps.Map(document.getElementById("map-tip"), {
                    center: coordinates,
                    zoom: 13,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                });
                new google.maps.Marker({
                    position: coordinates,
                    map: map,
                });
            }
        </script>
        <script src="https://cdn.jsdelivr.net/gh/somanchiu/Keyless-Google-Maps-API@v6.6/mapsJavaScriptAPI.js"
        async defer></script>
        <script>
            $(document).ready(function () {

                $("#player").addClass('player-frame-anime');

                $('#station-select').on('change', function () {
                    $("#btn-rem-fav").addClass('hidden');
                    $("#btn-add-fav").removeClass('hidden').addClass('btn-favorite').attr("data-text", "Add in Favorites");
                });

                $('#station-favorite').on('change', function () {
                    $("#btn-add-fav").addClass('hidden');
                    $("#btn-rem-fav").removeClass('hidden').addClass('btn-favorite').attr("data-text", "Added in Favorites");               
                });

                var select_radio_values = {};
                $('#genre-select').on('change', function () {

                    select_radio_values.genre = $(this).val();
                    //                    if (select_radio_values.genre == "none" && select_radio_values.country == "none") {
                    //                        $("#station-select-title").addClass("hidden");
                    //                        return;
                    //                    }
                    if (select_radio_values.genre != "none" || select_radio_values.country != "none") {
                        $.ajax({
                            url: "radio/select_radio.php",
                            datatype: 'json',
                            data: select_radio_values,
                            cache: false,
                            type: "POST",
                            success: function (response) {

                                var formoption = "";
                                $.each(JSON.parse(response), function (key, value) {
                                    formoption += "<option value='" + value['url'] + "' data-stationuuid='" + value['stationuuid'] + "'>" + value['name'] + ", " + value['countrycode'] + ", " + value['bitrate'] + "kbps, " + value['codec'] + "</option>";
                                });
                                $('#station-select').html(formoption);
                                $('#station-select').on('change', function () {

                                    var name_radio = $("#station-select option:selected").text();
                                    var url_radio = $(this).val();
                                    var url = "https://radioplayer.link/iframe/index.php?autoplay=play&name=" + name_radio + "&logo=&bgcolor=212121&textcolor=FFFFFF&v=1&stream=" + url_radio;
                                    $("#radio_url").attr('src', url);

                                    $("#btn-rem-fav").addClass('hidden');
                                    $("#btn-add-fav").removeClass('hidden').addClass('btn-favorite');
                                    $("#btn-add-fav").attr("data-text", "Add in Favorites");

                                });
//add favorite

                                $("#btn-add-fav").on('click', function () {
                                    var name_radio = $("#station-select option:selected").text();
                                    var url_radio = $('#station-select').val();
                                    var stationuuid = $("#station-select option:selected").data('stationuuid');
                                    saveFaforiteRadio(name_radio, url_radio, stationuuid);
                                });


                            },
                        });
                    }
                });
                $('#country-select').on('change', function () {
                    select_radio_values.country = $(this).val();
                    //                    if (select_radio_values.genre == 'none' && select_radio_values.country == 'none') {
                    //                        $("#station-select-title").addClass("hidden");
                    //                        return;
                    //                    }

                    if (select_radio_values.genre != "none" || select_radio_values.country != "none") {
                        $.ajax({
                            url: "radio/select_radio.php",
                            datatype: 'json',
                            data: select_radio_values,
                            cache: false,
                            type: "POST",
                            success: function (response) {
                                var formoption = "";
                                $.each(JSON.parse(response), function (key, value) {
                                    formoption += "<option value='" + value['url'] + "' data-stationuuid='" + value['stationuuid'] + "'>" + value['name'] + ", " + value['countrycode'] + ", " + value['bitrate'] + "kbps, " + value['codec'] + "</option>";
                                });
                                $('#station-select').html(formoption);
                                $('#station-select').on('change', function () {
                                    var name_radio = $("#station-select option:selected").text();
                                    var url_radio = $(this).val();
                                    var url = "https://radioplayer.link/iframe/index.php?autoplay=play&name=" + name_radio + "&logo=&bgcolor=212121&textcolor=FFFFFF&v=1&stream=" + url_radio;
                                    $("#radio_url").attr('src', url);
                                    $("#btn-add-fav").removeClass('hidden').addClass('btn-favorite');
                                    $("#btn-add-fav").attr("data-text", "Add Favorite");
                                });

                            },
                        });
                    }
                });



            });


        </script>
        <script>
            $('document').ready(function () {
                $('#api_background').on('click', function () {
                    window.location.reload(true);
                });
            });
        </script>
        <script>
            /* Toggle between adding and removing the "responsive" class to topnav when the user clicks on the icon */
            function myFunction() {
                var x = document.getElementById("myTopnav");
                if (x.className === "topnav") {
                    x.className += " responsive";
                    $('#myTopnav a').click(function () {
                        myFunction();
                    });

                } else {
                    x.className = "topnav";
                }
            }</script>
        <script src="js/script.js"></script>
    </body>
</html>
