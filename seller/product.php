<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Product - ECSBS</title>
    <?php include_once("top.php");?>
</head>

<body>
    <?php include_once("header.php");?>
    <?php
        include_once("db.php");
        $table = $db->read_specific("product","sellerId = ?",[$_SESSION["login"]["id"]]);
        $category = $db->read_specific("category","sellerId = ?",[$_SESSION["login"]["id"]]);
        ?>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Product</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <form id="myForm">
                            <div class="form-group">
                                <label for="formFile" class="form-label">Product Image</label>
                                <input class="form-control" name="image" type="file" id="image">
                            </div>
                            <!-- Name Field -->
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" placeholder="Enter Name">
                            </div>
                            <!-- Hidden SellerId Field -->
                            <input type="hidden" id="sellerId" value="<?= $_SESSION["login"]["id"]?>">
                            <input type="hidden" id="id" value="">
                            <!-- CategoryId Select Field -->
                            <div class="form-group">
                                <label for="categoryId">Category</label>
                                <select class="form-control" id="categoryId">
                                    <option>Select Category</option>
                                    <?php
                                        foreach ($category as $item) {
                                                echo '<option value="'.$item["id"].'" >'.$item["name"].'</otion>';
                                            }
                                        ?>
                                </select>
                            </div>
                            <!-- Price -->
                            <div class="form-group">
                                <label for="description">Price</label>
                                <input type="number" class="form-control" name="price" id="price" required>
                            </div>
                            <!-- MRP -->
                            <div class="form-group">
                                <label for="description">MRP</label>
                                <input type="number" class="form-control" name="mrp" id="mrp" required>
                            </div>
                            <!-- MeasuringUnit Size Field -->
                            <div class="form-group">
                                <label for="measuringUnit">Measuring Unit</label>
                                <input type="text" class="form-control" id="measuringUnit"
                                    placeholder="Enter Measuring Unit" required>
                            </div>
                            <!-- MeasuringSize Field -->
                            <div class="form-group">
                                <label for="measuringSize">Measuring Size</label>
                                <input type="number" class="form-control" id="measuringSize"
                                    placeholder="Enter Measuring Size">
                            </div>
                            <!-- Description Textarea Field -->
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" rows="3"
                                    placeholder="Enter Description"></textarea>
                            </div>
                            <!-- Submit Button -->
                            <button type="submit" name="addproduct" class="my-2 btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid my-4 <?php if($table != 0) echo "d-none";?>">
        <h4 class="text-center my-2">No Product Found</h4>
        <div class="col-8 col-md-3 col-xl-2 mx-auto">            
            <button type="button"  class="btn btn-primary d-block w-100" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Add New Product
            </button>
        </div>
    </div>
    <!-- table -->
    <?php include_once("./table.php");?>
    
    <?php if($table !== 0) echo printTable("Product",$table);?>
    <!-- table -->
    <?php include_once("footer.php");?>
    <?php include_once("bottom.php");?>
    <script>
        let isEditing = false;
        let products = <?= json_encode($table)?>;
        
        function PostDATA(json=null){
            if(+$('#price').val() > +$('#mrp').val()){
                Toastify({
                    text: "This is a toast",
                    className:"bg-danger text-light",
                    duration: 3000
                }).showToast();
            }
            var formData = {
                name: $('#name').val(),
                price: $('#price').val(),
                mrp: $('#mrp').val(),
                sellerId: +$('#sellerId').val(),
                categoryId: $('#categoryId').val(),
                description: $('#description').val(),
                measuringUnit: $('#measuringUnit').val(),
                measuringSize: $('#measuringSize').val() ,
            };
            if(isEditing){
                formData.id = $('#id').val()
                formData.editproduct = "editing"
            }else{
                formData.image = json?.data?.url
                formData.addproduct = "addproduct"
            }
            $.ajax({
                type: 'POST',
                url: 'server.php',
                data: formData,
                datatype:"json",
                encode: false,
                success: function(response) {
                    // Handle the response from the server

                    try {
                        let jsn = response
                        if(typeof(response) == 'string'){
                            jsn = JSON.parse(response);
                        }
                        if(jsn?.data == 1){
                            location.reload();
                        }
                    } catch (error) {
                        console.log(error.message);
                        alert("Error , Try Again");
                        location.reload();
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    // Handle errors
                    console.error(textStatus, errorThrown);
                }
            });
        }

        function handleEdit(id) {
            const product = products.find(cat => +cat.id === +id);
            if (product) {
                $('#name').val(product?.name)
                $('#price').val(product?.price),
                $('#mrp').val(product?.mrp),
                $('#sellerId').val(product?.SellerId)
                $('#categoryId').val(product?.CategoryId)
                $('#description').val(product?.Description)
                $('#measuringUnit').val(product?.MeasuringUnit)
                $('#measuringSize').val(product?.MeasuringSize)
                $('#id').val(product?.id)
                isEditing = true;
            }
        }
    
    </script>
</body>

</html>