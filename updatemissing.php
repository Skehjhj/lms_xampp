<html>
<body>
  <h1>Nhap Student ID muon tim bai kiem tra</h1>
  <form action="updatemissing.php" method="post">
    <div class="form-group">
      <label for="StuID">Student ID:</label>
      <input type="text" id="StuID" name="StuID" required>
    </div>
    <button type="submit">Enter</button>
  </form>
</body>


</html>

<?php

$serverName = "SKEHJHJ";
$database = "lms";
$uid = "";
$pass = "";

$CurDATE = isset($_POST['CurDATE']) ? $_POST['CurDATE'] : '2000-10-10';
$StuID = isset($_POST['StuID']) ? $_POST['StuID'] : null;

$connection = [
    "Database" => $database,
    "Uid" => $uid,
    "PWD" => $pass
];

$conn = sqlsrv_connect($serverName, $connection);
if(!$conn)
    die(print_r(sqlsrv_errors(),true));
try {
    // Query to retrieve data from usertable
    $tsql = "EXEC UpdateMissingStuWorkScores '$CurDATE';";
    $stmt = sqlsrv_query($conn, $tsql);
    if ($stmt) {
        // Create HTML table
        echo "Da cap nhat thoi gian:"."\n";
        if(!$StuID){
            $tsql = "SELECT * FROM StuWork";
            $stmt = sqlsrv_query($conn, $tsql);
        }
        else{
                $tsql = "SELECT * FROM StuWork WHERE StuID = '$StuID'";
                $stmt = sqlsrv_query($conn, $tsql);
        }
    if ($stmt) {
       ?>
        <html>
            <head>
                <link rel="stylesheet" href="phpstyles.css">
            </head>
            <body>
                <h1>List of Students' Works</h1>
                <table>
                    <tr>
                        <th>Student ID</th>
                        <th>Test ID</th>
                        <th>Time</th>
                        <th>Student's Work</th>
                        <th>Score</th>
                    </tr>
                    <?php
                    while ($row = sqlsrv_fetch_object($stmt)) {
                       ?>
                        <tr>
                            <td><?= $row->StuID?></td>
                            <td><?= $row->TestID?></td>
                            <td><?= $row->TimesID?></td>
                            <td><?= $row->StuWork?></td>
                            <td><?= number_format($row->Score, 1)?></td>
                        </tr>
                        <?php
                    }
                   ?>
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