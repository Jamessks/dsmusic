<?php include_once 'header.php';

 if($_GET["search"]){
     $search = $_GET["search"];
    echo "<header><h1>" . $search . "</h1></header>";
}else
    echo "<header><h1>Our Products</h1></header>";



$product=searchProduct($search);
$imgdir = 'myimages/';


$counter = 0;




echo'<table class="mytable2">';
foreach($product as $rows) {
    list($rating) = find_rating_avg_of_product($rows['id']);
    if($counter == 4){
        $counter = 0;
        echo"<tr><td class='mything'>";
    }else{
        echo"<td class='mything'>";
    }
    echo"<div class='register8'><a href='singleproduct.php?id=".$rows["id"]."' class=''><img class='pimgs' src=".$imgdir.$rows['image']."></a>
         <h4 class='pheaders'>".$rows['title']."</h4>
         <div class='product-price'>
         <span class='normal-price'>".$rows["price"]."€</span>
         </div>
         <h4 class='pheaders'>Rating: ".(int)reset($rating)."/5</h4>
         <a href='singleproduct.php?id=". $rows['id']."' class='btn btn-primary' role='button'>View Details</a></div>";?>
    <?php if($counter == 4){
        $counter = 0;
        echo"</td></tr>";
    }else{
        echo"</td>";
    }
    $counter++;
}
//<button type='button' class='btn btn-default navbar-btn'>View Details</button>
echo'</table>';



