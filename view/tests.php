<?php

function showAllTestsUser($tests) {

    if(!empty($tests)){
        foreach ($tests as $test) {
            echo "<tr>";
                echo "<td>{$test['name']}</td>";
                echo "<td>{$test['numQuestions']}</td>";
                echo "<td>{$test['category']}</td>";
                echo "<td><a href='take-a-test.php?testId={$test['id']}' class='link-button m-b-10'>Start</a></td>";
            echo "</tr>";
        }
    }

}

function showAllTestsAdmin($tests) {

    if(!empty($tests)){
        foreach ($tests as $test) {

            echo "<tr>";
                echo "<td>{$test['name']}</td>";
                echo "<td>{$test['numQuestions']}</td>";
                echo "<td>{$test['category']}</td>";
                echo "<td>{$test['status']}</td>";
                echo "<td><a href='admin-edit-test.php?testId={$test['id']}' class='link-button m-b-10'>Edit</a></td>";
            echo "</tr>";

        }
    } else {
        echo "Nothing to show. <a href='admin-add-test.php'>Add a Test</a>";
    }

}

?>