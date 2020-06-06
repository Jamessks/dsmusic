<?php
session_start();
if (empty($_SESSION['id'])){

    header('http://steiakakis.students.acg.edu/coursework/index.php');
    exit();
}
include_once 'header.php';
$deliveriesofuser = getProductInfo_andDeliveries($_SESSION['id']);
$userhistory = get_user_history_by_id($_SESSION['id']);
$userinfo = getUserInfo_by_id($_SESSION['id']);
echo'<div class="jumbotron">
<h1>Profile Page</h1>

  <ul id="admin_list">
  <li><button id="manprof" class="btn btn-info">Profile</button></li>
  <li><button id="manhistory" class="btn btn-info">View History</button></li>
  </ul>
  </div>';
if (isset($_SESSION['updatesuccess']))
{
echo'<script>alert("Changes to your profile were made successfully.")</script>';
    unset($_SESSION['updatesuccess']);
}
echo'
<div id="manprofarea" style="display: none" class="main2">
      <div class="one">
  <div  class="register">
  <form  id="editprofile" action="UpdateUser.php" method="POST">
            <div>
              <label for="name">FirstName</label>
              <input type="text" id="firstnameprof" name="firstname"  placeholder="First Name" value="' . reset($userinfo)["firstname"] . '" required/>
              <span id="correctfname" style="display: none" class="error2">✔</span>
              <span id="wrongfname" style="display: none" class="error">✖</span>
            </div>
            <div>
              <label for="name">LastName</label>
              <input type="text" id="lastnameprof" name="lastname"  placeholder="Last name" value="' . reset($userinfo)["lastname"] . '" required/>

              <span id="correctlname" style="display: none" class="error2">✔</span>
              <span id="wronglname" style="display: none" class="error">✖</span>
            </div>
            <div>
              <label for="email">Email</label>
              <input type="email" id="emailprof" name="email" placeholder="email" value="' . reset($userinfo)["email"] . '" required/>

              <span id="correct" style="display: none" class="error2">✔</span>
              <span id="wrong" style="display: none" class="error">✖</span>
              <span id="emailexists" style="display: none" class="error3">E-mail exists</span>
            </div>


            <div>
              <label for="username">Username</label>
              <input type="text" id="usernameprof" name="username" placeholder="username" value="' . reset($userinfo)["username"] . '" required />

              <span id="correctuname" style="display: none" class="error2">✔</span>
              <span id="wronguname" style="display: none" class="error">✖</span>
              <span id="unameexists" style="display: none"  class="error3">Username exists</span>
            </div>
            <div>
              <label></label>
              <input type="submit" value="Update Profile" id="usereditid" class="button"/>
            </div>
          </form>
</div></div></div>'; ?>
<?php

echo"<div id='manhistoryarea' style='display: none'>";
echo '<td class= toptd><div class="register7">';
echo '<table class="admin_table" border="1">';
echo "<tr><th>Title</th><th>Image</th><th>Price</th><th>Date Purchased</th></tr>";
foreach($userhistory as $row) {

    echo "<tr><td style=\"text-align:center\">".$row["Title"]."</td>";
    echo "<td><img src=  myimages/" . $row["Image"] . " width='100px'/></td>";
    echo "<td style=\"text-align:center\">".$row["Price"]. "</td>";
    echo "<td style=\"text-align:center\">" . $row["DateAdded"] . "</td></tr>";
}
echo "</table></div></td>";
echo "</table></div>";
?>



    <script>var useremail ='<?php echo reset($userinfo)["email"];?>'; var userlastprof ='<?php echo reset($userinfo)["lastname"];?>'; var userfirstprof ='<?php echo reset($userinfo)["firstname"];?>'; var usernameprof ='<?php echo reset($userinfo)["username"];?>'</script>

<?php
include_once 'footer.php';