<?php
$serverName = "SKEHJHJ";
$database = "lms";
$uid = "";
$pass = "";

$StuID = $_POST['StuID'];
$TestID = $_POST['TestID'];
$TimesID = $_POST['TimesID'];
$StuWork = $_POST['StuWork'];
$Score = $_POST['Score'];

$connection = [
    "Database" => $database,
    "Uid" => $uid,
    "PWD" => $pass
];

$conn = sqlsrv_connect($serverName, $connection);
if(!$conn)
    die(print_r(sqlsrv_errors(),true));
else{
    $tsql = "INSERT INTO StuWork (StuID, TestID, TimesID, StuWork, Score) VALUES ('$StuID', $TestID, $TimesID, '$StuWork', $Score);";
    $stmt = sqlsrv_query($conn,$tsql);
    if($stmt == false){
        $errors = sqlsrv_errors();
        if ($errors != null) {
            echo "Bai lam da ton tai hoac gap loi ket noi" ."<br>";
            $targetUrl = "updatemissing.php";
            $linkText = "Di den danh sach bai lam";
            echo "<a href='$targetUrl'>$linkText</a>";
        }
    }else {
        echo 'Them bai lam thanh cong'."\n";
        $targetUrl = "updatemissing.php";
        $linkText = "Di den danh sach bai lam";
        echo "<a href='$targetUrl'>$linkText</a>";
    }
}
$conn = null;
?>