<?php include 'includes/header.php'?>

<?php

  if(isset($_SESSION['username'])) {

  

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

  $query_count = "SELECT * FROM categories";
  $post_query_count = mysqli_query($connection , $query_count);
  $count = mysqli_num_rows($post_query_count);

  $count = ceil($count / 5);

  $query = "SELECT * FROM categories  LIMIT $page_1 , 5";
  $select_all_query = mysqli_query($connection , $query);
?>


<body>
<?php include "includes/navigation.php"?>
 

  <!-- HEADER -->
  <header id="main-header" class="py-2 bg-warning text-white">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <h1>
            <i class="fas fa-pencil-alt"></i> Categories</h1>
        </div>
      </div>
    </div>
  </header>

 <!-- SEARCH -->
 <section id="search" class="py-4 mb-4 bg-light">
    <form action="" method="post">
    <div class="container">
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
    </form>
    
  </section>

  <!-- USERS -->
  <section id="users">
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-header">
              <h4>Search Query</h4>
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

                  if(isset($_POST['search_btn'])) {
                    $search_keyword = escape($_POST['search_item']);
                    $select_all = "SELECT * FROM categories WHERE category_name LIKE '%$search_keyword%'  " ;
                    $select_all_query = mysqli_query($connection , $select_all);
                    $select_all_num = mysqli_num_rows($select_all_query);
                    confirm($select_all_query);

                    if($select_all_num > 0) {
                        while($row = mysqli_fetch_assoc($select_all_query)) {
                            $category_name = $row['category_name'];
                            $category_id= $row['category_id'];
                            $category_date = $row['category_date'];
                            echo " <tr>";
                            echo "<td>$category_id</td>";
                            echo "<td>$category_name</td>";
                            echo "<td>$category_date</td>";
                            echo "<td><a href='categories.php?cat_id_delete=$category_id class='btn btn-danger'>
                                    <i class='fas fa-angle-double-right'></i> Delete
                                    </a></td>";
                            echo "</tr>";
        
                            }
                            echo "
                              <div class='alert alert-info'>
                                <h5>$select_all_num search result(s) found.</h5>
                              </div>
                  
                            ";
                    }else {
                        echo "
                              <div class='alert alert-danger'>
                                <h5>$select_all_num search result(s) found.</h5>
                              </div>
                  
                            ";
                    }

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