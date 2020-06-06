<?php
session_start();
if (empty($_SESSION['admin'])){
    header('http://steiakakis.students.acg.edu/coursework/index.php');
    exit();
}

include_once 'header.php';

//error messages
if(isset($_SESSION['DELUSERFAIL'])){
    echo'<script>alert("Cannot delete this user!")</script>';
    unset($_SESSION['DELUSERFAIL']);
}
if(isset($_SESSION['delsuccess']) && !isset($_SESSION['delfail'])){
    echo'<script>alert("Product Deleted successfully")</script>';
    unset($_SESSION['delsuccess']);
    unset($_SESSION['delfail']);
}else if(isset($_SESSION['delfail']) && !isset($_SESSION['delsuccess'])){
    echo'<script>alert("Product is used in Featured, swap it and try again.")</script>';
    unset($_SESSION['delfail']);
    unset($_SESSION['delsuccess']);
}
if(isset($_SESSION['RESETPWDFAIL'])){
    echo'<script>alert("Cannot reset Password of this user!")</script>';
    unset($_SESSION['RESETPWDFAIL']);
}
if(isset($_SESSION['RESETPWDSUCCESS'])){
    echo'<script>alert("Successfully reset password of user!")</script>';
    unset($_SESSION['RESETPWDSUCCESS']);
}
if(isset($_SESSION['LOCKUSERFAIL'])){
    echo'<script>alert("You cannot lock this user!")</script>';
    unset($_SESSION['LOCKUSERFAIL']);
}
if(isset($_SESSION['DELUSERLOCKFAIL'])){
    echo'<script>alert("You must first Lock this user in order to delete")</script>';
    unset($_SESSION['DELUSERLOCKFAIL']);
}
if(isset($_SESSION['DELUSERWAITTIME'])){
    echo'<script>alert("You must wait '.$_SESSION['DELUSERWAITTIME'].' minutes to delete this user")</script>';
    unset($_SESSION['DELUSERWAITTIME']);
}
//end of error messages

echo '

<div class="jumbotron">
<h1>Admin Panel</h1>

  <ul id="admin_list">
  <li><button id="manprod" class="btn btn-info">Manage Products</button></li>
  <li><button id="manuse" class="btn btn-info">Manage Users</button></li>
  <li><button id="manrep" class="btn btn-info">View Reports</button></li>
  <li><button id="manrat" class="btn btn-info">Ratings</button></li>
  <li><button id="manfeat" class="btn btn-info">Featured Products</button></li>
  </ul>
  </div>';
if(isset($_SESSION["CancelPWD"])) {
    echo '<div id="addusebtn" style=" width: 95px;height: 34px;">
<button  class="btn btn-info">Add Users</button>
</div>';
}else{
    echo '<div id="addusebtn" style="display:none; width: 95px;height: 34px;">
<button  class="btn btn-info">Add Users</button>
</div>';
}
if(isset($_SESSION["Cancel"])) {
    echo '<div id="addprodbtn" style=" width: 95px;height: 34px;">
<button  class="btn btn-info">Add Products</button>
</div>';
}else{
    echo '<div id="addprodbtn" style="display:none; width: 95px;height: 34px;">
<button  class="btn btn-info">Add Products</button>
</div>';

}
echo '<div id="upimgbtn" style="display:none; width: 95px;height: 34px;">
<button  class="btn btn-info">Upload Image</button>
</div>';


$users=getUsers();
$products=getProducts();
$categories=getCategories();
$productviews=getProductInfo_andViews();
$productbought=getProductInfo_andBought();

$featured=getFeatured();
$counter = 0;

//Featured panel
echo'<div id="manageFeatured" style="display: none" class="register9 manageFeaturedclass">';
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
echo'</ul>
     </div></div>';
//Ratings panel
echo"<div id='manageRatings' style='display: none' class='register9'>
<div class='register9'>
<h3>Find average rating of product:<h3>";
echo"<select id='selectionid' class='selectionclass' name='mysel'>";
echo"<option value='Select'>Select Product</option>";
foreach ($products as $rowss) {
    echo"<option value='" . $rowss['id'] ."'>" . $rowss['title'] . "</option>";
    }
echo"</select>";
echo"</div>
<h3>Rating is: </h3><h3 id='myheading' class='myheadings'></h3></div>";

//Reports panel
echo'<table id="manageViewsReportsTable" style="display:none" class="mytable">';
echo'<tr><th><div class="register5"><h2 class="mytext">Product View Count</h2></div></th><th><div id = manageViewsReportsTable class="register5"><h2 class="mytext">Product Bought Count</h2></div></th></tr>';
echo '<td><div class="register7">';
echo '<table class="admin_table" border="1">';
echo "<tr><th>ProductID</th><th>Title</th><th>Image</th><th>ViewCount</th></tr>";
foreach($productviews as $row) {

    echo "<tr><td style=\"text-align:center\">".$row["ProductID"]."</td>
              <td style=\"text-align:center\">".$row["title"]. "</td>
              <td>" . "<img src=  myimages/" . $row["image"] . ' width="100px"/>' . "</td>
              <td style=\"text-align:center\">".$row["ViewCount"]. "</td></tr>";
}
echo "</table></div></td>";

echo '<td class= toptd><div class="register7">';
echo '<table class="admin_table" border="1">';
echo "<tr><th>ProductID</th><th>Title</th><th>Image</th><th>BoughtCount</th></tr>";
foreach($productbought as $row) {

    echo "<tr><td style=\"text-align:center\">".$row["ProductID"]."</td>
              <td style=\"text-align:center\">".$row["title"]. "</td>
              <td>" . "<img src=  myimages/" . $row["image"] . ' width="100px"/>' . "</td>
              <td style=\"text-align:center\">".$row["BoughtCount"]. "</td></tr>";
}
echo "</table></div></td>";
echo "</table>";

if(isset($_SESSION["CancelPWD"])) {unset($_SESSION['CancelPWD']);
    echo '<table id="manageUserTable" class="mytable">';
    echo '<tr><th><div class="register5"><h2 class="mytext">Users Table</h2></div></th></tr>';
    echo '<td><div class="register7">';
    echo '<table  class="admin_table" border="1">';
    echo "<tr><th>ID</th><th>Username</th><th>First Name</th><th>Last Name</th><th>Email</th><th>IS_ADMIN</th><th>Status</th><th>DEL</th><th>ADMIN</th><th>PWD</th></tr>";
    foreach ($users as $row) {
        echo '<form method= "POST">';
        if ($row['id'] != $_SESSION['id']) {
            echo "<tr><td>" . $row["id"] . "</td>
              <td>" . $row["username"] . "</td>
              <td>" . $row["firstname"] . "</td>
              <td>" . $row["lastname"] . "</td>
              <td>" . $row["email"] . "</td>
              <td>" . $row["isadmin"] . "</td>";
            $start_date = new DateTime($row["LastActivity"]);
            $since_start = $start_date->diff(new DateTime(date("Y-m-d H:i:s")));
            $difference = $since_start->i . ' minutes';
            if ($difference >= 5 && $row['Status'] == 'Offline') {
                echo "<td class='tdimg'><img class ='statusimg' src='http://www.clker.com/cliparts/9/1/5/2/119498475589498995button-red_benji_park_01.svg.med.png' alt='Offline'></td>";
            } else if ($difference < 5 && $row['Status'] == 'Online') {
                echo "<td class = 'tdimg'><img class ='statusimg' src='http://www.clker.com/cliparts/c/8/3/c/13523550961548622750button-green-md.png' alt='Online'></td>";
            } else if ($difference >= 5 && $row['Status'] == 'Online') {
                echo "<td class='tdimg'><img class ='statusimg' src='http://www.clker.com/cliparts/9/1/5/2/119498475589498995button-red_benji_park_01.svg.med.png' alt='Offline'></td>";
            } else if ($difference < 5 && $row['Status'] == 'Offline') {
                echo "<td class='tdimg'><img class ='statusimg' src='http://www.clker.com/cliparts/9/1/5/2/119498475589498995button-red_benji_park_01.svg.med.png' alt='Offline'></td>";
            } else if($row['Status'] == 'Locked'){
                echo "<td class='tdimg'><img class ='statusimg' src='https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSolDdRckhGMye3RSpbwolPDttqsj3Y6Xq0PYN8VkS7__3XSIfLOg' alt='Locked'></td>";
            }
            ?><?php echo "
              <td><input type=\"hidden\" name=\"id\" value=\"" . $row['id'] . "\"/>
              <input type=\"hidden\" name=\"isadmin\" value=\"" . $row['isadmin'] . "\"/>
              <button class= 'DELUSERCLASS' data-username='" . $row["username"] . "' type=submit name='delete' value='DELETE_USER'>Delete</button></td>
              <td><button type=submit name='lock' value='LOCK'>Lock</button></td>
              <td><button type=submit name='admin' value='ADMIN'>Admin</button></form></td>";
            echo '<td><form name="editpwdform" action="ResetPwd.php" method="POST">' .
                '<input type="hidden" value="' . $row["id"] . '" name="id"/>' .
                '<input type="submit" value="Reset PWD" name="edituserbtn"/> </form>' . "</td></tr>";

        }


        if ($_POST["delete"] == 'DELETE_USER' && $_POST['id'] == $row['id']) {
            list($findadmin2) = find_admin_by_id($_POST['id']);
            if (reset($findadmin2) == 1) {
                $_SESSION["CancelPWD"] = 1;
                $_SESSION['DELUSERFAIL'] = 1;
                echo '<script>
        function Redirect() {
        window.location="http://steiakakis.students.acg.edu/coursework/adminpanel.php";
    }
        setTimeout(\'Redirect()\', 0);
        </script>';
            } else {
                $_SESSION["CancelPWD"] = 1;
                delete_user($row['id']);
                echo '<script>
        function Redirect() {
        window.location="http://steiakakis.students.acg.edu/coursework/adminpanel.php";
    }
        setTimeout(\'Redirect()\', 0);
        </script>';
            }
        }
        if ($_POST["admin"] == 'ADMIN' && $_POST['id'] == $row['id']) {
            list($findadmin) = find_admin_by_id($_POST['id']);

            if (reset($findadmin) == 1) {
                $_SESSION["CancelPWD"] = 1;
                revoke_admin($row['id']);
                echo '<script>
        function Redirect() {
        window.location="http://steiakakis.students.acg.edu/coursework/adminpanel.php";
    }

        setTimeout(\'Redirect()\', 0);
        </script>';
            } else {
                $_SESSION["CancelPWD"] = 1;
                give_admin($row['id']);
                echo '<script>
        function Redirect() {
        window.location="http://steiakakis.students.acg.edu/coursework/adminpanel.php";
    }

        setTimeout(\'Redirect()\', 0);
        </script>';
            }
        }if ($_POST["lock"] == 'LOCK' && $_POST['id'] == $row['id']) {
            list($findstatus) = find_user_status($_POST['id']);
            $lockstatus = "Locked";
            if (reset($findstatus) == "Online" || reset($findstatus) == "Offline") {
                $_SESSION["CancelPWD"] = 1;
                lock_user($row['id'],$lockstatus);
                echo '<script>
        function Redirect() {
        window.location="http://steiakakis.students.acg.edu/coursework/adminpanel.php";
    }

        setTimeout(\'Redirect()\', 0);
        </script>';
            } else {
                $offstatus = "Offline";
                $_SESSION["CancelPWD"] = 1;
                update_user_status($row['id'],$offstatus);
                echo '<script>
        function Redirect() {
        window.location="http://steiakakis.students.acg.edu/coursework/adminpanel.php";
    }

        setTimeout(\'Redirect()\', 0);
        </script>';
            }
        }
    }
}else{ unset($_SESSION['CancelPWD']);
    echo '<table id="manageUserTable" style="display:none" class="mytable">';
    echo '<tr><th><div class="register5"><h2 class="mytext">Users Table</h2></div></th></tr>';
    echo '<td><div class="register7">';
    echo '<table  class="admin_table" border="1">';
    echo "<tr><th>ID</th><th>Username</th><th>First Name</th><th>Last Name</th><th>Email</th><th>IS_ADMIN</th><th>Status</th><th>DEL</th><th>Lock</th><th>ADMIN</th><th>PWD</th></tr>";
    foreach ($users as $row) {
        echo '<form method= "POST">';
        if ($row['id'] != $_SESSION['id']) {
            echo "<tr><td>" . $row["id"] . "</td>
              <td>" . $row["username"] . "</td>
              <td>" . $row["firstname"] . "</td>
              <td>" . $row["lastname"] . "</td>
              <td>" . $row["email"] . "</td>
              <td>" . $row["isadmin"] . "</td>";
            $start_date = new DateTime($row["LastActivity"]);
            $since_start = $start_date->diff(new DateTime(date("Y-m-d H:i:s")));
            $difference = $since_start->i . ' minutes';
            if ($difference >= 5 && $row['Status'] == 'Offline') {
                echo "<td class='tdimg'><img class ='statusimg' src='http://www.clker.com/cliparts/9/1/5/2/119498475589498995button-red_benji_park_01.svg.med.png' alt='Offline'></td>";
            } else if ($difference < 5 && $row['Status'] == 'Online') {
                echo "<td class = 'tdimg'><img class ='statusimg' src='http://www.clker.com/cliparts/c/8/3/c/13523550961548622750button-green-md.png' alt='Online'></td>";
            } else if ($difference >= 5 && $row['Status'] == 'Online') {
                echo "<td class='tdimg'><img class ='statusimg' src='http://www.clker.com/cliparts/9/1/5/2/119498475589498995button-red_benji_park_01.svg.med.png' alt='Offline'></td>";
            } else if ($difference < 5 && $row['Status'] == 'Offline') {
                echo "<td class='tdimg'><img class ='statusimg' src='http://www.clker.com/cliparts/9/1/5/2/119498475589498995button-red_benji_park_01.svg.med.png' alt='Offline'></td>";
            } else if($row['Status'] == 'Locked'){
                echo "<td class='tdimg'><img class ='statusimg' src='https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSolDdRckhGMye3RSpbwolPDttqsj3Y6Xq0PYN8VkS7__3XSIfLOg' alt='Locked'></td>";
            }
            ?><?php echo "
              <td><input type=\"hidden\" name=\"id\" value=\"" . $row['id'] . "\"/>
              <input type=\"hidden\" name=\"isadmin\" value=\"" . $row['isadmin'] . "\"/>
              <button class= 'DELUSERCLASS' data-username='" . $row["username"] . "' type=submit name='delete' value='DELETE_USER'>Delete</button></td>
              <td><button type=submit name='lock' value='LOCK'>Lock</button></td>
              <td><button type=submit name='admin' value='ADMIN'>Admin</button></form></td>";
            echo '<td><form name="editpwdform" action="ResetPwd.php" method="POST">' .
                '<input type="hidden" value="' . $row["id"] . '" name="id"/>' .
                '<input type="submit" value="Reset PWD" name="edituserbtn"/> </form>' . "</td></tr>";

        }


        if ($_POST["delete"] == 'DELETE_USER' && $_POST['id'] == $row['id']) {
            list($findadmin2) = find_admin_by_id($_POST['id']);
            list($userstatus) = find_user_status($_POST['id']);
            $userLastActivity = get_user_lastactivity($row['id']);
            $start_date2 = new DateTime($userLastActivity[0]["LastActivity"]);
            $since_start2 = $start_date2->diff(new DateTime(date("Y-m-d H:i:s")));
            $difference2 = $since_start2->i . ' minutes';
            if(reset($userstatus) != "Locked"){ //if user is not locked first
                $_SESSION["CancelPWD"] = 1;
                $_SESSION['DELUSERLOCKFAIL'] = 1;
                echo '<script>
        function Redirect() {
        window.location="http://steiakakis.students.acg.edu/coursework/adminpanel.php";
    }
        setTimeout(\'Redirect()\', 0);
        </script>';
            }else if($difference2 < 5){
                $_SESSION["CancelPWD"] = 1;
                if($userLastActivity[0]["LastActivity"] == null){
                    delete_user($row['id']);
                    echo '<script>
        function Redirect() {
        window.location="http://steiakakis.students.acg.edu/coursework/adminpanel.php";
    }
        setTimeout(\'Redirect()\', 0);
        </script>';
                }else{
                    $_SESSION["CancelPWD"] = 1;
                $_SESSION['DELUSERWAITTIME'] = (5 - $difference2);
                echo '<script>
        function Redirect() {
        window.location="http://steiakakis.students.acg.edu/coursework/adminpanel.php";
    }
        setTimeout(\'Redirect()\', 0);
        </script>';
            }
            }
             else{
                 $_SESSION["CancelPWD"] = 1;
                delete_user($row['id']);
                echo '<script>
        function Redirect() {
        window.location="http://steiakakis.students.acg.edu/coursework/adminpanel.php";
    }
        setTimeout(\'Redirect()\', 0);
        </script>';
            }
        }
        if ($_POST["admin"] == 'ADMIN' && $_POST['id'] == $row['id']) {
            list($findadmin) = find_admin_by_id($_POST['id']);

            if (reset($findadmin) == 1) {
                $_SESSION["CancelPWD"] = 1;
                revoke_admin($row['id']);
                echo '<script>
        function Redirect() {
        window.location="http://steiakakis.students.acg.edu/coursework/adminpanel.php";
    }

        setTimeout(\'Redirect()\', 0);
        </script>';
            } else {
                $_SESSION["CancelPWD"] = 1;
                give_admin($row['id']);
                echo '<script>
        function Redirect() {
        window.location="http://steiakakis.students.acg.edu/coursework/adminpanel.php";
    }

        setTimeout(\'Redirect()\', 0);
        </script>';
            }
        }
        if ($_POST["lock"] == 'LOCK' && $_POST['id'] == $row['id']) {
            list($findadmin2) = find_admin_by_id($_POST['id']);
            list($findstatus) = find_user_status($_POST['id']);
            $lockstatus = "Locked";

            if (reset($findadmin2) == 1) {
                $_SESSION["CancelPWD"] = 1;
                $_SESSION['LOCKUSERFAIL'] = 1;
                echo '<script>
        function Redirect() {
        window.location="http://steiakakis.students.acg.edu/coursework/adminpanel.php";
    }
        setTimeout(\'Redirect()\', 0);
        </script>';
            }

          else if (reset($findstatus) == "Online" || reset($findstatus) == "Offline") {
              $_SESSION["CancelPWD"] = 1;
                lock_user($row['id'],$lockstatus);
                echo '<script>
        function Redirect() {
        window.location="http://steiakakis.students.acg.edu/coursework/adminpanel.php";
    }

        setTimeout(\'Redirect()\', 0);
        </script>';
            } else {
                $offstatus = "Offline";
              $_SESSION["CancelPWD"] = 1;
                update_user_status($row['id'],$offstatus);
                echo '<script>
        function Redirect() {
        window.location="http://steiakakis.students.acg.edu/coursework/adminpanel.php";
    }

        setTimeout(\'Redirect()\', 0);
        </script>';
            }
        }
    }
}
echo "</table></div></td></table>";


if(isset($_SESSION["Cancel"])) {


    echo'<table id="manageProductTable" class="mytable">';
    echo'<tr><th><div class="register5"><h2 class="mytext">Products Table</h2></div></th></tr>';
    echo '<td><div class="register7">';
    echo '<table class="admin_table" border="1">';
    echo "<tr><th>ID</th><th>TITLE</th><th>IMAGE</th><th>DESCRIPTION</th><th>PRICE</th><th>ADDEDON</th><th colspan=\"2\">DELETE/EDIT</th></tr>";
    foreach($products as $rows) {
        echo "<tr>";
        echo "<td>" . $rows["id"] . "</td>" .
            "<td>" . $rows["title"] . "</td>" .
            "<td>" . "<img src=myimages/" . $rows["image"] . ' width="100px"/>' . "</td>" .
            "<td>" . $rows["description"] . "</td>" .
            "<td>" . $rows["price"] . "€</td>" .
            "<td>" . $rows["addedon"] . "</td>" .
            '<td>' .
            '<form name="deleteprodform" action="deleteProduct.php" method="POST">' .
            '<input type="hidden" value="' . $rows["id"] . '" name="id"/>' .
            '<input type="hidden" value="' . $rows["image"] . '" name="image"/>' .
            '<input type="submit" value ="Delete" name="deletebtn"/> </form>' .

            '<form name="editprodform" action="editProduct.php" method="POST">' .
            '<input type="hidden" value="' . $rows["id"] . '" name="id"/>' .
            '<input type="hidden" value="' . $rows["title"] . '" name="title"/>' .
            '<input type="hidden" value="' . $rows["description"] . '" name="description"/>' .
            '<input type="hidden" value="' . $rows["price"] . '" name="price"/>' .
            '<input type="submit" value="Edit" name="editbtn"/> </form>' .
            '</td>';
        echo "</tr>";
    }
    echo "</table></div></td></table>";
unset($_SESSION["Cancel"]);}else {unset($_SESSION["Cancel"]);


    echo '<table id="manageProductTable" style="display:none" class="mytable">';
    echo '<tr><th><div class="register5"><h2 class="mytext">Products Table</h2></div></th></tr>';
    echo '<td><div class="register7">';
    echo '<table class="admin_table" border="1">';
    echo "<tr><th>ID</th><th>TITLE</th><th>IMAGE</th><th>DESCRIPTION</th><th>PRICE</th><th>ADDEDON</th><th colspan=\"2\">DELETE/EDIT</th></tr>";
    foreach ($products as $rows) {
        echo "<tr>";
        echo "<td>" . $rows["id"] . "</td>" .
            "<td>" . $rows["title"] . "</td>" .
            "<td>" . "<img src=myimages/" . $rows["image"] . ' width="100px"/>' . "</td>" .
            "<td>" . $rows["description"] . "</td>" .
            "<td>" . $rows["price"] . "€</td>" .
            "<td>" . $rows["addedon"] . "</td>" .
            '<td>' .
            '<form name="deleteprodform" action="deleteProduct.php" method="POST">' .
            '<input type="hidden" value="' . $rows["id"] . '" name="id"/>' .
            '<input type="hidden" value="' . $rows["image"] . '" name="image"/>' .
            '<input type="submit" data-product="'.$rows['title'].'" value ="Delete" name="deletebtn"/> </form>' .

            '<form name="editprodform" action="editProduct.php" method="POST">' .
            '<input type="hidden" value="' . $rows["id"] . '" name="id"/>' .
            '<input type="hidden" value="' . $rows["title"] . '" name="title"/>' .
            '<input type="hidden" value="' . $rows["description"] . '" name="description"/>' .
            '<input type="hidden" value="' . $rows["price"] . '" name="price"/>' .
            '<input type="submit" value="Edit" name="editbtn"/> </form>' .
            '</td>';
        echo "</tr>";
    }
    echo "</table></div></td></table>";
}


echo'
<div id="adduseform" style="display:none">

 <div class="main">
      <div class="one">
        <div class="register">
          <h3>Register</h3>
          <form  id="reg-form" method="POST">
            <div>
              <label for="name">FirstName</label>
              <input type="text" id="firstname" name="firstname" placeholder="First Name" required/>
            </div>
            <div>
              <label for="name">LastName</label>
              <input type="text" id="lastname" name="lastname" placeholder="Last name" required/>
            </div>
            <div>
              <label for="email">Email</label>
              <input type="email" id="email" name="email"  placeholder="email" required/>
            </div>
            <div>
              <label for="username">Username</label>
              <input type="text" id="username" name="username" placeholder="username" required />
            </div>
            <div>
              <label for="password">Password</label>
              <input type="password" id="password" name="password" required />
            </div>
            <div>
              <label for="isadmin">Admin(1 or 0)</label>
              <select id="isadmin" class="selectionadminclass" name="isadmin">
            <option value="0">0</option>
            <option value="1">1</option>
            </select>
            </div>
              <button type="submit" value="Insert_User" name="Insert_User" id="create-account" class="button">Add User</button>
              </form>
            </div>
        </div>
        </div>

</div>';
if(isset($_POST["Insert_User"])){
    $username = $_POST["username"];
    $password = $_POST["password"];
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $isadmin = $_POST["isadmin"];

//echo $username . " " . $password . " " . $firstname . " " . $lastname . " " . $email;

    $unamemail = username_email_exists($username,$email);
    if (sizeof($unamemail) > 0){


        echo "<script>
function Redirect() {
        window.location=\"http://steiakakis.students.acg.edu/coursework/adminpanel.php\";
    }
                    //document.write(\"Username/email exists.You will be redirected to main page in 5 sec.\");
                     setTimeout('Redirect()', 0);
    }
          </script>";
    }
    else {
        $reguser = insertUser($firstname, $lastname, $email, $username, $password, $isadmin);

        echo "<script>
function Redirect() {
        window.location=\"http://steiakakis.students.acg.edu/coursework/adminpanel.php\";
    }
                  //document.write(\"User Created.You will be redirected to main page in 5 sec.\");
                   setTimeout('Redirect()', 0);

          </script>";
    }
}


echo'
<div id="addprodform" style="display:none">

 <div class="main">
      <div class="one">
        <div class="register">
          <h3>Register</h3>
          <form  id="reg-form"  action="" enctype="multipart/form-data" method="POST">
            <div>
              <label for="price">Price</label>
              <input type="text" id="price" name="price" placeholder="Product Price" required/>
            </div>
            <div>
              <label for="title">Title</label>
              <input type="text" id="title" name="title" placeholder="Product Title" required/>
            </div>
             <div>
              <label for="image">Image</label>
              <input type="file" name="fileToUpload" id="fileToUpload">
            </div>
            <div>
              <label for="description">Description</label>
              <input type="text" id="description" name="description"  placeholder="Product Description" required/>
            </div>

            <div>
              <label for="categories_id">Category</label>
              <select id="categories id" class="selectioncategoryclass" name="categories_id">';?>
              <?php foreach($categories as $mycats){ ?><?php
              echo"<option value='" . $mycats['id'] ."'>" . $mycats['name'] . "</option>";
                                                    } ?><?php
           echo'</select>
            </div>
              <input type="hidden" id="filename" name="filename"/>
              <button type="submit" value="Insert_Product" name ="Insert_Product" id="create-account" class="button">Insert Product</button>
              </form>
            </div>
        </div>
        </div>

</div>';
if(isset($_POST["Insert_Product"])) {
    $price = $_POST["price"];
    $title = $_POST["title"];
    $image = $_POST["filename"];
    $description = $_POST["description"];
    $categories_id = $_POST["categories_id"];


    $prodtitleimage = prod_title_image_exists($title, $image);





    // Check if image file is a actual image or fake image

    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        //echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;

    }
    $imageFileType = substr($image,strrpos($image,".")+1);
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    $target_dir = "myimages/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;


// Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
// Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            // echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";

        } else {
            echo "Sorry, there was an error uploading your file.";

        }
    }


    if(sizeof($prodtitleimage) > 0){

        echo "<script>
function Redirect() {
        window.location=\"http://steiakakis.students.acg.edu/coursework/adminpanel.php\";
    }
                    document.write(\"Product title/image already exists.You will be redirected to main page in 5 sec.\");
                     setTimeout('Redirect()', 5000);

          </script>";
        exit();
    }
    if ($uploadOk == 1 && sizeof($prodtitleimage) == 0) {
        insertProduct($price, $title, $image, $description, $categories_id);

        echo "<script>
function Redirect() {
        window.location=\"http://steiakakis.students.acg.edu/coursework/adminpanel.php\";
    }
                   document.write(\"Product Created.You will be redirected to main page in 5 sec.\");
                   setTimeout('Redirect()', 0);

          </script>";
    }
    ?>



    <?php
}

echo'<div id="upimgform" style="display:none">
    <div class="main">
      <div class="one">
      <div class="register">
<form action="uploadimage.php"  method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>
      </div>
      </div>
    </div>
</div>';



include 'footer.php';