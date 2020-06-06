<?php
include_once 'header.php';

$product_id = $_GET['id'];
if(!(isset($product_id))){
    echo "<header><h1>Product not found. Redirecting....</h1></header>";
    echo '<script>
        function Redirect() {
        window.location="http://steiakakis.students.acg.edu/coursework";
    }
        setTimeout(\'Redirect()\', 3000);
        </script>';
    exit();
}
list($prodinfo) = get_prod_info_from_id($product_id);

$userbought = deliveries_find_product_and_userid($product_id,$_SESSION['id']);
$prodprice = current($prodinfo);
$prodtitle = next($prodinfo);
$prodimgurl= next($prodinfo);
$proddesc = next($prodinfo);
$imgdir = 'myimages/';
$viewcount = 1;
//reset($prodinfo);

list($average) = find_rating_avg_of_product($product_id);
$printaverage = current($average);
//reset($average);

$founduser = find_product_and_userid($product_id,$_SESSION['id']);
if(sizeof($founduser) > 0){
    $userexists=true;
}else{
    $userexists=false;
}

$productexists = productViewReport_exists($product_id);
if(sizeof($productexists) == 0){
    add_ProductViewCount($product_id,$viewcount);
}
else{
    update_ViewCount($product_id);
}
list($usernamebyid) = getUsernameByid($_SESSION['id']);
$allreviews = getReviews_ofProduct($product_id);
$votes = get_number_votes($product_id);

?>

<?php if(isset($_SESSION['id'])){ ?>
    <script>var productid =' <?php echo $product_id;?>'; var userid = '<?php echo $_SESSION['id'];?>'; var userfirst = '<?php echo $_SESSION['first'];?>'; var username = '<?php echo reset($usernamebyid);?>'</script>";
<?php } ?>
<?php
echo'
<div class="register4">
<div class="container-fluid">
    <div class="content-wrapper">
		<div class="item-container">
			<div class="container">
				<div class="col-md-12">
					<div class="product col-md-3 service-image-left">

						<center>
							<img id="item-display" src="'. $imgdir . $prodimgurl.'" alt="'.$prodtitle.'">
						</center>
					</div>

					<div class="container service1-items col-sm-2 col-md-2 pull-left">
						<center>
							<a id="item-1" class="service1-item">
								<img src="'. $imgdir . $prodimgurl.'" alt="'.$prodtitle.'">
							</a>
							<a id="item-2" class="service1-item">
								<img src="'. $imgdir . $prodimgurl.'" alt="'.$prodtitle.'">
							</a>
							<a id="item-3" class="service1-item">
								<img src="'. $imgdir . $prodimgurl.'" alt="'.$prodtitle.'">
							</a>
						</center>
					</div>
				</div>

				<div class="col-md-7">
					<div class="product-title">'. $prodtitle .'</div>
					<div class="product-desc">'. $proddesc .'</div>
					<br>
					<div class="product-rating">Rating: '.round($printaverage).'/5</div>
                    <div class="product-rating">Total Votes: '.sizeof($votes).'</div>
					';?><?php if(!isset($_SESSION['id'])) {
    echo '<div class="product-rate">You need to be logged in to vote.Click
                    <a href="http://steiakakis.students.acg.edu/coursework/logregpage.php">here</a>.</div>';
}else if(isset($_SESSION['id']) && sizeof($userbought) < 1){
    echo '<div class="product-rate">You have not bought the item to rate it yet</div>';
}else if($userexists && isset($_SESSION['first'])){
    echo'<div class="product-rate">Thank you for your vote!</div>';
    ?><?php }else{echo'
					<div class="product-rate">
					Rate this product:';?>

    <?php foreach(range(1, 5) as $rating): ?>
        <?php echo'<a href="rate.php?product='.$product_id .'&rating='.$rating.'">'.$rating.'</a>'; ?>
    <?php endforeach; ?>

    <?php echo'
					</div> '; } echo'
					<br>
					<div class="product-price">'. $prodprice .'€</div>
					<hr>
					<div class="btn-group cart">'; ?><?php if(!isset($_SESSION['id'])) {
    echo '<div class="product-rate">You need to be logged in to Add this to your cart.Click
                    <a href="http://steiakakis.students.acg.edu/coursework/logregpage.php">here</a>.</div>';
}else{
    echo'<button type="button" id="mybutton" class="btn btn-success" >
							Add to cart
						</button>'; ?>
<?php } echo '</div>

				</div>
			</div>
		</div>
		<div class="container-fluid" >
			<div class="col-md-12 product-info">
					<ul id="myTab" class="nav nav-tabs nav_tabs">

						<li class="active"><a href="#service-one" data-toggle="tab">DESCRIPTION</a></li>
						<li><a href="#service-two" data-toggle="tab">PRODUCT INFO</a></li>
						<li><a href="#service-three" data-toggle="tab">REVIEWS</a></li>

					</ul>
				<div id="myTabContent" class="tab-content">
						<div class="tab-pane fade in active" id="service-one">

							<section class="container product-info">


                        <h2>To be added...</h2>
							</section>

						</div>
					<div class="tab-pane fade" id="service-two">

                    <h2>To be added...</h2>


						</section>

					</div>'; ?>
    <div class="tab-pane fade" id="service-three">
        <?php if(!isset($_SESSION['id'])){
            echo'<div class="product-rate">You need to be logged in to Review this item.Click
                            <a href="http://steiakakis.students.acg.edu/coursework/logregpage.php">here</a>.</div>';
            foreach($allreviews as $pars){  $ratingarray = get_user_rating($pars['userID'],$product_id);
                if(sizeof($ratingarray) == 1){
                    $rating = $ratingarray[0]['rating'] . '/5';
                }else{ $rating = "Not Rated";}
                echo'<div id="mybox" class="box" data-myid=' . $pars['id'] . '>
                        <div id="reviewbox" class="box-inner">
                        <h2 id="reviewheading">'. $pars['firstname']  . ' says:</h2>
                        <p id="reviewpar" class="hellopar" value=' . $pars['id'] . '>'. $pars['review'] .'</p>
                        <h4 class="ratingdiv">(Rating: '.$rating.')</h4>
                    </div>
                    </div>';}
            if(sizeof($allreviews) < 1){echo '
                    <div id="reviewboxnothing" class="box">
                        <div class="box-inner">
                        <h2 id="reviewheading">No reviews for this product yet</h2>
                        </div>
                    </div>';}
        }else if(sizeof($userbought) < 1){
            echo '<div class="product-rate">You have not bought the item to rate it yet</div>';
            if(sizeof($allreviews) < 1){echo '<div id="reviewboxnothing" class="box">
                            <div class="box-inner">
                                <h2 id="reviewheading">No reviews for this product yet</h2>
                            </div>
                        </div>';}
            else{foreach($allreviews as $pars){
                $ratingarray = get_user_rating($pars['userID'],$product_id);
                if(sizeof($ratingarray) == 1){
                    $rating = $ratingarray[0]['rating'] . '/5';
                }else{ $rating = "Not Rated";}
                echo'
    <div id="mybox" class="box" data-myid=' . $pars['id'] . '>
        <div id="reviewbox" class="box-inner">
            <h2 id="reviewheading">'. $pars['firstname']  . ' says:</h2>
            <p id="reviewpar" class="hellopar" value=' . $pars['id'] . '>'. $pars['review'] .'</p>
            <h4 class="ratingdiv">(Rating: '.$rating.')</h4>
        </div>
        </div>';}}}else{ ?>
            <textarea id="comment" name="comment" style="width: 499px; height: 108px; resize: none;"></textarea>
            <button id ="submit">Submit</button>
            <?php
            if(sizeof($allreviews) < 1){
                ?>
                <div id="reviewboxnothing" class="box">
                    <div class="box-inner">
                        <h2 id="reviewheading">No reviews for this product yet</h2>
                    </div>
                </div>

            <?php } else{ foreach($allreviews as $pars){
                $ratingarray = get_user_rating($pars['userID'],$product_id);
                if(sizeof($ratingarray) == 1){
                    $rating = $ratingarray[0]['rating'] . '/5';
                }else{ $rating = "Not Rated";}
                echo'
    <div id="mybox" class="box" data-myid=' . $pars['id'] . '>
        <div id="reviewbox" class="box-inner">
            <h2 id="reviewheading">'. $pars['firstname']  . ' says:</h2>
            <p id="reviewpar" class="hellopar" value=' . $pars['id'] . '>'. $pars['review'] .'</p>
            <h4 class="ratingdiv">(Rating: '.$rating.')</h4>
        </div>
        </div>';
                if($_SESSION['id'] == $pars['userID']){ echo'
        <div id="reviewbuttons" class="myreviewbuttons" data-myid=' . $pars['id'] . '>
            <button id="delbutton" class="helloreview1" value=' . $pars['id'].'>Delete</button>
            <button id="editbutton" class="helloreview2" value=' . $pars['id'].'>Edit</button>
            </div>';?><?php } ?><?php echo'';}}}?></div>
<?php echo'
                   </div>
				</div>
				<hr>
			</div>
		</div>
	</div>
</div></div>';

include_once 'footer.php';