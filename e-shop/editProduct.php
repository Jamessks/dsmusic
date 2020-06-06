<?php
ini_set('display_errors','off');
session_start();
if (empty($_SESSION['admin'])){
    header('Location: http://steiakakis.students.acg.edu/coursework/index.php');
    exit();
}
include 'dbfunctions.php';

if (isset ($_POST["editbtn"])) {

    $prodid = $_POST['id'];
    $prodtitle = $_POST['title'];
    $proddesc = $_POST['description'];
    $prodprice = $_POST['price'];


?>

<form name='updateProductInfo' method='POST'>

    <input type="hidden" value="<?php echo $prodid ?> " name="prodid"/>
    <label for="prodtitle">Product Title</label>
    <input type="text" id="prodtitle" name="prodtitle" value="<?php echo $prodtitle ?>"/>
    <br/>

    <label for="proddesc">Product Description</label>
    <input type="text" id="proddesc" name="proddesc" value="<?php echo $proddesc ?>"/>
    <br/>

    <label for="prodprice">Product Price</label>
    <input type="text" id="prodprice" name="prodprice" value="<?php echo $prodprice ?>"/>
    <br/>

    <input type="submit" name="updateProductbtn" value="Update">
    <input type="submit" name="Cancelbtn" value="Cancel">
</form>

<?php }

if (isset ($_POST["updateProductbtn"])) {
    $prodid = $_POST['prodid'];
    $prodtitle = $_POST['prodtitle'];
    $proddesc = $_POST['proddesc'];
    $prodprice = $_POST['prodprice'];

    echo updateProduct($prodprice, $prodtitle, $proddesc,$prodid);

    echo '<script>
        function Redirect() {
        window.location="http://steiakakis.students.acg.edu/coursework/adminpanel.php";
    }
        setTimeout(\'Redirect()\', 0);
        </script>';
    ?>

    <?php
}
if (isset ($_POST["Cancelbtn"])){
    $_SESSION["Cancel"] = 1;
    echo '<script>
        function Redirect() {
        window.location="http://steiakakis.students.acg.edu/coursework/adminpanel.php";
    }
        setTimeout(\'Redirect()\', 0);
        </script>';

}
?>