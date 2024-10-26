<?php
// Connect to SQL Server database
$serverName = "SKEHJHJ";
$database = "lms";
$uid = "";
$pass = "";

$SemesterID = $_POST['SemesterID'];
$StuID = $_POST['StuID'];

$connection = [
    "Database" => $database,
    "Uid" => $uid,
    "PWD" => $pass
];

$conn = sqlsrv_connect($serverName, $connection);

if (!$conn) {
    die(print_r(sqlsrv_errors(), true));
}

try {
    $tsql = "SELECT * FROM Study JOIN Class ON Study.ClassID = Class.ClassID WHERE Study.StuID = '$StuID' AND Class.SemesterID = '$SemesterID';";
    $stmt = sqlsrv_query($conn, $tsql);
    if ($stmt) {
        // Create HTML table
       ?>
        <html>
            <head>
                <link rel="stylesheet" href="phpstyles.css">
            </head>
            <body>
                <h1>List of Student's Class in this Semester</h1>
                <table>
                    <tr>
                        <th>Student ID</th>
                        <th>Class</th>
                        <th>Average Score</th>
                    </tr>

                    <?php
                    while ($row = sqlsrv_fetch_Array($stmt, SQLSRV_FETCH_ASSOC)) {
                       ?>
                        <tr>
                            <td><?= $row['StuID']?></td>
                            <td><?= $row['ClassID']?></td>
                            <td><?= $row['Avg_Score']?></td>
                        </tr>
                    <?php }?>
                </table>
            </body>
        </html>
        <?php
    } else {
        $errors = sqlsrv_errors();
        foreach ($errors as $error) {
            echo "SQLSTATE: ". $error['SQLSTATE']. "\n";
            echo "Code: ". $error['code']. "\n";
            echo "Message: ". $error['message']. "\n";
        }
    }

    // Query to retrieve data from usertable
    $tsql = "EXECUTE GetScholarshipStudents '$SemesterID'";
    $stmt = sqlsrv_query($conn, $tsql);
    // Check if query was successful
    if ($stmt) {
        // Create HTML table
       ?>
        <html>
            <head>
                <link rel="stylesheet" href="phpstyles.css">
            </head>
            <body>
                <h1>List of Students who get Scholarship</h1>
                <table>
                    <tr>
                        <th>Student ID</th>
                        <th>Avarage Grade</th>
                        <th>Num of Class</th>
                        <th>Rank</th>
                    </tr>

                    <?php
                    $num = 0;
                    while ($row = sqlsrv_fetch_Array($stmt, SQLSRV_FETCH_ASSOC)) {
                        $num++;
                       ?>
                        <tr>
                            <td><?= $row['StuID']?></td>
                            <td><?= $row['AverageGrade']?></td>
                            <td><?= $row['CountClass']?></td>
                            <td><?= $num?></td>
                        </tr>
                    <?php }?>
                </table>
            </body>
        </html>
        <?php
    } else {
        $errors = sqlsrv_errors();
        foreach ($errors as $error) {
            echo "SQLSTATE: ". $error['SQLSTATE']. "\n";
            echo "Code: ". $error['code']. "\n";
            echo "Message: ". $error['message']. "\n";
        }
    }
} catch (Exception $e) {
    echo "Error: ". $e->getMessage();
} finally {
    // Close connection explicitly
    sqlsrv_close($conn);
}
$targetUrl = "index.html";
$linkText = "Di den Trang chu"; // Text displayed on the link
echo "<a href='$targetUrl'>$linkText</a>";
$conn = null;
?>
