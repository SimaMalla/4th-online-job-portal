<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page | Jobs Portal</title>
    <link rel="stylesheet" href="./css/cards.css">
    <link rel="stylesheet" href="./css/swiper.css">

    <?php include('header_link.php'); ?>

</head>

<body>

    <?php include('header.php');
    ?>

    <?php
    include('dbconnect.php');
    ?>


    <section class="position-relative hero-holder bg-cover bg-center">
        <!-- <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark bg-opacity-75"></div> -->
        <div class="container">

            <div
                class=" position-relative d-flex flex-column justify-content-center align-items-start text-white py-5 h-100 inner-hero-section">
                <div class="text-start">
                    <h1 class="display-4 fw-bold hero-header">
                        Let us find your Forever Job.
                        <br>
                        <strong class="d-block text-danger"> "Your Dream Job Awaits!"</strong>
                    </h1>
                    <p class="mt-4 fs-5 para-hero">
                        Explore thousands of opportunities tailored just for you. Start your journey to success today.
                    </p>
                    <div class="mt-4 d-flex gap-3">
                        <a href="viewjobs.php" class="btn btn-danger px-4 py-2 text-white">Get Started</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
                                        <img src="./images/a1.jpg" class="card-img-top" alt="...">

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
                                        <img src="./images/1.png" class="card-img-top" alt="...">

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

        <script src="./js/jsswiper.js"></script>
    </div>

    <?php include('footer.php'); ?>


</body>

</html>