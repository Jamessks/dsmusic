<?php
/**
 * Created by PhpStorm.
 * User: Dimitris
 * Date: 19/11/2017
 * Time: 1:29 PM
 */
include 'dbfunctions.php';

if(isset($_POST['email'])){
    $email = $_POST['email'];
    $valemail = email_exists($email);
    if(sizeof($valemail) == 0){
    echo'0';
    }
}