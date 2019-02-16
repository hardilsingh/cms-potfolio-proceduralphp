<?php

    $connection = mysqli_connect("localhost" , "root" , "" , "blogging_system");
    if(!$connection) {
        echo "Could not connect to database";
    }

?>