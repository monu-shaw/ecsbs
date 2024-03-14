<?php
session_start();
if(!isset($_SESSION["login"])){
    header("Location: index.php");
}
?>
<nav class="navbar navbar-expand-lg  c-bg-secondary navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="./product.php">Product</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./category.php">Category</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./setting.php">Settings</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./logout.php">Log Out</a>
        </li>
    </ul>
    </div>
  </div>
</nav>