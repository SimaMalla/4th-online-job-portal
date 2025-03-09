<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Applied Jobs | Jobs Portal</title>
    <?php include('header_link.php'); ?>
</head>

<body>

    <?php
    include('dbconnect.php');
    include('header.php');

    if (!$con) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    // Ensure session is started
    if (!isset($_SESSION['userid'])) {
        echo "<script>alert('You must log in first.'); window.location.href='login.php';</script>";
        exit();
    }

    $userid = $_SESSION['userid'];
    ?>

    <div class="container view-h-job">
        <div class="single">
            <div class="col-md-12">
                <div class="form-group">
                    <input type="text" id="myinput" placeholder="Search..." class="form-control">
                </div>

                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Job</th>
                            <th>Category</th>
                            <th>Date</th>
                            <th>CV</th>
                        </tr>
                    </thead>

                    <tbody id="mytable">
                        <?php
                        $sql = "SELECT a.appid, j.name AS job_name, c.Name AS category_name, a.date, a.cv
                                FROM application a
                                INNER JOIN jobs j ON a.jobid = j.jobid
                                INNER JOIN categories c ON j.catid = c.catid
                                WHERE j.userid = '$userid'";
                        $rs = mysqli_query($con, $sql);

                        if (!$rs) {
                            die("Query failed: " . mysqli_error($con));
                        }

                        while ($data = mysqli_fetch_array($rs)) {
                            ?>
                            <tr>
                                <td><?= htmlspecialchars($data['appid']) ?></td>
                                <td><?= htmlspecialchars($data['job_name']) ?></td>
                                <td><?= htmlspecialchars($data['category_name']) ?></td>
                                <td><?= htmlspecialchars($data['date']) ?></td>
                                <td>
                                    <a href="uploads/<?= htmlspecialchars($data['cv']) ?>" class="btn btn-warning"
                                        target="_blank">View CV</a>
                                </td>
                            </tr>
                        <?php } ?>
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

    <?php include('footer.php'); ?>

</body>

</html>