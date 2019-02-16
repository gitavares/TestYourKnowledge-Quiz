<?php include "../view/header-admin.php"; ?>

<body>
    <div class="container">
        <?php include "../view/menu-admin.php"; ?>
        <main class="main">
            <?php include "../view/welcome.php"; ?>
            <div class="page-title-box">
                <h2 class="page-title">Tests</h2>
            </div>
            <div class="m-b-10">
                <a href="admin-add-test.php" class="link-button">Add Test</a>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>Test Name</th>
                        <th># Questions / Test</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php showAllTestsAdmin(Test::getAllTests()); ?>
                </tbody>
            </table>
            
        </main>
    </div>
</body>
</html>
