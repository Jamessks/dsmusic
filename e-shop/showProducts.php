<?php
/**
 * Created by PhpStorm.
 * User: s-ad169880
 * Date: 3/3/2016
 * Time: 5:13 PM
 */

include 'dbfunctions.php';
include 'header.php';




$product=getProducts();
$imgdir = 'myimages/';

echo'<div class="col-sm-8 col-md-9">';
echo'<ul class="thumbnail-list">';
            foreach($product as $rows) {
   echo"
       <li> <a href='dgdfgds' class=''><img class='pimgs' src=".$imgdir.$rows['image']."></a>

                    <h4 class='pheaders'>".$rows['title']."</h4>
                    <div class='product-price'> <span class='cut-price'>MYR290.00</span>
                        <span class='normal-price'>".$rows["price"]."€</span>

                    </div>
                    <button type='button' class='btn btn-default navbar-btn'>Add to Cart</button>
                </li>";
            }

echo'</div>';
echo'</ul>';

?>