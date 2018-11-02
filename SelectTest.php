<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Select Database</title>
    <script src="modernizr.custom.65897.js"></script>
</head>

<body>
    <h2>Select Database</h2>
    <?php
    //shows version that we are currently in
    $hostName = "localhost";
    $userName = "adminer";
    $password = "doubt-drink-37";
    $DBName = "newsletter1";
    //hold conection information we are trying to establish
    $DBConnect = mysqli_connect($hostName, $userName, $password);
    if(!$DBConnect){
        echo "<p>Connection error:". mysqli_connect_error(). ".</p>\n";
    }else{
        //testing the select
        if(mysqli_select_db($DBConnect, $DBName)){
            echo "<p>Successfuly selected the \"$DBName\"". "database.</p>\n";//debug
        }else{
            echo "<p>Could not select the \"$DBName\"". "database: ". mysqli_error($DBConnect) . "</p>\n";
        }
        echo "<p>Closing Database Connection.</p>\n";
        mysqli_close($DBConnect);
    }
    ?>
</body>

</html>