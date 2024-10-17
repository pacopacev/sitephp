<?php
include 'mysql_conn.php';
include 'api_background.php';
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.html');
    exit;
}
$api_background_sql_all = "SELECT * FROM `api_background` ORDER BY id ASC";
$result = $conn->query($api_background_sql_all);

if ($result->num_rows > 0) {
//print_r($result);
//    foreach ($result as $elem) {
//
//        $word_1 = $elem['key_word_1'];
//        $word_2 = $elem['key_word_2'];
//    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <link href="css/home_style.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="//cdn.datatables.net/2.1.3/js/dataTables.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />


    </head>
    <body>
        <div>
            <nav class="navtop">
                <div>
                    <h1><i class="fas fa-user-cog"></i>ADMIN PANEL</h1>
                    <a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
                    <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
                    <a href="index.php"><i class="fa fa-check"></i>Site Index</a>
                </div>
            </nav>
        </div>

        <!--        //side navi menu-->
        <div class="sidenav">
            <a href="#api_background" class="tablinks" id="defaultOpen">Api background</a>
            <a href="#services" class="tablinks" id="test">Services</a>
            <a href="#clients">Clients</a>
            <a href="#contact">Contact</a>
            <button class="dropdown-btn">Statistic 
                <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-container">
                <a href="#" id="visitor_details">Visitor Details</a>
                <a href="#">Link 2</a>
                <a href="#">Link 3</a>
            </div>
            <a href="#contact">Search</a>
        </div>

        <div id="masterdiv" class="tabcontent" </div>


        <script>
            /* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
            var dropdown = document.getElementsByClassName("dropdown-btn");
            var i;

            for (i = 0; i < dropdown.length; i++) {
                dropdown[i].addEventListener("click", function () {
                    this.classList.toggle("active");
                    var dropdownContent = this.nextElementSibling;
                    if (dropdownContent.style.display === "block") {
                        dropdownContent.style.display = "none";
                    } else {
                        dropdownContent.style.display = "block";
                    }
                });
            }
        </script>  


        <script>
            $(document).ready(function () {
                $("#masterdiv").empty();
                $("#defaultOpen").click(function () {
                    $("#masterdiv").empty();
                    $(".tabcontent").load("api_background/new_api_background_edit.php");
                });
                $("#test").click(function () {
                    $("#masterdiv").empty();
                    $(".tabcontent").load("newhtml_1.html");
                });

                $("#visitor_details").click(function () {
                    $("#masterdiv").empty();
                    $(".tabcontent").load("visitor_details/visitor_list.php");
                });
            });
        </script>




    </body>
</html>