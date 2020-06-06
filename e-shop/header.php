<!DOCTYPE html>
<html>
<?php
include_once 'head.php';
include_once 'dbfunctions.php';
$categories = getCategories();
?>

<body>
<!-- Fixed navbar -->
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="http://steiakakis.students.acg.edu/coursework/index.php">DSMusic</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="http://steiakakis.students.acg.edu/coursework/index.php">Home</a></li>
                <li><a href="http://steiakakis.students.acg.edu/coursework/aboutpage.php">About</a></li>
                <li><a href="http://steiakakis.students.acg.edu/coursework/contactpage.php">Contact</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Categories <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <?php  foreach ($categories as $row) { ?>
                            <li><a href="categories.php?id=<?php echo $row["id"]?>"><?php echo $row['name']; ?></a></li>
                        <?php } ?>
                    </ul>
                </li>
                <?php
                if (isset($_SESSION['first']) && isset($_SESSION['admin'])) {
                    echo' <li><a href = "http://steiakakis.students.acg.edu/coursework/adminpanel.php">Admin Panel</a></li>';
                }?>
                <?php
                if (isset($_SESSION['first'])) {
                  echo'  <li>Welcome ' . $_SESSION['first']; echo'</li>';
                    echo' <li><a href="http://steiakakis.students.acg.edu/coursework/logout.php">Logout</a></li>
                          <li><a href="http://steiakakis.students.acg.edu/coursework/profile.php">Profile</a></li>';
                }else

               echo' <li><a href="http://steiakakis.students.acg.edu/coursework/logregpage.php">Login/Register</a></li>
            </ul>'?>
            <ul class="nav navbar-nav navbar-right">
                <form class="navbar-form navbar-right" action="search.php" method="GET">
                    <input class="form-control" type="text" placeholder="Search..." name="search" id="search">
                </form>

            </ul>
                <?php if (isset($_SESSION['first'])) {
                    echo '<div id = "cartdiv" ><button id = "shoppingcart" onclick="myRedirect()">
                                                                <img id = "cart-img" src = "myimages/shopping_%20cart.jpg" ></button ></div >';
                }?>
        </div><!--/.nav-collapse -->
    </div>
</nav>
<br>
<br>
<script>function myRedirect() {

        window.location = "http://steiakakis.students.acg.edu/coursework/shoppingCart.php";
    }</script>