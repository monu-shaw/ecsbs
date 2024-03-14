<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <?php include_once("top.php");?>
</head>

<body style="background-color:#e3eafc">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid col-12 col-md-10 col-lg-8 col-xl-6">
            <a class="navbar-brand" href="#">Store</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                </ul>                
                <button class="btn btn-outline-success mx-md-1 my-1 my-md-0" type="button">
                    <i class="bi bi-cart"></i>
                </button>
                <div class="dropdown-center">
                    <button class="btn btn-outline-success dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="bi bi-search"></i>
                    </button>
                    <div class="dropdown-menu" id="dropdownMenuButton" aria-labelledby="dropdownMenuButton">
                        <form class="px-4 py-2">
                            <input type="search" class="form-control" placeholder="Search.." id="myInput" onkeyup="filterFunction()" />
                        </form>
                        <a class="dropdown-item" href="#">Item 1</a>
                        <a class="dropdown-item" href="#">Item 2</a>
                        <a class="dropdown-item" href="#">Item 3</a>
                    </div>
                </div>                
            </div>
        </div>
    </nav>

    <div class="col-12 col-md-10 col-lg-8 col-xl-6 mx-auto my-1 p-1 bg-light min-h-100 tr-animate">
        <div class="jumbotron text-center border border-end-0 border-start-0 my-1">
            <h1 class="display-4">- Our Category - </h1>
        </div>
        <section class="splide" aria-label="Splide Basic HTML Example">
            <div class="splide__track">
                <ul class="splide__list">
                    <?php
                        // Sample associative array
                        $items = [
                            ['name' => 'Logitek Keyboard', 'image' => 'logitek.jpeg'],
                            ['name' => 'MSI Keyboard', 'image' => 'msi.jpeg'],
                            ['name' => 'Genius Mouse', 'image' => 'genius.jpeg'],
                            ['name' => 'Jerry Mouse', 'image' => 'jerry.jpeg']
                        ];
  
                        // Loop through the associative array
                        foreach ($items as $item) {
                            // Print each card wrapped in a splide__slide
                            echo '<div class="splide__slide">';
                            echo '<div class="card" style="width: 14rem;">';
                            echo '<img src="https://www.shutterstock.com/image-vector/default-avatar-profile-icon-grey-260nw-769594684.jpg" class="card-img-top" alt="' . $item['name'] . '">';
                            echo '<div class="card-body">';
                            echo '<h6 class="card-title">' . $item['name'] . '</h6>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        }
                        ?>
                </ul>
            </div>
        </section>
        <div class="jumbotron text-center border border-end-0 border-start-0 my-1">
            <h1 class="display-4">- Our Products - </h1>
        </div>
        <?php
        // Sample associative array of products
        $products = [
            [
                "name" => "Product 1",
                "price" => "$100",
                "description" => "This is a description for Product 1.",
                "image" => "product1.jpg"
            ],
            [
                "name" => "Product 2",
                "price" => "$200",
                "description" => "This is a description for Product 2.",
                "image" => "product2.jpg"
            ],
            [
                "name" => "Product 2",
                "price" => "$200",
                "description" => "This is a description for Product 2.",
                "image" => "product2.jpg"
            ],
            [
                "name" => "Product 2",
                "price" => "$200",
                "description" => "This is a description for Product 2.",
                "image" => "product2.jpg"
            ],
            // Add more products as needed
        ];
        ?>

        <div class="container">
            <div class="row">
                <?php foreach ($products as $product): ?>
                <div class="col-md-6">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <img src="https://www.shutterstock.com/image-vector/default-avatar-profile-icon-grey-260nw-769594684.jpg"
                                        class="img-fluid" alt="<?php echo $product['name']; ?>">
                                </div>
                                <div class="col-6">
                                    <h5 class="card-title"><?php echo $product['name']; ?></h5>
                                    <p class="card-text"><?php echo $product['description']; ?></p>
                                    <p class="card-text"><small
                                            class="text-muted"><?php echo $product['price']; ?></small></p>
                                    <button type="button" class="btn btn-primary">Add to Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <hr>
        <div class="p-1">
            <h3>Store</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic dolor delectus possimus ullam vero odit?</p>
            <p> tel : 456854854</p>
            <p> email : 456854854</p>
        </div>

    </div>




    <?php include_once("bottom.php");?>
    <script>
    var splide = new Splide('.splide', {
        type: 'loop',
        autoplay: true,
        pagination: false,
        autoWidth: true,
        arrows: false,
        gap: 10
    });
    splide.mount();

    function filterFunction() {
        var input, filter, a, i;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        div = document.getElementById("dropdownMenuButton");
        a = div.getElementsByTagName("a");
        for (i = 0; i < a.length; i++) {
            txtValue = a[i].textContent || a[i].innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                a[i].style.display = "";
            } else {
                a[i].style.display = "none";
            }
        }
    }
    </script>
</body>

</html>