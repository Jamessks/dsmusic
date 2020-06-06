<?php
/**
 * Created by PhpStorm.
 * User: Dimitris
 * Date: 24/10/2017
 * Time: 6:53 PM
 */
include 'dbfunctions.php';

if (isset($_POST["deletebtn"])) {
    $prodid = $_POST['id'];
    $myresults = find_orderID_of_cart_product_duplicates($_SESSION['id'], $prodid);
    if($myresults > 1){
        $orderID = $myresults[0]['orderID'];
    remove_orderID($orderID);
    }else
        remove_orderID_by_ProductID_and_UserID($_SESSION['id'],$prodid);

}
echo '<script>function Redirect() {
        window.location="http://steiakakis.students.acg.edu/coursework/shoppingCart.php";
    }
        setTimeout(\'Redirect()\', 0);
        </script>';

