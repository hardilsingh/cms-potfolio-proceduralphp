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
      $ans1 = $row['user_ans1'];
      $ans2 = $row['user_ans2'];
      $sq1 = $row['user_sq1'];
      $sq2 = $row['user_sq2'];
  }

  if(isset($_POST['forgot_password'])) {
    $sc1 = escape($_POST['sq1']);
    $sc2 = escape($_POST['sq2']);
    $sa1 = escape($_POST['ans1']);
    $sa2 = escape($_POST['ans2']);

    

    if($sc1 == $sq1 && $sc2 == $sq2 && $sa1 == $ans1 && $sa2 == $ans2) {

      header("Location:security_check_complete.php?user_id=$user_id&security_check=true");
    }else {
      echo "<h6 style='color:red'>Wrong answer. Please try again</h6>";
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
                <div class="form-group">
                  <label for="">Security Question 1</label>
                  <select name="sq1" id="" class="form-control">
                    <?php
                      $select_sq = "SELECT * FROM users where user_id = $user_id";
                      $select_sq_query = mysqli_query($connection , $select_sq);

                      while($row = mysqli_fetch_assoc($select_sq_query)) {
                        $user_sq1 = $row['user_sq1'];
                        echo "<option value='$user_sq1'>$user_sq1</option>";
                      }

                    ?>
                  </select>
                  <input type="text" name='ans1' class="form-control" placeholder="Answer 1" style="margin-top:20px">
                </div>
                <div class="form-group">
                  <label for="">Security Question 1</label>
                  <select name="sq2" id="" class="form-control">
                  <?php
                      $select_sq = "SELECT * FROM users where user_id = $user_id";
                      $select_sq_query = mysqli_query($connection , $select_sq);

                      while($row = mysqli_fetch_assoc($select_sq_query)) {
                        $user_sq2= $row['user_sq2'];
                        echo "<option value='$user_sq2'>$user_sq2</option>";
                      }

                    ?>
                  </select>
                  <input type="text" name='ans2' class="form-control" placeholder="Answer 2" style="margin-top:20px">
                  <div class="form-group">
                    <label for="forgot_password" class='btn btn-success' style="margin-top:20px;">Next <i style='margin-left:3px ' class='fas fa-arrow-circle-right'></i></label>
                    <input  type='submit' name='forgot_password' id="forgot_password" style="display:none;">
                  <a href="logout.php" class="btn btn-info" style=" margin-left:600px;">Log in</a>

                  </div>

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

