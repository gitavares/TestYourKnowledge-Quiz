<?php

function showAllTestsFinishedByUser($testsResults) {

    if(!empty($testsResults)){
        foreach ($testsResults as $testResult) {

            // $createdDate = date("F j, Y, g:i a", strtotime($testResult['createdDate']));
            $createdDate = date("M j, Y", strtotime($testResult['createdDate']));
            $score = number_format((float)$testResult['score'], 1, '.', '');
            $status = $testResult['passed'] ? 'Passed' : 'Fail';

            echo "<tr>";
                echo "<td>{$testResult['testName']}</td>";
                echo "<td>{$testResult['category']}</td>";
                echo "<td>{$score}</td>";
                echo "<td>{$status}</td>";
                echo "<td>{$createdDate}</td>";
            echo "</tr>";
        }
    } else {
        echo "<div class='user-tests-box-nothing'><p>No past tests to show...</p><p>You didn’t take any test yet.</p><p class='m-t-50'><a href='".getUrlDirPath()."take-a-test' title='Make a Test' class='link-button m-t-50'>Take a Test</a></p></div>";
    }

}




?>