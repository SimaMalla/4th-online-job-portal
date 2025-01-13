<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apply Job | Jobs Portal</title>
    <?php

  include('header_link.php');
  include('header.php');
  include('dbconnect.php');




  ?>
</head>

<body>

    <div class="container">


        <div class="single">
            <h1>Apply Jobs</h1>
            <div class="col-md-6">
                <form action="apply.php" method="post" enctype="multipart/form-data">

                    <input type="hidden" value="<?= $jobdata['jobid'] ?>" name="jobid">
                    <input type="hidden" value="<?= $userdata['userid'] ?>" name="userid">

                    <div class="form-group">
                        <input type="file" name="file" placeholder="upload your cv" class="form-control">
                    </div>

                    <input type="submit" name="applyjob" value="Apply" class="btn btn-primary">

                </form>


            </div>

        </div>


        <?php

    if (isset($_FILES['applyjob'])) {



      $userid = $_POST['userid'];
      $jobid = $_POST['jobid'];
      $date = date('d/m/y');


      $file = $_FILES['file']['name'];
      $tmp = $_FILES['file']['tmp_name'];


      move_uploaded_file($tmp, "uplodes/$file");

      $sql = "INSERT INTO `application`(`userid`, `jobid`, `cv`, `date`) VALUES ('$userid','$jobid','$file','$date')";
      if (mysqli_query($con, $sql)) {

        echo "<script>alert('Applied Job')</script>";

        header('Location: index.php');

      } else {
        echo "<script>alert('not applied Job')</script>";
      }
    }
    ?>


    </div>

    <br><br>
    <?php include('footer.php'); ?>


</body>

</html>