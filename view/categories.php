<?php

function showAllCategories($categories) {

    if(!empty($categories)){
        foreach ($categories as $category) {

            echo "<tr>";
                echo "<td>{$category->getName()}</td>";
                echo "<td><a href='admin-edit-category.php?categoryId={$category->getId()}' class='link-button m-b-10'>Edit</a></td>";
            echo "</tr>";

        }
    }

}

?>