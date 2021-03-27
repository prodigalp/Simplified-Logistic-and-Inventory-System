<!-- User deleted to the database including profile image -->
<?php
session_start();
require_once('conn/connect.php');
if ($_SESSION['role'] == '4' || $_SESSION['role'] == '3') {
    // Get the value of id
    $id = $_GET['id'];
    if (!is_numeric($id)) {
        echo ("
        <script>
        alert('Data is not a number');
        window.location='control_user.php';
        </script>
        ");
    }
    // --- START -->
    // This will delete the file inside the folder
    $querySel = "SELECT picture FROM tbluser WHERE id = ?";
    $stmt = mysqli_stmt_init($CON);
    if (!mysqli_stmt_prepare($stmt, $querySel)) {
        echo ("
            <script>
            alert('Something went wrong while deleting profile picture');
            window.location='control_user.php';
            </script>
        ");
    } else {
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);
    }
    while ($row = mysqli_fetch_object($result)) {
        $imgFile = $row->picture;
    }
    // This will delete the user's profile image
    unlink("img/user_img/" . $imgFile);

    // --- END -->

    // This will delete the file inside the dabase.
    $query = 'DELETE FROM tbluser WHERE id = ?';
    $stmt = mysqli_stmt_init($CON);
    if (!mysqli_stmt_prepare($stmt, $query)) {
        echo ("
            <script>
            alert('Query request error!');
            window.location='control_user.php';
            </script>
            ");
    } else {
        mysqli_stmt_bind_param($stmt, "s", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);
    }
    include('inc/header.php');
?>
    <div class="card w-50 mx-auto mt-4 text-center">
        <h5 class="card-header text-center bg-success text-white text-uppercase">Alert!</h5>
        <div class="card-body">
            <h5 class="card-title">Record successfuly Deleted!</h5>
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