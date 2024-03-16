<!-- Tables -->
<?php
function printTable($name,$table){
    $html = '
    <div class="mx-2 overflow-auto card rounded-0 p-1 col-lg-10 col-xl-8 mx-auto">
        <div class="card-header">
            <div class="container-fluid">
                <div class="d-flex flex-column flex-md-row justify-content-between">
                    <div class="">
                        <h4>'.$name.'</h4>
                    </div>
                    <div class="">
                    <button type="button" onclick="document.getElementById("myForm").reset()" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Add '.$name.'
                    </button>
                    </div>
                </div>
            </div>
        </div>
        <table id="myTable" class="table rounded ';
         if($table ==0) $html .= "display-none" ;
        $html .= ' style="width:100%">
            <thead>
                <tr>
                    <th>id</th>
                    <th>image</th>
                    <th>name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>';
                foreach ($table as $item) {
                        // Print each card wrapped in a splide__slide
                        $html .= '<tr>';
                        $html .= '<td>' . $item['name'] . '</td>';
                        $html .= '<td><img src="'.$item["Image"].'" width="50px" height="50px" class="" alt="'.$item["name"].'"/></td>';
                        $html .= '<td>' . $item['name'] . '</td>';
                        $html .= '<td>
                        <div class="gap-2 row mx-0">
                        <button type="button" class="col-5 col-md-3 d-inline btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="handleEdit('.$item["id"].')"><i class="bi bi-pencil-square"></i></button>
                        <button type="button" class="col-5 col-md-3 btn btn-outline-danger" onclick="deleteItem('.$item["id"].',`'.$name.'`)"><i class="bi bi-trash"></i></button>
                        </div>
                        </td>';
                        $html .= '</tr>';
                    }
            $html .= '</tbody>
        </table>
    </div>  
    ';
    return $html;
}
?>
    <!-- Tables -->