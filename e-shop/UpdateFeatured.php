<?php

include 'dbfunctions.php';

$newprodid = $_POST['productselectedid'];
$prodidtoupdate = $_POST['rowidtoupdate'];

updateFeatured($newprodid,$prodidtoupdate);

$featured=getFeatured();
$products=getProducts();

echo'<div id="manageFeatured" class="register9">';
echo'<div class="col-sm-8 col-md-9">
            <ul class="thumbnail-list">'; ?><?php
foreach($featured as $rows){
    $theproduct=getProductInfo_by_id($rows['ProductID']);
    $theproducttitle =reset($theproduct)['title'];
    $theproductid=reset($theproduct)['id'];
    echo"<li><div class='register9'>
<h3>Swap Slot: " . $rows["SlotId"] . "<h3>";
    echo"<select id='selectionfeaturedid' class='selectionfeaturedclass' value=" . $rows['SlotId'] . " name='myselfeatured'>";
    echo"<option value='SelectFeatured'>". $theproducttitle ."</option>";
    foreach ($products as $rowsss) {
        $product=getProductInfo_by_id($rowsss['id']);
        $producttitle = reset($product)['title'];
        $productid = reset($product)['id'];
        $queryresult = Featured_Exists($productid);
        if(sizeof($queryresult) != 1){
            echo "<option value='" . $rowsss['id'] . "'>" . $rowsss['title'] . "</option>";
        }
    }
    echo"</select>";
    echo"</div></li>";
}
echo'</ul></div></div>';