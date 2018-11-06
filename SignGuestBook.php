<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Sign GuestBook</title>
    <script src="modernizr.custom.65897.js"></script>
</head>
<body>
    <h1>Sign Guest Book</h1>
<?php
//function to connect to database
function connectToDB($hostname,$username,$password){
    $DBConnect = mysqli_connect($hostname,$username,$password);
    //displays error if it doesn't work
    if(!$DBConnect){
        echo "<p>Connection error: ". mysqli_connect_error(). "</p>\n"; 
    }
    return $DBConnect;
}
//function to select database
function selectDB($DBConnect,$DBName){
    //tries to select database
        $success = mysqli_select_db($DBConnect,$DBName);
        if($success){
            echo "<p>Successfully selected the \"$DBName\" database.</p>\n";
        }else{
            echo "<p>Could not select the \"$DBName\" database:". mysqli_error($DBConnect). ",creating it.</p>\n";
            //creates data base if one is not already made
            $sql = "CREATE DATABASE $DBName";
            if(mysqli_query($DBConnect,$sql)){
                echo "<p>Successfully created the \"$DBName\" database.</p>\n";
                //selects database again
                $success = mysqli_select_db($DBConnect,$DBName);
                //if it works displays to the user
                // if($success){
                //     echo "<p>Successfully selected the \"$DBName\" database.</p>\n";
                // }
            }else{
                //if not created error messag eis made
            echo "<p>Could not create the \"$DBName\" database:". mysqli_error($DBConnect). ".</p>\n";
        }
    }
    //returns the result
    return $success;
}
//function to create tables and check to see if one is made
function createTable($DBConnect,$tablename){
    $success = false;
    //brings up the table
    $sql = "SHOW TABLES LIKE '$tablename'";
    $result = mysqli_query($DBConnect,$sql);
    //if it doesn't exist it makes it with three colums 
    if(mysqli_num_rows($result) === 0){
        echo "The <strong>$tablename</strong> table does not exist, creating table.<br>\n";
        $sql = "CREATE TABLE $tablename(countID SMALLINT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
        lastName VARCHAR(40), firstName VARCHAR(40))";
        $result = mysqli_query($DBConnect,$sql);
        //displays error if it doesn't work
        if($result === false){
            $success = false;
            echo "<p>Unable to create the $tablename table.</p>";
        }
        //tells the user it already exists
    }else{
        $success = true;
        // echo "The $tablename table already exists.<br>\n";
    }
    return $success;
}



//variables
$hostname = "localhost";
$username = "adminer";
$password = "doubt-drink-37";
$DBName = "guestbook";
$tablename = "visitors";
$firstname = "";
$lastname = "";
$formErrorCount = 0;
//Main Code Block
if(isset($_POST['submit'])){
    //cleaning up input
    $firstname = stripslashes($_POST['firstName']);
    $firstname = trim($firstname);
    $lastname = stripslashes($_POST['lastName']);
    $lastname = trim($lastname);
    //error message to see if input is empty
    if(empty($firstname) || empty($lastname)){
        echo "<p>You must enter your first and last <strong>name</strong>.</p>\n";
        ++$formErrorCount;
        //if no errors continue
    }if($formErrorCount === 0){
        //opens function to connect to data base
        $DBConnect = connectToDB($hostname,$username,$password);
        if($DBConnect){
            //calls the function to select with more validation
            if(selectDB($DBConnect,$DBName)){
                //calls the function to make the table
                if(createTable($DBConnect, $tablename)){
                    echo "<p>Connection successful!</p>\n";
                    //makes a variable to insert the data
                    $sql = "INSERT INTO $tablename
                    VALUES(NULL,'$lastname','$firstname')";
                    //sends the data to the database
                    $result = mysqli_query($DBConnect,$sql);
                    if($result === false){
                        //displays error messag if it fails
                        echo "<p>Unable to execute the query.</p>";
                        echo "<p>Error Code ". mysqli_errno($DBConnect). ": ". mysqli_error($DBConnect). "</p>";
                    }else{
                        //displays thank you message and emptys the fields
                        echo "<h3>Thank you for signing our guest book!</h3>";
                        $firstname = "";
                        $lastname = "";
                    }
                }
            }
            //closes database
            mysqli_close($DBConnect);
        }
    }
}
?>

<form action="SignGuestBook.php" method="post">
<p><strong>First Name: </strong><br>
<input type="text" name="firstName" value="<?php echo $firstname; ?>"></p>
<p><strong>Last Name: </strong><br>
<input type="text" name="lastName" value="<?php echo $lastname; ?>"></p>
<p><input type="submit" name="submit" value="Submit"></p>
</form>
<!-- code to diplay visitors logs -->
<?php
//calls function to connect to the database
$DBConnect = connectToDB($hostname,$username,$password);
//validation
if($DBConnect){
    if(selectDB($DBConnect,$DBName)){
        if(createTable($DBConnect,$DBName)){
            // echo "<p>Connection successful!</p>\n";//debug
            echo "<h2>Visitors Log</h2>";
            //selects everything in the table
            $sql = "SELECT * FROM $tablename";
            $result = mysqli_query($DBConnect,$sql);
            //displays error to user saying no data
            if(mysqli_num_rows($result) == 0){
                echo "<p>There are no entries in the quest book!</p>";
            }else{
                //creates a table
                echo "<table width='60%' border='1'>";
                echo "<tr>";
                echo "<th>Visitor</th>";
                echo "<th>First Name</th>";
                echo "<th>Last Name</th>";
                echo "</tr>";
                //opens indexed array and places the data in the table rows
                while($row = mysqli_fetch_row($result)){
                    echo "<tr>";
                    echo "<td width='10%' style='text-align:center'>$row[0]</td>";
                    echo"<td>$row[2]</td>";
                    echo"<td>$row[1]</td>";
                    echo "</tr>";
                }
                echo "</table>";
                mysqli_free_result($result);
            }
        }
    }
    mysqli_close($DBConnect);
}
?>

</body>
</html>