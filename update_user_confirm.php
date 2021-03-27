<!-- If new image inserted, check the image first for verification and
If there is no new image update directly the the database using the data -->
<?php
session_start();
require_once('conn/connect.php');
if ($_SESSION['role'] == '3' || $_SESSION['role'] == '4') {
    include('inc/header.php');
    // Gathering of data
    $id  = mysqli_real_escape_string($CON, $_POST['txtId']);
    $fnm = mysqli_real_escape_string($CON, $_POST['txtFnm']);
    $mnm = mysqli_real_escape_string($CON, $_POST['txtMnm']);
    $lnm = mysqli_real_escape_string($CON, $_POST['txtLnm']);
    $usr = mysqli_real_escape_string($CON, $_POST['txtUsr']);
    $grp = mysqli_real_escape_string($CON, $_POST['txtGrp']);
    $hid = mysqli_real_escape_string($CON, $_POST['txtHide']);
    $pic = $_FILES['txtPic']['name'];
    $rol = '';

    // Insert value to role, depending on the users choice
    if ($grp == 'Admin') {
        $rol = 4;
    } else if ($grp == 'Manager' || $grp == 'Supervisor') {
        $rol = 3;
    } else if ($grp == 'Asistant') {
        $rol = 2;
    } else {
        $rol = 1;
    }
    // Trim names
    $fnm = trim($fnm);
    $mnm = trim($mnm);
    $lnm = trim($lnm);
    // Capitalized 
    $fnm = ucwords($fnm);
    $mnm = ucwords($mnm);
    $lnm = ucwords($lnm);

    // Checking of which data to use during update
    // Update using Previous Image
    if ($pic == '') {
        $query = "UPDATE tbluser SET fname = ?, mname = ?, lname = ?, username = ?, gtype = ?, role = ?, picture = ? WHERE id = ?";
        $stmt = mysqli_stmt_init($CON);
        if (!mysqli_stmt_prepare($stmt, $query)) {
            echo ("
                <script>
                alert('Query request error!');
                window.location='control_user.php';
                </script>
            ");
        } else {
            mysqli_stmt_bind_param($stmt, "sssssisi", $fnm, $mnm, $lnm, $usr, $grp, $rol, $hid, $id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            echo ("
                <script>
                alert('Record successfuly updated, Profile picture retained!');
                window.location='control_user.php';
                </script>
            ");
        }
    } else {
        // Update with New Image
        // Check for proper image 
        if ((($_FILES['txtPic']['type'] == 'image/gif') ||
                ($_FILES['txtPic']['type'] == 'image/jpg') ||
                ($_FILES['txtPic']['type'] == 'image/jpeg') ||
                ($_FILES['txtPic']['type'] == 'image/png') ||
                ($_FILES['txtPic']['type'] == 'image/pjpg')) &&
            ($_FILES['txtPic']['size'] < 50000000)
        ) {
            // Check for image error
            if ($_FILES['txtPic']['error'] > 0) {
                echo ("
                    <script>
                    alert('Error opening image!');
                    window.location='control_user.php';
                    </script>
                ");
            } else {
                // Check if Image already exists in the database
                if (file_exists("img/user_img/" . $_FILES['txtPic']['name'])) {
                    die("
                        <script>
                        alert('Image already exists in the database!');
                        window.location='control_user.php';
                        </script>
                    ");
                } else {
                    // If no problem, Upload image to the database
                    move_uploaded_file($_FILES['txtPic']['tmp_name'], "img/user_img/" . $_FILES['txtPic']['name']);

                    $query = "UPDATE tbluser SET fname = ?, mname = ?, lname = ?, username = ?, gtype = ?, role = ?, picture = ? WHERE id = ?";
                    $stmt = mysqli_stmt_init($CON);
                    if (!mysqli_stmt_prepare($stmt, $query)) {
                        echo ("
                            <script>
                            alert('Query request error!');
                            window.location='control_user.php';
                            </script>
                        ");
                    } else {
                        mysqli_stmt_bind_param($stmt, "sssssisi", $fnm, $mnm, $lnm, $usr, $grp, $rol, $pic, $id);
                        mysqli_stmt_execute($stmt);
                        echo ("
                            <script>
                            alert('Record successfuly Updated!');
                            window.location='control_user.php';
                            </script>
                        ");
                        mysqli_stmt_close($stmt);
                    }
                }
            }
        } else {
            die("
                <script>
                alert('Invalid picture format!');
                window.location='control_user.php';
                </script>
            ");
        }
    }
?>
    <?php include('inc/footer.php'); ?>
<?php
} else {
    header("Location: update_user_verify.php");
}
?>

<!-- 
$id 
$fnm
$mnm
$lnm
$usr
$grp
$hid
$pic
$rol

// echo 'Control # : ' . $id . '<br>';
    // echo 'Firstname : ' . $fnm . '<br>';
    // echo 'Middle : ' . $mnm . '<br>';
    // echo 'Last : ' . $lnm . '<br>';
    // echo 'username : ' . $usr . '<br>';
    // echo 'Gtype : ' . $grp . '<br>';
    // echo 'Role : ' . $rol . '<br>';
    // echo 'OLD Picture : ' . $hid . '<br>';
    // echo 'New Picture : ' . $pic . '<br>';
    // echo 'Final Picture : ' . $usePic;
    
    // Check which picture value to use
    // if ($pic == '') {        // If no new picture, use the original image
    // $usePic = $hid;
    // } else {
    // $usePic = $pic; // else, update user image
    // } -->