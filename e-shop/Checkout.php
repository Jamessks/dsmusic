<?php
/**
 * Created by PhpStorm.
 * User: Dimitris
 * Date: 25/10/2017
 * Time: 1:05 AM
 */
include 'dbfunctions.php';

$cartproducts = getProductInfo_from_CartUserID($_SESSION['id']);
$cartproducts2 = getProductInfo_from_CartUserID($_SESSION['id']);
$boughtcount = 1;

foreach($cartproducts as $rows){
    insert_delivery($_SESSION['id'],$rows["id"]);
    $productinfo = get_prod_info_from_id($rows['id']);
    $prodimage = $productinfo[0]['image'];
    $prodtitle = $productinfo[0]['title'];
    $prodprice = $productinfo[0]['price'];
    insert_history($_SESSION['id'],$prodtitle,$prodimage,$prodprice);
    if(sizeof($cartproducts) <= 1){
    remove_orderID_by_ProductID_and_UserID($_SESSION['id'], $rows['id']);
    }else{
        remove_orderID_by_ProductID_and_UserID($_SESSION['id'],$rows['id']);


    }
}
foreach($cartproducts2 as $rowss){
    $productexists = productBoughtReport_exists($rowss["id"]);
    if(sizeof($productexists) == 0){
        add_ProductBoughtCount($rowss["id"],$boughtcount);
    }
    else{
        update_BoughtCount($rowss["id"]);
    }
}

echo '<script>function Redirect() {
        window.location="http://steiakakis.students.acg.edu/coursework/shoppingCart.php";
    }
        setTimeout(\'Redirect()\', 0);
        </script>';

