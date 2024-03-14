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
        <div class="container-fluid col-12 col-md-10 col-lg-8">
            <a class="navbar-brand" href="#">Store</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

      <div class="col-12 col-md-10 col-lg-8 col-xl-6 mx-auto my-1 p-1 bg-light min-h-100 tr-animate">
          <div class=" p-1">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic dolor delectus possimus ullam vero odit?</p>
            <p> tel : 456854854</p>
            <p> email : 456854854</p>
          </div>
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
          

      </div>




    <?php include_once("bottom.php");?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
       var splide = new Splide('.splide', {
            type: 'loop',
            autoplay: true,
            pagination: false,
            autoWidth: true,
            arrows: false,
            gap:10
        });
        splide.mount();
    </script>
</body>

</html>