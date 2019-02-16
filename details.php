<?php include 'includes/header.php'?>

<?php
  if(isset($_SESSION['username'])) {
?>

<body>

<?php include "includes/navigation.php"?>
<?php

  if(isset($_GET['post_id'])) {
    $p_id = $_GET['post_id'];
    $select_posts = "SELECT * FROM posts WHERE post_id = $p_id";
    $select_posts_query = mysqli_query($connection , $select_posts);
  }


    while($row = mysqli_fetch_assoc($select_posts_query)) {
    $post_title = $row['post_title'];
    $post_author = $row['post_author'];
    $post_category_id = $row['post_category_id'];
    $post_image_db = $row['post_image'];
    $post_content = $row['post_content'];
    $post_tags = $row['post_tags'];
    }

    

    $select_category_all = "SELECT * FROM categories WHERE category_id != $p_id";
    $select_category_query = mysqli_query($connection , $select_category_all);


    if(isset($_POST['save_post'])) {
      $post_title = escape($_POST['post_title']);
      $post_category_id = escape($_POST['post_category']);
      $post_author = escape($_POST['post_author']);
      $post_tags = escape($_POST['post_tags']);
      $post_content =escape($_POST['editor1']) ;
      $post_update_date = escape(date('d-m-y'));
      $post_image = $_FILES['post_image'] ['name'];

      if($post_image == '') {
        $post_image = $post_image_db;
        }else {
          $post_image_temp = $_FILES['post_image'] ['tmp_name'];
          move_uploaded_file($post_image_temp , "img/posts/$post_image" );
        }

        $select_category = "SELECT * FROM categories WHERE category_id = $p_id";
        $select_category_query = mysqli_query($connection , $select_category);
      
        while($row = mysqli_fetch_assoc($select_category_query)) {
          $category_name = $row['category_name'];
          $category_id = $row['category_id'];
        }
      

      

      $update = "UPDATE posts SET post_title = '$post_title' , post_category_id = '$post_category_id' , post_author = '$post_author' , post_tags = '$post_tags' , 
      post_content = '$post_content', post_last_update = now() , post_image = '$post_image' WHERE post_id = $p_id ";
      $update_query = mysqli_query($connection , $update);
      confirm($update_query);

      header("Location:details.php?post_id=$p_id&post_update=true");
    }


    if(isset($_POST['delete_post'])) {
      $delete = "DELETE FROM posts WHERE post_id =  $p_id ";
      $delete_query = mysqli_query($connection , $delete);
      confirm($delete);

      header("Location:posts.php?post_delete=asdeqwerlkgbskjdhgjebgkjhafudghkjehf");
    }

?>


  <!-- HEADER -->
  <header id="main-header" class="py-2 bg-primary text-white">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <h1>
            By <?php echo $post_author?></h1>
        </div>
      </div>
    </div>
  </header>

  <!-- ACTIONS -->
  <section id="actions" class="py-4 mb-4 bg-light">
  <form enctype="multipart/form-data" action="" method="post">
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <a href="main.php" class="btn btn-light btn-block">
            <i class="fas fa-arrow-left"></i> Back To Dashboard
          </a>
        </div>
        <div class="col-md-3">
          <button  class="btn btn-success btn-block" type='submit' name='save_post'>
            <i class="fas fa-check"></i> Save Changes
          </button>
        </div>
        <div class="col-md-3">
          <button  class="btn btn-danger btn-block" type='submit' name="delete_post">
            <i class="fas fa-check"></i> Delete post
          </button>
        </div>
      </div>
    </div>
  </section>

  <!-- DETAILS -->
  <section id="details">
    <div class="container">
      <div class="row">
        <div class="col" style='diaplay:flex;'>
          <div class="card">
            <div class="card-header">
              <h4>Edit Post</h4>
            </div>
            <div class="card-body">
              <?php
                if(isset($_GET['post_update'])) {
                  echo "
                  <div class='alert alert-success'>
                    <strong>Success! </strong>Post updated successfully;
                  </div>
                  
                  ";
                }
              ?>
                <div class="form-group">
                  <label for="title">Post Title</label>
                  <input type="text" class="form-control" value='<?php echo $post_title?>' name='post_title'>
                </div>
                <div class="form-group">
                  <label for="category">Current Category</label>
                  <select class="form-control" name='post_category'>
                    <?php
                      if($post_category_id == 0) {
                        echo "<option value = ''>Select post category</option>";
                        
                      }else {

                        $select_category = "SELECT * FROM categories WHERE category_id = $post_category_id";
                        $select_category_query = mysqli_query($connection , $select_category);
                        confirm($select_category_query);

                        while($row = mysqli_fetch_assoc($select_category_query)) {
                          $post_category_name = $row['category_name'];
                        }

                        echo "<option value = '$post_category_id'>$post_category_name</option>";
                      }                    
                      
                      
                      $select_category_all = "SELECT * FROM categories WHERE category_id != $post_category_id";
                      $select_category_query = mysqli_query($connection , $select_category_all);

                      while($row = mysqli_fetch_assoc($select_category_query)) {
                        $category_name = $row['category_name'];
                        $category_id = $row['category_id'];

                        echo "<option value='$category_id'>$category_name</option>";
                      }
                      
                    ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="author">Author</label>
                  <input type="text" class="form-control" value='<?php echo $post_author?>' name='post_author'>
                </div>
                <div class="form-group">
                  <label for="tags">Tags</label>
                  <input type="text" class="form-control" value='<?php echo $post_tags?>' name='post_tags'>
                </div>
                <div class="form-group">
                <h3 style='padding:10px;'>Your Post Avatar</h3>
                <img src="img/posts/<?php echo $post_image_db?>" alt="" class="d-block img-fluid mb-3" style="height:80%; width:100%; object-fit:cover; display:block">
                </div>
                <div class="form-group">
                  <label for="image">Upload Image</label>
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="image" name="post_image">
                    <label for="image" class="custom-file-label">Choose File</label>
                  </div>
                </div>
                <div class="form-group">
                  <label for="body">Body</label>
                  <textarea name="editor1" class="form-control" id="editor" value='<?php echo "$post_content"?>'><?php echo "$post_content"?></textarea>
                </div>

                <script>
                  ClassicEditor
                    .create( document.querySelector( '#editor' ) )
                    .catch( error => {
                        console.error( error );
                    } );
                </script>

              </form>
              
            </div>
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