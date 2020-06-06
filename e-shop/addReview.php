<?php
/**
 * Created by PhpStorm.
 * User: Dimitris
 * Date: 26/10/2017
 * Time: 2:19 AM
 */
include 'dbfunctions.php';

$userid = $_POST['myuserid2'];
$prodid = $_POST['myprodid2'];
$review = $_POST['myreview2'];
$userfname = $_POST['myusername2'];

$_SESSION["tempproduct"] = $prodid;
addReview($userid, $prodid, $review,$userfname);
?>




