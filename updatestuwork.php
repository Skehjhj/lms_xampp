<?php

$serverName = "SKEHJHJ";
$database = "lms";
$uid = "";
$pass = "";

$StuID = isset($_POST['StuID']) ? $_POST['StuID'] : null;
$TestID = isset($_POST['TestID']) ? $_POST['TestID'] : null;
$TimesID = isset($_POST['TimesID']) ? $_POST['TimesID'] : null;
$StuWork = isset($_POST['StuWork']) ? $_POST['StuWork'] : null;
$Score = isset($_POST['Score']) ? $_POST['Score'] : null;


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
        $tsql = "UPDATE StuWork SET StuWork = '$StuWork', Score = $Score WHERE StuID = '$StuID' AND TestID = $TestID AND TimesID = $TimesID;";
        $stmt = sqlsrv_query($conn, $tsql);
        if($StuWork == null && $Score == null) echo "Vui long nhap thong tin";
        else{
        if($stmt == false){
                echo "Bai lam khong ton tai";
        }else {
                echo 'Chinh sua bai lam thanh cong'."<br>";
                $targetUrl = "updatemissing.php";
                $linkText = "Di den danh sach bai lam"."<br>"; // Text displayed on the link
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
$linkText = "Di den Trang chu"; // Text displayed on the link
echo "<a href='$targetUrl'>$linkText</a>";
$conn = null;
?>