<?session_start();
    //password_protect.php Provided by Zubrag.com
    if($_SESSION['login']!="true") {
        include("password_protect.php");
    } 
    $_SESSION['login']="true";
?>
<html>
    <head>
        <title>Golden Rod</title>
        <link rel="stylesheet" href="../css/styles.css" />
        <?
        include("../login/php/constants.php");  
         ?>
    </head>


    <?
    //php functions
    /*database import--Credit for dbimport given to Raj@
   http://stackoverflow.com/questions/19751354/how-to-import-sql-file-in-mysql-database-using-php
   */
    function dbimport ($DB_SERVER, $DB_USER, $DB_PASS, $DB_NAME) {
        // Name of the file
        $filename = 'file.sql';
        // MySQL host
        $mysql_host = $DB_SERVER;
        // MySQL username
        $mysql_username = $DB_USER;
        // MySQL password
        $mysql_password = $DB_PASS;
        // Database name
        $mysql_database = $DB_NAME;

        // Connect to MySQL server
        $link=mysql_connect($mysql_host, $mysql_username, $mysql_password) or die('Error connecting to MySQL server: ' . mysql_error());
        // Select database
        mysql_select_db($mysql_database) or die('Error selecting MySQL database: ' . mysql_error());

        // Temporary variable, used to store current query
        $templine = '';
        // Read in entire file
        $lines = file($filename);
        // Loop through each line
        foreach ($lines as $line)
        {
            // Skip it if it's a comment
            if (substr($line, 0, 2) == '--' || $line == '')
            continue;

            // Add this line to the current segment
            $templine .= $line;
            // If it has a semicolon at the end, it's the end of the query
            if (substr(trim($line), -1, 1) == ';')
                {
                    // Perform the query
                    mysql_query($templine) or print('Error performing query \'<strong>' . $templine . '\': ' . mysql_error() . '<br /><br />');
                    // Reset temp variable to empty
                    $templine = '';
                }
            }
        echo "<script> alert('Proccess Was Successful'); </script>";
        mysql_close($link);
    }
    
    
    
    
    
    

//php actions main
//student sync
    if (isset($_POST['sync'])) {
        //Clear database for import
        $cond=new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
        $query=$cond->query("DROP TABLE IF EXISTS student_book,users,admin,Teacher");
        mysqli_kill($cond, mysqli_thread_id($cond));
        mysqli_close($cond);
        
        
        //for this proccess to work completely you have to change database firt
        //import database structure********************************************************************************************************************
        dbimport(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
        
        
        
        
        
        
        
        
        
        
        
        //clear database for sync********************************************************************************************************************************************
        $conc=new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
        $query=$conc->query("TRUNCATE student_book");
        mysqli_kill($conc, mysqli_thread_id($conc));
        mysqli_close($conc);
        
        $cond=new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
        $query=$cond->query("TRUNCATE users");
        mysqli_kill($cond, mysqli_thread_id($cond));
        mysqli_close($cond);
        
        

        
        
        //Sync students********************************************************************************************************************************************
        $con=new mysqli($_POST['DB_SERVER1'], $_POST['DB_USER1'], $_POST['DB_PASS1'], $_POST['DB_NAME1']);
        
        // Check connection
        if (mysqli_connect_errno($con))
        {
            echo '<script>
            alert("Error connecting to MySQL server. '.mysqli_connect_error().'");
            </script> ';
            exit();
        }
    
    
        //Run 
        $mysqli_query="SELECT ".$_POST['fname'].",".$_POST['lname'].",".$_POST['ename'].",".$_POST['st_id_name'].",".$_POST['gname']." FROM ". $_POST['table'];
        $query=$con->query($mysqli_query);
        if(!$query) {
            echo '<script> alert("Error finding tables and fields. Did you enter them in incorrectly? Try again.");
            </script>';
            exit();
        }
        
        while($row=$query->fetch_assoc()){
            $flname=$row[$_POST['fname']]." ".$row[$_POST['lname']];
            $email=$row[$_POST['ename']];
            $st_id=$row[$_POST['st_id_name']];
            $grade=$row[$_POST['gname']];
            $conb=new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
            $queryb=$conb->query("INSERT INTO users(email, flname, st_id, Grader) VALUES ('$email','$flname','$st_id','$grade')");
            mysqli_kill($conb, mysqli_thread_id($conb));
            mysqli_close($conb);    
        }
        mysqli_kill($con, mysqli_thread_id($con));
        mysqli_close($con);
        echo "<script> alert('Sync was successful!'); </script>"; 
    
    
    }
    ?>
    
 <?   
    
    
    //teacher sync    
    if(isset($_POST['tsync'])) {
        
        //clear database for sync********************************************************************************************************************************************
        $con=new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
        $query=$con->query("TRUNCATE Teacher");
        mysqli_kill($con, mysqli_thread_id($con));
        mysqli_close($con);
        
        
        
        
        
        
        
        //Sync teachers********************************************************************************************************************************************
        $conb=new mysqli($_POST['DB_SERVER2'], $_POST['DB_USER2'], $_POST['DB_PASS2'], $_POST['DB_NAME2']);
        
        // Check connection
        if (mysqli_connect_errno($conb))
        {
            echo '<script>
            alert("Error connecting to MySQL server. '.mysqli_connect_error().'");
            </script> ';
            exit();
        }
    
    
        //Run 
        $mysqli_query="SELECT ".$_POST['tfname'].",".$_POST['tlname']." FROM ". $_POST['ttable'];
        $queryb=$conb->query($mysqli_query);
        if(!$queryb) {
            echo '<script> alert("Error finding tables and fields. Did you enter them in incorrectly? Try again.");
            </script>';
            exit();
        }
        
        while($rowb=$queryb->fetch_assoc()){
            $tflname=$rowb[$_POST['tlname']].",".$rowb[$_POST['tfname']];
            $cone=new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
            $querye=$cone->query("INSERT INTO Teacher(teachername) VALUES ('$tflname')");
            mysqli_kill($cone, mysqli_thread_id($cone));
            mysqli_close($cone);    
        }
        mysqli_kill($conb, mysqli_thread_id($conb));
        mysqli_close($conb);
        echo "<script> alert('Sync was successful!'); </script>";
    }
?>
    
    
    
<!--Visual Appearance--> <!--HTML-->
    <body>
    <br>
    <h1> Data Transfer Page</h1>
    <br>

    <br>
        
        
    <!--Student Sync-->    
    <form action="sync2394921.php" class="formatted" method="post">
        <fieldset>
            <legend>Specify other Database to Sync From for Students:</legend>
            <span style="font-weight:bold;"> Server: &nbsp; </span>
            <input type="text"  class="text-input" name="DB_SERVER1"/>
             <br>
            <span style="font-weight:bold;"> Username: &nbsp; </span>
            <input type="text"  class="text-input" name="DB_USER1"/>
            <br>
            <span style="font-weight:bold;"> Password: &nbsp; </span>
            <input type="password" class="text-input" name="DB_PASS1"/>
            <br>
            <span style="font-weight:bold;"> Database Name: &nbsp; </span>
            <input type="text" class="text-input" name="DB_NAME1"/>    
            <br>
        </fieldset>
        <fieldset>
            <legend> Information about Specific Table(s) and Columns for Students</legend>
            <br>
            <br>
            <span style="font-weight:bold;"> Table Name: &nbsp; </span>
            <input type="text" class="text-input" name="table"/>    
            <br>
            <br>
            
            <div style="margin-left:10%;">
                <br>
                <span style="font-weight:bold;"> First Name Column: &nbsp; </span>
                <input type="text" class="text-input" name="fname"/>    
                <br>
                <span style="font-weight:bold;"> Last Name Column: &nbsp; </span>
                <input type="text" class="text-input" name="lname"/>    
                <br>
                <span style="font-weight:bold;"> Email Column: &nbsp; </span>
                <input type="text" class="text-input" name="ename"/>    
                <br>
                <span style="font-weight:bold;"> Student ID Column: &nbsp; </span>
                <input type="text" class="text-input" name="st_id_name"/>    
                <br>
                <span style="font-weight:bold;"> Grade: &nbsp; </span>
                <input type="text" class="text-input" name="gname"/>    
                <br>
            </div>
            <br>
            <input type="submit"  name="sync" class="button" value="Sync" />
        </fieldset>
    </form>
    
    
    
    
    
    
    
    
    
    <!--Teacher Sync-->    
      <form action="sync2394921.php" class="formatted" method="post">
        <fieldset>
            <legend>Specify other Database to Sync From for Teachers:</legend>
            <span style="font-weight:bold;"> Server: &nbsp; </span>
            <input type="text"  class="text-input" name="DB_SERVER2"/>
             <br>
            <span style="font-weight:bold;"> Username: &nbsp; </span>
            <input type="text"  class="text-input" name="DB_USER2"/>
            <br>
            <span style="font-weight:bold;"> Password: &nbsp; </span>
            <input type="password" class="text-input" name="DB_PASS2"/>
            <br>
            <span style="font-weight:bold;"> Database Name: &nbsp; </span>
            <input type="text" class="text-input" name="DB_NAME2"/>    
            <br>
        </fieldset>
        <fieldset>
            <legend> Information about Specific Table(s) and Columns for Teachers</legend>          
            <br>
            <br>
            <span style="font-weight:bold;"> Teacher Table Name: &nbsp; </span>
            <input type="text" class="text-input" name="ttable"/>    
            <br>
            <br>
            
            <div style="margin-left:10%;">
                <br>
                <span style="font-weight:bold;"> First Name Column: &nbsp; </span>
                <input type="text" class="text-input" name="tfname"/>    
                <br>
                <span style="font-weight:bold;"> Last Name Column: &nbsp; </span>
                <input type="text" class="text-input" name="tlname"/>    
                <br>
            </div>
            <br>
            <input type="submit"  name="tsync" class="button" value="Sync" />
        </fieldset>
    </form>
    
    
    
    
    
    
    
    
    </body>
</html>
