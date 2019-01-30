<?php include "../includes/header-admin.php"; ?>
<?php include "../functions/users.php"; ?>

<?php

getSession();
if(!$_SESSION['admin']) {
    redirectDashboard();
}

?>

<body>
    <div class="container">
        <?php include "../includes/menu-admin.php"; ?>
        <main class="main">
            <?php include "../includes/welcome.php"; ?>
            <div class="page-title-box">
                <h2 class="page-title">Admin Dashboard</h2>
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
            <div>
                <span class="subtitle-content">Your last tests:</span>
                <table>
                    <thead>
                        <tr>
                            <th>Test Name</th>
                            <th>Score</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>PMP Project Management - PMI</td>
                            <td>8.5</td>
                            <td>Jan 15, 2019</td>
                        </tr>
                        <tr>
                            <td>Microsoft Certified of Something</td>
                            <td>7.2</td>
                            <td>Dec 25, 2018</td>
                        </tr>
                        <tr>
                            <td>Microsoft Certified of Something</td>
                            <td>9.8</td>
                            <td>Dec 12, 2018</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>
</html>
