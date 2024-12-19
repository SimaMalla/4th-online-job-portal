<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Job | Jobs Portal</title>
    <?php
    include('header_link.php');
    ?>
</head>

<body>

    <?php
    include('header.php');
    ?>
    <?php include('dbconnect.php'); ?>
    <?php
    error_reporting(0);
    $catid = $_GET['catid'];
    $sql = "SELECT * FROM `categories` where catid='$catid'";
    $rs = mysqli_query($con, $sql);
    $catdata = mysqli_fetch_array($rs);


    if ($_GET['delid']) {
        $delid = $_GET['delid'];
        $sql1 = "DELETE FROM `categories` where catid='$delid'";
        mysqli_query($con, $sql1);
        header('Location: categories.php');
    }

    ?>
    <div class="container">
        <div class="">
            <div class="col-md-6 custom-form-container">
                <div class="login-content categories-custom">
                    <form action="categories.php" method="post">
                        <div class="section-title">
                            <h3>Add Categories</h3>
                        </div>

                        <!-- Hidden field for data -->
                        <input type="hidden" name="catid" value="" class="form-control">

                        <div class="form-group custom-form-group">
                            <input type="hidden" name="cid" value="<?= $catdata['catid'] ?>" class="form-control">
                            <input type="text" placeholder="Enter category name" name="Name"
                                value=" <?= $catdata['Name'] ?>" class="form-control custom-input">
                        </div>

                        <div class="form-buttons custom-form-buttons">
                            <input type="submit" name="addcat" value="Add Category" class="btn btn-primary custom-btn">
                            <input type="submit" name="updatecat" value="Update Category"
                                class="btn btn-info custom-btn">
                        </div>
                    </form>
                </div>
            </div>


            <div class="col-md-12 custom-search-container">
                <div class="col-md-6 custom-search-input">
                    <input type="text" id="myinput" placeholder="Search category..."
                        class="form-control custom-search-field">
                </div>

                <table class="table custom-category-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <?php
                    $sql = "SELECT * FROM `categories`";
                    $rs = mysqli_query($con, $sql);
                    while ($data = mysqli_fetch_array($rs)) {
                        ?>
                        <tr>
                            <td><?= $data['catid'] ?></td>
                            <td><?= $data['Name'] ?></td>
                            <td>
                                <a href="categories.php?catid=<?= $data['catid'] ?>"
                                    class="btn btn-primary custom-edit-btn">Edit</a>
                                <a href="categories.php?delid=<?= $data['catid'] ?>"
                                    class="btn btn-danger custom-delete-btn">Delete</a>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
            </div>

        </div>
    </div>


    <br><br>
    <div class="relative footer-wrapper">

        <?php include 'footer.php'; ?>
    </div>


</body>

</html>
<?php

if (isset($_POST['addcat'])) {
    $catname = $_POST['Name'];
    if (mysqli_query($con, "INSERT INTO `categories`(`Name`) VALUES ('$catname')")) {
        echo "<script> alert('record inserted')</script>";
    } else {
        echo "<script>alert('record not inserted')</script>";
    }
}
//update code
if (isset($_POST['updatecat'])) {
    $cid = $_POST['cid'];
    $catname = $_POST['Name'];
    if (mysqli_query($con, "UPDATE `categories` SET `name`='$catname' WHERE catid='$cid'")) {
        echo "<script> alert('record updated')</script>";
    } else {
        echo "<script>alert('record not updated')</script>";
    }
}
?>