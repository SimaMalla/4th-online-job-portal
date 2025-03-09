<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include('header_link.php'); ?>
    <link rel="stylesheet" href="./css/cards.css">
</head>

<body>
    <?php include('header.php'); ?>
    <?php include('dbconnect.php'); ?>

    <?php
    // Check if 'jobid' is provided in the query string
    if (isset($_GET['jobid'])) {
        // Sanitize the job id (assuming it's an integer)
        $jobId = filter_var($_GET['jobid'], FILTER_SANITIZE_NUMBER_INT);
    } else {
        die("Job ID not provided.");
    }

    // Corrected SQL: Place WHERE before ORDER BY and use '=' instead of '=='
    $sql = "SELECT jobs.jobid,
                   jobs.name,
                   categories.name AS catname,
                   jobs.desc,
                   jobs.skill,
                   jobs.timing,
                   jobs.date,
                   jobs.salary,
                   jobs.location, 
                   jobs.logo
            FROM jobs
            INNER JOIN categories ON categories.catid = jobs.catid
            WHERE jobs.jobid = $jobId
            ORDER BY jobs.jobid DESC";

    $rs = mysqli_query($con, $sql);
    if (!$rs) {
        die("Query failed: " . mysqli_error($con));
    }

    $jobdata = mysqli_fetch_array($rs);

    // Optionally store job data in session (if needed)
    $_SESSION['jobid'] = $jobdata;
    ?>

    <div class="col bgapply">
        <div class="h-100 shadow-sm flex-setting">
            <?php
            $imagePath = 'uploads/jobs/' . htmlspecialchars($jobdata['logo']);
            ?>
            <img src="<?= $imagePath ?>" class="card-img-top" alt="Job Image">
            <div class="card-body">
                <div class="clearfix">
                    <h4><b><?= htmlspecialchars($jobdata['name']); ?></b></h4>
                    <small><?= htmlspecialchars($jobdata['catname']); ?></small>
                    <p>Desc: <?= htmlspecialchars($jobdata['desc']); ?></p>
                    <p>Skill: <?= htmlspecialchars($jobdata['skill']); ?></p>
                    <p>Timing: <?= htmlspecialchars($jobdata['timing']); ?></p>
                    <p>Location: <?= htmlspecialchars($jobdata['location']); ?></p>

                    <div class="col-sm-2">
                        <?php
                        if (isset($_SESSION['roletype'])) {
                            if ($_SESSION['roletype'] == 'user') {
                                echo '<a href="apply.php?jobid=' . htmlspecialchars($jobdata["jobid"]) . '" class="btn btn-primary">Apply Now</a>';
                            }
                        } else {
                            echo '<a href="register.php" class="btn btn-primary">Register</a>';
                            echo '<a href="login.php" class="btn btn-primary">Login</a>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include('footer.php'); ?>
</body>

</html>