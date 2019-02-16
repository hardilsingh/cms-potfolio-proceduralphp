<?php include 'includes/header.php'?>
<?php

  if(isset($_SESSION['username'])) {

  

?>

<body>
<?php include "includes/navigation.php"?>
  

  <!-- HEADER -->
  <header id="main-header" class="py-2 bg-primary text-white">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <h1>
            <i class="fas fa-cog"></i> Settings</h1>
        </div>
      </div>
    </div>
  </header>

  <!-- ACTIONS -->
  <section id="actions" class="py-4 mb-4 bg-light">
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <a href="index.html" class="btn btn-light btn-block">
            <i class="fas fa-arrow-left"></i> Back To Dashboard
          </a>
        </div>
        <div class="col-md-3">
          <a href="index.html" class="btn btn-success btn-block">
            <i class="fas fa-check"></i> Save Changes
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- SETTINGS -->
  <section id="settings">
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-header">
              <h4>Edit Settings</h4>
            </div>
            <div class="card-body">
              <form>
                <fieldset class="form-group">
                  <legend>Allow User Registration</legend>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" value="Yes" checked> Yes
                    </label>
                  </div>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" value="No"> No
                    </label>
                  </div>
                </fieldset>

                <fieldset class="form-group">
                  <legend>Homepage Format</legend>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" value="posts" checked> Blog Page
                    </label>
                  </div>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" value="page"> Homepage
                    </label>
                  </div>
                </fieldset>
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