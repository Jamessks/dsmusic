<?php
ini_set('display_errors','off');
session_start();
if (empty($_SESSION['admin'])){
    header('Location: http://steiakakis.students.acg.edu/coursework/index.php');
    exit();
}
include 'dbfunctions.php';

if (isset ($_POST["edituserbtn"]) && isset($_POST['id'])) {

    $userid = $_POST['id'];

    ?>

    <form name='ResetPWDform' method='POST'>

        <input type="hidden" name="id" value="<?php echo $userid ?>"/>
        <label for="pwd">New Password</label>

        <input type="text" id="pwd" name="userpwd"/>
        <br/>


        <input type="submit" name="ResetPWDbtn" value="Reset PWD">
        <input type="submit" name="CancelPWDbtn" value="Cancel">
    </form>

<?php }else{
    echo '<script>
        function Redirect() {
        window.location="http://steiakakis.students.acg.edu/coursework/adminpanel.php";
    }
        setTimeout(\'Redirect()\', 0);
        </script>';
}

if (isset ($_POST["ResetPWDbtn"])) {
    $password = $_POST['userpwd'];
    $myuserid = $_POST['id'];
    list($findadmin2) = find_admin_by_id($_POST['id']);
    if (reset($findadmin2) == 1) {
        $_SESSION['RESETPWDFAIL'] = 1;
        echo '<script>
        function Redirect() {
        window.location="http://steiakakis.students.acg.edu/coursework/adminpanel.php";
    }
        setTimeout(\'Redirect()\', 0);
        </script>';
    } else {
        update_password_by_id($password, $myuserid);

        $_SESSION['RESETPWDSUCCESS'] = 1;
        echo '<script>
        function Redirect() {
        window.location="http://steiakakis.students.acg.edu/coursework/adminpanel.php";
    }
        setTimeout(\'Redirect()\', 0);
        </script>';
        ?>

        <?php
    }
}
if (isset ($_POST["CancelPWDbtn"])){
    $_SESSION["CancelPWD"] = 1;
    echo '<script>
        function Redirect() {
        window.location="http://steiakakis.students.acg.edu/coursework/adminpanel.php";
    }
        setTimeout(\'Redirect()\', 0);
        </script>';

}
?>