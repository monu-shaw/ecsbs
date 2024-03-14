<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Category - ECSBS</title>
    <?php include_once("top.php");?>
    
</head>
<body>
    <?php include_once("header.php");?>
    <?php
        include_once("db.php");
        $table = $db->read_specific("category","sellerId = ?",[$_SESSION["login"]["id"]]);
    ?>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Add Category
    </button>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Category</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <form id="addCategoryForm">
                            <div class="form-group">
                                <label for="categoryName">Category Name</label>
                                <input type="text" class="form-control" id="categoryName" name="categoryName"
                                    placeholder="Enter category name">
                            </div>
                            <input type="hidden" id="sellerId" name="sellerId" value="<?= $_SESSION["login"]["id"]?>"> <!-- Example sellerId -->
                            <div class="form-group">
                                <label for="categoryImage">Category Image</label>
                                <input type="file" class="form-control" id="categoryImage" name="categoryImage">
                            </div>
                            <button type="submit" class="btn btn-primary my-1">Add</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Tables -->
    <div class="m-1 overflow-auto border">
        <table id="myTable" class="table table-striped <?php if($table ==0) echo "display-none" ;?>" style="width:100%">
            <thead>
                <tr>
                    <th>id</th>
                    <th>image</th>
                    <th>name</th>
                    <th>slug</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($table as $item) {
                        // Print each card wrapped in a splide__slide
                        echo '<tr>';
                        echo '<td>' . $item['name'] . '</td>';
                        echo '<td><img src="'.$item["image"].'" width="50px" height="50px" class="" alt="'.$item["name"].'"/></td>';
                        echo '<td>' . $item['name'] . '</td>';
                        echo '<td>' . $item['slug'] . '</td>';
                        echo '</tr>';
                    }
                ?>
            </tbody>
        </table>
    </div>
    <!-- Tables -->
    <?php include_once("footer.php");?>
    <?php include_once("bottom.php");?>
    <script>
$(document).ready(function() {
    $('#addCategoryForm').on('submit',async function(e) {
        e.preventDefault();
        // let f = {
        //     "image":"json.data.url",
        //     "name":document.getElementById("categoryName").value,
        //     "sellerId":document.getElementById("sellerId").value,
        //     "addcategory":"addcategory",
        // }
        //     $.ajax({
        //             url: 'server.php',
        //             type: 'POST',
        //             data: f,
        //             dataType: 'json',
        //             encode: false,
        //             success: function(response) {
                        
        //                 if(response?.data==1){
        //                     location.reload();
        //                 }
        //             },
        //             error: function(error) {
        //                 console.log(error);
        //             }
        //         });
        //         return;
        var formData = new FormData()
        var imageFile = $('#categoryImage')[0].files[0];
        formData.append("image",imageFile)

        // Upload image to Imgur
        const response = await fetch('https://api.imgbb.com/1/upload?key=4b1af61ccb28e1c6d7337ab65bef08fb', {
            method: 'POST',
            body: formData
        });

        const json = await response.json();

        if (response.ok) {
            let f = {
            "image":json.data.url,
            "name":document.getElementById("categoryName").value,
            "sellerId":document.getElementById("sellerId").value,
            "addcategory":"addcategory",
        }
            $.ajax({
                    url: 'server.php',
                    type: 'POST',
                    data: f,
                    dataType: 'json',
                    encode: false,
                    success: function(response) {
                        if(response.data==1){
                            location.reload();
                        }
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
        } else {
            alert("Upload failed");
        }
                // Send the form data including the image link
                
    });
});
</script>
</body>

</html>