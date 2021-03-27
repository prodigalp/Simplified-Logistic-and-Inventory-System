<!-- Footer of the page -->
</div>

</div>
<footer class="bg-dark">
    <p class="text-warning text-center py-1">&copy; Copyright <?php echo date('Y'); ?> | Programmer: Karim Abdul V. Tapar</p>
</footer>

<!-- Bootstrap core JavaScript -->
<script src="js/jquery.slim.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/all.js"></script>

<!-- Menu Toggle Script -->
<script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
</script>

<!-- Code if you want the name of the file appear on select -->
<script>
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>

</body>

</html>