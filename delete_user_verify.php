<!-- Verify if a user will be deleted -->
<?php
session_start();
require_once('conn/connect.php');
if ($_SESSION['role'] == '4' || $_SESSION['role'] == '3') {

    $id = $_GET['id'];

    if (!is_numeric($id)) {
        echo ("
            <script>
            alert('Data is not a number');
            window.location='control_user.php';
            </script>
        ");
    }
    $query = 'SELECT * FROM tbluser WHERE id = ?';
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
        $row = mysqli_fetch_assoc($result);
    }
    include('inc/header.php');
?>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <div class="card w-50 mx-auto mt-4 text-center">
            <h5 class="card-header text-center bg-danger text-white text-uppercase">Warning!</h5>
            <div class="card-body">
                <h5 class="card-title">Do you really want to delete this record?</h5>
                <p class="card-text lead"><?php echo $row['fname'] . ' ' . $row['mname'] . ' ' . $row['lname']; ?></p>
                <a href="control_user.php" class="btn btn-dark"><i class="fas fa-arrow-alt-circle-left"></i>&nbsp;&nbsp;Back</a>

                <button type="button" onclick="location.href='delete_user_confirm.php?id=<?php echo $row['id'] ?>';" name="btnDel" id="btnDel" class="btn btn-danger"><i class="fas fa-trash"></i>&nbsp;&nbsp;Delete</button>
            </div>
        </div>
    </form>
<?php
    include('inc/footer.php');
} else {
    header('Location: sindex.php');
}
?>