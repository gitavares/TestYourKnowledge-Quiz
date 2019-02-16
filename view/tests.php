<?php

function showAllTestsUser($tests) {

    if(!empty($tests)){
        foreach ($tests as $test) {
            echo "<tr>";
                echo "<td>{$test->getName()}</td>";
                echo "<td>{$test->getNumQuestions()}</td>";
                echo "<td>{$test->getCategory()}</td>";
                echo "<td><a href='take-a-test.php?testId={$test->getId()}' class='link-button m-b-10'>Start</a></td>";
            echo "</tr>";
        }
    } else {
        echo "<div class='user-tests-box-nothing'><p>No results...</p></div>";
    }

}

function showAllTestsAdmin($tests) {

    if(!empty($tests)){
        foreach ($tests as $test) {

            echo "<tr>";
                echo "<td>{$test->getName()}</td>";
                echo "<td>{$test->getNumQuestions()}</td>";
                echo "<td>{$test->getCategory()}</td>";
                echo "<td>{$test->getStatus()}</td>";
                echo "<td><a href='admin-edit-test.php?testId={$test->getId()}' class='link-button m-b-10'>Edit</a></td>";
            echo "</tr>";

        }
    } else {
        echo "Nothing to show. <a href='admin-add-test.php'>Add a Test</a>";
    }

}

?>