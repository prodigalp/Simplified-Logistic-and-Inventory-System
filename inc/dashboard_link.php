<!-- Additional menu depending on users restriction -->
<?php
if ($_SESSION['role'] == '4' || $_SESSION['role'] == '3') {
    echo ('
            <div class="list-group list-group-flush">
                <a href="dashboard.php" class="list-group-item list-group-item-action bg-warning text-dark"><i class="fas fa-desktop"></i>&nbsp;&nbsp;Dashboard</a>
                <a href="#" class="list-group-item list-group-item-action bg-warning text-dark"><i class="fa fa-hospital"></i>&nbsp;&nbsp;Shortcuts</a>
                <a href="#" class="list-group-item list-group-item-action bg-warning text-dark"><i class="fa fa-dog"></i>&nbsp;&nbsp;Overview</a>
                <a href="#" class="list-group-item list-group-item-action bg-warning text-dark"><i class="fa fa-cog"></i>&nbsp;&nbsp;Settings</a>
                <a href="#" class="list-group-item list-group-item-action bg-warning text-dark"><i class="fa fa-truck"></i>&nbsp;&nbsp;Courier</a>
                <a href="#" class="list-group-item list-group-item-action bg-warning text-dark"><i class="fa fa-user-shield"></i>&nbsp;&nbsp;Control Panel</a>
                <a href="#" class="list-group-item list-group-item-action bg-warning text-dark"><i class="fa fa-chair"></i>&nbsp;&nbsp;Contacts</a>
                <a href="#" class="list-group-item list-group-item-action bg-warning text-dark"><i class="fa fa-check"></i>&nbsp;&nbsp;Highlights</a>
                <a href="#" class="list-group-item list-group-item-action bg-warning text-dark"><i class="fa fa-chess-bishop"></i>&nbsp;&nbsp;Others</a>
                <a href="#" class="list-group-item list-group-item-action bg-warning text-dark"><i class="fa fa-child"></i>&nbsp;&nbsp;Boards</a>
                <a href="#" class="list-group-item list-group-item-action bg-warning text-dark"><i class="fa fa-city"></i>&nbsp;&nbsp;Concerns</a>
                </div>
    ');
}

if ($_SESSION['role'] == '2' || $_SESSION['role'] == '1') {
    echo ('
            <div class="list-group list-group-flush">
                <a href="dashboard.php" class="list-group-item list-group-item-action bg-warning text-dark"><i class="fas fa-desktop"></i>&nbsp;&nbsp;Dashboard</a>
                <a href="#" class="list-group-item list-group-item-action bg-warning text-dark"><i class="fa fa-hospital"></i>&nbsp;&nbsp;Shortcuts</a>
                <a href="#" class="list-group-item list-group-item-action bg-warning text-dark"><i class="fa fa-dog"></i>&nbsp;&nbsp;Overview</a>
                <a href="#" class="list-group-item list-group-item-action bg-warning text-dark"><i class="fa fa-cog"></i>&nbsp;&nbsp;Settings</a>
                <a href="#" class="list-group-item list-group-item-action bg-warning text-dark"><i class="fa fa-truck"></i>&nbsp;&nbsp;Courier</a>
            </div>
    ');
}
