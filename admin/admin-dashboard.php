<?php include "../view/header-admin.php"; ?>

<body>
    <div class="container">
        <?php include "../view/menu-admin.php"; ?>
        <main class="main">
            <?php include "../view/welcome.php"; ?>
            <div class="page-title-box">
                <h2 class="page-title">Admin Dashboard</h2>
            </div>
            <div class="chart-box">
                <?php include "../view/admin-chart.php"; ?>
                <div id="columnchart_material" class="chart"></div>
            </div>

            <?php
                $tests = Test::getAllTests();

                if(!empty($tests)){

                    $time = time();
                    $time_out_in_seconds = 60;
                    $time_out = $time - $time_out_in_seconds;

                    foreach($tests as $test){
                        if($test->getStatus() == "Active"){
                            $testResultStat = TestResult::getFinishedTestResultByTestId($test->getId());
                            $usersOnline = Test::getAllUsersOnlineByTestIdValid($test->getId(), $time_out);
            ?>
            <div class="test-stats">
                <div class="title-test-container">
                    <span class="title-test">Test: <?php echo $test->getName();?></span>
                    <a href="admin-edit-test.php?testId=<?php echo $test->getId();?>" class="link-button">Edit</a>
                </div>
                <div class="statistic-admin-box-container">
                    <div id="doing-test" class="statistic-user-box">
                        <span class="statistic-user-box-title">Doing this test now</span>
                        <!-- <span class="statistic-user-box-result"><span class="users-online"></span> user(s)</span> -->
                        <span class="statistic-user-box-result"><?php echo $usersOnline ? $usersOnline['numUsers'] : 0; ?> user(s)</span>
                    </div>
                    <div id="passed-test" class="statistic-user-box">
                        <span class="statistic-user-box-title">Passed the test</span>
                        <span class="statistic-user-box-result"><?php echo  $testResultStat ? $testResultStat['usersPassed'] : 0 ;?> user(s)</span>
                    </div>
                    <div id="not-passed-test" class="statistic-user-box">
                        <span class="statistic-user-box-title">Haven't passed the test</span>
                        <span class="statistic-user-box-result"><?php echo $testResultStat ? $testResultStat['usersHaventPassed'] : 0;?> user(s)</span>
                    </div>
                    <div id="test-average-score" class="statistic-user-box">
                        <span class="statistic-user-box-title">Average score</span>
                        <span class="statistic-user-box-result"><?php echo $testResultStat ? number_format($testResultStat['avgScore'], 1, '.', '') : '-';?></span>
                    </div>
                </div>
                <div class="m-t-20">
                <span>This test was taken <strong><?php echo $testResultStat ? $testResultStat['totalTests'] : 0 ;?></strong> time(s), of which <strong><?php echo $testResultStat ? $testResultStat['totalSuccessTests'] : 0;?></strong> time(s) was(were) successful and <strong><?php echo $testResultStat ? $testResultStat['totalFailedTests'] : 0;?></strong> time(s) failed.</span>
                </div>
            </div>
            <?php
                        } // if
                    } // foreach
                } // if
            ?>
        </main>
    </div>
</body>
</html>
