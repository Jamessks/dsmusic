<?php
include 'dbfunctions.php';
if(!isset($_SESSION['first']))
    header('Location: http://steiakakis.students.acg.edu/coursework');

if(isset($_GET['product'], $_GET['rating'])){

    $product = (int)$_GET['product'];
    $rating = (int)$_GET['rating'];

    if(in_array($rating, [1, 2 ,3 ,4 ,5])){

        $exists = rating_exists($rating);
        if(!(empty($exists)));{
            accept_rating($product,$rating,$_SESSION['id']);
        }
    }
    header('Location: singleproduct.php?id='. $product);
}