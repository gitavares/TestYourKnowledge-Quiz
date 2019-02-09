<?php include "../view/header-admin.php"; ?>
<?php include "../model/connection.php"; ?>
<?php include "../model/users.php"; ?>
<?php include "../model/tests.php"; ?>
<?php include "../model/questions.php"; ?>
<?php include "../model/categories.php"; ?>
<?php include "../view/categories.php"; ?>

<?php

getSession();
if(!$_SESSION['admin']) {
    redirectUserDashboard();
}

?>

<body>
    <div class="container">
        <?php include "../view/menu-admin.php"; ?>
        <main class="main">
            <?php include "../view/welcome.php"; ?>
            <div class="page-title-box">
                <h2 class="page-title">Categories</h2>
            </div>
            <div class="m-b-10">
                <a href="admin-add-category.php" class="link-button">Add Category</a>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>Category Name</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php showAllCategories(getAllCategories()); ?>
                </tbody>
            </table>
            
        </main>
    </div>
</body>
</html>
