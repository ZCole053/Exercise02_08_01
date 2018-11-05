<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Create Subscribers Table</title>
    <script src="modernizr.custom.65897.js"></script>
</head>

<body>
    <h2>Create Subscribers Table</h2>
    <?php
    //shows version that we are currently in
    $hostName = "localhost";
    $userName = "adminer";
    $password = "doubt-drink-37";
    $DBName = "newsletter1";
    $tableName = "subscribers";
    //hold conection information we are trying to establish
    $DBConnect = mysqli_connect($hostName, $userName, $password);
    if(!$DBConnect){
        echo "<p>Connection error:". mysqli_connect_error(). ".</p>\n";
    }else{
        //testing the select
        if(mysqli_select_db($DBConnect, $DBName)){
            echo "<p>Successfuly selected the \"$DBName\"". "database.</p>\n";
            //selecting everything
            $sql = "SELECT * FROM $tableName";
            $result = mysqli_query($DBConnect, $sql);
            //show the amount of rows of data
            echo "<p>number of rows in". " <strong>$tableName</strong>: ". mysqli_num_rows($result). ".</p>\n";//debug
            echo "<table width='100%' border='1'>\n";
            echo "<tr>";
            echo "<th>Subscriber id</th>";
            echo "<th>Name</th>";
            echo "<th>Email</th>";
            echo "<th>Subscriber Date</th>";
            echo "<th>Subscriber Confirm</th>";
            echo "<tr>";
            echo "</table>";
            mysqli_free_result($result);
        }else{
            echo "<p>Could not select the \"$DBName\"". "database: ". mysqli_error($DBConnect) . "</p>\n";
        }
        echo "<p>Closing Database Connection.</p>\n";
        mysqli_close($DBConnect);
    }
    ?>
</body>

</html>