<?php
include 'db.php';

if (isset($_POST['username'])) {
    $username = mysql_real_escape_string($_POST['username']);

    if (!empty($username)) {
        $sql = mysql_query("SELECT COUNT username
                                       FROM users
                                       WHERE username = '$username'");
        
        $result = mysql_query($sql);
        if(!$result) {
        	die('Could not query: ' .mysql_error());
        }
        
        echo mysql_result($result, 0);
    }
}

?>