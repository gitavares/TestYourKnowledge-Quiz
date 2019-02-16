<aside class="side">
    <div class="header">
        <div class="brand">
            <h1><span class="brand-title">
                <a class="brand-title-link" href="dashboard.php" title="Back to Dahsboard Page">Test<br>Your<br>Knowledge</a>
                <a class="brand-title-link-small" href="dashboard.php" title="Back to Dahsboard Page">T</a>
            </span></h1>
        </div>
    </div>

    <?php
        if(!$_SESSION['admin']) { 
    ?>
    <div class="main-menu">
        <a href="dashboard.php" title="Dashboard" class="link-side-menu"><i class="fas fa-tachometer-alt"></i> <span class="menu-text">Dashboard</span></a>
        <a href="take-a-test.php" title="Make a Test" class="link-side-menu"><i class="fas fa-edit"></i> <span class="menu-text">Take a Test</span></a>
    </div>
    <?php
        } else {
    ?>
    <div class="main-menu">
        <a href="admin/admin-dashboard.php" title="Dashboard" class="link-side-menu"><i class="fas fa-tachometer-alt"></i> <span class="menu-text">Dashboard</span></a>
        <a href="admin/admin-tests-list.php" title="Tests" class="link-side-menu"><i class="fas fa-edit"></i> <span class="menu-text">Tests</span></a>
        <a href="admin/admin-categories-list.php" title="Categories" class="link-side-menu"><i class="fas fa-tags"></i> <span class="menu-text">Categories</span></a>
        <a href="admin/admin-users-stats.php" title="Users Stats" class="link-side-menu"><i class="fas fa-users"></i> <span class="menu-text">Users Stats</span></a>
    </div>
    <?php
        }
    ?>
    <div class="footer-menu">               
        <a href="user-edit.php" title="Edit Profile" class="link-side-menu"><i class="fas fa-user-edit"></i> <span class="menu-text">Edit Profile</span></a>
        <a href="user-edit-password.php" title="Change Password" class="link-side-menu"><i class="fas fa-key"></i> <span class="menu-text">Change Password</span></a>
        <a href="logout.php" title="Logout" class="link-side-menu"><i class="fas fa-sign-out-alt"></i> <span class="menu-text">Logout</span></a>
    </div>
    
</aside>