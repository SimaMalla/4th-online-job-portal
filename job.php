<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Listings</title>
    <link rel="stylesheet" href="./css/job.css">
    <?php include('header_link.php'); ?>
</head>

<body>
    <?php include('header.php'); ?>
    <?php include('dbconnect.php'); ?>

    <div class="">
        <div class="addjobbanner">
            <div class="row">
                <div class="banner-job">
                    <div class="addjobform">
                        <form action="job.php" method="post" enctype="multipart/form-data">
                            <div class="">
                                <h3>Add Jobs</h3>
                            </div>

                            <div class="textbox-wrap">
                                <div class="form-group">
                                    <input type="hidden" name="jobid" value="" />
                                    <input type="text" placeholder="Enter a title of job" name="name" value=""
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
                                    <input type="date" placeholder="Date" name="date" value="" class="form-control"
                                        required />
                                </div>
                                <div class="form-group">
                                    <textarea name="location" id="desc" cols="2" rows="2" placeholder="Enter a location"
                                        class="form-control" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="photo">Choose a photo to upload:</label>
                                    <input type="file" name="file" id="photo" required><br><br>
                                </div>
                                <div class="form-group">
                                    <select name="catid" class="form-control" required>
                                        <?php
                                        $sql = "SELECT * FROM categories";
                                        $data = mysqli_query($con, $sql);
                                        if (mysqli_num_rows($data) > 0) {
                                            while ($row = mysqli_fetch_array($data)) {
                                                echo "<option value='{$row['catid']}'>{$row['Name']}</option>";
                                            }
                                        } else {
                                            echo "<option>Categories not added</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="login-btn">
                                    <input type="submit" name="addjob" value="Add Job" class="btn btn-primary">

                                </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="table-body-wrapper">
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Categories</th>
                            <th>Skill</th>
                            <th>Desc</th>
                            <th>Salary</th>
                            <th>Location</th>
                            <th>Date</th>
                            <th>Timing</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT jobs.jobid, jobs.name, categories.name AS 'catname', jobs.desc, jobs.skill, jobs.timing, jobs.date, jobs.salary, jobs.location
                                FROM jobs
                                INNER JOIN categories ON categories.catid = jobs.catid";
                        $rs = mysqli_query($con, $sql);
                        while ($jobdata = mysqli_fetch_array($rs)) {
                            echo "<tr>
                                    <td>{$jobdata['jobid']}</td>
                                    <td>{$jobdata['name']}</td>
                                    <td>{$jobdata['catname']}</td>
                                    <td>{$jobdata['skill']}</td>
                                    <td>{$jobdata['desc']}</td>
                                    <td>{$jobdata['salary']}</td>
                                    <td>{$jobdata['location']}</td>
                                    <td>{$jobdata['date']}</td>
                                    <td>{$jobdata['timing']}</td>
                                  </tr>";
                        }
                        ?>
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
        $date = date('Y-m-d'); // Use proper date format
        $timing = $_POST['timing'];
        $salary = $_POST['salary'];
        $location = $_POST['location'];
        $logo = '';
        $userid = $_SESSION['userid'];

        // File upload handling
        if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
            $file = $_FILES['file']['name'];
            $tmp = $_FILES['file']['tmp_name'];
            $dest = 'uploads/jobs';

            // Create uploads directory if it doesn't exist
            if (!is_dir($dest)) {
                mkdir($dest, 0777, true);
            }

            // Move the uploaded file
            if (move_uploaded_file($tmp, $dest . '/' . $file)) {
                $logo = $file; // Set the logo to the uploaded file
            } else {
                echo "<script>alert('File upload failed');</script>";
                exit;
            }
        } else {
            echo "<script>alert('No file uploaded or there was an error during upload');</script>";
            exit;
        }

        // Insert into the database
        $sql = "INSERT INTO jobs(`name`, `desc`, `skill`, `timing`, `date`, `salary`, `location`, `logo`, `catid`,`userid`) 
                VALUES ('$name', '$desc', '$skill', '$timing', '$date', '$salary', '$location', '$logo', '$catid','$userid')";

        if (mysqli_query($con, $sql)) {
            echo "<script>alert('Record added successfully');</script>";
        } else {
            echo "<script>alert('Error adding record: " . mysqli_error($con) . "');</script>";
        }
    }
    ?>

    <?php include('footer.php'); ?>
</body>

</html>