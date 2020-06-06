<?php
session_start();
if (empty($_SESSION['admin'])){
    header('Location: http://steiakakis.students.acg.edu/coursework/index.php');
    exit();
}
include 'dbfunctions.php';
unset($_SESSION['delsuccess']);
unset($_SESSION['delfail']);

if (isset($_POST["deletebtn"])) {
    $prodid = $_POST['id'];
    $prodimage = $_POST['image'];


    if(delete_prod($prodid) == "Success") {
        //unlink('myimages/' . $prodimage);
        $_SESSION["Cancel"] = 1;
        $_SESSION['delsuccess'] = 1;
        echo '<script>
        function Redirect() {
        window.location="http://steiakakis.students.acg.edu/coursework/adminpanel.php";
    }
        setTimeout(\'Redirect()\', 0);
        </script>';
    }else{
        $_SESSION["Cancel"] = 1;
        $_SESSION['delfail'] = 1;
        echo '<script>
        function Redirect() {
        window.location="http://steiakakis.students.acg.edu/coursework/adminpanel.php";
    }
        setTimeout(\'Redirect()\', 0);
        </script>';
    }




}