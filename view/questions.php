<?php

function showAllQuestions($testQuestions) {
    $count = 1;

    if(!empty($testQuestions)){
        foreach ($testQuestions as $question) {
            echo "<tr class='tr-questions'>";
                echo "<td class='td-questions'>{$count}</td>";
                echo "<td class='td-questions'>{$question['question']}</td>";
                echo "<td class='td-questions tb-button'><a href='admin-edit-question.php?questionId={$question['id']}' class='link-button m-b-10'>Edit</a></td>";
            echo "</tr>";

            $count++;
        }
    }

}




?>