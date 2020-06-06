<?php
/**
 * Created by PhpStorm.
 * User: s-ds131466
 * Date: 3/3/2016
 * Time: 6:39 PM
 */

include 'dbfunctions.php';



$userid = $_POST['myuserid'];
$prodid = $_POST["myprodid"];

echo $userid;
echo $prodid;

addCart($userid,$prodid);