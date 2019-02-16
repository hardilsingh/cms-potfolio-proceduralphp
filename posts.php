<?php include "includes/header.php"?>

<?php

  if(isset($_SESSION['username'])) {

  

?>

<body>
<?php include "includes/navigation.php"?>
  

<?php
  $select_posts = "SELECT * FROM posts ORDER BY post_id DESC";
  $select_posts_query = mysqli_query($connection , $select_posts);

  
  
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

  $query_count = "SELECT * FROM posts";
  $post_query_count = mysqli_query($connection , $query_count);
  $count = mysqli_num_rows($post_query_count);

  $count = ceil($count / 5);

  $query = "SELECT * FROM posts  LIMIT $page_1 , 5";
  $select_all_query = mysqli_query($connection , $query);


  if(isset($_POST['apply'])) {
    foreach($_POST['checkboxarray'] as $checkboxvalue) {
      $bulk_options = $_POST['bulk_options'];
      switch ($bulk_options) {
        case 'delete';
        $delete_posts_array = "DELETE FROM posts WHERE post_id = $checkboxvalue";
        $delete_posts_array_query = mysqli_query($connection , $delete_posts_array);
        confirm($delete_posts_array_query);
        header("Location:posts.php");
        break;

        case 'clone';
        $select_post = "SELECT * FROM posts WHERE post_id = $checkboxvalue";
        $select_post_query  = mysqli_query($connection , $select_post);
        confirm($select_post_query);
        while($row=mysqli_fetch_assoc($select_post_query)) {
          // $post_id = $row['post_id'];
          $post_title = $row['post_title'];
          $post_category_id = $row['post_category_id'];
          $post_author = $row['post_author'];
          $post_date = $row['post_date'];
          $post_content = $row['post_content'];
          $post_image = $row['post_image'];
          $post_tags = $row['post_tags'];
          $post_time = $row['post_time'];
          $post_user_id = $row['post_user_id'];
          $post_last_update = $row['post_last_update'];
        }

        $inser_post = "INSERT INTO posts ( post_title , post_category_id, post_author , post_date , post_content , post_image
        , post_tags , post_time , post_user_id , post_last_update)
        VALUES( '$post_title' , '$post_category_id' , '$post_author' , '$post_date' , '$post_content' , '$post_image'
        , '$post_tags' , '$post_time' , '$post_user_id' , '$post_last_update')";
        $inser_post_query = mysqli_query($connection , $inser_post);
        confirm($inser_post_query);
        header("Location:posts.php");
        break;
      }

     
    }
  }
?>

  <!-- HEADER -->
  <header id="main-header" class="py-2 bg-primary text-white">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <h1>
            <i class="fas fa-pencil-alt"></i> Posts</h1>
        </div>
      </div>
    </div>
  </header>

  <!-- SEARCH -->
  <section id="search" class="py-4 mb-4 bg-light">
    <div class="container">
      <form action="search_posts.php" method="post">
      <div class="row">
        <div class="col-md-6 ml-auto">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Search Posts..." name='search_item'>
            <div class="input-group-append">
            <button class="btn btn-warning" type="submit" name="search_btn">Search posts..</button>
            </div>
          </div>
        </div>
      </div>
      </form>
    </div>
  </section>

  <!-- POSTS -->
  <section id="posts">
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="card">
          <form action="" method="post">
          <div class="card-header" style="display:flex; justify-content:space-between">
              <h4>Latest Posts</h4>
              
                <select name="bulk_options" id="" class="form-control" style="width:50%;">
                <option value="">Select action</option>

                  <option value="delete">Delete</option>
                  <option value="clone">Clone</option>
                </select>
                <input type="submit" value="Apply" class="btn btn-success" name = "apply">
              
              
            </div>
            </div>
            <?php
              if(isset($_GET['post_delete'])) {
                echo " <div class='alert alert-info'>
                        <strong>Success! </strong>Post deleted successfully.
                      </div>";
              }

            ?>
            <table class="table table-striped">
              <thead class="thead-dark">
                <tr>

                  <th><input type="checkbox" id="checkAllBoxes"></th>
                  <th>#</th>
                  <th>Title</th>
                  <th>Category</th>
                  <th>Author</th>
                  <th>Date</th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                
                  <?php

                    while($row = mysqli_fetch_assoc($select_posts_query)) {
                    
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_category_id = $row['post_category_id'];

                    $select_category = "SELECT * FROM categories WHERE category_id = $post_category_id";
                    $select_category_query = mysqli_query($connection , $select_category);
                    confirm($select_category_query);

                    while($row = mysqli_fetch_assoc($select_category_query)) {
                      $post_category_id = $row['category_name'];
                    }

                    $post_date = $row['post_date'];

                  
                  
                    echo "<tr>";
                    echo "<td><input type='checkbox' class='checkBoxes btn' name='checkboxarray[]' value='$post_id'></td>";
                    echo " <td>$post_id</td>";
                    echo " <td>$post_title</td>";
                    echo " <td>$post_category_id</td>";
                    echo "<td>$post_author</td>";
                    echo "<td>$post_date</td>";
                    echo "<td>
                            <a href='details.php?post_id=$post_id' class='btn btn-secondary'>
                              <i class='fas fa-angle-double-right'></i> Details
                            </a>
                          </td>";
                    echo "<td><a href='posts.php?post_delete_upper_level=$post_id' class='btn btn-danger'>
                    <i class='fas fa-trash-alt'></i> Delete
                    </a></td>";
                    echo "</tr>";

                    }
                  
                  ?>
              </tbody>
            </table>
            <?php
               if(isset($_GET['post_delete_upper_level'])) {
                $delete = "DELETE FROM posts WHERE post_id =  $post_id ";
                $delete_query = mysqli_query($connection , $delete);
                confirm($delete_query);

                header("Location:posts.php");
              }
            ?>
           </form>

            <!-- PAGINATION -->
            <nav class="ml-4">
              <ul class="pagination">
              <?php
                for($i=1; $i<=$count; $i++) {
                  if($i == $page) {
                    echo "
                    <li class='page-item'>
                      <a href='posts.php?page=$i' class='page-link'>$i</a>
                    </li>
                    ";
                  }else {
                    echo "
                    <li class='page-item'>
                      <a href='posts.php?page=$i' class='page-link'>$i</a>
                    </li>
                    ";
                    }
                }
              ?>
              </ul>
            </nav>
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