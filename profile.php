<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link href="./css/profile.css" rel="stylesheet">
    <?php include('header_link.php'); ?>
    <?php include('header.php'); ?>
    <?php
    // session_start(); // Start session at the top
    include('dbconnect.php');

    // Check if the user is logged in; if not, redirect to login page
    if (isset($_SESSION['userid'])) {
        $userid = $_SESSION['userid'];
    } else {
        header("Location: login.php");
        exit();
    }
    ?>
</head>

<body class="bg-light">
    <div class="container mt-5 containerprofile">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm p-4 ">
                    <?php
                    // Fix the SQL query by using a single '=' and proper quoting
                    $sql = "SELECT * FROM user WHERE userid = '$userid'";
                    $rs = mysqli_query($con, $sql);

                    if ($rs && mysqli_num_rows($rs) > 0) {
                        // Fetch the user data from the result set
                        $jobdata = mysqli_fetch_array($rs);
                        ?>
                        <div class="card h-100 shadow-sm flex-setting">

                            <h2 class="text-center mb-4 profileform">Profile</h2>

                            <form action="profile.php" method="POST">
                                <div class="mb-3 profile-wrapper ">
                                    <?php
                                    $imagePath = 'uploads/' . htmlspecialchars($jobdata['image']);


                                    if (htmlspecialchars($jobdata['image'])) { ?>
                                        <img src="<?= $imagePath ?>" class="card-img-top" alt="Job Image">
                                    <?php } else { ?>
                                        <img src="./images/profile.png" class="card-img-top" alt="Job Image2">
                                    <?php } ?>
                                </div>
                                <div class=" profilelebel">

                                    <input type="text" name="name" class="form-control profilelevel"
                                        value="<?php echo htmlspecialchars($jobdata['name']); ?>" required>
                                </div>
                                <div class=" profilelebel">

                                    <input type="email" name="email" class="form-control profilelevel"
                                        value="<?php echo htmlspecialchars($jobdata['email']); ?>" required>
                                </div>
                                <div class=" profilelebel">

                                    <input type="text" name="role" class="form-control profilelevel"
                                        value="<?php echo htmlspecialchars($jobdata['roletype']); ?>" required>
                                </div>
                                <button type="submit" name="submit" class="btn btn-primary w-100"><a
                                        href="changepassword.php">Update Profile</a></button>

                            </form>

                        </div>
                        <?php
                    } else {
                        echo "<p class='text-danger text-center'>User not found.</p>";
                    }
                    ?>
                    <div class="text-center mt-3 logoutbttn">
                        <a href="logout.php" class="btn btn-danger w-100 ">Logout</a>
                    </div>
                    <?php if (isset($_SESSION['success_message'])): ?>
                        <div class="alert alert-success mt-3" role="alert">
                            <?php echo $_SESSION['success_message'];
                            unset($_SESSION['success_message']); ?>
                        </div>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['error_message'])): ?>
                        <div class="alert alert-danger mt-3" role="alert">
                            <?php echo $_SESSION['error_message'];
                            unset($_SESSION['error_message']); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

</body>

</html>