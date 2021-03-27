<!-- Logout function, SESSION's removed -->
<?php
session_start();
if (
    $_SESSION['role'] == '4' || $_SESSION['role'] == '3' ||
    $_SESSION['role'] == '2' || $_SESSION['role'] == '1'
) {
    // Make a connection to database
    require_once('conn/connect.php');
    // Gathering of data
    $fname = $_SESSION['fname'];
    $mname = $_SESSION['mname'];
    $lname = $_SESSION['lname'];
    $user  = $_SESSION['user'];
    $pswd  = $_SESSION['pass'];
    // Query for delete
    $query = "DELETE FROM tblcurrent WHERE fname = ? && mname = ? && lname = ? && username = ? && password = ?";
    $stmt = mysqli_stmt_init($CON);
    if (!mysqli_stmt_prepare($stmt, $query)) {
        echo ("
                <script>
                alert('There is an error in your query');
                window.location = 'sindex.php';
                </script>
            ");
    } else {
        // Binding and execution of query        
        mysqli_stmt_bind_param($stmt, "sssss", $fname, $mname, $lname, $user, $pswd);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        // Removing session variables
        unset($_SESSION['id']);
        unset($_SESSION['fname']);
        unset($_SESSION['mname']);
        unset($_SESSION['lname']);
        unset($_SESSION['user']);
        unset($_SESSION['pass']);
        unset($_SESSION['gtype']);
        unset($_SESSION['role']);
        unset($_SESSION['picture']);
    }
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Logout</title>
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/all.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="icon" href="img/logo/iconer.ico" type="image/ico">
    </head>

    <body>
        <div class="container-fluid logout-img">
            <div class="container">
                <div class="row h-100">
                    <div class="col-sm-12 my-auto">
                        <!-- Center Vertically my-auto-->
                        <!-- Center Horizontally mx-auto -->
                        <div class="card-header p-2 w-50 mx-auto rounded border bg-white shadow">
                            <p class="text-center p-2 text-warning text-uppercase bg-dark rounded mb-1">Message&nbsp;<i class="fas fa-exclamation"></i></p>
                            <div class="card-body p-2">
                                <h4 class="card-title text-center text-success ">Successful Logout&nbsp;&nbsp;<i class="fas fa-check"></i></h4>
                                <p class="card-text lead text-center m-0">Have a nice day!</p>
                                <p class="lead text-center m-2 rounded text-uppercase text-dark"> <?php echo $fname . ' ' . $mname . ' ' . $lname . '&nbsp;&nbsp;&nbsp;'; ?> </p>
                            </div>
                            <a href="sindex.php" class="btn btn-warning w-100 shadow text-white text-uppercase"><i class="fas fa-user-clock"></i>&nbsp;<strong>Login Again</strong></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>

    </html>
<?php
} else {
    header('Location: sindex.php');
}

?>