<!-- Password reset confirmation -->
<?php
session_start();
require_once('conn/connect.php');
if ($_SESSION['role'] == '4' || $_SESSION['role'] == '3') {
    // Data
    $rst = mysqli_real_escape_string($CON, $_POST['txtRst']);
    $id  = mysqli_real_escape_string($CON, $_POST['txtId']);
    // Hash
    $hash = password_hash($rst, PASSWORD_DEFAULT);

    $query = "UPDATE tbluser SET password = ? WHERE id = ?";
    $stmt = mysqli_stmt_init($CON);
    if (!mysqli_stmt_prepare($stmt, $query)) {
        echo ("
                 <script>
                 alert('There was an error processing your query!');
                 window.location='control_user.php';
                 </script>
             ");
    } else {
        mysqli_stmt_bind_param($stmt, "si", $hash, $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
    include('inc/header.php');
?>
    <div class="card w-50 mx-auto mt-4 text-center">
        <h5 class="card-header text-center bg-success text-white text-uppercase">Alert!</h5>
        <div class="card-body">
            <h5 class="card-title">Password successfully reset!</h5>
            <p class="card-text lead"></p>
            <a href="control_user.php" class="btn btn-dark btn-lg"><i class="fas fa-arrow-alt-circle-left"></i>&nbsp;&nbsp;Back</a>
        </div>
    </div>
<?php
    include('inc/footer.php');
} else {
    header('Location: sindex.php');
}
?>