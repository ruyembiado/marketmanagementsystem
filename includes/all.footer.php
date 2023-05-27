<!-- Footer -->
<!-- <div class="row m-auto bg-dark p-3">
    <div class="row">
        <div class="col-12 col-sm-6 text-center text-sm-start">
            &copy; <a href="#" style='color:#FFC107'>Web-based Market Product Monitoring System</a>, All
            Right Reserved.
        </div>
    </div>
</div> -->
<!-- Footer -->
</div>
<!-- Content -->
<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- <script src="../public/assets/js/aos.js"></script>
<script src="../public/assets/js/datatables.js"></script>
<script src="../public/assets/js/datatables.min.js"></script>
<script src="../public/assets/js/chartjs.min.js"></script>
<script src="../public/assets/js/chart.js"></script> -->

<!-- Template Javascript -->
<script src="../js/main.js"></script>
<script src="../js/jquery.js"></script>
<script src="../js/datatables.js"></script>
<script src="../js/datatables.min.js"></script>
<script src="../js/checkExpiration.js"></script>
<script src="../js/stallDetails.js"></script>
<script src="../js/sweetalert2.min.js"></script>

<script>
    $(document).ready(function() {
        $("#example").DataTable();
    });
</script>


<script>
    const filePath = document.getElementById('myFilePath').value;
    const fileInput = document.getElementById("myFileInput");

    if (filePath) {
        // extract file name from path
        const fileName = filePath.split('/').pop().split('\\').pop();

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

<!-- <script src="../bootstrap/js/bootstrap.min.js"></script>
            <script src="../js/jquery-3.6.0.min.js"></script> -->
<!-- <?php if (isset($_GET['login'])) { ?>
    <script>
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: '<?php echo $_GET['login'] ?>',
            confirmButtonColor: '#3085d6',
            showConfirmButton: true,
        })
    </script>
<?php } ?> -->
<?php if (isset($_SESSION['success'])) { ?>
    <script>
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: '<?php echo $_SESSION['success']; ?>',
            confirmButtonColor: '#3085d6',
            showConfirmButton: true,
        });
    </script>
    <?php unset($_SESSION['success']); ?>
<?php } ?>

<?php if (isset($_SESSION['error'])) { ?>
    <script>
        Swal.fire({
            position: 'center',
            icon: 'warning',
            title: '<?php echo $_SESSION['error']; ?>',
            confirmButtonColor: '#3085d6',
            showConfirmButton: true,
        });
    </script>
    <?php unset($_SESSION['error']); ?>
<?php } ?>

<script>
    /**logout */
    $(".logout").on("click", function(e) {
        e.preventDefault();
        const href = $(this).attr("href");

        Swal.fire({
            type: "warning",
            icon: "warning",
            title: "Are You Sure?",
            text: "You will be logged out",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes",
            customClass: {
                actions: "my-actions",
                cancelButton: "order-1 right-gap",
                confirmButton: "order-2",
                container: "my-swal",
            },
        }).then((result) => {
            if (result.value) {
                document.location.href = href;
            }
        });
    });
</script>
<script>
    /**delete */
    $(".delete").on("click", function(e) {
        e.preventDefault();
        const href = $(this).attr("href");

        Swal.fire({
            type: "warning",
            icon: "warning",
            title: "Are You Sure?",
            text: "This will be deleted",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes",
            customClass: {
                actions: "my-actions",
                cancelButton: "order-1 right-gap",
                confirmButton: "order-2",
                container: "my-swal",
            },
        }).then((result) => {
            if (result.value) {
                document.location.href = href;
            }
        });
    });
</script>
<script>
    /**cancel */
    $(".cancel").on("click", function(e) {
        e.preventDefault();
        const href = $(this).attr("href");

        Swal.fire({
            type: "warning",
            icon: "warning",
            title: "Are You Sure?",
            text: "This will be cancelled",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes",
            customClass: {
                actions: "my-actions",
                cancelButton: "order-1 right-gap",
                confirmButton: "order-2",
                container: "my-swal",
            },
        }).then((result) => {
            if (result.value) {
                document.location.href = href;
            }
        });
    });
</script>
<script>
    /**remove */
    $(".remove").on("click", function(e) {
        e.preventDefault();
        const href = $(this).attr("href");

        Swal.fire({
            type: "warning",
            icon: "warning",
            title: "Are You Sure?",
            text: "This will be removed",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes",
            customClass: {
                actions: "my-actions",
                cancelButton: "order-1 right-gap",
                confirmButton: "order-2",
                container: "my-swal",
            },
        }).then((result) => {
            if (result.value) {
                document.location.href = href;
            }
        });
    });
</script>
<script>
    /**reject */
    $(".reject").on("click", function(e) {
        e.preventDefault();
        const href = $(this).attr("href");

        Swal.fire({
            type: "warning",
            icon: "warning",
            title: "Are You Sure?",
            text: "This will be rejected",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes",
            customClass: {
                actions: "my-actions",
                cancelButton: "order-1 right-gap",
                confirmButton: "order-2",
                container: "my-swal",
            },
        }).then((result) => {
            if (result.value) {
                document.location.href = href;
            }
        });
    });
</script>
<script>
    /**Deactivate */
    $(".deactivate").on("click", function(e) {
        e.preventDefault();
        const href = $(this).attr("href");

        Swal.fire({
            type: "warning",
            icon: "warning",
            title: "Are You Sure?",
            text: "This will be deactivated",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes",
            customClass: {
                actions: "my-actions",
                cancelButton: "order-1 right-gap",
                confirmButton: "order-2",
                container: "my-swal",
            },
        }).then((result) => {
            if (result.value) {
                document.location.href = href;
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        var activeLink = localStorage.getItem("activeLink");
        if (activeLink) {
            $("#" + activeLink).addClass("active");
        }
    });
    $(document).ready(function() {
        $(".Links").on("click", function(e) {
            e.preventDefault();
            const href = $(this).attr("href");
            var activeLink = $(this).attr("id");
            localStorage.setItem("activeLink", activeLink);
            document.location.href = href;
        });
    });
</script>

</html>