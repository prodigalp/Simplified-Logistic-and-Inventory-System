<!-- Find a person to delete  -->
<?php
session_start();
require_once('conn/connect.php');
if ($_SESSION['role'] == '4' || $_SESSION['role'] == '3') {
    include('inc/header.php');
?>
    <div class="container-fluid">
        <div class="row">
            <div class="container w-50 border rounded p-3 mb-0 mt-4 shadow h-100">
                <h2 class="bg-warning text-center text-white  mb-0 p-2">User Control Section</h2>
                <p class="bg-dark text-white lead pl-3 mb-3">Search particular user</p>
                <form method="GET">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Enter username" aria-label="Enter Username to delete" aria-describedby="button-addon2" name="txtNme" id="txtNme" autocomplete="off" required>
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit" id="btnSnd" name="btnSnd"><i class="fas fa-search"></i></button>
                            <button class="btn btn-primary" type="button" onclick="location.href='dashboard.php';" id="btnSnd" name="btnSnd" title="Back to Dashboard"><i class="fas fa-window-close"></i></button>
                        </div>
                    </div>
                </form>
                <?php
                if (isset($_GET['btnSnd'])) {
                    // Gathering of data
                    $name = mysqli_real_escape_string($CON, $_GET['txtNme']);
                    $query = "SELECT * FROM tbluser WHERE username LIKE ? && gtype != ?";

                    $grp    = 'Admin';
                    $usr    = $name . '%';      // Concatenation of users entry

                    $stmt = mysqli_stmt_init($CON);
                    if (!mysqli_stmt_prepare($stmt, $query)) {
                        echo ("
                                <script>
                                alert('Query request error!');
                                window.location='control_user.php';
                                </script>
                            ");
                    } else {
                        mysqli_stmt_bind_param($stmt, "ss", $usr, $grp);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                        mysqli_stmt_close($stmt);
                        echo '<table class="table table-hover table-secondary table-sm text-center shadow mb-0">
                                            <thead class="bg-primary text-white text-uppercase">
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Full name</th>
                                                <th scope="col">Username</th>
                                                <th scope="col">Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>';
                        $cntr = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<tr>';
                            // echo '<th scope=row></th>';
                            echo '<td>' . $cntr . '.</td>';
                            echo '<td>' . $row['fname'] . ' ' . $row['mname'] . ' ' . $row['lname'] . '</td>';
                            echo '<td>' . $row['username'] . '</td>';
                            echo '<td>
                            
                            <a class="text-dark" href=delete_user_verify.php?id=' . $row['id'] . "><i class='fas fa-trash-alt' title='Delete this item'></i></a>&nbsp;&nbsp;&nbsp;&nbsp;" .

                                '<a class="text-dark" href=update_user_verify.php?id=' . $row['id'] . "><i class='fas fa-edit' title='Update Record'></i></a>&nbsp;&nbsp; " .

                                '<a class="text-dark" href=password_reset.php?id=' . $row['id'] . "><i class='fas fa-unlock' title='Password Reset'></i></a> " . '</td>';
                            echo '</tr>';
                            $cntr++;
                        }
                        echo 'Total entry found : ' . $cntr -= 1;
                    }
                }
                ?>
                <div class=""></div>
            </div>
        </div>
    </div>

<?php
} else {
    header('Location: sindex.php');
}
?>