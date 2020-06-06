<?php
include_once 'header.php';
if($_GET["id"]){
    $search = $_GET["id"];
    list($prodname) = find_prodname_by_id($_GET["id"]);
    echo "<header><h1>" . reset($prodname) . "</h1></header>";
}else {
    echo "<header><h1>No category selected. Redirecting....</h1></header>";
    echo '<script>
        function Redirect() {
        window.location="http://steiakakis.students.acg.edu/coursework/index.php";
    }
        setTimeout(\'Redirect()\', 3000);
        </script>';
    exit();
}
?>



<?php
$products = getProductsByCategory($search);
$imgdir = 'myimages/';
$counter = 0;




echo'<table class="mytable2">';
foreach($products as $rows) {
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

include_once 'footer.php';
?>