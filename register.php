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

    <div class="section-register register-bg">
        <div class="container view-h-job">
            <div class="single">
                <div class="main">
                    <div class="box effect7">
                        <div class="header-text">Employer/User Registration</div>

                        <form id="registrationForm" action="register.php" method="post">
                            <div class="form-group">
                                <input type="text" placeholder="Enter your name/company name" name="name" id="name"
                                    class="form-control">
                                <div class="error"></div>
                            </div>
                            <div class="form-group">
                                <input type="email" placeholder="Enter your email" name="email" id="email1"
                                    class="form-control">
                                <div class="error"></div>
                            </div>
                            <div class="form-group">
                                <input type="password" placeholder="Enter your password" name="password" id="pass"
                                    class="form-control">
                                <div class="error"></div>
                            </div>
                            <div class="form-group">
                                <select id="role" name="roletype" class="form-control">

                                    <option value="">Select Role</option>
                                    <option value="employer">employer</option>
                                    <option value="user">user</option>

                                </select>
                                <div class="error"></div>
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
                $role = mysqli_real_escape_string($con, $_POST['roletype']);
                $sql = "INSERT INTO `user` (`name`, `email`, `password`, `roletype`) VALUES ('$name', '$email', '$password', '$role')";
                if (mysqli_query($con, $sql)) {
                    echo "<script>alert('Your account created Successfully')</script>";
                } else {
                    echo "<script>alert('Registration Failed. Please try again later.')</script>";
                }
            }

            ?>
        </div>
    </div>
    <script>
        const form = document.getElementById("registrationForm");
        const username = document.getElementById("name");
        const email = document.getElementById("email1");
        const password = document.getElementById("pass");
        const role = document.getElementById("role");

        form.addEventListener("submit", (e) => {
            e.preventDefault();
            if (validateInputs()) {
                form.submit();
            }
        });

        const setError = (element, message) => {
            const formgroup = element.parentElement;
            const errorDisplay = formgroup.querySelector(".error");

            errorDisplay.innerText = message;
            formgroup.classList.add("error");
            formgroup.classList.remove("success");
        };

        const setSuccess = (element) => {
            const formgroup = element.parentElement;
            const errorDisplay = formgroup.querySelector(".error");

            errorDisplay.innerText = "";
            formgroup.classList.add("success");
            formgroup.classList.remove("error");
        };

        const isValidEmail = (email) => {
            const re = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            return re.test(String(email).toLowerCase());
        };

        const validateInputs = () => {
            const usernameValue = username.value.trim();
            const emailValue = email.value.trim();
            const passwordValue = password.value.trim();
            const roleValue = role.value;

            let isValid = true;

            if (usernameValue == "") {
                setError(username, "Username is required");
                isValid = false;
            } else {
                setSuccess(username);
            }

            if (emailValue == "") {
                setError(email, "Email is required");
                isValid = false;
            } else if (!isValidEmail(emailValue)) {
                setError(email, "Provide a valid email address");
                isValid = false;
            } else {
                setSuccess(email);
            }

            if (passwordValue === "") {
                setError(password, "Password is required");
                isValid = false;
            } else if (passwordValue.length < 8) {
                setError(password, "Password must be at least 8 characters.");
                isValid = false;
            } else {
                setSuccess(password);
            }
            if (roleValue === "") {
                setError(role, "Role selection is required");
                isValid = false;
            } else {
                setSuccess(role);
            }


            return isValid;
        };
    </script>
    <?php include('footer.php'); ?>
</body>

</html>