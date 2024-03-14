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
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Add Product
    </button>
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
                                <label for="formFile" class="form-label">Default file input example</label>
                                <input class="form-control" name="image" type="file" id="image">
                            </div>
                            <!-- Name Field -->
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" placeholder="Enter Name">
                            </div>
                            <!-- Hidden SellerId Field -->
                            <input type="hidden" id="sellerId" value="123">
                            <!-- CategoryId Select Field -->
                            <div class="form-group">
                                <label for="categoryId">Category</label>
                                <select class="form-control" id="categoryId">
                                    <option>Select Category</option>
                                    <option value="1">Category 1</option>
                                    <option value="2">Category 2</option>
                                    <option value="3">Category 3</option>
                                </select>
                            </div>
                            <!-- Description Textarea Field -->
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" rows="3"
                                    placeholder="Enter Description"></textarea>
                            </div>
                            <!-- MeasuringUnit Size Field -->
                            <div class="form-group">
                                <label for="measuringUnit">Measuring Unit</label>
                                <input type="text" class="form-control" id="measuringUnit"
                                    placeholder="Enter Measuring Unit">
                            </div>
                            <!-- MeasuringSize Field -->
                            <div class="form-group">
                                <label for="measuringSize">Measuring Size</label>
                                <input type="number" class="form-control" id="measuringSize"
                                    placeholder="Enter Measuring Size">
                            </div>
                            <!-- Submit Button -->
                            <button type="submit" name="addproduct" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <?php include_once("footer.php");?>
    <?php include_once("bottom.php");?>
    <script>
    $(document).ready(function() {
        $('#myForm').on('submit', function(e) {
            e.preventDefault(); // Prevent the default form submission
            var formData = {
                name: $('#name').val(),
                sellerId: $('#sellerId').val(),
                categoryId: $('#categoryId').val(),
                description: $('#description').val(),
                measuringUnit: $('#measuringUnit').val(),
                measuringSize: $('#measuringSize').val(),
                addproduct: "addproduct",
                
            };

            $.ajax({
                type: 'POST',
                url: 'server.php',
                data: formData,
                encode: true,
                success: function(response) {
                    // Handle the response from the server
                    console.log(response);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    // Handle errors
                    console.error(textStatus, errorThrown);
                }
            });
        });
    });
    </script>
</body>

</html>