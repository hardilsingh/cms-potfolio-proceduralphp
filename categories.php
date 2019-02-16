<?php include 'includes/header.php'?>

<?php

  if(isset($_SESSION['username'])) {

  

?>


<body>
<?php include "includes/navigation.php"?>

<!-- Post Category table retrieval code goes here -->
<?php
    $select_categories = "SELECT * FROM categories";
    $select_categories_query = mysqli_query($connection , $select_categories);
?>




  <!-- HEADER -->
  <header id="main-header" class="py-2 bg-success text-white">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <h1>
            <i class="fas fa-folder"></i> Categories</h1>
        </div>
      </div>
    </div>
  </header>

  <!-- SEARCH -->
  <section id="search" class="py-4 mb-4 bg-light">
    <div class="container">
    <form action="search_categories.php" method="post">
      <div class="row">
        <div class="col-md-6 ml-auto">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Search categories..." name='search_item'>
            <div class="input-group-append">
              <button class="btn btn-warning" type="submit" name="search_btn">Search</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  </form>

  <!-- CATEGORIES -->
  <section id="categories">
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-header">
              <h4>Latest Categories</h4>
            </div>
            <table class="table table-striped">
              <thead class="thead-dark">
                <tr>
                  <th>#</th>
                  <th>Title</th>
                  <th>Date</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
              <?php
                while($row = mysqli_fetch_assoc($select_categories_query)) {
                    $category_name = $row['category_name'];
                    $category_id = $row['category_id'];
                    $category_date = $row['category_date'];

                    echo "<tr>

                      <td>$category_id</td>
                      <td>$category_name</td>
                      <td>$category_date</td>
                      <td>

                        <a href='categories.php?cat_id_delete=$category_id' class='btn btn-danger'>
                          <i class='fas fa-angle-double-right'></i> Delete
                        </a>
                      </td>
                    
                    </tr>";
                }
                if(isset($_GET['cat_id_delete'])) {
                  $delete = "DELETE FROM categories WHERE category_id = $category_id";
                  $delete_query = mysqli_query($connection , $delete);
                  confirm($delete_query);
                  header("Location:categories.php");
                }        
              ?>

              </tbody>
            </table>

            

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