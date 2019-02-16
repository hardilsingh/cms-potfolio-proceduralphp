<?php require 'includes/header.php'?>

<?php

  if(isset($_SESSION['username'])) {

    if(isset($_GET['user_delete'])) {
      $delete_id = escape($_GET['user_delete']);

      $delete_user = "DELETE FROM users WHERE user_id = $delete_id";
      $delete_user_query = mysqli_query($connection , $delete_user);
      confirm($delete_user_query);

      header("Location:users.php");

    }


    if(isset($_POST['apply'])) {
      foreach($_POST['checkboxarray'] as $checkboxvalue) {
        $bulk_options = $_POST['bulk_options'];

        switch($bulk_options) {
          case 'delete';
          $delete_users_array = "DELETE FROM users WHERE user_id = $checkboxvalue";
          $delete_users_array_query = mysqli_query($connection , $delete_users_array);
          confirm($delete_users_array_query);
          header("Location:users.php");
          break;
        }
      }
    }

  

?>

<?php
  if(isset($_GET['page'])) {
    $page = $_GET['page'];

  }else {
    $page ='';
  }

  if($page == '' || $page == 1) {
    $page_1 = 0;
  }else {
    $page_1 = ($page *5) -5;
  }

  $query_count = "SELECT * FROM users";
  $post_query_count = mysqli_query($connection , $query_count);
  $count = mysqli_num_rows($post_query_count);

  $count = ceil($count / 5);

  $query = "SELECT * FROM users  LIMIT $page_1 , 5";
  $select_all_query = mysqli_query($connection , $query);
?>

<style>
  .pager {
    display: flex;
}

li {
    list-style: none;
    padding:5px;
}

span {
  padding:5px;

}

</style>
<body>
<?php require "includes/navigation.php"?>
 

  <!-- HEADER -->
  <header id="main-header" class="py-2 bg-warning text-white">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <h1>
            <i class="fas fa-users"></i> Users</h1>
        </div>
      </div>
    </div>
  </header>

  <!-- SEARCH -->
  <section id="search" class="py-4 mb-4 bg-light">
    <form action="search_users.php" method="post">
    <div class="container">
      <div class="row">
        <div class="col-md-6 ml-auto">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Search Users..." name='search_item'>
            <div class="input-group-append">
              <button class="btn btn-warning" type="submit" name="search_btn">Search users..</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    </form>
    
  </section>

  <!-- USERS -->
  <section id="users">
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="card">
          <form action="" method="post">
            <div class="card-header" style="display:flex; justify-content:space-between">
              <h4>Latest Users</h4>
              
              <select name="bulk_options" id="" class="form-control" style="width:50%;">
                <option value="delete">Delete</option>
              </select>
              <input type="submit" value="Apply" class="btn btn-success" name = "apply">
            </div>
            <table class="table table-striped">

            <thead class="thead-dark">
                <tr>
                  <th><input type="checkbox" id="checkAllBoxes"></th>
                  <th>#</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Details</th>
                  <th>Delete</th>
                </tr>
              </thead>
              
             

              <tbody>
                    
                  <?php

                  while($row = mysqli_fetch_assoc($select_all_query)) {
                    $firstname = $row['user_firstname'];
                    $lastname = $row['user_lastname'];
                    $email = $row['user_email'];
                    $user_id = $row['user_id'];
                    echo " <tr>";
                    echo "<td><input type='checkbox' class='checkBoxes btn' name='checkboxarray[]' value='$user_id'></td>";
                    echo "<td>$user_id</td>";
                    echo "<td>$firstname  $lastname</td>";
                    echo "<td>$email</td>";
                    echo "<td><a href='profile.php?user_details=$user_id' class='btn btn-secondary'>
                          <i class='fas fa-angle-double-right'></i> Details
                          </a></td>";
                    echo "<td><a href='users.php?user_delete=$user_id' class='btn btn-danger'>
                    <i class='fas fa-trash-alt'></i> Delete
                    </a></td>";
                    echo "</tr>";

                  }
                  ?>
              </tbody>
              </form>
            </table>
            <ul class="pager">
            <span class='btn'>Pages</span>
            <?php
            
              for($i=1; $i<=$count; $i++) {
                if($i == $page) {
                  echo "<li><a class='active_link' href='users.php?page=$i'>$i</a></li>";
                }else {
                  echo " <li><a href='users.php?page=$i'>$i</a></li>";
                  }
              }
             ?>
             </ul>
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php require "includes/footer.php"?>

<?php
  }else {
    header("Location:index.php");
  }
?>