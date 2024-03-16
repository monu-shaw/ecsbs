let table = new DataTable('#myTable',{
    searching: false,
    paging:false
});
$(document).ready(function() {
    $('#myForm').on('submit',async function(e) {
        e.preventDefault(); 
        if(isEditing){
            return PostDATA();
        }
        var formData = new FormData()
        var imageFile = $('#image')[0].files[0];
        formData.append("image",imageFile)

        // Upload image to Imgur
        const response = await fetch('https://api.imgbb.com/1/upload?key=4b1af61ccb28e1c6d7337ab65bef08fb', {
            method: 'POST',
            body: formData
        });

        const json = await response.json();

        if (response.ok) {
            PostDATA(json)
        } else {
            alert("Upload failed");
        }
    });
});

function deleteItem(id, type="product", callback = ()=>location.reload()) {
    if (!confirm('Are you sure you want to delete this item?')) return;
    let url = type.toLocaleLowerCase() === 'category' ? 'category' : 'product';
    var data = {
        id: id,
        type:url,
        del:"delete"
    };

    $.ajax({
        url: 'server.php',
        type: 'POST',
        data: data,
        dataType: 'json',
        encode: true,
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