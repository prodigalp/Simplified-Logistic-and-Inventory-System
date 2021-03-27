<!-- Additional menu for user control depending on users restriction -->
<?php
// Option for user control
if ($_SESSION['role'] == '4' || $_SESSION['role'] == '3') {
    echo ('
    <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Profile">
        <i class="fas fa-user"></i>
    </a>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="adduser.php"><i class="fas fa-user-plus"></i>&nbsp;&nbsp;Sign-Up</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="control_user.php"><i class="fas fa-remove-format"></i>&nbsp;&nbsp;User Control</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#"><i class="fas fa-pen"></i>&nbsp;&nbsp;User Profile</a>
    </div>
</li>
    ');
}
