<?php

function showAllTestsFinishedByUser($testsResults) {

    if(!empty($testsResults)){
        foreach ($testsResults as $testResult) {

            $createdDate = date("M j, Y", strtotime($testResult->getCreatedDate()));
            $score = number_format((float)$testResult->getScore(), 1, '.', '');
            $status = $testResult->getPassed() ? 'Passed' : 'Fail';

            echo "<tr>";
                echo "<td>{$testResult->getTestName()}</td>";
                echo "<td>{$testResult->getCategory()}</td>";
                echo "<td>{$score}</td>";
                echo "<td>{$status}</td>";
                echo "<td>{$createdDate}</td>";
            echo "</tr>";
        }
    } else {
        echo "<div class='user-tests-box-nothing'><p>No past tests to show...</p><p>You didn’t take any test yet.</p><p class='m-t-50'><a href='take-a-test.php' title='Make a Test' class='link-button m-t-50'>Take a Test</a></p></div>";
    }

}

function showAllUsersTestsResults($usersTestsResults) {

    if(!empty($usersTestsResults)){
        foreach ($usersTestsResults as $usersTestResult) {

            $finishedDate = date("M j, Y, g:i a", strtotime($usersTestResult->getFinishedDate()));
            $score = number_format((float)$usersTestResult->getScore(), 1, '.', '');
            $passed = $usersTestResult->getPassed() ? 'Passed' : 'Fail';

            echo "<tr>";
                echo "<td>{$usersTestResult->getUserName()}</td>";
                echo "<td>{$usersTestResult->getTestName()}</td>";
                echo "<td>{$usersTestResult->getCategory()}</td>";
                echo "<td>{$score}</td>";
                echo "<td>{$passed}</td>";
                echo "<td>{$finishedDate}</td>";
            echo "</tr>";
        }
    } else {
        echo "<div class='user-tests-box-nothing'><p>No results...</p></div>";
    }

}

?>