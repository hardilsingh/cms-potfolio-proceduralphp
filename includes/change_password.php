<?php include "header.php"?>

<?php

  if(isset($_SESSION['username'])) {

  

?>

<?php

    if(isset($_GET['change_password'])) {
      $change_password_id = escape($_GET['change_password']);
  
      $select_fields = "SELECT * from users WHERE user_id = $change_password_id";
      $select_fields_query  = mysqli_query($connection , $select_fields);
  
      while($row = mysqli_fetch_assoc($select_fields_query)) {
  
        $old_password_db = $row['user_password'];
        $user_id = $row['user_id'];
      }
    }

 

  

  

?>

<body>
  <?php include "self_navigation.php"?>
  <!-- HEADER -->
  <header id="main-header" class="py-2 bg-primary text-white">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <h1>
            <i class="fas fa-user"></i> Change Password</h1>
        </div>
      </div>
    </div>
  </header>

  <!-- ACTIONS -->
  <section id="actions" class="py-4 mb-4 bg-light">
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <a href="../main.php" class="btn btn-light btn-block">
            <i class="fas fa-arrow-left"></i> Back To Dashboard
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- PROFILE -->
  <section id="profile">
    <div class="container">
      <div class="row">
        <div class="col-md-9">
          <div class="card">
            <div class="card-header">
              <h4>Change Password</h4>
            </div>
            <div class="card-body">
            <?php
              if(isset($_POST['update_password'])) {
                $old_password = escape($_POST['old_password']);
                $new_password = escape($_POST['new_password']);
            
                if(password_verify($old_password , $old_password_db) && $old_password == '' && $new_password == '') {
                  $new_password = password_hash($new_password , PASSWORD_BCRYPT ,  array('tryandcrackityouidiot' => 10  ));
            
                  $insert_password = "UPDATE users set user_password = '$new_password' WHERE user_id = $user_id";
                  $insert_password_query = mysqli_query($connection , $insert_password);
                  confirm($insert_password_query);
            
                  header("Location:../profile.php?user_details=$change_password_id&changeof_password=true");
            
                } else {
                  echo "
                  <div class='alert alert-danger'>
                    <strong>Error!</strong> Please enter the password.
                  </div>
                  
                  ";
                }
              }
            ?>
            <form action="" method="post">
                <div class="form-group">
                  <label for="name">Old password</label>
                  <input type="password" class="form-control" name="old_password">
                </div>
                <div class="form-group">
                  <label for="email">New Password</label>
                  <input type="password" class="form-control"  name="new_password">
                </div>
                <input type="submit" class="btn btn-info" name="update_password" value="Update Password">

            </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php include "footer.php";
  

  
  ?>

<?php
  }else {
    header("Location:../index.php");
  }
?>