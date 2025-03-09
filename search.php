<?php
if (isset($_POST['submit']) && !empty($_POST['search'])) {
    $search = mysqli_real_escape_string($con, $_POST['search']);
    $sql = "SELECT jobs.name, categories.name AS category
                        FROM jobs 
                        INNER JOIN categories ON jobs.catid = categories.catid 
                        WHERE jobs.name LIKE '%$search%' OR categories.name LIKE '%$search%' OR jobs.desc LIKE '%$search%'";

    $result = mysqli_query($con, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        echo '<div class="table-responsive">';
        echo '<table class="table table-bordered">';
        echo '<thead>
                            <tr>
                                <th>Job Name</th>
                                <th>Category</th>
                            </tr>
                          </thead>';
        echo '<tbody>';
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($row['name']) . '</td>';
            echo '<td>' . htmlspecialchars($row['category']) . '</td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
        echo '</div>';
    } else {
        echo '<p class="text-danger">No jobs found.</p>';
    }
}
?>