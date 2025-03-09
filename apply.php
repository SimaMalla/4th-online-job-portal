<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Apply Job | Jobs Portal</title>
  <?php include('header_link.php'); ?>

  <link rel="stylesheet" href="./css/cards.css">
</head>

<body>
  <?php include('header.php'); ?>
  <?php
  // Start the session and include the DB connection before any output
  
  include('dbconnect.php');

  // Retrieve job id from GET (if available)
  if (isset($_GET['jobid'])) {
    $jobid = filter_var($_GET['jobid'], FILTER_SANITIZE_NUMBER_INT);
  } elseif (isset($_POST['jobid'])) {
    // Fallback in case the form is submitted and jobid comes via POST
    $jobid = filter_var($_POST['jobid'], FILTER_SANITIZE_NUMBER_INT);
  } else {
    die("Job ID not provided.");
  }

  // Retrieve user id from session
  if (isset($_SESSION['userid'])) {
    $userid = $_SESSION['userid'];
  } else {
    $userid = ""; // Optionally, you might want to redirect to login or show an error
  }
  ?>
  <div class="container applybanner">
    <div class="single">
      <h1>Apply Job</h1>
      <div class="col-md-6">
        <form action="apply.php" method="post" enctype="multipart/form-data">
          <!-- Set hidden inputs dynamically -->
          <input type="hidden" name="jobid" value="<?php echo htmlspecialchars($jobid); ?>">
          <input type="hidden" name="userid" value="<?php echo htmlspecialchars($userid); ?>">

          <div class="form-group">
            <input type="file" name="file" placeholder="Upload your CV" class="form-control" required>
          </div>
          <input type="submit" name="applyjob" value="Apply" class="btn btn-primary">
        </form>
      </div>
    </div>

    <?php
    // Display the User ID (for debugging/confirmation purposes)
    if (!empty($userid)) {

    } else {
      echo "User ID not found in session.";
    }

    // Process form submission if the Apply button was pressed
    if (isset($_POST['applyjob'])) {

      // In case the form submission did not carry jobid via GET, retrieve from POST
      if (isset($_POST['jobid'])) {
        $jobid = filter_var($_POST['jobid'], FILTER_SANITIZE_NUMBER_INT);
      }

      // Retrieve the uploaded file information
      $file = $_FILES['file']['name'];
      $tmp = $_FILES['file']['tmp_name'];
      $dest = 'uploads'; // Destination folder
    
      // Create the uploads directory if it doesn't exist
      if (!is_dir($dest)) {
        mkdir($dest, 0777, true);
      }

      // Move the uploaded file to the destination folder
      if (move_uploaded_file($tmp, $dest . '/' . $file)) {
        $date = date('Y-m-d'); // Format for MySQL
    
        // Insert the application record into the database
        $sql = "INSERT INTO `application`(`userid`, `jobid`, `cv`, `date`) VALUES ('$userid','$jobid','$file','$date')";
        if (mysqli_query($con, $sql)) {
          echo "<script>alert('Applied for the Job successfully'); window.location.href='index.php';</script>";
        } else {
          echo "<script>alert('Error: " . mysqli_error($con) . "');</script>";
        }
      } else {
        echo "<script>alert('Failed to upload file');</script>";
      }
    }
    ?>
  </div>

  <br><br>
  <?php include('footer.php'); ?>
</body>

</html>