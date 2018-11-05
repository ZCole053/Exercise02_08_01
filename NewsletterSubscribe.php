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
        //validation
        if(!empty($_POST['subName'])){
            //gets ride of quotes o strings
            $subscriberName = stripslashes($_POST['subName']);
            //gets ride of spaces
            $subscriberName = trim($subscriberName);
            //checks for string length
            if(strlen($subscriberName) == 0){
                //incriments error count
                ++$formErrorCount;
                echo "<p>You must include your". " <strong>name</strong>.</p>\n";
            }
        }else{
            ++$formErrorCount;
            echo "<p>Form submittal error, no". " <strong>Name</strong> field!</p>\n";
        }
        //validation
        if(!empty($_POST['subEmail'])){
            //gets ride of quotes o strings
            $subscriberEmail = stripslashes($_POST['subEmail']);
            //gets ride of spaces
            $subscriberEmail = trim($subscriberEmail);
            //checks for string length
            if(strlen($subscriberEmail) == 0){
                //incriments error count
                ++$formErrorCount;
                echo "<p>You must include your". " <strong>email</strong>.</p>\n";
            }
        }else{
            ++$formErrorCount;
            echo "<p>Form submittal error, no". " <strong>Email</strong> field!</p>\n";
        }
    if($formErrorCount == 0){
        $showForm = false;
            $DBConnect = mysqli_connect($hostName, $userName, $password);
            if(!$DBConnect){
                echo "<p>Connection error:". mysqli_connect_error(). ".</p>\n";
            }else{
                //testing the select
                if(mysqli_select_db($DBConnect, $DBName)){
                    echo "<p>Successfuly selected the \"$DBName\"". "database.</p>\n";
                    $subscirberDate = date("Y-m-d");
                    $sql = "INSERT INTO $tableName". 
                        " (name,email, subscribeDate)" . 
                        " VALUES ('$subscriberName'," . 
                        " '$subscriberEmail',".
                        " '$subscirberDate')";
                    $result = mysqli_query($DBConnect,$sql);
                    if(!$result){
                        echo "<p>Unable to insert the values". " into the <strong>$tableName". " </strong> table.</p>";
                        echo "<p>Error code <strong>". mysqli_errno($DBConnect) . ": " . mysqli_error($DBConnect). "</strong></p>";
                    }else{

                    }

                }else{
                    //fail
                    echo "<p>Could not select the \"$DBName\"". "database: ". mysqli_error($DBConnect) . "</p>\n";
                }
                echo "<p>Closing Database Connection.</p>\n";
                //closes the database
                mysqli_close($DBConnect);
            }
        }else{
            $showForm = true;
        }
    }else{
        $showForm = true;
    }
    //hold conection information we are trying to establish
    //sticky form
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