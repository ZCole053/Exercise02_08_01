<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Candidate Interview</title>
    <script src="modernizr.custom.65897.js"></script>
</head>
<body>
    <?php
    //functions

    //functions to connect to data base
    function connectDB($hostname,$username,$password){
        $DBConnect = mysqli_connect($hostname,$username,$password);
        if(!$DBConnect){
            echo "<p>Connection Error: ". mysqli_connect_error(). "</p>\n";
        } 
        return $DBConnect;
    }

    //function to select database
    function selectDB($DBConnect,$DBName){
        $selected = mysqli_select_db($DBConnect,$DBName);
        if($selected){
            echo "<p>The database was successfully selected.</p>\n";
        }else{
            echo "<p>Could not select database, attempting to create database.</p>\n";
            $sql = "CREATE DATABASE $DBName";
            if(mysqli_query($DBConnect,$sql)){
                echo "<p>Succesfully created the database.</p>\n";
                $selected = mysqli_select_db($DBConnect,$DBName);
            }else{
                echo "<p>Could not create database error:". mysqli_error($DBConnect). " occured</p>\n";
            }
        }
        return $selected;
    }


    //function to create the table
    function tablecreate($DBConnect,$tablename){
        $selected = false;
        $sql =  "SHOW TABLES LIKE '$tablename'";
        $result = mysqli_query($DBConnect,$sql);
        if(mysqli_num_rows($result) === 0){

        }
    }




    //variables
    $hostname = "localhost";
    $username = "adminer";
    $password = "doubt-drink-37";
    $DBName = "interviews";
    $tablename = "applicants";
    //Form 1
    $intvName = "";
    $position = "";
    $intvDate = "";
    //Form 2
    $firstcName = "";
    $LastName = "";
    $cAbility = "";
    $pApperance = "";
    $cSkils = "";
    $bKnowledge = "";
    $showForm = true;
    $formErrorCount = 0;

    //Main function
    function main(){
        if(isset($_POST['Submit'])){
            echo "So far so good";//debug
        }
    }
    
main();


// if ($showForm){
    ?>
    <h2>Interviewer's Info</h2>
    <form action="CandidateInterview.php" method="post">
    <p><strong>First Name: </strong><br>
    <input type="text" name="intvName" value="<?php echo $intvName; ?>"></p>
    <p><strong>Position: </strong><br>
    <input type="text" name="position" value="<?php echo $position; ?>"></p>
    <p><strong>Interview date: </strong><br>
    <input type="text" name="intvDate" value="<?php echo $intvDate; ?>"></p>
    </form>
    <hr>
    <h2>Candidate Info</h2>
    <p>When doing the communication abilities, professional apperance,or business knowledge base data input</p>
    <p>on a scale of 1-10. 1=Terrible 10=Excellent</p>
    <form action="CandidateInterview.php" method="post">
    <p><strong>First Name:</strong><br>
    <input type="text" name="firstcName" value="<?php echo $firstcName; ?>"></p>
    <p><strong>Last Name:</strong><br>
    <input type="text" name="LastName" value="<?php echo $LastName; ?>"></p>
    <p><strong>Communication Abilities:</strong><br>
    <input type="number" name="cAbility" value="<?php echo $cAbility; ?>"></p>
    <p><strong>Professional apperance:</strong><br>
    <input type="number" name="pApperance" value="<?php echo $pApperance; ?>"></p>
    <p><strong>Computer Skills:</strong><br>
    <input type="number" name="cSkils" value="<?php echo $cSkils; ?>"></p>
    <p><strong>Business Knowledge:</strong><br>
    <input type="number" name="bKnowledge" value="<?php echo $bKnowledge; ?>"></p>
    <p><strong>Comments:</strong><br></p>
    <textarea name="comment" cols="100" rows="6">
    </textarea><br>
    <p><input type="submit" name="submit" value="Submit"></p>
    </form>
    <?php
// }
    ?>
</body>
</html>