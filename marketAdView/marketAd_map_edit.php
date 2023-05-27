<?php

@include '../includes/marketAd.header.php';

?>

<div class="row justify-content-center mx-0">
    <div class="form-group mx-5">
        <div class="btn-group p-2">
            <a class="btn btn-primary text-light button-size px-4" href="marketAd_map.php" role="button"><i class="fa fa-arrow-left"></i> Back</a>
        </div>
    </div>
    <div class="col-md-5 p-5 mb-5 align-items-center justify-content-center text-dark rounded" style="height: 350px; background-color: #708D81;">

        <form action="../includes/marketAd.crud.php" method="post" enctype="multipart/form-data">
            <div>
                <div class="form-group row">
                    <label>
                        <p style="color:#001427; font-size: 20px;" class="mb-0 text-center mt-2">Update Market Map</h4>
                    </label>
                </div>
                <?php

                $map_ID = $_GET['edit_map'];

                $sql = "SELECT * FROM map WHERE map_ID ='$map_ID'";
                $result2 = mysqli_query($conn, $sql);

                while ($row = mysqli_fetch_assoc($result2)) {

                    $map_ID = $row['map_ID'];
                    $map_name = $row['map_name'];
                    $map_floor = $row['map_floor'];
                    $path = $row['map_img'];
                }
                ?>
                <div class="d-flex flex-row justify-content-evenly">
                    <div class="form-group mb-2 me-1">
                        <label style="color:#001427; " class="text-size">Map Name:</label>
                        <input class="form-control text-dark" type="text" name="map_name" required placeholder="Enter your map name" value="<?php echo $map_name; ?>">
                    </div>
                    <div class="form-group mb-2">
                        <label style="color:#001427; " class="text-size">Floor:</label>
                        <input class=" form-control text-dark" type="number" name="map_floor" required placeholder="Enter your map floor" value="<?php echo $map_floor; ?>">
                    </div>
                </div>

                <div class="form-group mb-2">
                    <label style="color:#001427; " class="text-size">Market Map:</label>
                    <input type="hidden" id="myFilePath" value="">
                    <input id="myFileInput" class="form-control text-dark" type="file" name="path">
                </div>

                <div class="form-group mb-5">
                    <div class="row m-auto">
                        <input type="hidden" name="current_path" value="<?php echo $path; ?>">
                        <input type="hidden" name="map_ID" value="<?php echo $map_ID; ?>" />
                        <input class="text-light button-size btn btn-primary" type="submit" name="update_map" value="Update">
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>

<script>
    const filePath = document.getElementById('myFilePath').value;
    const fileInput = document.getElementById("myFileInput");

    if (filePath) {
        // extract file name from path
        const fileName = filePath.split('../').pop().split('\\').pop();

        // create a fake file object to pass to the mapInput
        const file = new File([fileName], {
            type: "text/plain"
        });

        // set the mapInput value to the fake file object
        fileInput.files = [file];

        // display the file name in the mapInput field
        fileInput.nextElementSibling.innerHTML = fileName;
    }
</script>

<?php

@include '../includes/all.footer.php';

?>