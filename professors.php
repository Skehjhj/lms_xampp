<?php
// Connect to SQL Server database
$serverName = "SKEHJHJ";
$database = "lms";
$uid = "";
$pass = "";

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
    // Query to retrieve data from usertable
    $tsql = "SELECT * FROM Professor JOIN UserTable ON Professor.ProfID = UserTable.userID"; 
    $stmt = sqlsrv_query($conn, $tsql);
    
    if ($stmt) {
        // Create HTML table
       ?>
        <html>
            <head>
                <link rel="stylesheet" href="professors.css"> <!-- moved to external CSS file -->
                <title>Professor List</title>
            </head>
            <body>
                <h1 class="title">List of Professor</h1>
                <table class="professor-table">
                    <tr>
                        <th>Professor ID</th>
                        <th>Degree</th>
                        <th>E-Mail</th>
                        <th>Name</th>
                        <th>Gender</th>
                    </tr>
                    <?php
                    while ($row = sqlsrv_fetch_object($stmt)) {
                       ?>
                        <tr>
                            <td><?= $row->ProfID?></td>
                            <td><?= $row->Degree?></td>
                            <td><?= $row->mail?></td>
                            <td><?= $row->name?></td>
                            <td><?= $row->sex?></td>
                        </tr>
                        <?php
                    }
                   ?>
                </table>
                
                <!-- moved forms to separate sections -->
                <section class="delete-professor">
                    <h2>Delete Professor</h2>
                    <form action="delete.php" method="post">
                        <div class="form-group">
                            <label for="ProfID">Professor ID:</label>
                            <input type="text" id="ProfID" name="ProfID" required>
                        </div>
                        <button type="submit">Delete Professor</button>
                    </form>
                </section>
                
                <section class="update-degree">
                    <h2>Update Professor Degree</h2>
                    <form action="update.php" method="post">
                        <div class="form-group">
                            <label for="ProfID">Professor ID:</label>
                            <input type="text" id="ProfID" name="ProfID" required>
                        </div>
                        <div class="form-group">
                            <label for="Degree">Updated Degree:</label>
                            <input type="text" id="Degree" name="Degree" required>
                        </div>
                        <button type="submit">Update Professor Degree</button>
                    </form>
                </section>
                
                <!-- moved link to separate section -->
                <section class="back-to-index">
                    <a href="index.html"><?= "Di den Trang chu"?></a>
                </section>
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
?>