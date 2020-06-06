<?php
/**
 * Created by PhpStorm.
 * User: s-ds131466
 * Date: 3/3/2016
 * Time: 6:39 PM
 */

include 'dbfunctions.php';


$price = $_POST["price"];
$title = $_POST["title"];
$image = $_POST["image"];
$description = $_POST["description"];
$categories_id = $_POST["categories_id"];

$prodtitleimage = prod_title_image_exists($title, $image);
$target_ext = "jpg";
$myimage = $image . $target_ext;


if (!(file_exists('/myimages/'. $image . '.' . $target_ext))){
    echo "<script>
function Redirect() {
        window.location=\"http://steiakakis.students.acg.edu/coursework/adminpanel.php\";
    }
                    document.write(\"Image does not exist in directory. You will be redirected to main page in 5 sec.\");
                     setTimeout('Redirect()', 5000);

          </script>";
}else if(sizeof($prodtitleimage) > 0){


    echo "<script>
function Redirect() {
        window.location=\"http://steiakakis.students.acg.edu/coursework/adminpanel.php\";
    }
                    document.write(\"Product title/image already exists.You will be redirected to main page in 5 sec.\");
                     setTimeout('Redirect()', 5000);

          </script>";
}
else {
   insertProduct($price, $title, $image, $description, $categories_id);

    echo "<script>
function Redirect() {
        window.location=\"http://steiakakis.students.acg.edu/coursework/adminpanel.php\";
    }
                   document.write(\"Product Created.You will be redirected to main page in 5 sec.\");
                   setTimeout('Redirect()', 5000);

          </script>";
}