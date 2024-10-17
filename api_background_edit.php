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

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Home Page</title>
        <link href="css/home_style.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
    </head>
    <body>
        <div class="content">			        
            <section class="contact" id="api_background">
                <h1 class="heading">api_background</h1>
                <!--<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">-->

                <form action="" method="post">

                    <?php
                    if (isset($message)) {
                        foreach ($message as $message) {
                            echo '<p class="message">' . $message . '</p>';
                        }
                    }
                    ?>
                    <span> key_word_1:</span>
                    <input type="text" name="key_word_1" list="thechose_1" placeholder="enter your key_word_1" class="box" required>
                    <datalist id="thechose_1">
                        <?php
                        if ($api_background_combo_result->num_rows > 0) {
                            foreach ($api_background_combo_result as $element) {
                                echo "<option value= " . $element['key_word_1'] . ">";
                            }
                        }
                        ?>
                    </datalist>
                    <span> key_word_2</span>
                    <input type="text" name="key_word_2" list="thechose_2"placeholder="enter your key_word_2" class="box" required>
                    <datalist id="thechose_2">
                        <?php
                        if ($api_background_combo_result->num_rows > 0) {
                            foreach ($api_background_combo_result as $element) {
                                echo "<option value= " . $element['key_word_2'] . ">";
                            }
                        }
                        ?>
                    </datalist>
                    <input type="submit" value="save" name="submit_keys" class="link-btn">
                </form>  
            </section>
            <div class="card mb-5">
                <div class="card-header">
                    <i class="fas fa-table mr-1"></i>
                    Keywords List
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" id="logs_table">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>key_word_1</th>
                                    <th>key_word_2</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($result->num_rows > 0) {
                                    foreach ($result as $elem) {

                                        echo "<tr>";
                                        echo "<td>" . $elem['id'] . "</td>";
                                        echo "<td>" . $elem['key_word_1'] . "</td>";
                                        echo "<td>" . $elem['key_word_2'] . "</td>";
//        echo "<td><br/><button href=\"del_keyword_row.php?id=".$elem['id']."\">Delete</button></td>";
                                        echo "<td><a href=\"del_keyword_row.php?id=" . $elem['id'] . "\">Delete</a></td>";
                                        echo "<tr>";
                                    }
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>   
    </body>
</html>
