<?php include "../view/header-admin.php"; ?>

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
                    <?php showAllCategories(Category::getAllCategories()); ?>
                </tbody>
            </table>
            
        </main>
    </div>
</body>
</html>
