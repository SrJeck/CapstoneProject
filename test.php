<?php
error_reporting(0);
$conn = mysqli_connect("localhost", "root", "", "journal") or die(mysqli_error());
$query = "SELECT COUNT(topic) as count from journal WHERE topic='technology'";
$query_result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($query_result)) {
    $output = $row['count'] . '<br>';
}
$query = "SELECT COUNT(topic) as count from journal WHERE topic='education'";
$query_result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($query_result)) {
    $output2 = $row['count'] . '<br>';
}
$query = "SELECT COUNT(topic) as count from journal WHERE topic='research'";
$query_result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($query_result)) {
    $output3 =  $row['count'];
}
$query = "SELECT COUNT(topic) as count from journal WHERE topic='analysis'";
$query_result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($query_result)) {
    $output4 =  $row['count'];
}

$sql = "SELECT * from journal";
$result = mysqli_query($conn, $sql);

?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/admin.css">

    <style>
        table,
        tr,
        td {
            text-align: center;
        }

        table,
        tr,
        th,
        td {
            border: 1px solid #ccc;
        }
    </style>
</head>

<body>


    <div class="wrapper">
        <div class="counter col_fourth">
            <i class="fa fa-code fa-2x"></i>
            <h2 class="timer count-title count-number" data-to="300" data-speed="1500"></h2>
            <p class="count-text ">Technology</p>
            <p class="count-text ">
                <?php
                echo $output;
                ?>
            </p>

        </div>

        <div class="counter col_fourth">
            <i class="fa fa-coffee fa-2x"></i>
            <h2 class="timer count-title count-number" data-to="1700" data-speed="1500"></h2>
            <p class="count-text ">Education</p>
            <p class="count-text ">
                <?php
                echo $output2;
                ?>
            </p>
        </div>

        <div class="counter col_fourth">
            <i class="fa fa-lightbulb-o fa-2x"></i>
            <h2 class="timer count-title count-number" data-to="11900" data-speed="1500"></h2>
            <p class="count-text ">Research</p>
            <p class="count-text ">
                <?php
                echo $output3;
                ?>
            </p>
        </div>

        <div class="counter col_fourth end">
            <i class="fa fa-bug fa-2x"></i>
            <h2 class="timer count-title count-number" data-to="157" data-speed="1500"></h2>
            <p class="count-text">Analysis</p>
            <p class="count-text ">
                <?php
                echo $output4;
                ?>
            </p>
        </div>
    </div>
    <a href="#" class="btn btn-info btn-lg">
        <span class="glyphicon glyphicon-bookmark"></span> Bookmark
    </a>
    <script>
        $(function() {
            //var bookmarkOn = '<i class="fa fa-bookmark"></i>'
            //var bookmarkOff = '<i class="fa fa-bookmark-o"></i>'

            $('.pp-bookmark-btn')
                //.html( $('.pp-bookmark-btn').data('state') ? bookmarkOn : bookmarkOff )
                //.html( $('.pp-bookmark-btn').hasClass( "active" ) ? bookmarkOn : bookmarkOff )
                .click(function() {
                    var btn = $(this);

                    var context = $(this).data("context");
                    var contextAction = $(this).data("context-action");
                    var contextId = $(this).data("context-id");
                    // $('#log').html(context + " " + contextAction + " " + contextId )

                    // if( btn.data('state') ) {
                    //    btn.data('state', false);
                    if (btn.hasClass("active")) {
                        btn.removeClass("active")
                        // $getJSON
                        //btn.html(bookmarkOff);
                    } else {
                        // btn.data('state', true);
                        btn.addClass("active");
                        //btn.html(bookmarkOn);
                    };
                });

            /*
              updateBookmarks(action, context, context-action, context-id) {
              
              }
              */
            //     $('form').html('asfafaf');
            //     var btn = $('form').attr('action');
            //     var jqxhr = $.ajax({
            //         url: '/echo/html/',
            //         dataType: 'json',
            //         data:{ id: $('form input').val() }
            //     })
            //     .success(function(data) {
            //         alert("success"+data);
            //     })
            //     .error(function(err) {
            //         alert("error"+err);
            //     })
            //     .complete(function(stuff) {
            //         alert("complete"+stuff);
            //     });
            //
            //     e.preventDefault();

        });
    </script>
</body>

</html>