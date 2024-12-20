<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Applied Jobs | Jobs Portal</title>
    <?php

    include('header_link.php');
    include('dbconnect.php');




    ?>
</head>

<body>

    <?php

    include('header.php');

    if (!isset($_SESSION['userid'])) {
        header('Location: login.php');
    }

    $userid = $_SESSION['userid'];

    ?>
    <div class="container view-h-job">



        <div class="single">


            <div class="col-md-12">
                <div class="form-group">
                    <input type="text" id="myinput" placeholder="search ......" class="form-control">
                </div>

                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Pass</th>

                        </tr>
                    </thead>

                    <tbody id="mytable">
                        <?php

                        $sql = "select*from user where roletype='user'";
                        $rs = mysqli_query($con, $sql);
                        while ($data = mysqli_fetch_array($rs)) {
                            ?>

                            <tr>
                                <td><?= $data['userid'] ?></td>
                                <td><?= $data['name'] ?></td>
                                <td><?= $data['email'] ?></td>
                                <td><?= $data['password'] ?></td>


                            </tr>

                            <?php
                        }
                        ?>
                    </tbody>
                </table>

            </div>

        </div>



    </div>

    <script>
        $(document).ready(function () {
            $("#myinput").on("keyup", function () {
                var value = $(this).val().toLowerCase();
                $("#mytable tr").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>

    <br><br>
    <?php include('footer.php'); ?>


</body>

</html>