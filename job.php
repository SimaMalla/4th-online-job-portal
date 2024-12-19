<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Listings</title>
    <link rel="stylesheet" href="./css/job.css">
    <?php
    include('header_link.php');
    ?>

</head>

<body>
    <?php
    include('header.php');
    ?>
    <?php include('dbconnect.php'); ?>

    <div class="">
        <div class="container">
            <div class="row ">
                <div class="col-lg-6">

                    <div class="login-content">
                        <form action="job.php" method="post">
                            <div class="section-title">
                                <h3>Start your job search</h3>
                            </div>

                            <div class="textbox-wrap">
                                <div class="form-group">
                                    <input type="hidden" name="jobid" value="" />
                                    <input type="text" placeholder="Enter a name" name="name" value=""
                                        class="form-control" required />
                                </div>

                                <div class="form-group">
                                    <textarea name="desc" id="desc" cols="2" rows="2" placeholder="Enter a description"
                                        class="form-control" required></textarea>
                                </div>
                                <div class="form-group">
                                    <input type="text" placeholder="Skill" name="skill" value="" class="form-control"
                                        required />
                                </div>

                                <div class="form-group">
                                    <input type="text" placeholder="Timing" name="timing" value="" class="form-control"
                                        required />
                                </div>

                                <div class="form-group">
                                    <input type="text" placeholder="Salary" name="salary" value="" class="form-control"
                                        required />
                                </div>

                                <div class="form-group">
                                    <select name="catid" class="form-control" required>
                                        <?php
                                        $sql = "SELECT*from categories";
                                        $data = mysqli_query($con, $sql);
                                        if (mysqli_num_rows($data) > 0) {
                                            while ($row = mysqli_fetch_array($data)) {
                                                ?>
                                                <option value="<?= $row['catid'] ?>"><?= $row['Name'] ?></option>
                                                <?php
                                            }
                                        } else {
                                            ?>
                                            <option>Categories not added</option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="login-btn">
                                    <input type="submit" name="addjob" value="Add Job" class="btn btn-primary">
                                    <input type="submit" name="updatejob" value="Update Job" class="btn btn-info">
                                </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 table-job">
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Categories</th>
                            <th>Skill</th>
                            <th>Desc</th>
                            <th>Salary</th>
                            <th>Timing</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT jobs.jobid, jobs.name, categories.name AS 'catname', jobs.desc, jobs.skill, jobs.timing, jobs.date, jobs.salary, jobs.location
                            FROM jobs
                            INNER JOIN categories ON categories.catid = jobs.catid";
                        $rs = mysqli_query($con, $sql);
                        while ($jobdata = mysqli_fetch_array($rs)) {
                            ?>
                            <tr>
                                <td><?= $jobdata['jobid'] ?></td>
                                <td><?= $jobdata['name'] ?></td>
                                <td><?= $jobdata['catname'] ?></td>
                                <td><?= $jobdata['skill'] ?></td>
                                <td><?= $jobdata['desc'] ?></td>
                                <td><?= $jobdata['salary'] ?></td>
                                <td><?= $jobdata['timing'] ?></td>
                                <td><?= $jobdata['date'] ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>


    <?php
    if (isset($_POST['addjob'])) {
        $name = $_POST['name'];
        $catid = $_POST['catid'];
        $desc = $_POST['desc'];
        $skill = $_POST['skill'];
        $date = date('d/m/y');
        $timing = $_POST['timing'];
        $salary = $_POST['salary'];

        if (
            mysqli_query($con, "INSERT INTO jobs(`name`, `desc`, `skill`, `timing`, `date`, `salary`, `catid`) 
            VALUES ('$name', '$desc', '$skill', '$timing', '$date', '$salary', '$catid')")
        ) {
            echo "<script> alert('Record added successfully');</script>";
        } else {
            echo "<script>alert('Error adding record');</script>";
        }
    }
    include('footer.php');
    ?>

</body>

</html>