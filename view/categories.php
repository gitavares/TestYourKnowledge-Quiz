<?php

function showAllCategories($categories) {

    if(!empty($categories)){
        foreach ($categories as $category) {

            echo "<tr>";
                echo "<td>{$category['name']}</td>";
                echo "<td><a href='admin-edit-category.php?categoryId={$category['id']}' class='link-button m-b-10'>Edit</a></td>";
            echo "</tr>";

        }
    }

}

?>