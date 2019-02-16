<?php include 'includes/header.php';


   


?>


<body>
  <nav class="navbar navbar-expand-sm navbar-dark bg-dark p-0">
    <div class="container">
      <a href="index.html" class="navbar-brand">Blogen</a>
    </div>
  </nav>

  <!-- HEADER -->
  <header id="main-header" class="py-2 bg-primary text-white">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <h1>
            <i class="fas fa-user"></i> Blogen Admin Registration</h1>
        </div>
      </div>
    </div>
  </header>

  <!-- ACTIONS -->
  <section id="actions" class="py-4 mb-4 bg-light">
    <div class="container">
      <div class="row">

      </div>
    </div>
  </section>

  <!-- register -->
  <section id="register">
    <div class="container">
      <div class="row">
        <div class="col-md-6 mx-auto">
          <div class="card">
            <div class="card-header">
              <h4>Account Signup</h4>
            </div>
            <div class="card-body">
            
            <?php

              if(isset($_POST['signup'])) {
                $username = escape($_POST['username']);
                $password = escape($_POST['password']);
                $email = escape($_POST['email']);
                $confirm_password = escape($_POST['confirm_password']);

                $check_user_exists = "SELECT * FROM users WHERE username = '$username' OR user_email = '$email'";
                $check_user_exists_query = mysqli_query($connection , $check_user_exists);
                confirm($check_user_exists_query);

                while($row = mysqli_fetch_assoc($check_user_exists_query)) {
                  $username_exists = $row['username'];
                  $email_exists = $row['user_email'];
                }

                $check_user_exists_num = mysqli_num_rows($check_user_exists_query);

                if($check_user_exists_num > 0 && $username == $username_exists) {
                  echo "
                  <div class='alert alert-danger'>
                    <strong>Error!</strong> Username already exists.
                  </div>
                  ";
                }else if($check_user_exists_num > 0 && $email == $email_exists) {
                  echo "
                  <div class='alert alert-danger'>
                    <strong>Error!</strong> Email already exists.
                  </div>
                  ";
                }else if($check_user_exists_num > 0 && $email == $email_exists  && $username == $username_exists) {
                  echo "<h6 style='color:red'>username and email already exists</h6>";
                }else {
                  if($password == $confirm_password) {
                    require "includes/mail.php";
                    $password = password_hash($password , PASSWORD_BCRYPT , array('hacker'=> 12));

          
                    $create_user = "INSERT INTO users ";
                    $create_user .= "(username , user_email , user_password) ";
                    $create_user .= "VALUES ('$username' , '$email' , '$password')";
            
                    $create_user_query = mysqli_query($connection , $create_user);
            
                    confirm($create_user_query);
                    header("Location:includes/confirm.php");
                  }else {
                    echo "<h6 style='color:red'>The passwords do not match. Please try again</h6>";
                  }  
                }
        
               
            }
            
            ?>

              <form action="" method="post" autocomplete = "off">
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" name="email" required>
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" name="password" required>
                </div>
                <div class="form-group">
                  <label for="password">Confirm password</label>
                  <input type="password" class="form-control" name="confirm_password" required>
                </div>
                <div class="form-group">
                  <label for="username">Username</label>
                  <input type="text" class="form-control" name="username" required>
                </div>
                <input type="submit" value="Sign up" class="btn btn-primary " name="signup">
                <a href="index.php" class="btn btn-success" style=" margin-left:340px;">Log in</a>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php include "includes/footer.php"?>
