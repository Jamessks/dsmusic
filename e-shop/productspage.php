<?php
list($myviewproduct) = getTop_ViewProduct();
$mostviewedvar = reset($myviewproduct);
$mostv = getProductInfo_by_id($mostviewedvar);
list($myboughtproduct) = getTop_BoughtProduct();
$mostboughtvar = reset($myboughtproduct);
$mostb = getProductInfo_by_id($mostboughtvar);
list($viewrating) = find_rating_avg_of_product($mostviewedvar);
list($boughtrating) = find_rating_avg_of_product($mostboughtvar);
$featured = getFeatured();
?>
<div class="container">
    <div class="register2">
    <div class="row">
        <div class="register3"><h2 class="mytext">Featured products</h2></div>
        <div class="col-sm-4 col-md-3">
            <div id="panel" class="">
                <div class="well">
                    <h2 class="mytext">Most Viewed</h2>
                    <div class="register10">
                        <?php foreach($mostv as $myvars){
                         ?>
                        <a href="#" class=""><img class="frontpimgs" src="myimages/<?php echo $myvars['image']; ?>" ></a>
                        <h4 class="pheaders"><?php echo $myvars['title'] ?></h4>
                        <div class="product-price">
                            <span class="normal-price"><?php echo $myvars['price'] ?>€</span>
                        </div>
                        <h4 class='pheaders'>Rating: <?php echo (int)reset($viewrating)?>/5</h4>
                        <a href="singleproduct.php?id=<?php echo $myvars['id'] ?>" class="btn btn-primary" role="button">View Details</a>
                    </div><?php } ?>
                    <br>
                    <h2 class="mytext">Most bought</h2>
                    <div class="register10">
                    <?php foreach($mostb as $myvars2){
                    ?>
                    <a href="#" class=""><img class="frontpimgs" src="myimages/<?php echo $myvars2['image']; ?>" ></a>
                    <h4 class="pheaders"><?php echo $myvars2['title'] ?></h4>
                    <div class="product-price">
                        <span class="normal-price"><?php echo $myvars2['price'] ?>€</span>
                    </div>
                        <h4 class='pheaders'>Rating: <?php echo (int)reset($boughtrating)?>/5</h4>
                    <a href="singleproduct.php?id=<?php echo $myvars2['id'] ?>" class="btn btn-primary" role="button">View Details</a>
                </div><?php } ?>
                </div>

            </div>
        </div>
        <div class="col-sm-8 col-md-9">
            <ul class="thumbnail-list">
            <?php foreach ($featured as $rows){
                $theproduct=getProductInfo_by_id($rows['id']);
                $theproducttitle =reset($theproduct)['title'];
                $theproductid=reset($theproduct)['id'];
                $theproductprice=reset($theproduct)['price'];
                $theproductimage=reset($theproduct)['image'];
                list($theproductrating)= find_rating_avg_of_product($theproductid);
                ?><?php
                echo'<li class="register11"> <a href="singleproduct.php?id='.$theproductid.'" class=""><img class="pimgs" src="myimages/'.$theproductimage.'" ></a>
                    <h4 class="pheaders">'.$theproducttitle.'</h4>
                    <div class="product-price">
                        <span class="normal-price">'.$theproductprice.'€</span>
                        <h4 class="pheaders">Rating: '.(int)reset($theproductrating).'/5</h4>
                    </div>
                    <a href="singleproduct.php?id='.$theproductid.'" class="btn btn-primary" role="button">View Details</a>
                </li>'; ?>
                <?php } ?>
            </ul>
        </div>
    </div>
        </div>
</div>




