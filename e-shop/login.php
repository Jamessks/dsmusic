<?php include_once 'dbfunctions.php';

$adminvalue = 0;
$name = 0;
$id = 0;
$user=user_exists($_POST["username"],$_POST["password"]);
$LastActivityDate = date("Y-m-d H:i:s");
$status = "Online";
if (empty($user)){
    $errorlogging = 1;
    $_SESSION['logerror'] = $errorlogging;
    //header('Location: http://localhost/myproject/index.php');
    header('Location: http://steiakakis.students.acg.edu/coursework/logregpage.php');
    exit();

}else if(sizeof($user > 0)){
    $admins = admin_exists($_POST["username"],$_POST["password"]);
    $adminvalue = current($admins);

    $fnames = firstname_from_username($_POST["username"], $_POST["password"]);
    $name = current($fnames);

    list($userid) = find_user_id_by_username($_POST["username"]);
    $id = current($userid);
    list($idstatus) = find_user_status($id);

}
if(reset($idstatus) != "Locked"){
if($adminvalue == 1) {
    $_SESSION['id'] = $id;

    $_SESSION['first'] = $name;
    $_SESSION['admin'] = $adminvalue;
    update_user_lastactivity($id,$LastActivityDate);
    update_user_status($id,$status);
    //header('Location: http://localhost/myproject/index.php');
    echo '<script>var sessionID ='.$id.';
        function Redirect() {
        window.location="http://steiakakis.students.acg.edu/coursework/index.php";
    }
        setTimeout(\'Redirect()\', 0);
        </script>';
    exit();
}else{
    $_SESSION['id'] = $id;
    echo'<script>var sessionID ='.$id.'</script>';
    $_SESSION['first'] = $name;
    update_user_lastactivity($id,$LastActivityDate);
    update_user_status($id,$status);
    //header('Location: http://localhost/myproject/index.php');
    echo '<script>var sessionID ='.$id.';
        function Redirect() {
        window.location="http://steiakakis.students.acg.edu/coursework/index.php";
    }
        setTimeout(\'Redirect()\', 0);
        </script>';
    exit();
}
}else{
    unset($_SESSION['ACCOUNTLOCKED']);
    $_SESSION['ACCOUNTLOCKED'] = 1;
    echo '<script>
        function Redirect() {
        window.location="http://steiakakis.students.acg.edu/coursework/index.php";
    }

        setTimeout(\'Redirect()\', 0);
        </script>';
}


