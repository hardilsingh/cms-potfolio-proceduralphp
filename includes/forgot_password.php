<?php include "header.php"?>






<body>
  <!-- HEADER -->
  <header id="main-header" class="py-2 bg-secondary text-white" style="margin-bottom:80px">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <h1>
            <i style='margin-right:10px;' class="fas fa-shield-alt"></i>Security check</h1>
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
              <h4>Verify your <i class="fas fa-id-card"></i></h4>
            </div>
            <div class="card-body">
            <form action="" method="post" autocomplete="off">

            <?php
              if(isset($_POST['forgot_password'])) {
                
                
                $username = escape($_POST['username']);
                $email = escape($_POST['email']);

                $select_user = "SELECT * FROM users WHERE username = '$username' OR user_email = '$email' ";
                $select_user_query = mysqli_query($connection , $select_user);
                confirm($select_user_query);
                $select_user_num = mysqli_num_rows($select_user_query);

                while($row = mysqli_fetch_assoc($select_user_query)) {
                  $user_id = $row['user_id'];
                }

                if($select_user_num > 0) {
                  session_start();
                  $_SESSION['user_id'] = $user_id;
                  header("Location:security_questions.php?user_id=$user_id&previous_check=true");
                }else {
                  echo "<ul><li style='color:red'>Please enter correct EMAIL ID or PASSWORD</li></ul>";
                }
              }
            ?>
                <div class="form-group">
                  <label for="">Username</label>
                  <input type="text" class="form-control" name="username">
                </div>
                <h6 class="text-center" style="margin:20px 0;">OR</h6>
                <div class="form-group">
                  <label for="">Email</label>
                  <input type="email" class="form-control"  name="email">
                </div>
                <div class="form-group">
                  <label for="forgot_password" class='btn btn-success'>Next <i style='margin-left:3px' class='fas fa-arrow-circle-right'></i></label>
                  <input  type='submit' name='forgot_password' id="forgot_password" style="display:none;">
                <a href="../index.php" class="btn btn-info" style=" margin-left:600px;">Log in</a>

                </div>

                

            </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php include "footer.php";
  

  
  ?>

