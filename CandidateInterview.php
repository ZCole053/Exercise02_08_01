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
            echo "<p>Could not select database, attempting to create database now.</p>\n";
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
            echo "<p>The table does not exist, attempting to create table now.</p>\n";
            $sql = "CREATE TABLE $tablename(countID SMALLINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
              interviewername VARCHAR(40), position VARCHAR(40), interviewDate SMALLINT, cFirstName SMALLINT,
               lastName SMALLINT, cAbility SMALLINT, proApperance SMALLINT , skills SMALLINT, 
               bisKnowledge SMALLINT, comments VARCHAR(40))";
               $result = mysqli_query($DBConnect,$sql);
               if($result === false){
                $selected = false;
                echo "<p>Unable to create the table $tablename.</p>";
               }
        }else{
            $selected = true;
        }
        return $selected;
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
    $comments = "";
    $showForm = true;
    $formErrorCount = 0;

    //Main Code Block
        if(isset($_POST['submit'])){
            //cleaning input
            $intvName = stripslashes($_POST['intvName']);
            $intvName = trim($intvName);//end of input1
            $position = stripslashes($_POST['position']);
            $position = trim($position);//end of input2
            $intvDate = stripslashes($_POST['intvDate']);
            $intvDate = trim($intvDate);//end of input3
            $firstcName = stripslashes($_POST['firstcName']);
            $firstcName = trim($firstcName);//end of input4
            $LastName = stripslashes($_POST['LastName']);
            $LastName = trim($LastName);//end of input5
            $cAbility = stripslashes($_POST['cAbility']);
            $cAbility = trim($cAbility);//end of input6
            $pApperance = stripslashes($_POST['pApperance']);
            $pApperance = trim($pApperance);//end of input7
            $cSkils = stripslashes($_POST['cSkils']);
            $cSkils = trim($cSkils);//end of input8
            $bKnowledge = stripslashes($_POST['bKnowledge']);
            $bKnowledge = trim($bKnowledge);//end of input9
            if(empty($intvName) || empty($position) || empty($intvDate) || empty($firstcName) ||
            empty($LastName) || empty($cAbility) || empty($pApperance) || empty($cSkils) ||
            empty($bKnowledge)){
                echo "<p>Please fill out all fields.</p>";
                ++$formErrorCount;
            }if($formErrorCount == 0){
                $DBConnect = connectDB($hostname,$username,$password);
                if($DBConnect){
                    if(selectDB($DBConnect,$DBName)){
                        if(tablecreate($DBConnect,$DBName)){
                            echo "Everything is working right";
                        }
                    }
                    mysqli_close($DBConnect);
                }
            }
        }
    


// if ($showForm){
    ?>
    <h2>Interviewer's Info</h2>
    <form action="CandidateInterview.php" method="post">
    <p><strong>First Name: </strong><br>
    <input type="text" name="intvName" value="<?php echo $intvName; ?>"></p>
    <p><strong>Position: </strong><br>
    <input type="text" name="position" value="<?php echo $position; ?>"></p>
    <p><strong>Interview date: </strong><br>
    <input type="number" name="intvDate" value="<?php echo $intvDate; ?>"></p>
    <hr>
    <h2>Candidate Info</h2>
    <p>When doing the communication abilities, professional apperance, computer skills, or business knowledge base data input</p>
    <p>on a scale of 1-10. 1=Terrible 10=Excellent</p>
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