<?php
/**
 * Created by PhpStorm.
 * User: s-ds131466
 * Date: 3/3/2016
 * Time: 6:39 PM
 */

include 'dbfunctions.php';
$successful = 1;
$username = $_POST["username"];
$password = $_POST["password"];
$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$email = $_POST["email"];

if (!preg_match("/^[a-zA-Z 0-9]*$/",$username)) {
    $usernameerror = 1;
    $successful = 0;
    $_SESSION['usernameerror'] = $usernameerror;
}
if (!preg_match("/^[a-zA-Z ]*$/",$firstname)) {
    $firstnameerror = 1;
    $successful = 0;
    $_SESSION['firstnameerror'] = $firstnameerror;
}
if (!preg_match("/^[a-zA-Z ]*$/",$lastname)) {
    $lastnameerror = 1;
    $successful = 0;
    $_SESSION['lastnameerror'] = $lastnameerror;
}

//echo $username . " " . $password . " " . $firstname . " " . $lastname . " " . $email;

$unamemail = username_email_exists($username,$email);
if (sizeof($unamemail) > 0){
    $successful = 0;
    $errorlogging = 1;
    $_SESSION['logerror'] = $errorlogging;
}
if($successful == 1) {
    $reguser = registerUser($firstname, $lastname, $email, $username, $password);
    $createsuccess = 1;
    $_SESSION['success'] = $createsuccess;
    header('Location: http://steiakakis.students.acg.edu/coursework/logregpage.php');
}else{
    $_SESSION['failfirstname'] = $firstname;
    $_SESSION['faillastname'] = $lastname;
    $_SESSION['failusername'] = $username;
    $_SESSION['failemail'] = $email;
    header('Location: http://steiakakis.students.acg.edu/coursework/regform.php');
}

