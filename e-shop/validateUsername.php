<?php
/**
 * Created by PhpStorm.
 * User: Dimitris
 * Date: 19/11/2017
 * Time: 2:03 PM
 */
include 'dbfunctions.php';

if(isset($_POST['username'])){
    $username = $_POST['username'];
    $valeusername = username_exists($username);
    if(sizeof($valeusername) == 0) {
        echo '0';
    }
}