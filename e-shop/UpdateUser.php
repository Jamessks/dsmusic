<?php
/**
 * Created by PhpStorm.
 * User: Dimitris
 * Date: 19/11/2017
 * Time: 5:50 PM
 */
include 'dbfunctions.php';
$userid = $_SESSION['id'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$username = $_POST['username'];

updateUser($username,$firstname,$lastname,$email,$userid);

header('Location: http://steiakakis.students.acg.edu/coursework/profile.php');

$_SESSION['first'] = $firstname;
$_SESSION['updatesuccess'] = 1;
