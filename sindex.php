<!-- User Login, username and password required -->
<?php
require_once('conn/connect.php');
session_start();

$msg = '';
$msgAlert = '';

// Check if button is set
if (isset($_POST['btnLog'])) {
	// Gathering of data
	$usr = mysqli_real_escape_string($CON, $_POST['txtUsr']);
	$pas = mysqli_real_escape_string($CON, $_POST['txtPas']);

	// Check for blank entry
	if (empty($usr) || empty($pas)) {
		$msg = 'Please fill in all the fiedls';
		$msgAlert = 'alert-danger';
	} else {
		// Check if user accout is already active.
		$query = "SELECT * FROM tblcurrent WHERE username = '$usr'";
		$result = mysqli_query($CON, $query);
		$resultCheck = mysqli_num_rows($result);
		if ($resultCheck >= 1) {
			$msg = 'User account already active!';
			$msgAlert = 'alert-danger';
		} else {
			// Check for a user match in tbluser
			$querySel = "SELECT * FROM tbluser WHERE username = '$usr'";
			$queryRes = mysqli_query($CON, $querySel);
			$resultRes = mysqli_num_rows($queryRes);
			// No match found
			if ($resultRes < 1) {
				$msg = 'No results found, Try something else!';
				$msgAlert = 'alert-danger';
			} else {
				// De-hashed password and create a session variable
				if ($row = mysqli_fetch_assoc($queryRes)) {
					$hash = password_verify($pas, $row['password']);
					if ($hash == false) {
						$msg = 'Invalid username or password, Try again!';
						$msgAlert = 'alert-danger';
					} else if ($hash == true) {
						// Fetch a data to be use in creating session variable
						$_SESSION['id'] = $row['id'];
						$_SESSION['fname'] = $row['fname'];
						$_SESSION['mname'] = $row['mname'];
						$_SESSION['lname'] = $row['lname'];
						$_SESSION['user'] = $row['username'];
						$_SESSION['pass'] = $row['password'];
						$_SESSION['gtype'] = $row['gtype'];
						$_SESSION['role'] = $row['role'];
						$_SESSION['picture'] = $row['picture'];
						// 
						// Use to get the current date and time PHP
						date_default_timezone_set('Asia/Manila');
						$today = date('Y-m-d');
						$clock = date('h:i:s');

						// Insert a copy of data to tblcurrent
						$sqlIns = "INSERT INTO tblcurrent(fname, mname, lname, username, password, gtype, role, picture, timer, dater) VALUES(?,?,?,?,?,?,?,?,?,?)";
						$stmt = mysqli_stmt_init($CON);
						if (!mysqli_stmt_prepare($stmt, $sqlIns)) {
							$msg = 'There was a problem inserting your data.';
							$msgAlert = 'alert-danger';
						} else {
							mysqli_stmt_bind_param($stmt, "ssssssssss", $row['fname'], $row['mname'], $row['lname'], $row['username'], $row['password'], $row['gtype'], $row['role'], $row['picture'], $clock, $today);
							mysqli_stmt_execute($stmt);
							mysqli_stmt_close($stmt);
						}
						// Insert a copy data to tblhistory
						$sqlIns = "INSERT INTO tblhistory(fname, mname, lname, username, password, gtype, role, picture, timer, dater) VALUES(?,?,?,?,?,?,?,?,?,?)";
						$stmt = mysqli_stmt_init($CON);
						if (!mysqli_stmt_prepare($stmt, $sqlIns)) {
							$msg = 'There was an error inserting your data.';
							$msgAlert = 'alert-danger';
						} else {
							mysqli_stmt_bind_param($stmt, "ssssssssss", $row['fname'], $row['mname'], $row['lname'], $row['username'], $row['password'], $row['gtype'], $row['role'], $row['picture'], $clock, $today);
							mysqli_stmt_execute($stmt);
							mysqli_stmt_close($stmt);
						}
						// Redirect to Dashboard (Main page)
						header("Location: dashboard.php");
					}
				}
			}
		}
	}
}
?>

<!DOCTYPE html>
<html>

<head>
	<title>Login Form</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/all.css">
	<link rel="stylesheet" href="css/style.css">
	<link href="img/logo/iconer.ico" rel="icon" type="image/ico">
</head>

<body>
	<div class="container-fluid">
		<div class="row">
			<!-- Left column -->
			<div class="col-lg-6 col-md-6 d-none d-md-block image-container"></div>
			<!-- Right column -->
			<div class="col-lg-6 col-md-6 form-container">
				<div class="col-lg-8 col-md-12 col-sm-9 col-xs-12 form-box text-center">
					<!-- Message alert box start -->
					<div class="container text-center">
						<?php if ($msg != '') : ?>
							<div class="alert <?php echo $msgAlert; ?>" role="alert">
								<?php echo $msg; ?>
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
						<?php endif; ?>
					</div>
					<!-- Message alert box end -->
					<div class="logo mb-3">
						<img src="img/logo/circlelogo.png" width="150px">
					</div>
					<div class="heading mb-4">
						<h4>Login into your account</h4>
					</div>
					<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
						<div class="form-input">
							<span><i class="fa fa-user"></i></span>
							<input type="text" name="txtUsr" id="txtUsr" placeholder="Username" autocomplete="off" required>
						</div>
						<div class="form-input">
							<span><i class="fa fa-lock"></i></span>
							<input type="password" name="txtPas" id="txtPas" placeholder="Password" autocomplete="off" required>
						</div>
						<div class="row mb-3">
						</div>
						<div class="text-left mb-3">
							<input type="submit" name="btnLog" id="btnLog" value="Login" class="btn btn-primary btn-lg w-100 shadow">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<script src="js/jquery.slim.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.js"></script>
	<script src="js/all.js"></script>
</body>

</html>