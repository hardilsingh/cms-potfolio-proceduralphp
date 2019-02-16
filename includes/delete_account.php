<?php include "header.php"?>

<?php

  if(isset($_SESSION['username'])) {

  

?>


<?php

      if(isset($_GET['delete_account'])) {
        $delete_id = escape($_GET['delete_account']);

        $select_all = "SELECT * FROM users WHERE user_id = $delete_id";
        $select_all_query = mysqli_query($connection , $select_all);

        while($row = mysqli_fetch_assoc($select_all_query)) {
            $username = $row['username'];
            $user_email = $row['user_email'];
            $user_password = $row['user_password'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_image = $row['user_image'];
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
            <i class="fas fa-user"></i> Delete Account</h1>
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
              <h4>Delete account</h4>
            </div>
            <div class="card-body">
              <p>The following data will be deleted upon your actions<br>You will not be able to retrieve you deleted data.</p>
              <ul style="list-style:none">
                <li><i class="fas fa-camera-retro"></i> Photos</li>
                <li><i class="fas fa-id-card"></i> Posts</li>
                <li><i class="fas fa-comments"></i> Comments</li>
                <li><i class="fas fa-users"></i> User info</li>
                <li><i class="fab fa-rocketchat"></i> Etc...</li>
              
              </ul>

              <?php
                if(isset($_POST['delete_account'])) {
                  $user_password_verify = escape($_POST['password']);
          
                  if(password_verify($user_password_verify , $user_password)) {
          
                      if($delete_id == $_SESSION[user_id]) {
                          $delete_image_path = "../img/users/$user_image";
                          unlink($delete_image_path);
                          $delete_account = "DELETE FROM users WHERE user_id = $delete_id";
                          $delete_account_query = mysqli_query($connection , $delete_account);


                          header("Location:logout.php");
                      }else {
                          $delete_image_path = "../img/users/$user_image";
                          unlink($delete_image_path);
                          $delete_account = "DELETE FROM users WHERE user_id = $delete_id";
                          $delete_account_query = mysqli_query($connection , $delete_account);
                          header("Location:../users.php");
                      }
          
                    }else if($user_password_verify == "") {
                      echo "<ul><li><h6 style='color:red'>The password field cannot be empty</h6></li></ul>";
                    }else {
                      echo "<ul><li><h6 style='color:red'>Please enter a valid password</h6></li></ul>";
                    }
                  }
              ?>
            <form action="" method="post">
                <div class="form-group">
                  <label for="name">Password</label>
                  <input type="password" class="form-control" name="password">
                </div>
                <input onClick=\"javascript: return confirm('Are you sure, you want to delete'); \" type="submit" class="btn btn-danger" name="delete_account" value="Delete Account">

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