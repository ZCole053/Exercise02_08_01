<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Newsletter Subscribers</title>
    <script src="modernizr.custom.65897.js"></script>
</head>

<body>
    <h2>Newsletter Subscribers</h2>
    <?php
    //variables
    $hostName = "localhost";
    $userName = "adminer";
    $password = "doubt-drink-37";
    $DBName = "newsletter1";
    $tableName = "subscribers";
    $subscriberName = "";
    $subscriberEmail = "";
    $showForm = false;
    if(isset($_POST['submit'])){
        $formErrorCount = 0;
        $DBConnect = mysqli_connect($hostName, $userName, $password);
        if(!$DBConnect){
            echo "<p>Connection error:". mysqli_connect_error(). ".</p>\n";
        }else{
            //testing the select
            if(mysqli_select_db($DBConnect, $DBName)){
                echo "<p>Successfuly selected the \"$DBName\"". "database.</p>\n";
                
            }else{
                echo "<p>Could not select the \"$DBName\"". "database: ". mysqli_error($DBConnect) . "</p>\n";
            }
            echo "<p>Closing Database Connection.</p>\n";
            mysqli_close($DBConnect);
        }
    }else{
        $showForm = true;
    }
    //hold conection information we are trying to establish
   
    if($showForm){
    ?>
    <form action="NewsletterSubscribe.php" method="post">
    <p><strong>Your Name: </strong><br>
    <input type="text" name="subName" value="<?php echo $subscriberName;?>">
    </p>
    <p><strong>Your Email Address: </strong><br>
    <input type="email" name="subEmail" value="<?php echo $subscriberEmail;?>">
    </p>
    <p>
    <input type="submit" name="submit" value="Submit">
    </p>
    </form>
</body>

</html>
<?php
    }
?>