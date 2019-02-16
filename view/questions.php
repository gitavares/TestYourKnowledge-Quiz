<?php

function showAllQuestions($testQuestions) {
    $count = 1;

    if(!empty($testQuestions)){
        foreach ($testQuestions as $question) {

            $questionBody = htmlspecialchars_decode(stripslashes($question->getQuestion()), ENT_QUOTES);
            
            echo "<tr class='tr-questions'>";
                echo "<td class='td-questions'>{$count}</td>";
                echo "<td class='td-questions'>{$questionBody}</td>";
                echo "<td class='td-questions'>{$question->getStatus()}</td>";
                echo "<td class='td-questions tb-button'><a href='admin-edit-question.php?questionId={$question->getId()}' class='link-button m-b-10'>Edit</a></td>";
            echo "</tr>";

            $count++;
        }
    }

}




?>