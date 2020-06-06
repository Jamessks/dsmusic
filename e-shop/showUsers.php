<?php
/**
 * Created by PhpStorm.
 * User: s-ad169880
 * Date: 3/1/2016
 * Time: 6:27 PM
 */

include 'dbfunctions.php';

$users=getUsers();


echo '<table border="1">';
echo "<tr><th>Username</th><th>First Name</th><th>Last Name</th><th>Email</th><th>IS_ADMIN</th><th>Password</th></tr><br/>";
foreach($users as $row) {
    echo "<tr><td>".$row["id"]."</td><td>".$row["username"]. "</td><td>".$row["firstname"].
        "</td><td>".$row["lastname"]. "</td><td>".$row["email"]. "</td><td>".$row["isadmin"]. "</td>
              <td>".$row["password"]. "</td></tr><br/>";
}
echo "</table>";




$user=getUserByUsername("ds");
if (empty($user)){
    echo "User does not exist";
}

else{
    echo '<table border="1">';
    echo "<tr><th>First Name</th><th>Last Name</th></tr><br/>";
    foreach($user as $row) {
        echo "<tr><td>".$row["firstname"]."</td><td>".$row["lastname"]. "</td></tr><br/>";
    }
    echo "</table>";
}




?>

