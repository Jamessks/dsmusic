<?php
include_once 'header.php';
/**
 * Created by PhpStorm.
 * User: Dimitris
 * Date: 24/10/2017
 * Time: 2:10 AM
 */
$cartproducts = getProductInfo_from_CartUserID($_SESSION['id']);
echo '<div class="jumbotron">
<h1>Shopping Cart</h1>';
echo '</div>';
$cartprice = 0;

if($cartproducts == null) {
    echo '<div class="jumbotron">
<h1>Your shopping cart is empty.</h1>';
}

else {

    echo '<div class="register7"><table id="manageCartTable" class="admin_table" border="1">';
    echo "<tr><th hidden>ID</th><th>TITLE</th><th>IMAGE</th><th>DESCRIPTION</th><th>PRICE</th><th colspan=\"2\">DELETE</th></tr>";
    foreach ($cartproducts as $rows) {
        echo "<tr>";
        echo
            "<td hidden>" . $rows["id"] . "</td>" .
            "<td>" . $rows["title"] . "</td>" .
            "<td>" . "<img src=myimages/" . $rows["image"] . ' width="100px"/>' . "</td>" .
            "<td>" . $rows["description"] . "</td>" .
            "<td>" . $rows["price"] . "€</td>" .
            '<td>' .
            '<form name="removecartprodform" action="removeCart.php" method="POST">' .
            '<input type="hidden" value="' . $rows["id"] . '" name="id"/>' .
            '<input type="submit" value ="Delete" name="deletebtn"/> </form>';
            $cartprice += $rows["price"];

        echo "</tr>";
    }

    echo "</table></div>";

    echo"<div id='manageRatings'  class='register9'>
    <div class='register9'>
    <h3>Choose payment method:<h3>";
    echo"<select id='selectionpaymentid' class='selectionpaymentclass' name='myselection'>";
    echo"<option value='Select'>Select</option>";
    echo"<option value='Visa'>Visa</option>";
    echo"<option value='MasterCard'>MasterCard</option>";
    echo"<option value='PaySafe'>PaySafe</option>";
    echo"<option value='PayPal'>PayPal</option>";
    echo"</select>";
    echo"</div></div>";

    echo '<div class="jumbotron">
        <h2>Total cart price is: ' . $cartprice .'€ <h2>
        <form name="checkoutform" action="Checkout.php" method="POST">
        <button id="checkoutbtn" class="btn btn-info">Checkout</button>
        </form>
        </div>';


}


include_once 'footer.php';
?>