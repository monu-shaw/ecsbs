<?php
session_start();
if(!isset($_SESSION["login"])){
    header("Location: index.php");
}
?>
<nav class="navbar navbar-expand-lg c-bg-secondary navbar-dark">
  <div class="container-fluid col-lg-10 col-xl-8 mx-auto">
    <a class="navbar-brand" href="#">ECSBS</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 px-0 px-md-4">
        <li class="nav-item">
          <a class="nav-link <?php if(str_contains($_SERVER['REQUEST_URI'],"product.php")) echo"active"; ?>" href="./product.php">Product</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php if(str_contains($_SERVER['REQUEST_URI'],"category.php")) echo"active"; ?>" href="./category.php">Category</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php if(str_contains($_SERVER['REQUEST_URI'],"setting.php")) echo"active"; ?>" href="./setting.php">Settings</a>
        </li>        
      </ul>
      <button class="btn btn-outline-success mx-0 mx-md-1 my-1 my-md-0">
        <a class="nav-link" href="../<?= $_SESSION["login"]["slug"]?>" target="_blank">Visit Store</a>
      </button>
      <button class="btn btn-outline-warning">
        <a class="nav-link" href="./logout.php">Log Out</a>
      </button>
    </div>
  </div>
</nav>