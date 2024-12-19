<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page | Jobs Portal</title>
    <link rel="stylesheet" href="./css/cards.css">
    <?php include('header_link.php'); ?>

</head>

<body>

    <?php include('header.php');
    ?>

    <?php
    include('dbconnect.php');
    ?>


    <div class="container picture">
        <div class="single">
            <div class="box_2 ">
                <div class="header-card-sec">

                    <div style="color:#fff; font-size:32px;">Latest Jobs</div>

                    <a href="viewjobs.php" class="btn btn-primary">View All Jobs</a>
                </div>

                <main>
                    <div class="container-fluid bg-trasparent my-4 p-3" style="position: relative;">
                        <div class="card-wrapper">


                            <?php
                            $sql = "SELECT jobs.jobid,jobs.name,categories.name AS 'catname', jobs.desc,jobs.skill,jobs.timing,jobs.date,jobs.salary,jobs.location 
                    FROM jobs
                    INNER JOIN categories ON categories.catid=jobs.catid
                    ORDER by jobs.jobid DESC LIMIT 3";
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
                                    </div>
                                </div>

                                <div class="clearfix"></div>
                            <?php } ?>




                        </div>

                    </div>
                </main>




            </div>
        </div>
        <div class="single">
            <div class="box_2 ">
                <div class="header-card-sec">

                    <div style="color:#fff; font-size:32px;">Hot Jobs</div>

                    <a href="viewjobs.php" class="btn btn-primary">View All Jobs</a>
                </div>

                <main>
                    <div class="container-fluid bg-trasparent my-4 p-3" style="position: relative;">
                        <div class="card-wrapper" style="margin-bottom:80px;">


                            <?php
                            $sql = "SELECT jobs.jobid,jobs.name,categories.name AS 'catname', jobs.desc,jobs.skill,jobs.timing,jobs.date,jobs.salary,jobs.location 
                    FROM jobs
                    INNER JOIN categories ON categories.catid=jobs.catid
                    ORDER by jobs.jobid DESC LIMIT 3";
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
                                    </div>
                                </div>

                                <div class="clearfix"></div>
                            <?php } ?>




                        </div>

                    </div>
                </main>




            </div>
        </div>


    </div>

    <?php include('footer.php'); ?>


</body>

</html>