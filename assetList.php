<?php
function displayItem($name, $description, $photoURL, $id) {
    echo '
        <div class="col-md-6">
            <div class="card mb-3" data-id="' . $id . '">
                <img src="' . $photoURL . '" class="card-img-top" alt="' . $name . '">
                <div class="card-body">
                    <h5 class="card-title">' . $name . '</h5>
                    <p class="card-text">' . $description . '</p>
                    <button class="btn btn-danger deleteItemBtn">Delete</button>
                    <button class="btn btn-warning editItemBtn mr-2">Edit</button>
                </div>
            </div>
        </div>';
}
?>
