<?php
$serverName = "SKEHJHJ";
$database = "lms";
$uid = "";
$pass = "";

$ProfID = $_POST['ProfID'];

$connection = [
    "Database" => $database,
    "Uid" => $uid,
    "PWD" => $pass
];

$conn = sqlsrv_connect($serverName, $connection);
if(!$conn)
    die(print_r(sqlsrv_errors(),true));
else{
    $tsql = "DELETE FROM Professor where Professor.ProfID = '$ProfID';
                DELETE FROM UserTable where UserTable.userID= '$ProfID';";
    $stmt = sqlsrv_query($conn,$tsql);
    if($stmt == false){
        echo "Khong the xoa giang vien nay";
    }else {
        echo 'Xoa giang vien thanh cong'."\n";
        $targetUrl = "professors.php";
        $linkText = "Di den danh sach giang vien"; // Text displayed on the link
        echo "<a href='$targetUrl'>$linkText</a>";
    }
}
$conn = null;
?>