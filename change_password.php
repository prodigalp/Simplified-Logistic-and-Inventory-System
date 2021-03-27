<?php
session_start();
require_once('conn/connect.php');
if (
    $_SESSION['role'] == '3' || $_SESSION['role'] == '4' ||
    $_SESSION['role'] == '2' || $_SESSION['role'] == '1'
) {
    include_once("inc/header.php");
?>
    <div class="container w-50 mt-4 shadow pt-2 rounded">
        <div class="row">
            <div class="col-md-12 cold-lg-12">
                <h3 class="mt-2 text-center text-white py-1 bg-warning">Change Password</h3>
                <form action="change_password_confirm.php" method="POST">
                    <div class="form-group ">
                        <input type="text" name="txtUsr" id="txtUsr" class="form-control my-3" placeholder="Username" autocomplete="off" required>

                        <input type="password" name="txtOld" id="txtOld" class="form-control my-3" placeholder="Old Password" autocomplete="off" required>

                        <input type="password" name="txtNew" id="txtNew" placeholder="New Password" class="form-control my-3" autocomplete="off" required>

                        <input type="password" name="txtVer" id="txtVer" placeholder="Verify New Password" class="form-control my-3" autocomplete="off" required>
                        <div class="w-100 text-center">
                            <button type="button" onclick="location.href='dashboard.php';" class="btn btn-dark w-25"><i class="fas fa-arrow-alt-circle-left"></i>&nbsp;&nbsp;Cancel</button>

                            <button name="btnUp" id="btnUp" class="btn btn-primary w-25" type="submit">Submit&nbsp;&nbsp;<i class="fas fa-paper-plane"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php include_once("inc/footer.php");
} else {
    header("Location: dashboard.php");
}

?>