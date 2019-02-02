<?php include "../view/header-admin.php"; ?>
<?php include "../model/connection.php"; ?>
<?php include "../model/users.php"; ?>
<?php include "../model/tests.php"; ?>

<?php

getSession();
if(!$_SESSION['admin']) {
    redirectUserDashboard();
}


?>

<body>
    <div class="container">
        <?php include "../view/menu-admin.php"; ?>
        <main class="main">
            <?php include "../view/welcome.php"; ?>
            <div class="page-title-box">
                <h2 class="page-title">Admin Dashboard</h2>
            </div>
            <div class="test-stats">
                <div class="title-test-container">
                    <span class="title-test">Test: PMP Project Management - PMI</span>
                    <a href="#" class="link-button">Edit</a>
                </div>
                <div class="statistic-admin-box-container">
                    <div id="doing-test" class="statistic-user-box">
                        <span class="statistic-user-box-title">Doing this test now</span>
                        <span class="statistic-user-box-result">3 users</span>
                    </div>
                    <div id="passed-test" class="statistic-user-box">
                        <span class="statistic-user-box-title">Users that passed</span>
                        <span class="statistic-user-box-result">35 users</span>
                    </div>
                    <div id="not-passed-test" class="statistic-user-box">
                        <span class="statistic-user-box-title">Users didn't passed</span>
                        <span class="statistic-user-box-result">15 users</span>
                    </div>
                    <div id="test-average-score" class="statistic-user-box">
                        <span class="statistic-user-box-title">Average score</span>
                        <span class="statistic-user-box-result">7.1</span>
                    </div>
                </div>
            </div>
            <div class="test-stats">
                <div class="title-test-container">
                    <span class="title-test">Test: PMP Project Management - PMI</span>
                    <a href="#" class="link-button">Edit</a>
                </div>
                <div class="statistic-admin-box-container">
                    <div id="doing-test" class="statistic-user-box">
                        <span class="statistic-user-box-title">Doing this test now</span>
                        <span class="statistic-user-box-result">3 users</span>
                    </div>
                    <div id="passed-test" class="statistic-user-box">
                        <span class="statistic-user-box-title">Users that passed</span>
                        <span class="statistic-user-box-result">35 users</span>
                    </div>
                    <div id="not-passed-test" class="statistic-user-box">
                        <span class="statistic-user-box-title">Users didn't passed</span>
                        <span class="statistic-user-box-result">15 users</span>
                    </div>
                    <div id="test-average-score" class="statistic-user-box">
                        <span class="statistic-user-box-title">Average score</span>
                        <span class="statistic-user-box-result">7.1</span>
                    </div>
                </div>
            </div>
            
        </main>
    </div>
</body>
</html>
