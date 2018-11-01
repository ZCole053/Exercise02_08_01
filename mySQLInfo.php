<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>MySQLInfo</title>
    <script src="modernizr.custom.65897.js"></script>
</head>

<body>
    <h2>MySql Database Server Information</h2>
    <?php
    //shows version that we are currently in
    echo "<p>MySQL Client Version: ". mysqli_get_client_info() . "</p>\n";
    $hostName = "localhost";
    $userName = "adminer";
    $password = "doubt-drink-37";
    //hold conection information we are trying to establish
    $DBConnect = mysqli_connect($hostName, $userName, $password);
    if(!$DBConnect){
        echo "<p>Connection failed.</p>\n";
    }else{
        echo "<p>MySQL connection: ". mysqli_get_host_info($DBConnect). "<p/>\n";
        echo "<p>Closing Database Connection.</p>\n";
        //closes similar to fie handlers
        mysqli_close($DBConnect);
    }
    ?>
</body>

</html>