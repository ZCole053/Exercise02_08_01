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
            //variable to show the table name
            $sql = "SHOW TABLES LIKE '$tableName'";
            //sends the query
            $result = mysqli_query($DBConnect, $sql);
            //returns back the number of rows
            if(mysqli_num_rows($result) == 0){
                echo "<p>The <strong>$tableName</strong>". " table does not exist, creating table.</p>\n";//debug
                                                    //primary key 2 BYTES
                $sql = "CREATE TABLE $tableName". " (subscriberID SMALLINT NOT NULL". " AUTO_INCREMENT PRIMARY KEY," ."  
                name VARCHAR(80), email VARCHAR(100),". 
                " subscribeDate DATE, confirmedDate DATE)";
                $result = mysqli_query($DBConnect, $sql);
                //false
                if(!$result){
                    echo "<p>Unable to create the". " <strong>$tableName</strong> table.<br>\n";
                    echo "Error: ". mysqli_error($DBConnect) . "</p>\n";
                }else{
                    echo "<p>Successfully created the". " <strong>$tableName</strong> table.</p>\n";   
                }
            }else{
                echo "<p>The <strong>$tableName</strong>". " table already exists.</p>\n";//debug
            }
        }else{
            echo "<p>Could not select the \"$DBName\"". "database: ". mysqli_error($DBConnect) . "</p>\n";
        }
        echo "<p>Closing Database Connection.</p>\n";
        mysqli_close($DBConnect);
    }
    ?>
</body>

</html>