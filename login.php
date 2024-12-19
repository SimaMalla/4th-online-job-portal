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
                        <form action="login.php" method="post">
                            <div class="form-group">
                                <input type="text" placeholder="enter a email" name="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="text" placeholder="enter a password" name="password" class="form-control">
                            </div>
                            <input type="submit" name="login" value="Login" class="btn btn-primary">

                            <span class="signup">Don't have an account?&nbsp;<a href="#" class="link">Sign up</a></span>
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

                    if ($userinfo['roletype'] == 1) {
                        header('Location: admin.php');
                    } elseif ($userinfo['roletype'] == 2) {
                        header('Location: index.php');
                    }

                } else {
                    echo "<h3 style='color:red;'> Invalid Username or password</h3>";
                }


            }
            ?>


        </div>
    </div>


    <?php include('footer.php'); ?>
</body>

</html>