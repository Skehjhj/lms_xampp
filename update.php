<?php
$serverName = "SKEHJHJ";
$database = "lms";
$uid = "";
$pass = "";

$ProfID = $_POST['ProfID'];
$Degree = $_POST['Degree'];

$connection = [
    "Database" => $database,
    "Uid" => $uid,
    "PWD" => $pass
];

$conn = sqlsrv_connect($serverName, $connection);
if(!$conn)
    die(print_r(sqlsrv_errors(),true));
else{
    $tsql = "EXEC UpdateProfessorDegree '$ProfID', '$Degree'";
    $stmt = sqlsrv_query($conn,$tsql);
    if($stmt == false){
        echo "Loi cap nhat giang vien (Ma giang vien khong hop le)";
    }else {
        echo 'Cap nhat bang cap cho giang vien thanh cong'."\n";
        $targetUrl = "professors.php";
        $linkText = "Di den danh sach giang vien"; // Text displayed on the link
        echo "<a href='$targetUrl'>$linkText</a>";
    }
}
$conn = null;
?>