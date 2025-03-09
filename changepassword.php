<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <link href="./css/profile.css" rel="stylesheet">
    <?php include('header_link.php'); ?>
    <?php include('header.php'); ?>
    <?php

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
                <div class="card shadow-sm p-4">
                    <h2 class="text-center mb-4 profileform">Change Password</h2>
                    <form action="updateprofile.php" method="POST">
                        <div class="mb-3">
                            <label for="current_password" class="form-label">Current Password</label>
                            <input type="password" name="current_password" id="current_password"
                                class="form-control profilelevel" placeholder="Enter current password" required>
                        </div>
                        <div class="mb-3">
                            <label for="new_password" class="form-label">New Password</label>
                            <input type="password" name="new_password" id="new_password"
                                class="form-control profilelevel" placeholder="Enter new password" required>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary w-100">Change Password</button>
                    </form>
                    <div class="text-center mt-3 logoutbttn">
                        <a href="logout.php" class="btn btn-danger w-100">Logout</a>
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