<?php include 'includes/header.php'?>

<?php
  if(isset($_SESSION['username']) == null) {

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
            <i class="fas fa-user"></i> Blogen Admin</h1>
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

  <!-- LOGIN -->
  <section id="login">
    <div class="container">
      <div class="row">
        <div class="col-md-6 mx-auto">
          <div class="card">
            <div class="card-header">
              <h4>Account Login</h4>
            </div>
            <div class="card-body">
              <?php
                if(isset($_GET['verification'])) {
                  echo "
                  <div class='alert alert-danger'>
                    <strong>Error!</strong> You have entered incorrect email or password
                  </div>
                  
                  ";
                }
              ?>
              <?php
                if(isset($_GET['forgot_password_check_complete'])) {
                  echo "<h6 style='color:green'>Password Changed</h6>";
                  $_SESSION['user_id'] = null;
                }
              
              ?>
              <form action="includes/login.php" method="post" autocomplete="off" style='padding:10px'>
                <div class="form-group">
                  <input type="text" class="form-control" name="email" placeholder='Email'>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" name="password" placeholder='Password'>
                </div>
                <input type="submit" value="Login" class="btn btn-primary btn-block" name="login" style='margin-top:30px; width:50%; margin-left:50%; transform:translateX(-50%);'>
              </form>
              <hr style='width:50%; margin-top:50px; background-color:grey'>
              <a href="register.php" class="btn btn-danger" style="margin-top:20px;">Register</a>
              <a href="includes/forgot_password.php" class="btn btn-info" style="margin-top:20px; margin-left:250px;">Forgot password?</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


<?php include "includes/footer.php"?>

<?php
  }else {
    header("Location:main.php");
  }
?>
  