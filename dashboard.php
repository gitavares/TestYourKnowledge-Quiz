<?php include "view/header.php"; ?>
<?php include "model/connection.php"; ?>
<?php include "model/users.php"; ?>

<?php

getSession();
if($_SESSION['admin']) {
    redirectAdminDashboard();
}

?>

<body>
    <div class="container">
        <?php include "view/menu-user.php"; ?>
        <main class="main">
            <?php include "view/welcome.php"; ?>
            <div class="page-title-box">
                <h2 class="page-title">Dashboard</h2>
            </div>
            <div class="statistic-user-box-container">
                <div id="test-made" class="statistic-user-box">
                    <span class="statistic-user-box-title">You made</span>
                    <span class="statistic-user-box-result">3 Tests</span>
                </div>
                <div id="average-score" class="statistic-user-box">
                    <span class="statistic-user-box-title">Your average score is</span>
                    <span class="statistic-user-box-result">8.5</span>
                </div>
                <div id="better-than" class="statistic-user-box">
                    <span class="statistic-user-box-title">You are better than</span>
                    <span class="statistic-user-box-result">73% of the users</span>
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
