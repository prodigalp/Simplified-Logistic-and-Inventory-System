<!-- Adding new user -->
<?php
session_start();
if ($_SESSION['role'] == '3' || $_SESSION['role'] == '4') {
?>
    <?php include('inc/header.php'); ?>

    <div class="container-fluid">
        <div class="row">
            <div class="container w-75 border rounded p-3 mb-0 mt-4 shadow h-100">
                <h2 class="bg-warning text-center text-white  mb-0 p-2"><i class="fas fa-street-view"></i>&nbsp;&nbsp;Sign Up Form</h2>
                <p class="bg-dark text-white lead pl-3 mb-3">Personal Information :</p>
                <form action="adduser_verify.php" method="POST" enctype="multipart/form-data">
                    <div class="form-row mb-1">
                        <div class="col-sm-12 col-md-12 col-lg-4 mb-2">
                            <input type="text" class="form-control" name="txtFnm" id="txtFnm" placeholder="First Name" autocomplete="off" required>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-4 mb-2">
                            <input type="text" class="form-control" name="txtMnm" id="txtMnm" placeholder="Middle Name" autocomplete="off" required>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-4 mb-2">
                            <input type="text" class="form-control" name="txtLnm" id="txtLnm" placeholder="Last Name" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="form-row mb-2">
                        <div class="col-sm-12 col-md-12 col-lg-6 mb-2">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Username</span>
                                </div>
                                <input type="text" class="form-control" name="txtUsr" id="txtUsr" placeholder="Hamilton" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-6 mb">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Password</span>
                                </div>
                                <input type="password" class="form-control" name="txtPas" id="txtPas" placeholder="*****" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-row mb-1">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Group</span>
                                </div>
                                <select name="txtGrp" id="txtGrp" class="custom-select" required>
                                    <option value="">Choose...</option>
                                    <option value="Admin">Admin</option>
                                    <option value="Manager">Manager</option>
                                    <option value="Supervisor">Supervisor</option>
                                    <option value="Asistant">Assistant</option>
                                    <option value="Visitor">Visitor</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-row mb-2 px-1">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Picture</span>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="txtPic" id="txtPic" required>
                                <label class="custom-file-label" for="txtPic">Choose file...</label>
                            </div>
                        </div>
                    </div>
                    <div class="w-100 text-left mt-3">
                        <input type="submit" name="btnSnd" id="btnSnd" class="btn btn-primary btn-lg w-25 shadow" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include('inc/footer.php'); ?>
<?php
} else {
    header('location: sindex.php');
}
?>