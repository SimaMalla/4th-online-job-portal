<?php
session_start();
include('dbconnect.php');

// Check if the form is submitted
if (isset($_POST['submit'])) {
    $userid = $_SESSION['userid'];
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];

    // Fetch the current password hash from the database
    $query = "SELECT password FROM user WHERE userid = '$userid'";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        $hashed_password = $user['password'];

        // Verify the current password
        if ($current_password == $hashed_password) {
            // Hash the new password
            $new_hashed_password = $new_password;

            // Update the password in the database
            $update_query = "UPDATE user SET password = '$new_hashed_password' WHERE userid = '$userid'";
            if (mysqli_query($con, $update_query)) {
                $_SESSION['success_message'] = "Password changed successfully.";
                header("Location: profile.php");

            } else {
                $_SESSION['error_message'] = "Failed to update the password. Please try again.";
                header("Location: profile.php");

            }
        } else {
            $_SESSION['error_message'] = "Current password is incorrect.";
            header("Location: profile.php");

        }
    } else {
        $_SESSION['error_message'] = "User not found.";
        header("Location: profile.php");

    }
}

?>