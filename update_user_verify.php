<!-- Update profile search and view -->
<?php
session_start();
include('inc/header.php');
if ($_SESSION['role'] == '3' || $_SESSION['role'] == '4') {
    require_once('conn/connect.php');

    $id = $_GET['id'];
    if (!is_numeric($id)) {
        echo ("
        <script>
        alert('Data is not a number');
        window.location='control_user.php';
        </script>
    ");
    }
    // Use to fetch the data of a specied user.
    $query = "SELECT * FROM tbluser WHERE id = ?";
    $stmt = mysqli_stmt_init($CON);
    if (!mysqli_stmt_prepare($stmt, $query)) {
        echo ("
        <script>
        alert('Query Requesting error!');
        window.location='control_user.php';
        </script>
    ");
    } else {
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_object($result);
        mysqli_stmt_close($stmt);
    }
?>
    <div class="container-fluid">
        <div class="row">
            <div class="container w-75 border rounded p-3 mb-0 mt-4 shadow h-100">
                <h2 class="bg-warning text-center text-white  mb-0 p-2">Personal Record Update</h2>
                <p class="bg-dark text-white lead pl-3 mb-3">Personal Information :</p>
                <form action="update_user_confirm.php" method="POST" enctype='multipart/form-data'>
                    <!-- Profile Picture Retain -->
                    <input type="hidden" name="txtHide" id="txtHide" value="<?php echo $row->picture; ?>">

                    <!-- User ID -->
                    <input type="hidden" name="txtId" id="txtId" value="<?php echo $row->id; ?>">

                    <div class="form-row mb-1">
                        <div class="col-sm-12 col-md-12 col-lg-4 mb-2">
                            <input type="text" class="form-control" name="txtFnm" id="txtFnm" autocomplete="off" value="<?php echo $row->fname; ?>" required>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-4 mb-2">
                            <input type="text" class="form-control" name="txtMnm" id="txtMnm" autocomplete="off" value="<?php echo $row->mname; ?>" required>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-4 mb-2">
                            <input type="text" class="form-control" name="txtLnm" id="txtLnm" value="<?php echo $row->lname; ?>" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="form-row mb-2">
                        <div class="col-sm-12 col-md-12 col-lg-12 mb-2">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Username</span>
                                </div>
                                <input type="text" class="form-control" name="txtUsr" id="txtUsr" value="<?php echo $row->username; ?>" autocomplete="off" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-row mb-1">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Group</span>
                                </div>
                                <select name="txtGrp" id="txtGrp" class="custom-select">
                                    <option value="<?php echo $row->gtype; ?>" selected="selected">New group (optional)</option>
                                    <option value="Admin">Admin</option>
                                    <option value="Manager">Manager</option>
                                    <option value="Supervisor">Supervisor</option>
                                    <option value="Asistant">Assistant</option>
                                    <option value="Visitor">Visitor</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- New picture insertion (optional) -->
                    <div class="form-row mb-2 px-1">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Picture</span>
                            </div>
                            <div class="custom-file">
                                <input type="file" accept="image/gif,image/jpg,image/jpeg,image/png,image/pjpg" class="custom-file-input" name="txtPic" id="txtPic">
                                <label class="custom-file-label" for="txtPic">Insert new image (optional)</label>
                            </div>
                        </div>
                    </div>
                    <div class="w-100 text-left mt-3 mx-auto text-center">
                        <!-- Cancel button -->
                        <input onclick="location.href='control_user.php';" type="button" data-toggle="modal" data-target="#staticBackdrop" name="btnCan" id="btnCan" class="btn btn-dark btn-lg w-25 shadow" value="Cancel" title="Back to Dashboard">

                        <!-- Submit button -->
                        <input type="submit" data-toggle="modal" data-target="#staticBackdrop" name="btnUpd" id="btnUpd" class="btn btn-primary btn-lg w-25 shadow" value="Update" title="Click to Update this record">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php include('inc/footer.php'); ?>
<?php
} else {
    header('Location: control_user.php');
}
?>