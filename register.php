<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Jobs Portal</title>
    <link rel="stylesheet" href="./css/login.css">

    <?php
    include('header_link.php');
    include('dbconnect.php');
    ?>
</head>

<body>
    <?php include('header.php'); ?>

    <div class="section-register">
        <div class="container view-h-job">
            <div class="single">
                <div class="main">
                    <div class="box effect7">
                        <div class="header-text">Employer/User Registration</div>

                        <form action="register.php" method="post">
                            <div class="form-group">
                                <input type="text" placeholder="Enter your name" name="name" class="form-control"
                                    required>
                            </div>
                            <div class="form-group">
                                <input type="email" placeholder="Enter your email" name="email" class="form-control"
                                    required>
                            </div>
                            <div class="form-group">
                                <input type="password" placeholder="Enter your password" name="password"
                                    class="form-control" required>
                            </div>
                            <div class="form-group">
                                <input type="number" placeholder="Enter your role type" name="role" class="form-control"
                                    required>
                            </div>
                            <input type="submit" name="register" value="Register" class="btn btn-primary">
                        </form>
                    </div>
                </div>
            </div>

            <?php
            if (isset($_POST['register'])) {
                $name = mysqli_real_escape_string($con, $_POST['name']);
                $email = mysqli_real_escape_string($con, $_POST['email']);
                $password = mysqli_real_escape_string($con, $_POST['password']);
                $role = mysqli_real_escape_string($con, $_POST['role']);

                // Basic validation for role
                if ($role != 1 && $role != 2) {
                    echo "<h3 style='color:red;'>Invalid role type! Please select 1 for Admin or 2 for Employer.</h3>";
                } else {
                    // Encrypt the password before storing it
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                    // Insert user into the database
                    $sql = "INSERT INTO `user` (`name`, `email`, `password`, `roletype`) VALUES ('$name', '$email', '$hashed_password', '$role')";
                    if (mysqli_query($con, $sql)) {
                        echo "<script>alert('Your account created Successfully')</script>";
                    } else {
                        echo "<script>alert('Registration Failed. Please try again later.')</script>";
                    }
                }
            }
            ?>
        </div>
    </div>

    <?php include('footer.php'); ?>
</body>

</html>