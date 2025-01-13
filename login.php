<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Jobs Portal</title>
    <link rel="stylesheet" href="./css/login.css">

    <?php

    include('header_link.php');
    include('dbconnect.php');



    ?>



</head>

<body>
    <?php

    include('header.php');

    ?>
    <div class="section-login">

        <div class="container view-h-job">


            <div class="single">

                <div class="main">
                    <div class="box effect7">
                        <div class="header-text">Employer / User Login</div>
                        <form id="loginForm" action="login.php" method="post">
                            <div class="form-group">
                                <input type="text" placeholder="enter a email" id="email" name="email"
                                    class="form-control">
                                <span class="error"></span>
                            </div>
                            <div class="form-group">
                                <input type="text" placeholder="enter a password" id="password" name="password"
                                    class="form-control">
                                <span class="error"></span>
                            </div>
                            <input type="submit" name="login" id="login" value="Login" class="btn btn-primary">

                            <span class="signup">Don't have an account?&nbsp;<a href="register.php" class="link">Sign
                                    up</a></span>
                        </form>
                    </div>
                </div>


            </div>


            <?php

            if (isset($_POST['login'])) {

                $email = $_POST['email'];
                $password = $_POST['password'];

                $sql = "select * from user where email = '$email' and password = '$password' ";

                $rs = mysqli_query($con, $sql);

                if ($row = mysqli_num_rows($rs) > 0) {
                    $userinfo = mysqli_fetch_array($rs);
                    $user_id = $userinfo['userid'];
                    $email = $userinfo['email'];
                    $password = $userinfo['password'];
                    $type = $userinfo['roletype'];

                    $_SESSION['userid'] = $user_id;
                    $_SESSION['email'] = $email;
                    $_SESSION['password'] = $password;
                    $_SESSION['roletype'] = $type;

                    if ($userinfo['roletype'] == 'admin') {
                        header('Location: index.php');
                    } elseif ($userinfo['roletype'] == 'user') {
                        header('Location: index.php');
                    } elseif ($userinfo['roletype'] == 'employer') {
                        header('Location: index.php');
                    }

                } else {
                    echo "<h3 style='color:red;'> Invalid Username or password</h3>";
                }


            }
            ?>


        </div>
    </div>

    <script>
        const loginForm = document.getElementById("loginForm");
        const email = document.getElementById("email");
        const password = document.getElementById("password");

        // Event listener for form submission
        loginForm.addEventListener("submit", (e) => {
            e.preventDefault(); // Prevent form submission
            if (validateInputs()) {
                loginForm.submit(); // Submit form if validation passes
            }
        });

        // Function to set error message
        const setError = (element, message) => {
            const formgroup = element.parentElement;
            const errorDisplay = formgroup.querySelector(".error");

            errorDisplay.innerText = message;
            formgroup.classList.add("error");
            formgroup.classList.remove("success");
        };

        // Function to set success state
        const setSuccess = (element) => {
            const formgroup = element.parentElement;
            const errorDisplay = formgroup.querySelector(".error");

            errorDisplay.innerText = "";
            formgroup.classList.add("success");
            formgroup.classList.remove("error");
        };

        // Function to validate email format
        const isValidEmail = (email) => {
            const re = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            return re.test(String(email).toLowerCase());
        };

        // Function to validate form inputs
        const validateInputs = () => {
            const emailValue = email.value.trim();
            const passwordValue = password.value.trim();

            let isValid = true;

            // Validate email
            if (emailValue === "") {
                setError(email, "Email is required");
                isValid = false;
            } else if (!isValidEmail(emailValue)) {
                setError(email, "Enter a valid email address");
                isValid = false;
            } else {
                setSuccess(email);
            }

            // Validate password
            if (passwordValue === "") {
                setError(password, "Password is required");
                isValid = false;
            } else if (passwordValue.length < 8) {
                setError(password, "Password must be at least 8 characters");
                isValid = false;
            } else {
                setSuccess(password);
            }

            return isValid;
        };
    </script>
    <?php include('footer.php'); ?>
</body>

</html>