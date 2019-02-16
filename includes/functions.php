<?php

    function escape($string) {
        global $connection;
        return mysqli_real_escape_string($connection , trim($string));
    }

    function confirm($result) {
        global $connection;
        if(!$result) {
            die("The connection could not be made" . mysqli_error($connection));
        }
        
    }

    function deleteConfirm() {
        alert("Are you sure you want to delete your account");
    }
    

?>
