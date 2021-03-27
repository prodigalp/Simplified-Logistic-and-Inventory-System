<!-- Verification if a certain user will be granted an account -->
<?php
session_start();
require_once('conn/connect.php');

// Check for user restriction
if ($_SESSION['role'] == '3' || $_SESSION['role'] == '4') {
    // Check for button click
    if (isset($_POST['btnSnd'])) {
        // Gathering of data
        $fnm = mysqli_real_escape_string($CON, $_POST['txtFnm']);
        $mnm = mysqli_real_escape_string($CON, $_POST['txtMnm']);
        $lnm = mysqli_real_escape_string($CON, $_POST['txtLnm']);
        $usr = mysqli_real_escape_string($CON, $_POST['txtUsr']);
        $pas = mysqli_real_escape_string($CON, $_POST['txtPas']);
        $grp = mysqli_real_escape_string($CON, $_POST['txtGrp']);
        $pic = $_FILES['txtPic']['name'];
        $rol = '';
        // Insert value to role, depending on the users choice
        if ($grp == 'Admin') {
            $rol = 4;
        } else if ($grp == 'Manager' || $grp == 'Supevrisor') {
            $rol = 3;
        } else if ($grp == 'Asistant') {
            $rol = 2;
        } else {
            $rol = 1;
        }
        // Trim white spaces
        $fnm = trim($fnm);
        $mnm = trim($mnm);
        $lnm = trim($lnm);
        // Capitalize the first letter of a word
        $fnm = ucwords($fnm);
        $mnm = ucwords($mnm);
        $lnm = ucwords($lnm);

        // Check for duplicate value
        $sqlSel = "SELECT * FROM tbluser WHERE fname = ? && mname = ? && lname = ? && username = ? && password = ? && gtype = ? && role = ? && picture = ?";
        $stmt = mysqli_stmt_init($CON);
        if (!mysqli_stmt_prepare($stmt, $sqlSel)) {
            echo ("
                <script>
                alert('Error making your request!');
                window.location='adduser.php';
                </script>
            ");
        } else {
            // Binding & execute
            mysqli_stmt_bind_param($stmt, "ssssssss", $fnm, $mnm, $lnm, $usr, $pas, $grp, $rol, $pic);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $result = mysqli_stmt_num_rows($stmt);
            // Check for duplicate entry
            if ($result >= 1) {
                echo ("
                    <script>
                    alert('Name already exists in the database!');
                    window.location='adduser.php';
                    </script>
                ");
            } else {
                // Validate Picture and insert new user record
                //  Check for proper Image type first.
                if ((($_FILES['txtPic']['type'] == 'image/gif') ||
                        ($_FILES['txtPic']['type'] == 'image/jpg') ||
                        ($_FILES['txtPic']['type'] == 'image/jpeg') ||
                        ($_FILES['txtPic']['type'] == 'image/png') ||
                        ($_FILES['txtPic']['type'] == 'image/pjpg')) &&
                    ($_FILES['txtPic']['size'] < 50000000)
                ) {
                    // Check for error in loading image
                    if ($_FILES['txtPic']['error'] > 0) {
                        die("
                        <script>
                        alert('There was an error loading picture!');
                        window.location='adduser.php';
                        </script>
                        ");
                    } else {
                        // Check for IMAGE if already EXIST
                        if (file_exists("img/user_img/" . $_FILES['txtPic']['name'])) {
                            die("
                                <script>
                                alert('Picture already exist in the database');
                                window.location='adduser.php';
                                </script>
                                 ");
                        } else {
                            // Hash password for security
                            $has = password_hash($pas, PASSWORD_DEFAULT);

                            // If no problem, Upload image to the database
                            move_uploaded_file($_FILES['txtPic']['tmp_name'], "img/user_img/" . $_FILES['txtPic']['name']);

                            // Insertion of data;
                            $sqlIns = "INSERT INTO tbluser(fname, mname, lname, username, password, gtype, role, picture) VALUES(?,?,?,?,?,?,?,?)";
                            $stmt = mysqli_stmt_init($CON);
                            if (!mysqli_stmt_prepare($stmt, $sqlIns)) {
                                echo ("
                                    <script>
                                    alert('There was an error executing your query!');
                                    window.location='adduser.php';
                                    </script>
                                ");
                            } else {
                                // Bind insertion query
                                mysqli_stmt_bind_param($stmt, "ssssssss", $fnm, $mnm, $lnm, $usr, $has, $grp, $rol, $pic);
                                mysqli_stmt_execute($stmt);
                                mysqli_stmt_close($stmt);
                            }
                            echo ("
                                <script>
                                alert('New record successfuly inserted!');
                                window.location='adduser.php';
                                </script>
                                ");
                        }
                    }
                } else {
                    // Invalid image type.
                    die("
                        <script>
                        alert('Invalid picture format!');
                        window.location='adduser.php';
                        </script>
                    ");
                }
            }
        }
    }
} else {
    header('location: sindex.php');
}
