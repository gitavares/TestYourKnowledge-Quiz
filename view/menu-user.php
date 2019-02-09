<aside class="side">
    <div class="header">
        <div class="brand">
            <h1><span class="brand-title"><a class="brand-title-link" href="<?php echo getUrlDirPath(); ?>dashboard" title="Back to Dahsboard Page">Test<br>Your<br>Knowledge</a></span></h1>
        </div>
        <div class="collapsed-menu">=</div>
    </div>

    <?php
        if(!$_SESSION['admin']) { 
    ?>
    <div class="main-menu">
        <a href="<?php echo getUrlDirPath(); ?>dashboard" title="Dashboard" class="link-side-menu">Dashboard</a>
        <a href="<?php echo getUrlDirPath(); ?>take-a-test" title="Make a Test" class="link-side-menu">Take a Test</a>
    </div>
    <?php
        } else {
    ?>
    <div class="main-menu">
        <a href="<?php echo getUrlDirPath(); ?>admin/admin-dashboard.php" title="Dashboard" class="link-side-menu">Dashboard</a>
        <a href="<?php echo getUrlDirPath(); ?>admin/admin-tests-list.php" title="Tests" class="link-side-menu">Tests</a>
        <a href="<?php echo getUrlDirPath(); ?>admin/admin-tests-history.php" title="Tests History" class="link-side-menu">Tests History</a>
        <a href="<?php echo getUrlDirPath(); ?>admin/admin-users-list.php" title="Users" class="link-side-menu">Users</a>
    </div>
    <?php
        }
    ?>
    <div class="footer-menu">               
        <a href="<?php echo getUrlDirPath(); ?>user-edit" title="Edit Profile" class="link-side-menu">Edit Profile</a>
        <a href="<?php echo getUrlDirPath(); ?>user-edit-password" title="Change Password" class="link-side-menu">Change Password</a>
        <a href="<?php echo getUrlDirPath(); ?>logout.php" title="Logout" class="link-side-menu">Logout</a>
    </div>
    
</aside>