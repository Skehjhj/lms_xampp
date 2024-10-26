<?php

$serverName = "SKEHJHJ";
$database = "lms";
$uid = "";
$pass = "";

$StuID = isset($_POST['StuID']) ? $_POST['StuID'] : null;
$TestID = isset($_POST['TestID']) ? $_POST['TestID'] : null;
$TimesID = isset($_POST['TimesID']) ? $_POST['TimesID'] : null;

$connection = [
    "Database" => $database,
    "Uid" => $uid,
    "PWD" => $pass
];

$conn = sqlsrv_connect($serverName, $connection);
if(!$conn)
    die(print_r(sqlsrv_errors(),true));


else
try {
        $tsql = "DELETE FROM StuWork WHERE StuID = '$StuID' AND TestID = $TestID AND TimesID = $TimesID;";
        $stmt = sqlsrv_query($conn, $tsql);
        if ($stmt) {

            if($stmt == false){
                echo "Bai lam nay khong ton tai";
            }else {
                echo 'Xoa bai lam thanh cong'."<br>";
                $targetUrl = "updatemissing.php";
                $linkText = "Di den danh sach bai lam"."<br>"; 
                echo "<a href='$targetUrl'>$linkText</a>";
            }
    }
} catch (Exception $e) {
    echo "Error: ". $e->getMessage();
} finally {
    // Close connection explicitly
    sqlsrv_close($conn);
}

$targetUrl = "index.html";
$linkText = "Di den Trang chu"; 
echo "<a href='$targetUrl'>$linkText</a>";
$conn = null;
?>