<?php
include'header.php';
if(isset($_SESSION['logerror'])) echo'<br><header class="">Check your username and password and try again.</header>';
unset($_SESSION['logerror']);
if(isset($_SESSION['success'])) echo'<br><header class="">Your Account was created successfully</header>';
unset($_SESSION['success']);
include 'logform.php';
include 'footer.php';