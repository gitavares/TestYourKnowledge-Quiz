<?php include "../view/header-admin.php"; ?>

<body>
    <div class="container">
        <?php include "../view/menu-admin.php"; ?>
        <main class="main">
            <?php include "../view/welcome.php"; ?>
            <div class="page-title-box">
                <h2 class="page-title">Users Stat</h2>
            </div>
            
            <form action="admin-users-stats.php" method="POST">
                <div class="filter-form-box">
                    <div class="form-group filter-form-box-date">
                        <label for="finishedDate"><span class="label-text">Finished Date:</span>
                            <input type="date" name="finishedDate" class="form-input" placeholder="YYYY-MM-DD"
                            value="<?php echo isset($_POST["finishedDate"]) ? $_POST["finishedDate"] : ''; ?>">
                        </label>
                    </div>
                    <div class="form-group filter-form-box-username">
                        <label for="idUser"><span class="label-text">Users:</span>
                            <select name="idUser" id="idUser" class="form-input">
                                <option value="" select></option>
                            <?php 
                            $usersResult = User::getAllUsers();
                            foreach ($usersResult as $user) {
                            ?>
                                <option value="<?php echo $user->getId(); ?>" <?php echo (isset($_POST['idUser']) && $_POST['idUser'] == $user->getId()) ? 'selected' : ''; ?>><?php echo $user->getFirstName()." ".$user->getLastName(); ?></option>
                            <?php
                            }
                            ?>
                            </select>
                        </label>
                    </div>
                    <div class="form-group filter-form-box-orderby">
                        <label for="orderyby"><span class="label-text">Order By:</span>
                            <select name="orderyby" id="orderyby" class="form-input">
                                <option value="" select></option>
                                <optgroup label="Score">
                                    <option value="highScore" <?php echo (isset($_POST['orderyby']) && $_POST['orderyby'] == 'highScore') ? 'selected' : ''; ?>>Highest score</option>
                                    <option value="lowScore" <?php echo (isset($_POST['orderyby']) && $_POST['orderyby'] == 'lowScore') ? 'selected' : ''; ?>>Lowest score</option>
                                </optgroup>
                                <optgroup label="Finished Date">
                                    <option value="recentDate" <?php echo (isset($_POST['orderyby']) && $_POST['orderyby'] == 'recentDate') ? 'selected' : ''; ?>>Recent date</option>
                                    <option value="olderdate" <?php echo (isset($_POST['orderyby']) && $_POST['orderyby'] == 'olderdate') ? 'selected' : ''; ?>>Older date</option>
                                </optgroup>
                                <optgroup label="User">
                                    <option value="userNameAsc" <?php echo (isset($_POST['orderyby']) && $_POST['orderyby'] == 'userNameAsc') ? 'selected' : ''; ?>>User Name A-Z</option>
                                    <option value="userNameDesc" <?php echo (isset($_POST['orderyby']) && $_POST['orderyby'] == 'userNameDesc') ? 'selected' : ''; ?>>User Name Z-A</option>
                                </optgroup>
                                <optgroup label="Test">
                                    <option value="testNameAsc" <?php echo (isset($_POST['orderyby']) && $_POST['orderyby'] == 'testNameAsc') ? 'selected' : ''; ?>>Test Name A-Z</option>
                                    <option value="testNameDesc" <?php echo (isset($_POST['orderyby']) && $_POST['orderyby'] == 'testNameDesc') ? 'selected' : ''; ?>>Test Name Z-A</option>
                                </optgroup>
                                <optgroup label="Category">
                                    <option value="categoryNameAsc" <?php echo (isset($_POST['orderyby']) && $_POST['orderyby'] == 'categoryNameAsc') ? 'selected' : ''; ?>>Category A-Z</option>
                                    <option value="categoryNameDesc" <?php echo (isset($_POST['orderyby']) && $_POST['orderyby'] == 'categoryNameDesc') ? 'selected' : ''; ?>>Category Z-A</option>
                                </optgroup>
                            </select>
                        </label>
                    </div>
                    <div class="form-group filter-form-box-filterbutton">
                        <input type="submit" name="submit" value="Filter" class="form-button">
                    </div>
                </div>
            </form>
            <table>
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Test</th>
                        <th>Category</th>
                        <th>Score</th>
                        <th>Result</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $iduser = null;
                        $date = null;
                        $orderby = null;

                        if(isset($_POST['submit'])){

                            if($_POST['finishedDate']) $date = $_POST['finishedDate'];
                            if($_POST['idUser']) $iduser = $_POST['idUser'];
                            if($_POST['orderyby']) $orderby = $_POST['orderyby'];

                            showAllUsersTestsResults(TestResult::getAllUsersTestResults($iduser, $date, $orderby));
                        } else {
                            showAllUsersTestsResults(TestResult::getAllUsersTestResults());
                        }
                    ?>
                </tbody>
            </table>
            
        </main>
    </div>
</body>
</html>
