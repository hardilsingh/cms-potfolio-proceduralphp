<?php include "header.php"?>

<?php
    
    if(isset($_SESSION['user_id'])) {

    $user_id = $_SESSION['user_id'];
  
    $select_all = "SELECT * FROM users where user_id = $user_id";
    $select_all_query = mysqli_query($connection , $select_all);
  
    while($row = mysqli_fetch_assoc($select_all_query)) {
      $firstname = $row['user_firstname'];
      $lastname = $row['user_lastname'];
      $email = $row['user_email'];
      $user_image = $row['user_image'];
      $user_password = $row['user_password'];
  }

  if(isset($_POST['change_password'])) {
      $p1 = escape($_POST['p1']);
      $p2 = escape($_POST['p2']);
      if($p1 == $p2) {
        $p1 = password_hash($p1 , PASSWORD_BCRYPT , array('hacker'=> 12) );
        $update_password = "UPDATE users SET user_password = '$p1' WHERE user_id = $user_id";
        $update_password_query = mysqli_query($connection , $update_password);
        confirm($update_password);

        header("Location:../index.php?forgot_password_check_complete=qwertyuiopasdfghjklzxcvbnm");

      }
  }
?>
<body>
  <!-- HEADER -->
  <header id="main-header" class="py-2 bg-secondary text-white" style="margin-bottom:80px">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <h1>
            <i style='margin-right:10px;' class="fas fa-shield-alt"></i>Security check complete</h1>
        </div>
      </div>
    </div>
  </header>

  <!-- PROFILE -->
  <section id="profile">
    <div class="container">
      <div class="row">
        <div class="col-md-9">
          <div class="card">
            <div class="card-header">
              <h4>Profile details <i class="fas fa-id-card"></i></h4>
            </div>
            <div class="card-body">
                <h3 style="margin-bottom:50px">Thankyou for you your co-operation. Here are details regarding your profile<br><h6>Please do not share these deatails with anyone.</h6></h3>
                <ul style="list-style:square">
                    <li>Firstname: <?php echo $firstname?></li>
                    <li>Lastname:<?php echo $lastname?></li>
                    <li>Email:<?php echo $email?></li>
                    <li>Profile: <img src="../img/users/<?php echo $user_image?>" alt=""  height=20% width=20% style="padding:15px;"></li>
                </ul>

                <form action="" method="post">
                <div class="form-group">
                  <label for="">New password</label>
                  <input type="password" class="form-control" name="p1">
                </div>
                <div class="form-group">
                  <label for="">Confirm password</label>
                  <input type="password" class="form-control"  name="p2">
                </div>
                <div class="form-group">
                  <label for="forgot_password" class='btn btn-success'>Change Password <i style='margin-left:3px' class='fas fa-arrow-circle-right'></i></label>
                  <input  type='submit' name='change_password' id="forgot_password" style="display:none;">
                  <a href="logout.php" class="btn btn-info" style=" margin-left:700px;">Log in</a>

                </div>
                </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php include "footer.php";?>

  <?php
    }else {
        header("Location:../index.php");
    }    
  ?>

