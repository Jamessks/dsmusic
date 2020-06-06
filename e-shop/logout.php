<?php
include_once 'dbfunctions.php';
$LastActivityDate = date("Y-m-d H:i:s");
$status = "Offline";
update_user_lastactivity($_SESSION['id'],$LastActivityDate);
if(!isset($_SESSION['LOCKEDLOGOUT'])) {
    update_user_status($_SESSION['id'], $status);
}
session_start();
session_destroy();
header('Location: index.php');
?>