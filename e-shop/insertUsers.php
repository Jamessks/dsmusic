<?php
/**
 * Created by PhpStorm.
 * User: s-ds131466
 * Date: 3/3/2016
 * Time: 6:39 PM
 */

include 'dbfunctions.php';

$username = $_POST["username"];
$password = $_POST["password"];
$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$email = $_POST["email"];
$isadmin = $_POST["isadmin"];

//echo $username . " " . $password . " " . $firstname . " " . $lastname . " " . $email;

$unamemail = username_email_exists($username,$email);
if (sizeof($unamemail) > 0){


    echo "<script>
function Redirect() {
        window.location=\"http://steiakakis.students.acg.edu/coursework/adminpanel.php\";
    }
                    document.write(\"Username/email exists.You will be redirected to main page in 5 sec.\");
                     setTimeout('Redirect()', 5000);
    }
          </script>";
}
else {
    $reguser = insertUser($firstname, $lastname, $email, $username, $password, $isadmin);

    echo "<script>
function Redirect() {
        window.location=\"http://steiakakis.students.acg.edu/coursework/adminpanel.php\";
    }
                   document.write(\"User Created.You will be redirected to main page in 5 sec.\");
                   setTimeout('Redirect()', 5000);

          </script>";
}

