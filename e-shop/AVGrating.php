<?php
/**
 * Created by PhpStorm.
 * User: Dimitris
 * Date: 16/11/2017
 * Time: 11:14 PM
 */
include 'dbfunctions.php';

$productid = $_POST['productid'];

list($rating) = find_rating_avg_of_product($productid);
$intrating = reset($rating);

echo (int)$intrating;
