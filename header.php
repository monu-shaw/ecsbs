<nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid col-12 col-md-10 col-lg-8 col-xl-6">
            <a class="navbar-brand ft-bold" href="<?=$base?>home/<?=$store[0]["slug"]?>"><?= $store[0]["businessName"] ?></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                </ul>                
                <a href="<?=$base?>cart/<?=$store[0]["slug"]?>" class=""><button class="btn btn-outline-success mx-md-1 my-1 my-md-0" type="button">
                    <i class="bi bi-cart"></i>
                </button></a>
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