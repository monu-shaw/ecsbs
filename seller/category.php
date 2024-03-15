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
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Category</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <form id="myForm">
                            <div class="form-group">
                                <label for="categoryName">Category Name</label>
                                <input type="text" class="form-control" id="categoryName" name="categoryName"
                                    placeholder="Enter category name">
                            </div>
                            <input type="hidden" id="sellerId" name="sellerId" value="<?= $_SESSION["login"]["id"]?>">
                            <input type="hidden" id="categoryId" name="categoryId" value="">
                            <div class="form-group">
                                <label for="categoryImage">Category Image</label>
                                <input type="file" class="form-control" id="image" name="image">
                            </div>
                            <button type="submit" class="btn btn-primary my-1">Add</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- table -->
    <?php include_once("./table.php");?>
    <?php if($table !== 0) echo printTable("Category",$table);?>
    <!-- table -->
    <?php include_once("footer.php");?>
    <?php include_once("bottom.php");?>
    <script>
        let categories  = <?= json_encode($table)?>;
        let isEditing =  false
        function handleEdit(id) {
            const category = categories.find(cat => +cat.id === +id);
            console.log(categories);
            if (category) {
                document.getElementById('categoryName').value = category.name;
                document.getElementById('categoryId').value = category.id;
                isEditing = true;
            }
        }
        
        function PostDATA(json=null){
            let f = {}
                if(isEditing){
                    f= {
                        "name":document.getElementById("categoryName").value,
                        "sellerId":document.getElementById("sellerId").value,
                        "categoryId":document.getElementById("categoryId").value,
                        "editcategory":"editcategory"
                    }
                }else{
                    f= {
                    "image":json.data.url,
                    "name":document.getElementById("categoryName").value,
                    "sellerId":document.getElementById("sellerId").value,
                    "addcategory":"addcategory",
                    }
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
        }
</script>
</body>

</html>