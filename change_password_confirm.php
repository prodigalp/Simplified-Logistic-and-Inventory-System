<!-- Logic -->
<!-- 1. Check if username and password is in the database -->
<!-- 2. Check for equality of new and verify password -->
<!-- 3. Check if new password is not the same in old password -->
<!-- 4.  -->
<?php
session_start();
require_once('conn/connect.php');
if (
    $_SESSION['role'] == '3' || $_SESSION['role'] == '4' ||
    $_SESSION['role'] == '2' || $_SESSION['role'] == '1'
) {
    include_once('inc/header.php');
    function messageAlert($mes, $loc)
    {
        echo "
            <script>
            alert('$mes');
            window.location='$loc';
            </script>
        ";
    }
    $usr = mysqli_real_escape_string($CON, $_POST['txtUsr']);
    $old = mysqli_real_escape_string($CON, $_POST['txtOld']);
    $new = mysqli_real_escape_string($CON, $_POST['txtNew']);
    $ver = mysqli_real_escape_string($CON, $_POST['txtVer']);

    // Check for the existence of username and password
    $queryOne = "SELECT * FROM tbluser WHERE username = ?";
    $stmt = mysqli_stmt_init($CON);
    if (!mysqli_stmt_prepare($stmt, $queryOne)) {
        messageAlert('Query request Error', 'change_password.php');
    } else {
        mysqli_stmt_bind_param($stmt, "s", $usr);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);    // Use for stmt_num_rows
        $resultRow = mysqli_stmt_num_rows($stmt);
        if ($resultRow >= 1) {
            // Bind use for stmt_get_result
            mysqli_stmt_bind_param($stmt, "s", $usr);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_assoc($result)) {
                $hashNew = password_hash($new, PASSWORD_DEFAULT);
                $hashVer = password_hash($ver, PASSWORD_DEFAULT);
                $hashOld = password_verify($old, $row['password']);
                $idUp    = $row['id'];
                if ($hashOld == false) {
                    messageAlert('Invalid Old Password', 'change_password.php');
                } else {
                    // Check for equality of new and confirm password
                    if ($new == $ver) {
                        // Check for equality of new and old password.
                        if ($new == $old) {
                            messageAlert('NEW password must NOT be the same with OLD Password', 'change_password.php');
                        } else {
                            // Update User with new password
                            $queryUp = "UPDATE tbluser SET password = ? WHERE id = ?";
                            $stmt = mysqli_stmt_init($CON);
                            if (!mysqli_stmt_prepare($stmt, $queryUp)) {
                                messageAlert('Query request error', 'change_password.php');
                            } else {
                                mysqli_stmt_bind_param($stmt, "si", $hashNew, $idUp);
                                mysqli_stmt_execute($stmt);
                                messageAlert('Password successfully updated!', 'change_password.php');
                            }
                        }
                    } else {
                        messageAlert('New and confirm password did not match!', 'change_password.php');
                    }
                }
            } else {
                messageAlert('Fetch request error!', 'change_password.php');
            }
        } else {
            messageAlert('Unknown user!', 'change_password.php');
        }
        mysqli_stmt_close($stmt);
        mysqli_close($CON);
    }
?>
    <?php include_once('inc/footer.php'); ?>
<?php
} else {
    header("Location: dashboard.php");
}

?>