<?php
include('../mysql_conn.php');
?>
<html>  
    <head>  
        <title>test</title> 
        <script
        src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="crossorigin="anonymous"></script>
        <script src="//cdn.datatables.net/2.1.3/js/dataTables.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>  
        <link rel="stylesheet" href="//cdn.datatables.net/2.1.3/css/dataTables.dataTables.min.css">
    </head>
    <body>  
        <div class="container">  


            <br>
            <section class="contact" id="api_background">
                <h1 class="heading">api_background</h1>
                <form action="" method="post" id="MyForm">
                    <span> key_word_1:</span>
                    <input type="text" name="key_word_1" id="key_word_1" list="thechose_1" placeholder="enter your key_word_1" class="box" required>   
                    <span> key_word_2</span>
                    <input type="text" name="key_word_2" id="key_word_2" list="thechose_2"placeholder="enter your key_word_2" class="box" required>
                    <input type="submit" value="save" name="submit_keys">
                </form>  
            </section>

            <br>

            <table class="table table-bordered" id="myTable">
                <thead>
                <th>Id</th>
                <th>Key_word_1</th>
                <th>Key_word_2</th>
                <th>Action</th>
                </thead>

            </table>
            <script>
                $(document).ready(function () {
             
               
                    var table = new DataTable('#myTable', {
                        ajax: {
                            url: "api_background/show-data.php",
                            type: 'GET',
                            dataSrc: '',
                        },
                        processing: true,
                        serverSide: true,

                        columnDefs: [
                            {
                                data: null,
                                defaultContent: '<button>Delete</button>',
                                targets: -1
                            }
                        ]
                    });
                    table.on('click', 'button', function (e) {
                        let data = table.row(e.target.closest('tr')).data();
                        $.ajax({
                            url: "api_background/remove_table_row.php?id=" + data[0],
                            type: "POST",
                            dataSrc: '',
                            success: function () {
                                table.ajax.url('api_background/show-data.php').load();

                            }
                        });

                    });



                    $("form").click(function (e) {
                        e.preventDefault();

                        var formData = {
                            key_word_1: $("#key_word_1").val(),
                            key_word_2: $("#key_word_2").val(),

                        };
                        $.ajax({
                            type: 'POST',
                            url: 'api_background/save_keywords.php',
                            data: formData,
                            success: function (response) {
                                table.ajax.url('api_background/show-data.php').load();

                            }
                        });
                    });

                });

            </script>

        </div>
    </body>  
</html>
