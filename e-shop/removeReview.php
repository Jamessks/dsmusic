<?php
include 'dbfunctions.php';


$prodid = $_POST['myprodid2'];
$review = $_POST['reviewid'];

$_SESSION["tempproduct"] = $prodid;

$arraysize = verify_review_user($review,$prodid,$_SESSION['id']);

if(sizeof($arraysize) == 1) {
    echo'Correct';
    delete_review($review);
}else{
    echo 'Error';
}
?>