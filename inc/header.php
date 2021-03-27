<!-- Footer of the page -->
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Dashboard">
    <meta name="author" content="Ramcar Main Dashboard">
    <title>Main Dashboard</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/sidebar.css" rel="stylesheet">
    <link href="css/all.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="img/logo/iconer.ico" rel="icon" type="image/ico">

</head>

<body>

    <div class="d-flex" id="wrapper">

        <!-- Sidebar -->
        <div class="bg-warning border-right" id="sidebar-wrapper">
            <div class="sidebar-heading"><img src="img/logo/logosm2.png" alt="Ramcar Logo"></div>

            <!-- Dashboard menu depending on users type -->
            <?php include('inc/dashboard_link.php'); ?>

        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">

            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                <button class="btn btn-primary shadow" id="menu-toggle"><i class="fas fa-broom"></i></button>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <p class="p-1 my-0 w-100 text-info">&nbsp;Active User&nbsp;: <?php echo $_SESSION['fname'] . ' ' . $_SESSION['mname'] . ' ' . $_SESSION['lname']; ?></p>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="#" title="Help"><i class="fas fa-question-circle"></i></a>
                        </li>
                        <!-- User Control Start -->
                        <?php include('inc/human_link.php'); ?>

                        <li class="nav-item active">
                            <a class="nav-link" href="#" title="About"><i class="fas fa-address-card"></i><span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Profile">
                                <i class="fas fa-key"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="change_password.php"><i class="fas fa-unlock-alt"></i>&nbsp;&nbsp;Change Password</a>
                                <a class="dropdown-item" href="#"><i class="fas fa-info"></i>&nbsp;&nbsp;User Info</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="logout.php"><i class="fas fa-power-off"></i>&nbsp;&nbsp;Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>