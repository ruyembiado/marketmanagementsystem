<!-- Footer -->
<div class="foot p-3" style="background-color: #001427;">
    <div class="row">
        <div class="col-12 col-sm-6 text-center text-sm-start">
            &copy; <a href="#" style="color: #F4D58D;" class="">Web-based Market Product Monitoring System</a>, All
            Right Reserved.
        </div>
    </div>
</div>
<!-- Footer -->
</div>
<!-- Content -->
</div>
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
<script src="js/main.js"></script>
<script src="js/jquery.js"></script>
<script src="js/datatables.js"></script>
<script src="js/datatables.min.js"></script>
<script src="js/checkExpiration.js"></script>
<script src="js/stallDetails.js"></script>
<script src="js/sweetalert2.min.js"></script>
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
</body>

</html>