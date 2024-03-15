<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>
<script src="https://cdn.datatables.net/2.0.2/js/dataTables.min.js"></script>
        
<script>
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
</script>
