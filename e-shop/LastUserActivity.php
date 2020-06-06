<?php
/**
 * Created by PhpStorm.
 * User: Dimitris
 * Date: 3/12/2017
 * Time: 12:21 AM
 */
include 'dbfunctions.php';

$lastactivityDate = $_POST['lastactivity'];

update_user_lastactivity($_SESSION['id'],$lastactivityDate);
list($status) = find_user_status($_SESSION['id']);

if(reset($status) == "Locked"){
    $_SESSION['LOCKEDLOGOUT'] = 1;
    echo 'Locked';
}
