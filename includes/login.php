<?php session_start();?>
<?php include "db.php"?>
<?php include "functions.php"?>


<?php

    if(isset($_POST['login'])) {
        $email = escape($_POST['email']);
        $password = escape($_POST['password']);

        $select_user = "SELECT * FROM users WHERE user_email = '$email' ";
        $select_user_query = mysqli_query($connection , $select_user);

        }

    while($row = mysqli_fetch_assoc($select_user_query)) {
        $db_email = $row['user_email'];
        $db_password = $row['user_password'];
        $db_firstname = $row['user_firstname'];
        $db_lastname = $row['user_lastname'];
        $db_image = $row['user_image'];
        $db_username= $row['username'];
        $db_user_id = $row['user_id'];
        $db_user_bio = $row['user_bio'];
    }


    if(password_verify($password , $db_password)) {
        $_SESSION['email'] = $db_email;
        $_SESSION['password'] = $db_password;
        $_SESSION['firstname'] = $db_firstname;
        $_SESSION['lastname'] = $db_lastname;
        $_SESSION['user_image'] = $db_image;
        $_SESSION['username'] = $db_username;
        $_SESSION['user_id'] = $db_user_id;
        $_SESSION['user_bio'] = $db_user_bio;

        header("Location:../main.php");
    } else {
        header("Location:../index.php?verification=qazwsxertyuiopdfghjklxcvbnm");
    }



    


?>