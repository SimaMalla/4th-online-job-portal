<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>View Applied Jobs | Jobs Portal</title>
     <?php

     include('header_link.php');




     ?>
</head>

<body>

     <?php include('header.php'); ?>
     <?php include('dbconnect.php'); ?>
     <?php
     if (!$con) {
          die("Database connection failed: " . mysqli_connect_error());
     }

     if (!isset($_SESSION['userid'])) {
          die("Session 'userid' is not set.");
     }

     $userid = $_SESSION['userid'];

     ?>
     <div class="container view-h-job">



          <div class="single">


               <div class="col-md-12">
                    <div class="form-group">
                         <input type="text" id="myinput" placeholder="search ......" class="form-control">
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
                              $userid = $_SESSION['userid'];
                              $sql = "select a.appid, j.name, c.Name, a.date, a.cv
                             FROM application a
                              INNER JOIN jobs j ON a.jobid = j.jobid
                              INNER JOIN categories c ON j.catid = c.catid
                              ";
                              $rs = mysqli_query($con, $sql);
                              if (!$rs) {
                                   die("Query failed: " . mysqli_error($con));
                              }
                              while ($data = mysqli_fetch_array($rs)) {
                                   ?>

                                   <tr>
                                        <td><?= $data['appid'] ?></td>
                                        <td><?= $data['name'] ?></td>
                                        <td><?= $data['Name'] ?></td>
                                        <td><?= $data['date'] ?></td>
                                        <td><a href="uploads/<?= $data['cv'] ?>" class="btn btn-warning" target="_blank">view
                                                  cv</a></td>

                                   </tr>

                                   <?php
                              }
                              ?>
                         </tbody>
                    </table>

               </div>

          </div>



     </div>


     <br><br>

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