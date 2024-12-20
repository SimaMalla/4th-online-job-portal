<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
    include('header_link.php');
    ?>
    <link rel="stylesheet" href="./css/cards.css">
</head>

<body>
    <?php
    include('header.php');
    ?>
    <?php include('dbconnect.php'); ?>
    <?php
    $sql = "SELECT jobs.jobid,jobs.name,categories.name AS 'catname', jobs.desc,jobs.skill,jobs.timing,jobs.date,jobs.salary,jobs.location 
                FROM jobs
                INNER JOIN categories ON categories.catid=jobs.catid
                ORDER by jobs.jobid DESC";
    $rs = mysqli_query($con, $sql);
    ($jobdata = mysqli_fetch_array($rs));

    $_SESSION['jobid'] = $jobdata;
    ?>
    <div class="col">
        <div class="card h-100 shadow-sm flex-setting">
            <img src="./images/a1.jpg" class="card-img-top" alt="...">

            <div class="card-body">
                <div class="clearfix">
                    <h4><?= $jobdata['name'] ?> </h4>
                    <small><?= $jobdata['catname'] ?></small>
                    <p>Desc:<?= $jobdata['desc'] ?></p>
                    <p>Skill:<?= $jobdata['skill'] ?></p>
                    <p>Timing:<?= $jobdata['timing'] ?></p>
                    <p>Location:<?= $jobdata['location'] ?></p>

                    <div class="col-sm-2">
                        <?php
                        if (isset($_SESSION['roletype'])) {
                            if ($_SESSION['roletype'] == 'user') {
                                echo '<a href="apply.php" class="btn btn-primary">Apply Now</a>';
                            }
                        } else {
                            echo '<a href="register.php" class="btn btn-primary">Register</a>';
                            echo '<a href="login.php" class="btn btn-primary">Login</a>';
                        } ?>
                    </div>

                </div>

            </div>
        </div>



        <?php include('footer.php'); ?>

</body>

</html>