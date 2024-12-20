<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Job | Jobs Portal</title>
    <link rel="stylesheet" href="./css/cards.css">
    <?php include('header_link.php'); ?>

</head>

<body>

    <?php include('header.php');
    ?>

    <?php
    include('dbconnect.php');
    ?>

    <div class=" picture ">
        <div class="container">

            <div class="row all-job-sec">
                <div class="header-card-sec1">


                    <div style="color:#fff; font-size:32px;">All Jobs</div>



                </div>


                <main>
                    <div class="container-fluid bg-trasparent my-4 p-3" style="position: relative;">
                        <div class="card-wrapper">


                            <?php
                            $sql = "SELECT jobs.jobid,jobs.name,categories.name AS 'catname', jobs.desc,jobs.skill,jobs.timing,jobs.date,jobs.salary,jobs.location 
                        FROM jobs
                        INNER JOIN categories ON categories.catid=jobs.catid
                        ORDER by jobs.jobid DESC";
                            $rs = mysqli_query($con, $sql);
                            while ($jobdata = mysqli_fetch_array($rs)) {

                                ?>


                                <div class="col">
                                    <div class="card h-100 shadow-sm flex-setting">
                                        <img src="https://www.freepnglogos.com/uploads/notebook-png/download-laptop-notebook-png-image-png-image-pngimg-2.png"
                                            class="card-img-top" alt="...">

                                        <div class="card-body">
                                            <div class="clearfix">
                                                <h4><?= $jobdata['name'] ?> </h4>
                                                <small><?= $jobdata['catname'] ?></small>

                                            </div>
                                        </div>
                                        <a href="single.php?jobid=<?= $jobdata['jobid'] ?>" class="btn btn-primary">More
                                            Details</a>
                                    </div>
                                </div>

                                <div class="clearfix"></div>
                            <?php } ?>




                        </div>

                    </div>
                </main>


            </div>
        </div>
        <?php include('footer.php'); ?>

</body>

</html>