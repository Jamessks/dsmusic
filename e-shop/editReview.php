<?php
/**
 * Created by PhpStorm.
 * User: Dimitris
 * Date: 29/10/2017
 * Time: 3:11 AM
 */
include 'dbfunctions.php';

$reviewid = $_POST['reviewid'];
$reviewstring = $_POST['review'];
$prodid = $_POST['myprodid2'];


$_SESSION["tempproduct"] = $prodid;

$arraysize = verify_review_user($reviewid,$prodid,$_SESSION['id']);

if(sizeof($arraysize) == 1) {
    echo'Correct';
    updateReview($reviewstring,$reviewid);
}else{
    echo 'Error';
}
