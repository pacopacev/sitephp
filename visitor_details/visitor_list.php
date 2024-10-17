
<?php
//require('visitor_details/get_visitor_list.php');
?>
<html>  
    <head>  
        <title>get_user_details</title> 
        <script
        src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="crossorigin="anonymous"></script>
        <script src="//cdn.datatables.net/2.1.3/js/dataTables.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>  
        <link rel="stylesheet" href="//cdn.datatables.net/2.1.3/css/dataTables.dataTables.min.css">
    </head>
    <body>  
        <div class="container">
            <br>
            <div class="">
                <h1 class="heading">Visitor Details</h1> 
            </div>
            <br>
            <table class="table table-bordered" id="visitor_table">
                <thead>
                <th>Id</th>
                <th>HTTP_USER_AGENT</th>
                <th>REMOTE_ADDR</th>
                <th>SCRIPT_NAME</th>
                <th>QUERY_STRING</th>
                <th>Current Page</th>
                <th>Date</th>
                <th>Time</th>
                <th>Country</th>
                <th>City</th>
                <th>Region</th>
                <th>Latitude</th>
                <th>Longitude</th>
                <th>Time Zone</th>
                <th>Provider</th>
                </thead>

            </table>
            <script>
                $(document).ready(function () {
                    var table = new DataTable('#visitor_table', {
                        ajax: {
                            url: "visitor_details/get_visitor_list.php",
                            type: 'GET',
                            dataSrc: '',
                        },
                        processing: true,
                        serverSide: true,
                    });

                });

            </script>

        </div>
    </body>  
</html>

