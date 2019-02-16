<?php include "view/header.php"; ?>

<?php

User::getSession();
if($_SESSION['admin']) {
    User::redirectAdminDashboard();
}

$testsResults = TestResult::getAllTestsResultsByUserId();
$sum = 0;

if(!empty($testsResults)){
    foreach($testsResults as $testResult){
        $sum += $testResult->getScore();
    }
}

$avg = count($testsResults) > 0 ? number_format(($sum / count($testsResults)), 1, '.', '') : '-';

$allAverages = User::getAllUsersScoreAverages();

$better = null;

if(!empty($allAverages)){
    $scoreAverage = 0;

    foreach ($allAverages as $average) {
        if($average['idUser'] == $_SESSION['userId']){
            $scoreAverage = $average['userScoreAverage'];
            break;
        }
    }

    $countLowerScoreAvg = 0;
    
    foreach ($allAverages as $average) {
        if($average['userScoreAverage'] < $scoreAverage) $countLowerScoreAvg++;
    }

    $better = ($countLowerScoreAvg / (count($allAverages) - 1)) * 100;
}

$better = $better == 100 ? $better.'%' : $better >= 0 ? number_format($better, 1, '.', '').'%' : '-';

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
                    <span class="statistic-user-box-result"><?php echo count($testsResults); ?> Test(s)</span>
                </div>
                <div id="average-score" class="statistic-user-box">
                    <span class="statistic-user-box-title">Your average score is</span>
                    <span class="statistic-user-box-result"><?php echo $avg; ?></span>
                </div>
                <div id="better-than" class="statistic-user-box">
                    <span class="statistic-user-box-title">You are better than</span>
                    <span class="statistic-user-box-result"><?php echo $better; ?> of the users</span>
                </div>
            </div>
            <div>
                <?php
                    if(!empty($testsResults)){
                ?>
                <span class="subtitle-content">Your last tests:</span>
                <table>
                    <thead>
                        <tr>
                            <th>Test Name</th>
                            <th>Category</th>
                            <th>Score</th>
                            <th>Result</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php showAllTestsFinishedByUser($testsResults); ?>
                    </tbody>
                </table>
                <?php 
                    } else {
                        showAllTestsFinishedByUser($testsResults);
                    }
                ?>
            </div>
        </main>
    </div>
</body>
</html>
